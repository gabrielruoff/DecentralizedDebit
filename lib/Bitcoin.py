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
        self.rpc_connection = AuthServiceProxy("http://%s:%s@127.0.0.1:8332"%(BTC_RPC_USER, BTC_RPC_PASS))

    def createwallet(self, wallet_name):
        commands = [ ["createwallet", DATADIR+BTC_WALLET_DIR+wallet_name] ]
        create = self.rpc_connection.batch_(commands)
        print(create)

    def loadwallet(self, wallet_name):
        commands = [ ["loadwallet", DATADIR+BTC_WALLET_DIR+wallet_name] ]
        load = self.rpc_connection.batch_(commands)
        print(load)

    def unloadwallet(self, wallet_name):
        commands = [ ["unloadwallet", DATADIR+BTC_WALLET_DIR+wallet_name] ]
        unload = self.rpc_connection.batch_(commands)
        print(unload)

    def getbalance(self, wallet_name, minconf=0):
        self.loadwallet(wallet_name)
        commands = [ ["getbalance", "*", minconf] ]
        balance = self.rpc_connection.batch_(commands)
        self.unloadwallet(wallet_name)
        print(balance[0])
        return balance[0]

    def sendtoaddress(self, rx, amount):
        commands = [ ["sendtoaddress", rx, amount ]]
        send = self.rpc_connection.batch_(commands)
        print(send)

    def getnewaddress(self, wallet_name):
        self.loadwallet(wallet_name)
        commands = [["getnewaddress"]]
        getnew = self.rpc_connection.batch_(commands)
        self.unloadwallet(wallet_name)
        print(getnew[0])
        return getnew[0]


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