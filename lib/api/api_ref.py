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