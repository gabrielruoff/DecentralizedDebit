from lib.socks import client
from lib.Monero import transaction

c = client(connect=True)

tx = transaction.sock_import(transaction, c)

tx.print_tx()