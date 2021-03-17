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

    def createwallet(self, wallet_name):
        commands = [ ["createwallet", DATADIR+BTC_WALLET_DIR+wallet_name] ]
        create = self.rpc_connection.batch_(commands)
        print(create)

    def _loadwallet(self, wallet_name, wallet_password=None):
        commands = [ ["loadwallet", DATADIR+BTC_WALLET_DIR+wallet_name] ]
        load = self.rpc_connection.batch_(commands)
        print('loaded', load)

    def _unloadwallet(self, wallet_name):
        commands = [ ["unloadwallet", DATADIR+BTC_WALLET_DIR+wallet_name] ]
        unload = self.rpc_connection.batch_(commands)
        print(unload)

    def getbalance(self, wallet_name, minconf=0):
        print(self._loadwallet(wallet_name))
        commands = [ ["getbalance", "*", minconf] ]
        balance = self.rpc_connection.batch_(commands)
        self._unloadwallet(wallet_name)
        print(balance[0])
        return balance[0]

    def sendtoaddress(self, tx_wallet_name, rx_address, amount, wallet_password=None):
        self._loadwallet(tx_wallet_name)
        commands = [ ["sendtoaddress", rx_address, amount, '', '', True ]]
        try:
            send = self.rpc_connection.batch_(commands)
        except JSONRPCException as e:
            self._unloadwallet(tx_wallet_name)
            print(str(e))
            return str(e)
        self._unloadwallet(tx_wallet_name)
        print(send)
        return True

    def getnewaddress(self, wallet_name):
        self._loadwallet(wallet_name)
        commands = [["getnewaddress"]]
        getnew = self.rpc_connection.batch_(commands)
        self._unloadwallet(wallet_name)
        print(getnew[0])
        return getnew[0]

    def listtransactions(self, wallet_name):
        self._loadwallet(wallet_name)
        commands = [["listtransactions"]]
        transactions = self.rpc_connection.batch_(commands)
        self._unloadwallet(wallet_name)
        return transactions

    def getunconfirmedbalance(self, wallet_name):
        self._loadwallet(wallet_name)
        commands = [["getunconfirmedbalance"]]
        balance_unconf = self.rpc_connection.batch_(commands)
        self._unloadwallet(wallet_name)
        print(balance_unconf[0])
        return balance_unconf[0]

# commands = [ ["createrawtransaction", [{"txid":"6dbe0e53413df27183e959922f9df859ea7646b574aafcef446e33978df97f15","vout":31}], [{"bc1q6j9td6m5g6ah8cgscm7wqjuxlrs6kakzadcrh4":amount}]] ]
# block_hashes = rpc_connection.batch_(commands)
# print(block_hashes[0])
#
# commands = [ ["decoderawtransaction", block_hashes[0]] ]
# decode = rpc_connection.batch_(commands)
# print(decode)
# scriptPubkey = decode[0]['vout'][0]['scriptPubKey']['hex']
# print(scriptPubkey)
#
# commands = [ ["loadwallet", "C:\\Users\\GEruo\\AppData\\Roaming\\Bitcoin\\wallets\\customer"] ]
# load = rpc_connection.batch_(commands)
# print(load)
#
# commands = [ ["signrawtransactionwithwallet", block_hashes[0]] ]
# signed = rpc_connection.batch_(commands)
# print('signed:', signed)
#
# commands = [ ["decoderawtransaction", block_hashes[0]] ]
# decode = rpc_connection.batch_(commands)
# print(decode)
#
# print(signed[0]['hex'])
# commands = [ ["sendrawtransaction", signed[0]['hex']] ]
# sent = rpc_connection.batch_(commands)
# print(sent)