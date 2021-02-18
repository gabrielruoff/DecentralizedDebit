from lib.Crypt import RSAcrypt
from lib.Serial import arduino
import time

from monero.wallet import Wallet
from monero.backends.jsonrpc import JSONRPCWallet
import monero.exceptions

rsacrypt = RSAcrypt()
rsacrypt.set_key('my_private_rsa_key.bin', code='code')
arduino = arduino()

amount = input("Enter transaction amount: ")
receiver = "42eKczsBGi5TXjpnHEovnk9R4YbZMBT6MFqfyhiTYEUUjWBepy5vPSYhK4N1Tr79nNgZAz4aqHj47VSukPkA4nWqBt36HjW"

# connect to arduino
arduino.connect("COM3")
time.sleep(3)

print("\n\nReading card data...")
arduino.send('r')
recv = arduino.receive()
recv = rsacrypt.decrypt(recv).split(":")

# parse wallet name and password
wallet, passwd = recv[0], recv[1]
port = "28081"

print("opening customer wallet: ", recv[0])
print("syncing wallet...")
import subprocess
import os

rpc = subprocess.Popen(['start-rpc-server.bat', wallet, passwd, port], stdout=subprocess.PIPE, stderr=open(os.devnull, 'w'))
# rpc = subprocess.Popen(['start-rpc-server.bat', wallet, passwd, port])

# wait for the refresh to finish
for line in iter(rpc.stdout.readline, b''):
    print(line)
    if b'Refresh done' in line:
        break

w = Wallet(JSONRPCWallet(port=port))

from decimal import Decimal

success = True

if input('transfer '+amount+' to '+receiver+' ?').lower() == 'y':

    print('sending transaction')
    try:
        tx_hash = w.transfer(receiver, Decimal(amount))

    except Exception as e:
        print("transaction failed")
        success = False

    if success:
        print("successful")
        print("transaction hash:")
        print(tx_hash)

else:
    print('cancelling transaction')

print("closing wallet")
w.close_wallet()
print("killing rpc")
os.kill(rpc.pid, 0)