# Gabriel Ruoff, geruoff@syr.edu
# Backend class to handle direct calls to the bitcoin RPC server

from bitcoinrpc.authproxy import AuthServiceProxy, JSONRPCException
from dotenv import load_dotenv
import os

# load .env
load_dotenv()
# set env variables
BTC_RPC_USER = os.environ.get("BTC_RPC_USER")
BTC_RPC_PASS = os.environ.get("BTC_RPC_PASS")
BTC_WALLET_DIR = os.environ.get("BTC_WALLET_DIR")
DATADIR = os.environ.get("DATADIR")

class bitcoinrpc:

    def __init__(self):

        # rpc_user and rpc_password are set in the bitcoin.conf file
        self.rpc_connection = AuthServiceProxy("http://%s:%s@71.176.66.122:8332"%(BTC_RPC_USER, BTC_RPC_PASS))
        self.walletname = 'core'

    def _loadwallet(self, wallet_password=None):
        commands = [ ["loadwallet", DATADIR+BTC_WALLET_DIR+self.walletname] ]
        load = self.rpc_connection.batch_(commands)
        print('loaded', load)

    def _unloadwallet(self):
        commands = [ ["unloadwallet", DATADIR+BTC_WALLET_DIR+self.walletname] ]
        unload = self.rpc_connection.batch_(commands)
        print(unload)

    def getcorebalance(self, minconf=0):
        print(self._loadwallet(self.walletname))
        commands = [ ["getbalance", "*", minconf] ]
        balance = self.rpc_connection.batch_(commands)
        self._unloadwallet(self.walletname)
        print(balance[0])
        return balance[0]

    def sendtoaddress(self, rx_address, amount, wallet_password=None):
        self._loadwallet(self.walletname)
        commands = [ ["sendtoaddress", rx_address, amount, '', '', True ]]
        try:
            send = self.rpc_connection.batch_(commands)
        except JSONRPCException as e:
            self._unloadwallet(self.walletname)
            print(str(e))
            return str(e)
        self._unloadwallet(self.walletname)
        print(send)
        return True

    def getnewcoreaddress(self):
        self._loadwallet(self.walletname)
        commands = [["getnewaddress"]]
        getnew = self.rpc_connection.batch_(commands)
        self._unloadwallet(self.walletname)
        print(getnew[0])
        return getnew[0]

    def listcoretransactions(self):
        self._loadwallet(self.walletname)
        commands = [["listtransactions"]]
        transactions = self.rpc_connection.batch_(commands)
        self._unloadwallet(self.walletname)
        return transactions

    def getunconfirmedcorebalance(self, wallet_name):
        self._loadwallet(wallet_name)
        commands = [["getunconfirmedbalance"]]
        balance_unconf = self.rpc_connection.batch_(commands)
        self._unloadwallet(self.walletname)
        print(balance_unconf[0])
        return balance_unconf[0]
