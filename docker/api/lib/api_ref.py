# RESTAPI reference functions
# Gabriel Ruoff, geruoff@syr.edu
# This api uses the request method field to directly call the relevant helper function contained in this
# file which facilitates the required backend calls. Function names must match their relevant api method call exactly.

from MySqlBackend import _backend
import json

# api reference for Account
class accounts:
    def __enter__(self):
        return self
    def __exit__(self, exc_type, exc_val, exc_tb):
        pass

    def createaccount(self, data):
        print(data)
        with _backend() as b:
            print(data['merchant'])
            return b._create_account(data['username'], data['password'], merchant=(data['merchant']))

    def becomemerchant(self, data):
        # validate credentials
        with _backend() as b:
            if b._validate_user_credentials(data['username'], data['password']):
                return b._become_merchant(data['username'])
            return b._build_api_response(False, 'incorrectcredientals')

class account():
    def __enter__(self):
        return self

    def __exit__(self, exc_type, exc_val, exc_tb):
        pass

    def authenticate(self, username, data):
        # validate credentials
        with _backend() as b:
            if b._validate_user_credentials(username, data['password']):
                return b._build_api_response(True)
            return b._build_api_response(False, 'incorrectcredientals')

    def generatesessionid(self, username, data):
        # validate credentials
        with _backend() as b:
            if b._validate_user_credentials(username, data['password']):
                return b._generate_session_id(username)
            return b._build_api_response(False, 'incorrectcredientals')

    def destroysession(self, username, data):
        # validate credentials
        with _backend() as b:
            if b._validate_session(data['session_id']):
                return b._destroy_session(data['session_id'])
            return b._build_api_response(False, 'incorrectcredientals')
            # unfinished

    def updatesession(self, username, data):
        # validate credentials
        with _backend() as b:
            if b._validate_session(data['session_id']):
                return b._update_session(data['session_id'])
            return b._build_api_response(False, 'invalidsessionid')
        #unfinished

    def validatesession(self, username, data):
        with _backend() as b:
            if b._validate_session(data['session_id']):
                return b._build_api_response(True)
            return b._build_api_response(False, 'invaildsessionid')

    def createwalletbtc(self, username, data):
        # validate credentials
        with _backend() as b:
            print(username, data['password'])
            if b._validate_user_credentials(username, data['password']):
                return b._create_wallet_btc(username)
            return b._build_api_response(False, 'incorrectcredientals')


class wallet():
    def __enter__(self):
        return self

    def __exit__(self, exc_type, exc_val, exc_tb):
        pass

    def getbalance(self, username, currency, data):

        # validate credentials
        with _backend() as b:
            print(username, data['session_id'])
            if b._validate_session(data['session_id']):
                if currency == '*':
                    balancedata = [{}]
                    # get a list of wallets owned by this user
                    return b._build_api_response(True, '', b.update_balance_all(username))

                else:
                    func = getattr(b, ('_update_balance_'+currency))
                    return func(username)
            return b._build_api_response(False, 'invaildsessionid')


    def getnewaddress(self, username, currency, data):
        # validate credentials
        with _backend() as b:
            print(username, data['session_id'])
            if b._validate_session(data['session_id']):
                func = getattr(b, ('_get_new_address_'+currency))
                # btc addresses, which this function returns upon success, are 42 characters
                newaddress = func(username)
                if len(newaddress) == 42:
                    return b._build_api_response(True, data={'newaddress':newaddress})
            return b._build_api_response(False, 'invaildsessionid')

    def listtransactions(self, username, currency, data):
        # validate credentials
        with _backend() as b:
            if b._validate_session(data['session_id']):
                func = getattr(b, '_list_transactions_'+currency)
                return func(username)
            return b._build_api_response(False, 'invalidsessionsid')


class merchant():
    def __enter__(self):
        return self
    def __exit__(self, exc_type, exc_val, exc_tb):
        pass

    def submittransaction(self, username, data, origin):
        # validate credentials
        with _backend() as b:
            if b._validate_session(data['session_id']):
                tx = b._import_transaction_from_raw_data(data['rx_data'], data['tx_data'], data['signed_hash'],
                                                         data['password'], username)
                tx.decrypt(b._get_master_priv_keyfile(), b._get_master_key_pass())
                return b.process_transaction(tx)
            return b._build_api_response(False, 'invaildsessionid')

    def submittokendeposit(self, username, data, origin):
        # validate credentials
        print(origin)
        with _backend() as b:
            if b._validate_session(data['session_id']):
                tx = data['tx']
                return b._confirmtokendeposit(tx)
            return b._build_api_response(False, 'invaildsessionid')