import os
from dotenv import load_dotenv
from lib.Transaction import transaction
from lib import socks
from lib import MySqlBackend
from lib.HardwareSerial import arduino
from decimal import Decimal
import time
from pathlib import Path
import glob
from hashlib import sha224

# load .env
env_path = Path('.') / 'merchant.conf'
load_dotenv(dotenv_path=env_path)
# set env variables
DATADIR = os.getcwd()+'\\'
MASTER_KEY_PREF = os.environ.get("MASTER_KEY_PREF")
KEYDIR = os.environ.get("KEYDIR")
KEY_PRIV_SUFFIX = os.environ.get("KEY_PRIV_SUFFIX")
KEY_PUB_SUFFIX = os.environ.get("KEY_PUB_SUFFIX")

print('-----MerchantSide-----\nstarting payment terminal...')

# get merchant user and pass
merchant, passwd = input("\ninput merchant name and password (user, pass): ").split(',')
passwd = sha224(merchant.encode('utf-8')+passwd.encode('utf-8')).hexdigest().strip()

print('\nloading profile...\nwelcome merchant: ' + merchant)

# make a reader instance
cardreader = arduino()

instr = ''
while instr != 'exit':

    # start a socket server
    sock_client = socks.server()

    # get input
    instr = input('Enter a transaction (amount:currency) or \'exit\' to quit ')

    if instr != 'exit':

        # make sure the entered amount is a double
        try:
            amount, currency = (instr.split(':'))
            amount = Decimal(amount)
        except TypeError:
            print('the entered string is not a valid transaction')
            break
        print('transaction amount: ' + instr)

        # connect to the arduino
        print('connecting to reader')
        cardreader.connect("COM3")
        # wait for arduino to reboot
        time.sleep(3)

        print('\nplace card on reader')
        # read card data from the arduino
        tx_data = cardreader.read_card_data()
        # close connection to reader
        cardreader.close()

        # build a transaction from this data. Encrypt to server masterkey
        tx = transaction(merchant, tx_data, amount, currency, (DATADIR+KEYDIR+MASTER_KEY_PREF+KEY_PUB_SUFFIX, ''))
        # sign transaction with merchant private key
        # lookup merchant private key dir
        with MySqlBackend._backend() as b:
            priv_sign_key = glob.glob('keys/*'+KEY_PRIV_SUFFIX)[0]
            print(priv_sign_key)
        tx.sign(merchant, priv_sign_key, passwd)
        # print it to terminal
        print('\nbuilt transaction:')
        tx.print_tx()

        # tximport = transaction(tx.rx_data, tx.tx_data, tx.signed_hash, tx.sign_key, importtx=True)
        # tx.print_tx(enc=True)

        # try and connect to to the server
        print('waiting for a response to export to server')
        while 1:
            try:
                sock_client.connect('127.0.0.1', 12001)
                # sock_client.send(sock_server.addr+':'+str(sock_server.port))
                break
            except ConnectionRefusedError:
                pass
        # wait for a socket connection
        # accepted = sock_server.accept()
        # while not accepted:
        #     accepted = sock_server.accept()
        #
        # print(sock_server.conn.getsockname)

        # export transaction
        print('exporting transaction')
        tx.export(sock_client)

        sock_client.sock.close()
