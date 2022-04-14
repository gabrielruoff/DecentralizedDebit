import MySqlBackend

class token:

    def __init__(self):
        pass


    def sendtoaddress(self, tx, rx, amount, wallet_password=None):
        # subtract token balance from sender's account and add it to the receiver's account
        with MySqlBackend._backend() as b:
            return bool(b._modify_tok_balance(tx, amount, False) and b._modify_tok_balance(rx,amount))