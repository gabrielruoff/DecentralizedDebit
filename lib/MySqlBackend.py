# Gabriel Ruoff, geruoff@syr.edu
# Backend class to handle low-level database calls as well as database and wallet helper functions
import uuid, os, json, binascii
from datetime import datetime, timedelta
import mysql.connector
from dotenv import load_dotenv
from hashlib import sha224
# local classes
import Bitcoin, Crypt, Monero, Token, Transaction, Payouts, paypal_client

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
MYSQL_TAB_SESSIONS = os.environ.get("MYSQL_TAB_SESSIONS")
MYSQL_TAB_BTCWALLETS = os.environ.get("MYSQL_TAB_BTCWALLETS")
MYSQL_TAB_XMRWALLETS = os.environ.get("MYSQL_TAB_XMRWALLETS")
MYSQL_TAB_TOKWALLETS = os.environ.get("MYSQL_TAB_TOKWALLETS")
MYSQL_TAB_TOKTRANSACTIONS = os.environ.get("MYSQL_TAB_TOKTRANSACTIONS")
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

    def _generate_session_id(self, username):
        # remove any previous session id related to this user
        self._destroy_session(username=username)
        # create a new session id
        session_id = str(uuid.uuid4())
        if self._insert(MYSQL_TAB_SESSIONS, ['username', 'session_id'], [username, session_id]):
            return self._build_api_response('True', data={'session_id': session_id})
        return self._build_api_response('False', err='genericapierror')

    def _destroy_session(self, session_id=None, username=None):
        if username is None:
            print('here')
            destroyquery = self._raw_query(
                "DELETE FROM %s WHERE session_id='%s'" % (MYSQL_DB + '.' + MYSQL_TAB_SESSIONS, session_id))
        else:
            destroyquery = self._raw_query(
                "DELETE FROM %s WHERE username='%s'" % (MYSQL_DB + '.' + MYSQL_TAB_SESSIONS, username))
        if destroyquery:
            return self._build_api_response(True)
        return self._build_api_response(False, err='genericapierror')

    def _update_session(self, session_id):
        if self._update(MYSQL_TAB_SESSIONS, ['expire_at'], datetime.now() + timedelta(minutes=60), 'session_id',
                        session_id):
            return self._build_api_response('True')
        return self._build_api_response('False', err='genericapierror')
        # unfinished

    def _validate_session(self, session_id):
        try:
            expire_at = self._select(MYSQL_TAB_SESSIONS, 'session_id', session_id, selection='expire_at')[0][0]
        except Exception as e:
            return False
        print(expire_at)
        return expire_at > datetime.now()

    ##########################################
    #        GENERAL WALLET FUNCTIONS        #
    ##########################################

    def _list_account_wallets(self, username):
        # get list of wallets pertaining to user
        wallets = self._select(MYSQL_TAB_USERS, 'username', username)[0][4:]
        return wallets
        # update balance for each wallet that the user holds and add to array
        # for i in

    def _list_supported_currencies(self):
        # get a list of supported currencies
        currencies = self._raw_query("SELECT ticker from accounts.supported_currencies")
        # currencies = [i[0].split('wallet_')[1] for i in currencies]
        return currencies

    def update_balance_all(self, username):
        # update balance for each wallet that the user holds and add to array
        balances = {}
        currencies = self._list_supported_currencies()
        wallets = self._list_account_wallets(username)
        print(wallets)
        print(currencies)
        for i, wallet in enumerate(wallets):
            if wallet == 1:
                func = getattr(self, '_update_balance_' + currencies[i][0].lower())
                balances[currencies[i][0].lower()] = func(username)['data']
            else:
                balances[currencies[i][0].lower()] = 'null'
        print(balances)
        return balances

    ##########################################
    #            TOKEN FUNCTIONS             #
    ##########################################

    # required
    def _update_balance_tok(self, username):
        # retrieve the users' token balance
        tokbalance = self._select(MYSQL_TAB_TOKWALLETS, 'name', username, selection="balance_conf")[0]
        if tokbalance:
            print(tokbalance[0])
            return self._build_api_response(True, data={'balance_conf': str(tokbalance[0]), 'balance_unconf': str(0)})
        return self._build_api_response(False, err='genericapierror')

    # helper
    def _modify_tok_balance(self, username, amount, increase=True):
        # retrieve the users' token balance
        tokbalance = self._select(MYSQL_TAB_TOKWALLETS, 'name', username, selection="balance_conf")[0][0]
        if increase:
            tokbalance += float(amount)
        else:
            tokbalance -= float(amount)
        # update it to the new value
        return self._update(MYSQL_TAB_TOKWALLETS, ['balance_conf'], [tokbalance], 'name', username)

    # required
    def _list_transactions_tok(self, username):
        transactions = []
        tok_transactions = self._select(MYSQL_TAB_TOKTRANSACTIONS, 'user', username, selection='category, amount, txid, create_time')
        for tx in tok_transactions:
            tok_transactions = tx[0]
            # non-applicable information to TOKEN
            confirmations = 10
            category = tx[0]
            amount = tx[1]
            txid = tx[2]
            time = datetime.strftime(tx[-1], "%Y-%m-%d %H:%M:%S")
            address = username
            transactions.append({'category': category, 'amount': amount, 'txid': txid, 'time': time, 'address': address, 'confirmations': confirmations})
        print(transactions)
        return self._build_api_response(True, data={'transactions': transactions})


    ##########################################
    #           BITCOIN FUNCTIONS            #
    ##########################################

    # required
    def _create_wallet_btc(self, username):
        # create a wallet name by hashing the users uid and passwd
        wallet_name = self._getwalletname(username)
        # make sure this wallet doesn't exist. If it doesn't create it
        if not self._select('btcwallets', 'name', wallet_name):
            self.btcrpc.createwallet(wallet_name)
            self.btcrpc._unloadwallet(wallet_name)
        else:
            print('this wallet already exists')
            return self._build_api_response(False, 'walletexists')
        # insert new wallet data into database - set balances to 0
        if self._insert(MYSQL_TAB_BTCWALLETS, ['name', 'KEY_DIR', 'BALANCE_CONF', 'BALANCE_UNCONF'],
                        [wallet_name, (DATADIR + BTC_WALLET_DIR + wallet_name).replace('\\', '\\\\'), 0, 0]):
            print('inserted wallet data')
            # update user account data
            if self._update(MYSQL_TAB_USERS, ['wallet_btc'], [True], 'username', username):
                print('updated user account')
                return self._build_api_response(True)
        return self._build_api_response(False, err='genericapierror')

    # required
    def _update_balance_btc(self, username):
        # get the wallet name
        wallet_name = self._getwalletname(username)
        print(wallet_name)
        # retrieve the wallet's confirmed and unconfirmed balances
        balance_conf, balance_unconf = self.btcrpc.getbalance(wallet_name, 1), self.btcrpc.getunconfirmedbalance(
            wallet_name)
        # update the database with these values
        if self._update(MYSQL_TAB_BTCWALLETS, ['BALANCE_CONF', 'BALANCE_UNCONF'], [balance_conf, balance_unconf],
                        'name',
                        wallet_name):
            return self._build_api_response(True, data={'balance_conf': str(balance_conf),
                                                        'balance_unconf': str(balance_unconf)})
        return self._build_api_response(False, err='genericapierror')

    # required
    def _get_new_address_btc(self, username):
        # get the wallet name
        wallet_name = self._getwalletname(username)
        # get the new address
        new_address = self.btcrpc.getnewaddress(wallet_name)
        if not new_address:
            return self._build_api_response(False, err='generic')
        # this function is special because in certain cases we want the raw address returned.
        # The api handler converts this output into a boolean
        return new_address

    def _withdraw_crypto_btc(self, tx, rx, amount):
        tx = self._getwalletname(tx)
        coin_backend = Bitcoin.bitcoinrpc()
        # make transaction
        if coin_backend.sendtoaddress(tx, rx, amount):
            return self._build_api_response(True)
        return self._build_api_response(False, err='transactionerror')

    # required
    def _list_transactions_btc(self, username):
        wallet_name = self._getwalletname(username)
        transactions = self.btcrpc.listtransactions(wallet_name)[0]
        for transaction in enumerate(transactions):
            print(transaction)
            transaction[1]['amount'] = str(transaction[1]['amount'])
            if transaction[1]['category'] == 'send':
                transaction[1]['fee'] = str(transaction[1]['fee'])
        return self._build_api_response(True, data={'transactions': transactions})

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
            txwallet, rxwallet = self._getwalletname(tx.tx_account_id_decrypt), self._getwalletname(
                tx.rx_account_id_decrypt)
            amount, currency = tx.amount_decrypt, tx.currency_decrypt

            # select a coin backend depending on the currency in question
            if currency.lower() == 'btc':
                coin_backend = Bitcoin.bitcoinrpc()
            elif currency.lower() == 'xmr':
                coin_backend = Monero.monerorpc()
            elif currency.lower() == 'tok':
                coin_backend = Token.token()

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
        return not self._select(MYSQL_TAB_TX_BLOCKCHAIN, 'hash', sha224(binascii.unhexlify(tx.signed_hash)).hexdigest(),
                                selection='block_id')

    def _add_transaction_to_blockchain(self, tx):
        # get required data
        block_id = self._raw_query("SELECT COUNT(block_id) FROM " + MYSQL_DB + "." + MYSQL_TAB_TX_BLOCKCHAIN)[0][0] + 1
        prev_hash = self._raw_query(
            "SELECT hash, block_id FROM " + MYSQL_DB + "." + MYSQL_TAB_TX_BLOCKCHAIN + " ORDER BY block_id DESC LIMIT 1")[
            0]
        prev_hash = sha224(prev_hash[0] + prev_hash[1])
        print(prev_hash)
        this_hash = sha224(binascii.unhexlify(tx.signed_hash).hexdigest())
        return self._insert(MYSQL_TAB_TX_BLOCKCHAIN, ['prev_hash', 'block_id', 'hash'],
                            [prev_hash, block_id, this_hash])

    def _confirm_token_deposit(self, username, tx):
        print(tx)
        txid = tx['id']
        status = tx['status']
        payer = tx['payer']['email_address']
        payer_id = tx['payer']['payer_id']
        country_code = tx['purchase_units'][0]['shipping']['address']['country_code']
        postal_code = tx['purchase_units'][0]['shipping']['address']['postal_code']
        name = tx['payer']['name']['given_name'] + ' ' + tx['payer']['name']['surname']
        currency_code = tx['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code']
        amount = tx['purchase_units'][0]['payments']['captures'][0]['amount']['value']
        final_capture = tx['purchase_units'][0]['payments']['captures'][0]['final_capture']
        create_time = tx['purchase_units'][0]['payments']['captures'][0]['create_time']
        create_time = datetime.strptime(create_time, "%Y-%m-%dT%H:%M:%SZ")
        # transaction category and associated user
        category = 'receive'
        user = username

        if not self._select(MYSQL_TAB_TOKTRANSACTIONS, 'txid', txid, selection='status'):
            if self._insert(MYSQL_TAB_TOKTRANSACTIONS,
                            ['txid', 'status', 'payer', 'payer_id', 'country_code', 'postal_code', 'name',
                             'currency_code', 'amount', 'final_capture', 'category', 'user', 'create_time'],
                            [txid, status, payer, payer_id, country_code, postal_code, name, currency_code, amount,
                             final_capture, category, user, create_time]):
                if self._modify_tok_balance(username, amount, True):
                    return self._build_api_response(True)
        return self._build_api_response(False, err='duplicate paypal transaction')
        # verify that this transaction id is valid
        # verify that this transaction id has not already been processed

    def _get_token_transaction_by_txid(self, txid):
        tx = list(self._select(MYSQL_TAB_TOKTRANSACTIONS, 'txid', txid)[0])
        tx[-1] = datetime.strftime(tx[-1], "%Y-%m-%d %H:%M:%S")
        print(tx)
        if tx:
            return self._build_api_response(True, data={'tx': tx})
        return self._build_api_response(False, err='no match for transaction ' + txid)

    # destination is a paypal email
    def _confirm_token_withdrawl(self, username, amount, destination):
        # make sure the user has enough tokens
        if float(self._update_balance_tok(username)['data']['balance_conf']) > amount:
            # process the payout
            if Payouts.CreatePayouts().create_payout(destination, amount):
                # modify the user's token balance
                # false indicates to subtract balance
                if self._modify_tok_balance(username, amount, False):
                    # add to token transactions
                    txid = uuid.uuid4()
                    currency_code = 'USD'
                    create_time = datetime.now()
                    payer = 'system'
                    category = 'send'
                    user = username
                    if self._insert(MYSQL_TAB_TOKTRANSACTIONS, ['txid', 'status', 'payer', 'currency_code', 'amount', 'category', 'user', 'create_time'],
                                    [txid, 'COMPLETED', payer, currency_code, amount, category, user, create_time]):
                        return self._build_api_response(True)
                return self._build_api_response(False, err='genericapierror')
            return self._build_api_response(False, err='paypalpayouterror')
        return self._build_api_response(False, err='insufficientbalance')

    ##########################################
    #           HELPER FUNCTIONS            #
    ##########################################

    def _build_api_response(self, success, err="", data=""):
        response = {'success': '', 'data': {}, 'err': ''}
        response['success'] = success
        response['data'] = data
        response['err'] = err
        return response

    def _validate_trusted_ip(self, ip):
        valid_ips = '192.168.1.2:127.0.0.1:45.61.54.203'
        print(ip in valid_ips)
        return ip in valid_ips

    def _validate_user_credentials(self, username, password):
        passwd = sha224(username.encode('utf-8') + password.encode('utf-8')).hexdigest()
        try:
            print(passwd, self._select(MYSQL_TAB_USERS, 'username', username, selection='passwd')[0][0])
            return self._select(MYSQL_TAB_USERS, 'username', username, selection='passwd')[0][
                       0].strip() == passwd.strip()
        except IndexError:
            return False

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
        return DATADIR + MASTER_KEY_DIR + MASTER_KEY_PREF + KEY_PRIV_SUFFIX

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
        cursor.execute(q)
        print(q)
        if "SELECT" in q.upper():
            ret = cursor.fetchall()
        elif "INSERT" in q.upper() or "DELETE" in q.upper():
            self.cnx.commit()
            ret = True
        else:
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
