# RESTAPI reference functions
# Gabriel Ruoff, geruoff@syr.edu
# This api uses the request method field to directly call the relevant helper function contained in this
# file which facilitates the required backend calls. Function names must match their relevant api method call exactly.

from lib.MySqlBackend import _backend

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
            return b._create_account(data['username'], data['password'], merchant=eval(data['merchant']))

    def becomemerchant(self, data):
        # validate credentials
        with _backend() as b:
            if b._validate_user_credentials(data['username'], data['password']):
                return b._become_merchant(data['username'])
            return b._build_api_response('False', 'incorrectcredientals')

class account():
    def __enter__(self):
        return self

    def __exit__(self, exc_type, exc_val, exc_tb):
        pass

    def createwalletbtc(self, username, data):
        # validate credentials
        with _backend() as b:
            print(username, data['password'])
            if b._validate_user_credentials(username, data['password']):
                return b._create_wallet_btc(username)
            return b._build_api_response('False', 'incorrectcredientals')

class wallet():
    def __enter__(self):
        return self

    def __exit__(self, exc_type, exc_val, exc_tb):
        pass

    def getbalance(self, username, currency, data):
        # validate credentials
        with _backend() as b:
            print(username, data['password'])
            if b._validate_user_credentials(username, data['password']):
                func = getattr(b, ('_update_balance_'+currency))
                return func(username)
            return b._build_api_response('False', 'incorrectcredientals')

    def getnewaddress(self, username, currency, data):
        # validate credentials
        with _backend() as b:
            print(username, data['password'])
            if b._validate_user_credentials(username, data['password']):
                func = getattr(b, ('_get_new_address_'+currency))
                # btc addresses, which this function returns upon success, are 42 characters
                if len(func(username)) == 42:
                    return b._build_api_response('True')
            return b._build_api_response('False', 'incorrectcredientals')

class merchant():
    def __enter__(self):
        return self
    def __exit__(self, exc_type, exc_val, exc_tb):
        pass

    def submittransaction(self, username, data):
        # validate credentials
        with _backend() as b:
            print(username, data['password'])
            if b._validate_user_credentials(username, data['password']):
                tx = b._import_transaction_from_raw_data(data['rx_data'], data['tx_data'], data['signed_hash'],
                                                         data['password'], username)
                tx.decrypt(b._get_master_priv_keyfile(), b._get_master_key_pass())
                return b.process_transaction(tx)
            return b._build_api_response('False', 'incorrectcredientals')