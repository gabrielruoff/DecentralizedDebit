import time

from lib import socks
from lib.Monero import *

# make a wallet handler
multiwallet = multiwallet('C:/Users/GEruo/Documents/Monero/wallets/')

# start a sock server
sock_server = socks.server()
sock_server.bind(port=12001)

while 1:

    # wait for merchant to connect
    accepted = sock_server.accept()
    while not accepted:
        accepted = sock_server.accept()

    # terminal_addr = sock_server.receive().decode('utf-8').split(':')
    # print(terminal_addr)
    # sock_server.close()

    # start a connection to this merchant server
    # sock_server.connect(*terminal_addr)

    # import the transaction from the merchant server
    tx = transaction.sock_import(transaction, sock_server)

    # print it
    tx.print_tx()

    # decrypt transaction data
    tx.decrypt(multiwallet.private_key('merchant'), code='code')

    # start daemon
    # print('starting daemon')
    # # monerod = monerod()
    # monerod.start_daemon()
    # while not monerod.waitforrefresh():
    #     monerod.waitforrefresh()

    rpcwallet = rpc_wallet(monerod.bind_port, "localhost", "28081", tx)
    rpcwallet.open()
    # rpcwallet.waitforrefresh()
    print('connecting')
    rpcwallet.waitforrefresh()
    rpcwallet.waitforrefresh()
    # rpcwallet.waitforrefresh()
    rpcwallet.connect()
    print('transferring')
    rpcwallet.transfer()

    rpcwallet.wallet.close_wallet()
    rpcwallet.kill()
    # monerod.kill_daemon()