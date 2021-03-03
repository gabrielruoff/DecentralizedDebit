# Gabriel Ruoff, geruoff@syr.edu
# Backend class to handle direct calls to the monero RPC server

import os
import subprocess
from decimal import Decimal
from monero.wallet import Wallet
from monero.backends.jsonrpc import JSONRPCWallet
from dotenv import load_dotenv
import os

# load .env
load_dotenv()
# set env variables
BTC_RPC_USER = os.environ.get("BTC_RPC_USER")
BTC_RPC_PASS = os.environ.get("BTC_RPC_PASS")
XMR_WALLET_DIR = os.environ.get("XMR_WALLET_DIR")
DATADIR = os.environ.get("DATADIR")

class monerorpc:

    def __init__(self):
        self.bind_port = 28089

    def _loadwallet(self, wallet_name, wallet_password):
        # open the rpc wallet
        self.rpc = subprocess.Popen([DATADIR+'lib\\start-rpc-server.bat', DATADIR+XMR_WALLET_DIR+wallet_name, wallet_password, self.bind_port], stdout=subprocess.PIPE, stderr=open(os.devnull, 'w'))
        self.wallet = Wallet(JSONRPCWallet(port=self.bind_port))

    def _unloadwallet(self):
        os.kill(self.rpc.pid, 0)

    def waitforrefresh(self):
        # wait for the refresh to finish
        for line in iter(self.rpc.stdout.readline, b''):
            print(line)
            if b'Refresh done' in line:
                break
        return True

    def sendtoaddress(self, tx_wallet_name, rx, amount, wallet_password):
        self._loadwallet(tx_wallet_name, wallet_password=wallet_password)
        amount *= 10e12
        try:
            send = self.wallet.transfer(rx, amount, 0)
        except Exception as e:
            return False
        self._unloadwallet()
        print(send)
        return True


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
