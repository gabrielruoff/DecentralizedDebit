import os
import subprocess
from decimal import Decimal

from monero.wallet import Wallet
from monero.backends.jsonrpc import JSONRPCWallet
from lib.Crypt import RSAcrypt
from lib.Serial import arduino
from lib.socks import server


class transaction:

    def __new__(cls, *args, importtx=False):

        cls.rsacrypt = RSAcrypt()
        cls.args = args

        # if we are importing a transaction, verify and process it before creating the transaction instance
        if importtx:
            # set vars
            cls.rx_data, cls.tx_data, cls.signed_hash, cls.sign_key = [args[i] for i in range(len(args))]
            # set key
            cls.rsacrypt.set_key(cls.sign_key)

            # first, verify the hash
            if cls.verify(transaction):
                print('verified hash')

                # set args to be fed into default constructor
                cls.args = [cls.rx_data, cls.tx_data, None, cls.sign_key]

            else:
                print('invalid hash')
                raise Exception

        # extract variables from args
        cls.rx_data, cls.tx_data, cls.amount, cls.keyfile = map(str, cls.args)
        # make class instance
        return super(transaction, cls).__new__(cls)

    def __init__(self, *args, importtx=False):

        # delineator
        self.delineator = ':'

        # if this is a new transaction, encrypt it
        if not importtx:
            # import key
            self.rsacrypt.set_key(self.keyfile)

            # encrypt rx data string
            self.rx_data = self.rsacrypt.encrypt(self.rx_data + self.delineator + str(self.amount))
            self.signed_hash = None

        # initialize vars for decrypted data
        self.wallet_name_decrypt = None
        self.wallet_pass_decrypt = None
        self.rx_address_decrypt = None
        self.amount_decrypt = None

    def sign(self, keyfile, code):
        # import the key
        self.rsacrypt.set_key(keyfile, code=code)
        # sign a hash of rx_data+tx_data
        self.signed_hash = self.rsacrypt.sign(self.rx_data+self.tx_data, self.rsacrypt.key)
        self.sign_key = self.rsacrypt.key.publickey().exportKey()

    def verify(self):
        return self.rsacrypt.verify((self.rx_data+self.tx_data), self.rsacrypt.key, self.signed_hash)

    def sock_import(self, sock_client):
        print('importing transaction from ' + str(sock_client.conn.getpeername()))
        imported_tx = []
        for i in range(4):
            imported_tx.append(bytes(sock_client.receive()))
        # return a transaction instance re-built from imported data
        return transaction(*imported_tx, importtx=True)

    def export(self, sock_server):
        for item in [self.rx_data, self.tx_data, self.signed_hash, self.sign_key]:
            if not sock_server.send(item):
                return False
        return True

    # decrypt transaction data
    def decrypt(self, privatekey, code=''):

        # set private key
        self.rsacrypt.set_key(privatekey, code=code)

        # decrypt the data
        _rx_data, _tx_data = self.rsacrypt.decrypt(self.rx_data[2:-1]).split(':'), self.rsacrypt.decrypt(self.tx_data[2:-1]).split(':')

        # unpack data
        self.wallet_name_decrypt, self.wallet_pass_decrypt = [_tx_data[i] for i in range(2)]
        self.rx_address_decrypt, self.amount_decrypt = [_rx_data[i] for i in range(2)]

    def print_signed_hash(self):
        print(self.signed_hash)

    def print_tx(self):
        print('transaction details:')
        print('\tencrypted tx info: '+self.tx_data)
        print('\tencrypted rx info: '+self.rx_data)
        if self.signed_hash is not None:
            print('\tsigned hash: '+ str(self.signed_hash))
            print('\tsigned by: '+ str(self.sign_key))
        else:
            print('\tthis transaction is not yet signed')


class monerod:

    def __init__(self):
        self.daemon = None
        self.bind_address = "127.0.0.1"
        self.bind_port = 18081

    def start_daemon(self):
        self.daemon = subprocess.Popen(['C:\\Users\\GEruo\\Dropbox\\Crypto Terminal\\lib\\start-daemon.bat'], stdout=subprocess.PIPE, stderr=open(os.devnull, 'w'))

    def kill_daemon(self):
        os.kill(self.daemon.pid, 0)

    def waitforrefresh(self):
        # wait for the refresh to finish
        for line in iter(self.daemon.stdout.readline, b''):
            print(line)
            if b'You are now synchronized with the network' in line:
                break
        return True

    def dump(self, lines=100):
        for i, line in enumerate(iter(self.daemon.stdout.readline, b'')):
            if i > lines:
                break
            print(line)
            i+=1
        self.daemon.stdout.flush()


class multiwallet:

    def __init__(self, basepath):

        if basepath[-1] != '/':
            basepath += '/'
        self.dir = basepath

    def path(self, wallet):
        return self.dir+wallet+'/'+wallet

    def public_comm_key(self, wallet, keyfilename='my_rsa_public.pem'):
        return self.dir+wallet+'/'+keyfilename

    def private_key(self, wallet, keyfilename='my_private_rsa_key.bin'):
        return self.dir+wallet+'/'+keyfilename


class rpc_wallet:

    def __init__(self, daemon_port, bind_addr, bind_port, transaction):
        self.daemon_port = daemon_port
        self.wallet_name = transaction.wallet_name_decrypt
        self.wallet_pass = transaction.wallet_pass_decrypt
        self.bind_addr = bind_addr
        self.bind_port = bind_port

        self.rpc = None
        self.wallet = None
        self.tx_success_hash = None
        self.transaction = transaction
        self.multiwallet = multiwallet('C:/Users/GEruo/Documents/Monero/wallets/')

    def open(self, waitforrefresh=False):
        # open the rpc wallet
        self.rpc = subprocess.Popen(['C:\\Users\\GEruo\\Dropbox\\Crypto Terminal\\lib\\start-rpc-server.bat', self.multiwallet.path(self.wallet_name), self.wallet_pass, self.bind_port], stdout=subprocess.PIPE, stderr=open(os.devnull, 'w'))

        if waitforrefresh:
            self.waitforrefresh()

    def kill(self):
        os.kill(self.rpc.pid, 0)

    def waitforrefresh(self):
        # wait for the refresh to finish
        for line in iter(self.rpc.stdout.readline, b''):
            print(line)
            if b'Refresh done' in line:
                break
        return True

    def connect(self):
        self.wallet = Wallet(JSONRPCWallet(port=self.bind_port))

    def transfer(self):
        print(self.transaction.rx_address_decrypt, Decimal(self.transaction.amount_decrypt))
        self.tx_success_hash = self.wallet.transfer("42eKczsBGi5TXjpnHEovnk9R4YbZMBT6MFqfyhiTYEUUjWBepy5vPSYhK4N1Tr79nNgZAz4aqHj47VSukPkA4nWqBt36HjW", Decimal(0.0001))
        # self.tx_success_hash = self.wallet.transfer(self.transaction.rx_address_decrypt, Decimal(self.transaction.amount_decrypt))
        print('tx hash:')
        print(self.tx_success_hash)

    # def load_transaction(self, tx):
    #     # parse wallet name and password from transaction
    #     self.transaction = tx.rx_address, tx.tx_data.split('.'), tx.amount
    #
    # def execute_transaction(self):
    #     if self.transaction is not None and self.wallet is not None and self.waitforrefresh():
    #         self.wallet.transfer



# rsacrypt = RSAcrypt()
# rsacrypt.gen_key('code', path='merchants/test/')

# rx_address = 'rx'
# tx_data = 'acct.pass'
# amount = 5
#
# tx = transaction(rx_address, tx_data, amount, 'merchants/test/my_private_rsa_key.bin')
# tx.sign()
# tx.print_tx()
#
# tximport = transaction(tx.transaction, tx.sign_key, 'merchants/test/my_private_rsa_key.bin', tx.signed_hash, importtx=True)
# tximport.print_tx()

# # connect to arduino
# arduino = arduino()
# arduino.connect("COM3")
# import time
# time.sleep(3)
#
# rx_address = '42eKczsBGi5TXjpnHEovnk9R4YbZMBT6MFqfyhiTYEUUjWBepy5vPSYhK4N1Tr79nNgZAz4aqHj47VSukPkA4nWqBt36HjW'
# tx_data = arduino.read_card_data()
# amount = 5
#
# tx = transaction(rx_address, tx_data, amount, 'C:/Users/GEruo/Documents/Monero/wallets/merchant/my_private_rsa_key.bin')
# tx.sign()
# tx.print_tx(enc=True)
#
# # tximport = transaction(tx.rx_data, tx.tx_data, tx.signed_hash, tx.sign_key, importtx=True)
# # tx.print_tx(enc=True)
#
# s = server(bind=True)
#
# # wait for a connection
# while not s.accept():
#     s.accept()
#
# tx.export(s)

# verify
# multiwallet = multiwallet('C:/Users/GEruo/Documents/Monero/wallets/')
# tx = transaction(tx.transaction, multiwallet.public_comm_key(tx_data.split('.')[0]), 'merchants/test/my_private_rsa_key.bin', tx.signed_hash, importtx=True)

# print('starting daemon')
# monerod = monerod()
# monerod.start_daemon()
# monerod.waitforrefresh()
#
# rpcwallet = rpc_wallet(monerod.bind_port, "localhost", "28081", tx)
# rpcwallet.open()
# rpcwallet.waitforrefresh()
# rpcwallet.connect()
#
# rpcwallet.transfer()
#
# rpcwallet.kill()
# monerod.kill_daemon()