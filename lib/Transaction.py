from lib.Crypt import RSAcrypt
from MySqlBackend import _backend

class transaction:

    def __new__(cls, *args, importtx=False):

        cls.rsacrypt = RSAcrypt()
        cls.args = args

        # if we are importing a transaction, verify and process it before creating the transaction instance
        if importtx:
            # set vars
            cls.rx_data, cls.tx_data, cls.signed_hash = [args[i] for i in range(3)]
            cls.sign_key = args[-1]
            with _backend() as backend:
                _sign_key = backend._get_merchant_signkey_from_username(cls.sign_key)

            # set key
            cls.rsacrypt.set_key(_sign_key)

            # first, verify the hash
            if cls.verify(transaction):
                print('verified hash')

                # set args to be fed into default constructor
                cls.args = [cls.rx_data, cls.tx_data, None, None, cls.sign_key]

            else:
                print('invalid hash')
                raise Exception

        # extract variables from args

        cls.rx_data, cls.tx_data, cls.amount, cls.currency = map(str, cls.args[:-1])
        cls.keyfile = args[-1]

        # make class instance
        return super(transaction, cls).__new__(cls)

    def __init__(self, *args, importtx=False):

        # delineator
        self.delineator = ':'

        # if this is a new transaction, encrypt it
        if not importtx:
            # import key
            self.rsacrypt.set_key(*self.keyfile)

            # encrypt rx data string
            self.rx_data = self.rsacrypt.encrypt(self.rx_data + self.delineator + str(self.amount) + self.delineator + str(self.currency))
            self.signed_hash = None

        # initialize vars for decrypted data
        self.tx_account_id_decrypt = None
        self.rx_account_id_decrypt = None
        self.amount_decrypt = None
        self.currency_decrypt = None

    def sign(self, keyfile, code):
        # import the key
        self.rsacrypt.set_key(keyfile, code=code)
        # sign a hash of rx_data+tx_data
        self.signed_hash = self.rsacrypt.sign(self.rx_data+self.tx_data, self.rsacrypt.key)
        self.sign_key = rx_account_id

    def verify(self):
        print(self.tx_data)
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
        _rx_data, self.tx_account_id_decrypt = self.rsacrypt.decrypt(self.rx_data).split(':'), self.rsacrypt.decrypt(self.tx_data)

        # unpack rx data
        self.rx_account_id_decrypt, self.amount_decrypt, self.currency_decrypt = [_rx_data[i] for i in range(3)]

    def print_signed_hash(self):
        print(self.signed_hash)

    def print_tx(self):
        print('transaction details:')
        print('\tencrypted tx info: ', self.tx_account_id_decrypt, self.tx_data)
        print('\tencrypted rx info: ', self.rx_account_id_decrypt, self.amount_decrypt, self.currency_decrypt, self.rx_data)
        if self.signed_hash is not None:
            print('\tsigned hash: ' + str(self.signed_hash))
            print('\tsigned by: ' + str(self.sign_key))
        else:
            print('\tthis transaction is not yet signed')

rx_account_id = 'merchant'
rsacrypt = RSAcrypt()
rsacrypt.set_key('C:/Users/GEruo/Dropbox/DecentralizedDebit/masterkeys/master_rsa_public.pem')
tx_data = rsacrypt.encrypt('customer')
amount = 5
currency = 'btc'

tx = transaction(rx_account_id, tx_data, amount, currency, ('C:/Users/GEruo/Dropbox/DecentralizedDebit/masterkeys/master_rsa_public.pem', ''))
tx.sign('C:/Users/GEruo/Dropbox/DecentralizedDebit/merchants/1e262f5bce51dc8d0e8bd3dfa655127860784732/1e262f5bce51dc8d0e8bd3dfa655127860784732_private_rsa_key.bin', 'c1f6d02ff25690934e22aba3d44cd60727f34ed01dfa72bd0784e602')
tx.print_tx()
tximport = transaction(tx.rx_data, tx.tx_data, tx.signed_hash, tx.sign_key, importtx=True)
tximport.decrypt('C:/Users/GEruo/Dropbox/DecentralizedDebit/masterkeys/master_private_rsa_key.bin', 'master')
tximport.print_tx()
print('tx: send ' + str(tximport.amount_decrypt) + ' ' + tximport.currency_decrypt + ' to merchant ' + tximport.rx_account_id_decrypt)
print('tx signed by merchant', tximport.rx_account_id_decrypt)

with _backend() as b:
    if b._check_transaction_is_original(tximport):
        b._add_transaction_to_blockchain(tximport)
        # b._process_transaction(tximport)
    else:
        print('duplicate tx')
    if b._check_transaction_is_original(tximport):
        b._add_transaction_to_blockchain(tximport)
        b._process_transaction(tximport)
    else:
        print('duplicate tx')