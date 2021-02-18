from lib import socks
from lib.Monero import transaction
from lib.HardwareSerial import arduino
from lib.Monero import multiwallet
from decimal import Decimal
import time

# make a wallet handler
multiwallet = multiwallet('C:/Users/GEruo/Documents/Monero/wallets/')

# merchant wallet info
merchant_wallet = 'merchant'
rx_address = 'rx'
print('starting payment terminal | your merchant address is ' + rx_address)

# make a reader instance
cardreader = arduino()

instr = ''
while instr != 'exit':

    # start a socket server
    sock_client = socks.server()

    # get input
    instr = input('Enter transaction amount ')

    if instr != 'exit':

        # make sure the entered amount is a double
        try:
            amount = Decimal(instr)
        except TypeError:
            print('the entered amount is not a ')
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

        # build a transaction from this data
        tx = transaction(rx_address, tx_data, amount, multiwallet.public_comm_key(merchant_wallet))
        # sign transaction
        tx.sign(multiwallet.private_key('merchant'), 'code')
        # print it to terminal
        print('\nbuilt transaction:')
        tx.print_tx()

        # tximport = transaction(tx.rx_data, tx.tx_data, tx.signed_hash, tx.sign_key, importtx=True)
        # tx.print_tx(enc=True)

        # try and connect to to the server
        print('waiting for a response to export to server')
        while(1):
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