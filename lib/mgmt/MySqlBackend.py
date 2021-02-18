import mysql.connector
from dotenv import load_dotenv
import os
from hashlib import sha224
from lib import Bitcoin, Crypt

# load .env
load_dotenv()
# set env variables
DATADIR = os.environ.get("DATADIR")
MERCHANT_DATA = os.environ.get("MERCHANT_DATA")
BTC_WALLET_DIR = os.environ.get("BTC_WALLET_DIR")
XMR_WALLET_DIR = os.environ.get("XMR_WALLET_DIR")
MYSQL_DB = os.environ.get("MYSQL_DB")
MYSQL_HOST = os.environ.get("MYSQL_HOST")
MYSQL_USER = os.environ.get("MYSQL_USER")
MYSQL_PASS = os.environ.get("MYSQL_PASS")
MYSQL_TAB_USERS = os.environ.get("MYSQL_TAB_USERS")
MYSQL_TAB_BTCWALLETS = os.environ.get("MYSQL_TAB_BTCWALLETS")
MYSQL_TAB_XMRWALLETS = os.environ.get("MYSQL_TAB_XMRWALLETS")
KEY_PRIV_SUFFIX = os.environ.get("KEY_PRIV_SUFFIX")
KEY_PUB_SUFFIX = os.environ.get("KEY_PUB_SUFFIX")
MYSQL_TAB_TX_BLOCKCHAIN = os.environ.get("MYSQL_TAB_TX_BLOCKCHAIN")


class _backend:
    def __init__(self):
        self.cnx = mysql.connector.connect(user=MYSQL_USER, password=MYSQL_PASS,
                                      host=MYSQL_HOST,
                                      database='')

        self.btcrpc = Bitcoin.bitcoinrpc()
        self.rsacrypt = Crypt.RSAcrypt()

    ##########################################
    #           ACCOUNT FUNCTIONS            #
    ##########################################


    def _create_account(self, user, passwd, merchant=False):
        # see if this account exists
        if self._select(MYSQL_TAB_USERS, 'username', user):
            print('this username is taken')
            return False
        passwd = sha224(user.encode('utf-8')+passwd.encode('utf-8'))
        self._insert(MYSQL_TAB_USERS, ['username', 'passwd'], [user, passwd.hexdigest()])
        # if this is a merchant account
        if merchant:
            wallet_name = self._getwalletname(user)
            # create a keypair, use their account password as the code
            code = self._select('users', 'username', user, selection='passwd')[0]
            self.rsacrypt.gen_key(*code, wallet_name.hexdigest(), DATADIR+MERCHANT_DATA+wallet_name.hexdigest())
            # update the user as a merchant in the system

    ##########################################
    #           BITCOIN FUNCTIONS            #
    ##########################################

    def _create_wallet_btc(self, username):
        # create a wallet name by hashing the users uid and passwd
        wallet_name = self._getwalletname(username)
        print(wallet_name.hexdigest())
        # make sure this wallet doesn't exist. If it doesn't create it
        if not self._select('btcwallets', 'name', wallet_name.hexdigest()):
            self.btcrpc.createwallet(wallet_name.hexdigest())
            self.btcrpc.unloadwallet(wallet_name.hexdigest())
        else:
            print('this wallet already exists')
            return False
        # insert new wallet data into database - set balances to 0
        self._insert(MYSQL_TAB_BTCWALLETS, ['name', 'KEY_DIR', 'BALANCE_CONF', 'BALANCE_UNCONF'], [wallet_name.hexdigest(), (DATADIR+BTC_WALLET_DIR+wallet_name.hexdigest()).replace('\\', '\\\\'), 0, 0])

    def _update_balance_btc(self, username):
        # get the wallet name
        wallet_name = self._getwalletname(username)
        # retrieve the wallet's confirmed and unconfirmed balances
        balance_conf, balance_unconf = self.btcrpc.getbalance(wallet_name.hexdigest(), 10), self.btcrpc.getbalance(wallet_name.hexdigest())
        # update the database with these values
        return self._update('btcwallets', ['BALANCE_CONF', 'BALANCE_UNCONF'], [balance_conf, balance_unconf], 'name', wallet_name.hexdigest())

    def _get_new_address_btc(self, username):
        # get the wallet name
        wallet_name = self._getwalletname(username)
        # get the new address
        return self.btcrpc.getnewaddress(wallet_name.hexdigest())

    ##########################################
    #         TRANSACTION FUNCTIONS          #
    ##########################################

    def _check_transaction_is_original(self, tx):
        return not self._select(MYSQL_DB+'.'+MYSQL_TAB_TX_BLOCKCHAIN, 'hash', tx.signed_hash, selection='block_id')

    def _add_transaction_to_blockchain(self, tx):
        # get required data
        prev_hash = self._raw_query("SELECT prev_hash FROM " + MYSQL_DB+"."+MYSQL_TAB_TX_BLOCKCHAIN + " ORDER BY block_id DESC LIMIT 1")
        block_id = self._raw_query("SELECT COUNT(block_id) FROM " + MYSQL_DB+"."+MYSQL_TAB_TX_BLOCKCHAIN)[0][0] + 1
        hash = tx.signed_hash
        return self._insert(MYSQL_DB+"."+MYSQL_TAB_TX_BLOCKCHAIN, [prev_hash, block_id, hash], ['prev_hash', 'block_id', 'hash'])


    ##########################################
    #           HELPER FUNCTIONS            #
    ##########################################

    # helper function to get the wallet's name from a user's account name
    def _getwalletname(self, username):
        uid, passwd = self._select(MYSQL_TAB_USERS, "username", username, selection='uid, passwd')[0]
        return sha224(str(uid).encode('utf-8') + passwd.encode('utf-8'))

    # helper functions start with _
    def _select(self, table, field, target, suffix="", selection='*'):
        q = "SELECT %s FROM %s WHERE %s='%s'" + suffix
        d = (selection, (MYSQL_DB+'.'+table), field, target)
        print(q%d)
        cursor = self.cnx.cursor()
        cursor.execute(q % d)
        selected = cursor.fetchall()
        cursor.close()
        return selected

    def _insert(self, table, fields, data, suffix=""):
        q = "INSERT INTO %s (" + ("%s, "*(len(fields)-1)) + "%s) VALUES (" + ("'%s', "*(len(data)-1)) + "'%s') " + suffix
        d = (MYSQL_DB+'.'+table, *fields, *data)
        print(q%d)
        cursor = self.cnx.cursor()
        cursor.execute(q % d)
        self.cnx.commit()
        selected = cursor.fetchall()
        cursor.close()
        return selected

    def _update(self, table, fields, data, where, target, suffix=''):
        q = "UPDATE %s SET " + (("%s='%s', "*(len(fields)-1)) + "%s='%s'") + " WHERE %s='%s'" + suffix
        # list to store ordered field=data information for set clause
        fieldsdata = []
        while fields:
            fieldsdata.append(fields.pop(0))
            fieldsdata.append(data.pop(0))
        d = (MYSQL_DB+'.'+table, *fieldsdata, where, target)
        cursor = self.cnx.cursor()
        cursor.execute(q % d)
        self.cnx.commit()
        updated = cursor.fetchall()
        cursor.close()
        return updated

    def _raw_query(self, q):
        cursor = self.cnx.cursor()
        print(q)
        cursor.execute(q)
        if "SELECT" in q.upper():
            ret = cursor.fetchall()
        elif "INSERT" in q.upper():
            self.cnx.commit()
            ret = True
        cursor.close()
        return ret

bknd = _backend()
fields = ['username', 'passwd']
data = ['one', 'two']

# for i in range(10):
# print(bknd._insert('accounts.users', fields, data))
# print(bknd._select("users", "username", "one", selection='uid, passwd')[0])
# print(bknd._create_account('merchant', 'test2', merchant=True))
# print(bknd.update_balance_btc('test'))
# print(bknd.update_balance_btc('test'))
bknd._add_transaction_to_blockchain('hu')