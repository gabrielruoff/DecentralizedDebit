from lib import socks, MySqlBackend
from lib.Transaction import transaction
from dotenv import load_dotenv
import os

# load .env
load_dotenv()
# set env variables
DATADIR = os.environ.get("DATADIR")
MASTER_KEY_PREF = os.environ.get("MASTER_KEY_PREF")
MASTER_KEY_DIR = os.environ.get("MASTER_KEY_DIR")
KEY_PRIV_SUFFIX = os.environ.get("KEY_PRIV_SUFFIX")
MASTER_KEY_PASS = os.environ.get("MASTER_KEY_PASS")

print("-----ServerSide-----")

# start a sock server
sock_server = socks.server()
sock_server.bind(port=12001)

while 1:

    # wait for a merchant to connect
    print('waiting for a connection...')
    accepted = sock_server.accept()
    while not accepted:
        accepted = sock_server.accept()

    # import the transaction from the merchant server
    print('waiting for a connection...')
    tx = transaction.sock_import(transaction, sock_server)

    # print it
    tx.print_tx()

    # decrypt transaction data with master key
    print('decrypting transaction ' + str(tx.signed_hash))
    tx.decrypt(DATADIR+MASTER_KEY_DIR+MASTER_KEY_PREF+KEY_PRIV_SUFFIX, code=MASTER_KEY_PASS)

    # print decrypted transaction
    print('\ndecrypted transaction:')
    tx.print_tx()

    # process the transaction
    print('\nprocessing transaction:')
    with MySqlBackend._backend() as b:
        b.process_transaction(tx)

    print('done- disconnecting from merchant')