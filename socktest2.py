from lib.monerosocks import server
from lib.Monero import transaction
from lib.Serial import arduino

# connect to arduino
arduino = arduino()
arduino.connect("COM3")
import time
time.sleep(3)

rx_address = '42eKczsBGi5TXjpnHEovnk9R4YbZMBT6MFqfyhiTYEUUjWBepy5vPSYhK4N1Tr79nNgZAz4aqHj47VSukPkA4nWqBt36HjW'
tx_data = arduino.read_card_data()
amount = 5

tx = transaction(rx_address, tx_data, amount, 'C:/Users/GEruo/Documents/Monero/wallets/merchant/my_private_rsa_key.bin')
tx.sign()
tx.print_tx()

# tximport = transaction(tx.rx_data, tx.tx_data, tx.signed_hash, tx.sign_key, importtx=True)
# tx.print_tx(enc=True)

s = server(bind=True)

# wait for a connection
accepted=s.accept()
while not accepted:
    accepted = s.accept()

print('exporting transaction')
tx.export(s)