from Crypto.PublicKey import RSA
from Crypto.Cipher import PKCS1_OAEP
from Crypto.Signature import pkcs1_15
from Crypto.Hash import SHA384
from base64 import b64encode
from base64 import b64decode
from dotenv import load_dotenv
import os

# load .env
load_dotenv()
# set env variables
# set env variables
KEY_PRIV_SUFFIX = os.environ.get("KEY_PRIV_SUFFIX")
KEY_PUB_SUFFIX = os.environ.get("KEY_PUB_SUFFIX")

class RSAcrypt:

    def __init__(self):
        self.key = None
        self.pkcs = None
        self.sha384 = None

    def __enter__(self):
        return self

    def __exit__(self, exc_type, exc_val, exc_tb):
        pass

    def gen_key(self, code, wallet_name, dir, len=2048):
        self.key = RSA.generate(len)

        encrypted_key = self.key.exportKey(format='DER', passphrase=code, pkcs=8)

        # make a directory to store their keys
        os.mkdir(dir+wallet_name)

        with open(dir+wallet_name+'\\'+wallet_name+KEY_PRIV_SUFFIX, 'wb') as f:
            f.write(encrypted_key)

        with open(dir+wallet_name+'\\'+wallet_name+KEY_PUB_SUFFIX, 'wb') as f:
            f.write(self.key.publickey().exportKey())

    def set_key(self, keyfile, code=""):
        # if this is a raw key
        if isinstance(keyfile, bytes):
            self.key = RSA.import_key(keyfile, passphrase=code)
        else:
            with open(keyfile, 'rb') as f:
                self.key = RSA.import_key(f.read(), passphrase=code)
                print("imported key")
                f.close()

    def encrypt(self, data):
        plaintext = b64encode(data.encode())
        rsa_encryption_cipher = PKCS1_OAEP.new(self.key)
        ciphertext = rsa_encryption_cipher.encrypt(plaintext)
        return b64encode(ciphertext).decode()

    def decrypt(self, data):
        ciphertext = b64decode(data.encode())
        rsa_decryption_cipher = PKCS1_OAEP.new(self.key)
        plaintext = rsa_decryption_cipher.decrypt(ciphertext)
        return b64decode(plaintext).decode()

    def sign(self, data, key):
        self.pkcs = pkcs1_15.new(key)
        self.sha384 = SHA384.new()
        self.sha384.update(str.encode(data))

        return self.pkcs.sign(self.sha384)

    def verify(self, data, key, signature):
        self.pkcs = pkcs1_15.new(key)
        self.sha384 = SHA384.new()
        # if this is already a byte array
        if not isinstance(data, bytes):
            data = str.encode(data)
        self.sha384.update(data)

        return self.pkcs.verify(self.sha384, signature) is None
