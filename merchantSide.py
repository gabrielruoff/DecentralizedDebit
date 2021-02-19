import binascii
import os
from dotenv import load_dotenv
from lib.Transaction import transaction
from lib import socks
from lib import MySqlBackend
from lib.HardwareSerial import arduino
from decimal import Decimal
import time
import requests
import json


# load .env
load_dotenv()
# set env variables
DATADIR = os.environ.get("DATADIR")
MASTER_KEY_PREF = os.environ.get("MASTER_KEY_PREF")
MASTER_KEY_DIR = os.environ.get("MASTER_KEY_DIR")
KEY_PRIV_SUFFIX = os.environ.get("KEY_PRIV_SUFFIX")
MASTER_KEY_PASS = os.environ.get("MASTER_KEY_PASS")
KEY_PUB_SUFFIX = os.environ.get("KEY_PUB_SUFFIX")

# merchant wallet info
merchant = 'merchant'

print('-----MerchantSide-----\nstarting payment terminal...\nwelcome merchant: ' + merchant)

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
        tx = transaction(merchant, tx_data, amount, currency, (DATADIR+MASTER_KEY_DIR+MASTER_KEY_PREF+KEY_PUB_SUFFIX, ''))
        # sign transaction with merchant private key
        # lookup merchant private key dir
        with MySqlBackend._backend() as b:
            priv_sign_key = b._get_merchant_priv_signkey_from_username(merchant)
            print(priv_sign_key)
        tx.sign(merchant, priv_sign_key, 'c1f6d02ff25690934e22aba3d44cd60727f34ed01dfa72bd0784e602')
        # print it to terminal
        print('\nbuilt transaction:')
        tx.print_tx()

        url = "http://localhost:5000/Merchant/merchant"
        data = {'method': 'submittransaction', 'body': {
            'rx_data': tx.rx_data,
            'tx_data': tx.tx_data,
            'signed_hash': tx.signed_hash,
            'signer': merchant, 'password': 'tet2'}}
        headers = {'Content-type': 'application/json', 'Accept': 'text/plain'}

        r = requests.post(url, data=json.dumps(data), headers=headers)

        print(r.json())

        # tximport = transaction(tx.rx_data, tx.tx_data, tx.signed_hash, tx.signer, importtx=True)
        # tx.print_tx()

        # # try and connect to to the server
        # print('waiting for a response to export to server')
        # while 1:
        #     try:
        #         sock_client.connect('127.0.0.1', 12001)
        #         # sock_client.send(sock_server.addr+':'+str(sock_server.port))
        #         break
        #     except ConnectionRefusedError:
        #         pass
        # # wait for a socket connection
        # # accepted = sock_server.accept()
        # # while not accepted:
        # #     accepted = sock_server.accept()
        # #
        # # print(sock_server.conn.getsockname)
        #
        # # export transaction
        # print('exporting transaction')
        # tx.export(sock_client)

        sock_client.sock.close()