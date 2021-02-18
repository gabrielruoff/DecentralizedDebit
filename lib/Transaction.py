from lib.Crypt import RSAcrypt

class transaction:

    def __new__(cls, *args, importtx=False):

        cls.rsacrypt = RSAcrypt()
        cls.args = args

        # if we are importing a transaction, verify and process it before creating the transaction instance
        if importtx:
            # set vars
            cls.rx_data, cls.tx_data, cls.signed_hash, cls.sign_key = [args[i] for i in range(len(args))]
            # set key
            cls.rsacrypt.set_key(cls.sign_key)

            # first, verify the hash
            if cls.verify(transaction):
                print('verified hash')

                # set args to be fed into default constructor
                cls.args = [cls.rx_data, cls.tx_data, None, cls.sign_key]

            else:
                print('invalid hash')
                raise Exception

        # extract variables from args
        cls.rx_data, cls.tx_data, cls.amount, cls.keyfile = map(str, cls.args)
        # make class instance
        return super(transaction, cls).__new__(cls)

    def __init__(self, *args, importtx=False):

        # delineator
        self.delineator = ':'

        # if this is a new transaction, encrypt it
        if not importtx:
            # import key
            self.rsacrypt.set_key(self.keyfile)

            # encrypt rx data string
            self.rx_data = self.rsacrypt.encrypt(self.rx_data + self.delineator + str(self.amount))
            self.signed_hash = None

        # initialize vars for decrypted data
        self.wallet_name_decrypt = None
        self.wallet_pass_decrypt = None
        self.rx_address_decrypt = None
        self.amount_decrypt = None

    def sign(self, keyfile, code):
        # import the key
        self.rsacrypt.set_key(keyfile, code=code)
        # sign a hash of rx_data+tx_data
        self.signed_hash = self.rsacrypt.sign(self.rx_data+self.tx_data, self.rsacrypt.key)
        self.sign_key = self.rsacrypt.key.publickey().exportKey()

    def verify(self):
        return self.rsacrypt.verify((self.rx_data+self.tx_data), self.rsacrypt.key, self.signed_hash)

    def sock_import(self, sock_client):
        print('importing transaction from ' + str(sock_client.conn.getpeername()))
        imported_tx = []
        for i in range(4):
            imported_tx.append(bytes(sock_client.receive()))
        # return a transaction instance re-built from imported data
        return transaction(*imported_tx, importtx=True)

    def export(self, sock_server):
        for item in [self.rx_data, self.tx_data, self.signed_hash, self.sign_key]:
            if not sock_server.send(item):
                return False
        return True

    # decrypt transaction data
    def decrypt(self, privatekey, code=''):

        # set private key
        self.rsacrypt.set_key(privatekey, code=code)

        # decrypt the data
        _rx_data, _tx_data = self.rsacrypt.decrypt(self.rx_data[2:-1]).split(':'), self.rsacrypt.decrypt(self.tx_data[2:-1]).split(':')

        # unpack data
        self.wallet_name_decrypt, self.wallet_pass_decrypt = [_tx_data[i] for i in range(2)]
        self.rx_address_decrypt, self.amount_decrypt = [_rx_data[i] for i in range(2)]

    def print_signed_hash(self):
        print(self.signed_hash)

    def print_tx(self):
        print('transaction details:')
        print('\tencrypted tx info: '+self.tx_data)
        print('\tencrypted rx info: '+self.rx_data)
        if self.signed_hash is not None:
            print('\tsigned hash: '+ str(self.signed_hash))
            print('\tsigned by: '+ str(self.sign_key))
        else:
            print('\tthis transaction is not yet signed')