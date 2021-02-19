# Gabriel Ruoff, geruoff@syr.edu
# Backend class to handle low-level database calls as well as database and wallet helper functions
import binascii

import mysql.connector
from dotenv import load_dotenv
import os
from hashlib import sha224
from lib import Bitcoin, Crypt, Monero, Transaction

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
MASTER_KEY_DIR = os.environ.get("MASTER_KEY_DIR")
MASTER_KEY_PREF = os.environ.get("MASTER_KEY_PREF")
MASTER_KEY_PASS = os.environ.get("MASTER_KEY_PASS")


class _backend:
    def __init__(self):
        self.cnx = mysql.connector.connect(user=MYSQL_USER, password=MYSQL_PASS,
                                           host=MYSQL_HOST,
                                           database='')

        self.btcrpc = Bitcoin.bitcoinrpc()
        self.rsacrypt = Crypt.RSAcrypt()

    def __enter__(self):
        return self

    def __exit__(self, exc_type, exc_val, exc_tb):
        self.cnx.close()

    ##########################################
    #           ACCOUNT FUNCTIONS            #
    ##########################################

    def _create_account(self, user, passwd, merchant=False):
        # see if this account exists
        if self._select(MYSQL_TAB_USERS, 'username', user):
            return self._build_api_response('false', 'accountexists')

        passwd = sha224(user.encode('utf-8') + passwd.encode('utf-8')).hexdigest()
        self._insert(MYSQL_TAB_USERS, ['username', 'passwd', 'is_merchant'], [user, passwd, 0])
        # if this is a merchant account
        if merchant:
            wallet_name = self._getwalletname(user)
            # create a keypair, use their account password as the code
            code = self._select('users', 'username', user, selection='passwd')[0]
            self.rsacrypt.gen_key(*code, wallet_name, DATADIR + MERCHANT_DATA)
            # update the user as a merchant in the system
            self._update(MYSQL_TAB_USERS, ['is_merchant'], [1], 'username', user)

        return self._build_api_response('true', '', "'user':'%s'," % user)

    def _become_merchant(self, user):
        # make sure they aren't already a merchant
        if not self._select(MYSQL_TAB_USERS, 'is_merchant', '1'):
            print('making user ' + user + ' a merchant')
            wallet_name = self._getwalletname(user)
            # create a keypair, use their account password as the code
            code = self._select('users', 'username', user, selection='passwd')[0]
            self.rsacrypt.gen_key(*code, wallet_name, DATADIR + MERCHANT_DATA)
            # update the user as a merchant in the system
            self._update(MYSQL_TAB_USERS, ['is_merchant'], [1], 'username', user, suffix=(' AND passwd=' + code))
            return self._build_api_response('true', err='', data="'username':%s," % user)

        return self._build_api_response('false', 'alreadymerchant')

    ##########################################
    #           BITCOIN FUNCTIONS            #
    ##########################################

    def _create_wallet_btc(self, username):
        # create a wallet name by hashing the users uid and passwd
        wallet_name = self._getwalletname(username)
        # make sure this wallet doesn't exist. If it doesn't create it
        if not self._select('btcwallets', 'name', wallet_name):
            self.btcrpc.createwallet(wallet_name)
            self.btcrpc._unloadwallet(wallet_name)
        else:
            print('this wallet already exists')
            return self._build_api_response('false', 'walletexists')
        # insert new wallet data into database - set balances to 0
        if self._insert(MYSQL_TAB_BTCWALLETS, ['name', 'KEY_DIR', 'BALANCE_CONF', 'BALANCE_UNCONF'],
                        [wallet_name, (DATADIR + BTC_WALLET_DIR + wallet_name).replace('\\', '\\\\'), 0, 0]):
            print('inserted wallet data')
            return self._build_api_response('True')
        return self._build_api_response('False', err='genericapierror')

    def _update_balance_btc(self, username):
        # get the wallet name
        wallet_name = self._getwalletname(username)
        # retrieve the wallet's confirmed and unconfirmed balances
        balance_conf, balance_unconf = self.btcrpc.getbalance(wallet_name, 10), self.btcrpc.getbalance(wallet_name)
        # update the database with these values
        if self._update('btcwallets', ['BALANCE_CONF', 'BALANCE_UNCONF'], [balance_conf, balance_unconf], 'name',
                        wallet_name):
            return self._build_api_response('True', data="'balance_conf':%s, 'balance_unconf':%s," % (
            balance_conf, balance_unconf))
        return self._build_api_response('False', err='genericapierror')

    def _get_new_address_btc(self, username):
        # get the wallet name
        wallet_name = self._getwalletname(username)
        # get the new address
        new_address = self.btcrpc.getnewaddress(wallet_name)
        if not new_address:
            return self._build_api_response('False', err='generic')
        # this function is special because in certain cases we want the raw address returned.
        # The api handler converts this output into a boolean
        return new_address

    ##########################################
    #         TRANSACTION FUNCTIONS          #
    ##########################################

    # takes a transaction as input and processes it and adds it to the transaction blockchain
    def process_transaction(self, tx):
        # check that the transaction is verified
        if not tx.verified:
            return self._build_api_response('False', err='invalid hash')
        # check that this transaction is not a duplicate
        if self._check_transaction_is_original(tx):
            print(tx.rx_account_id_decrypt)
            txwallet, rxwallet = self._getwalletname(tx.tx_account_id_decrypt), self._getwalletname(tx.rx_account_id_decrypt)
            amount, currency = tx.amount_decrypt, tx.currency_decrypt

            # select a coin backend depending on the currency in question
            if currency.lower() == 'btc':
                coin_backend = Bitcoin.bitcoinrpc()
            elif currency.lower() == 'xmr':
                coin_backend = Monero.monerorpc()

            # make a new receiving address
            new_rx_address = coin_backend.getnewaddress(rxwallet)
            print('created new rx address ' + new_rx_address)
            # execute the transfer
            if coin_backend.sendtoaddress(txwallet, new_rx_address, amount):
                # add transaction to blockchain
                self._add_transaction_to_blockchain(tx)
                return self._build_api_response('True')
            else:
                return self._build_api_response('False', 'rpcerror')

        return self._build_api_response('False', err='duplicatetransaction')

    # imports a transaction from  rx_data, tx_data, signed_hash, password, and signer (username) and returns it
    def _import_transaction_from_raw_data(self, rx_data, tx_data, signed_hash, password, signer):
        print('signer' + signer)
        args = [rx_data, tx_data, signed_hash, password, signer]
        return Transaction.transaction(*args, importtx=True)

    # Transaction-blockchain Functions #
    def _check_transaction_is_original(self, tx):
        print(sha224(binascii.unhexlify(tx.signed_hash)).hexdigest())
        # print(self._select(MYSQL_TAB_TX_BLOCKCHAIN, 'hash', sha224(binascii.unhexlify(tx.signed_hash).hexdigest(), selection='block_id')))
        return not self._select(MYSQL_TAB_TX_BLOCKCHAIN, 'hash', sha224(binascii.unhexlify(tx.signed_hash)).hexdigest(), selection='block_id')

    def _add_transaction_to_blockchain(self, tx):
        # get required data
        block_id = self._raw_query("SELECT COUNT(block_id) FROM " + MYSQL_DB + "." + MYSQL_TAB_TX_BLOCKCHAIN)[0][0] + 1
        prev_hash = self._raw_query(
            "SELECT hash, block_id FROM " + MYSQL_DB + "." + MYSQL_TAB_TX_BLOCKCHAIN + " ORDER BY block_id DESC LIMIT 1")[0]
        prev_hash = sha224(prev_hash[0]+prev_hash[1])
        print(prev_hash)
        this_hash = sha224(binascii.unhexlify(tx.signed_hash).hexdigest())
        return self._insert(MYSQL_TAB_TX_BLOCKCHAIN, ['prev_hash', 'block_id', 'hash'], [prev_hash, block_id, this_hash])

    ##########################################
    #           HELPER FUNCTIONS            #
    ##########################################

    def _build_api_response(self, success, err="", data=""):
        return eval("{'success':'%s', %s 'err':'%s'}" % (success, data, err))

    def _validate_user_credentials(self, username, password):
        passwd = sha224(username.encode('utf-8') + password.encode('utf-8')).hexdigest()
        print(passwd, self._select(MYSQL_TAB_USERS, 'username', username, selection='passwd')[0][0])
        return self._select(MYSQL_TAB_USERS, 'username', username, selection='passwd')[0][0].strip() == passwd.strip()

    def _get_merchant_pub_signkey_from_username(self, username):
        print(username)
        walletname = self._getwalletname(username)
        return DATADIR + MERCHANT_DATA + walletname + '\\' + walletname + KEY_PUB_SUFFIX

    def _get_merchant_priv_signkey_from_username(self, username):
        walletname = self._getwalletname(username)
        return DATADIR + MERCHANT_DATA + walletname + '\\' + walletname + KEY_PRIV_SUFFIX

    def _get_merchant_username_from_keyfile(self, key_file_path):
        return key_file_path.split('\\')[-2]

    def _get_master_priv_keyfile(self):
        return DATADIR+MASTER_KEY_DIR+MASTER_KEY_PREF+KEY_PRIV_SUFFIX

    def _get_master_key_pass(self):
        return MASTER_KEY_PASS

    # helper function to get the wallet's name from a user's account name
    def _getwalletname(self, username):
        uid, passwd = self._select(MYSQL_TAB_USERS, "username", username, selection='uid, passwd')[0]
        # wallet name is chars 16-64 of the hashed uid and password
        return sha224(str(uid).encode('utf-8') + passwd.encode('utf-8')).hexdigest()[16:64]

    # helper functions start with _
    def _select(self, table, match_field, match_target, suffix="", selection='*'):
        q = "SELECT %s FROM %s WHERE %s='%s'" + suffix
        d = (selection, (MYSQL_DB + '.' + table), match_field, match_target)
        print(q % d)
        cursor = self.cnx.cursor()
        cursor.execute(q % d)
        selected = cursor.fetchall()
        cursor.close()
        return selected

    def _insert(self, table, fields, data, suffix=""):
        q = "INSERT INTO %s (" + ("%s, " * (len(fields) - 1)) + "%s) VALUES (" + (
                    "'%s', " * (len(data) - 1)) + "'%s') " + suffix
        d = (MYSQL_DB + '.' + table, *fields, *data)
        print(q % d)
        cursor = self.cnx.cursor()
        cursor.execute(q % d)
        self.cnx.commit()
        cursor.close()
        return True

    def _update(self, table, fields, data, where, target, suffix=''):
        q = "UPDATE %s SET " + (("%s='%s', " * (len(fields) - 1)) + "%s='%s'") + " WHERE %s='%s'" + suffix
        # list to store ordered field=data information for set clause
        fieldsdata = []
        while fields:
            fieldsdata.append(fields.pop(0))
            fieldsdata.append(data.pop(0))
        d = (MYSQL_DB + '.' + table, *fieldsdata, where, target)
        cursor = self.cnx.cursor()
        print(q % d)
        cursor.execute(q % d)
        self.cnx.commit()
        updated = cursor.fetchall()
        cursor.close()
        return True

    # helper function for a generic query
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

# print(bknd._create_account('customer', 'test2', merchant=False))
# print(bknd._create_account('merchant', 'test2', merchant=True))
# bknd._create_wallet_btc('merchant')
# bknd._create_wallet_btc('customer')
# bknd._become_merchant('merchant')
# print(bknd._update_balance_btc('merchant'))
# print(bknd._update_balance_btc('customer'))

# print(bknd.update_balance_btc('test'))

# bknd._add_transaction_to_blockchain('hu')
