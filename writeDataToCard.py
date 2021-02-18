from lib.Crypt import RSAcrypt
from lib.Monero import multiwallet
from lib.Serial import arduino
import time

rsacrypt = RSAcrypt()
arduino = arduino()
# make a wallet handler
multiwallet = multiwallet('C:/Users/GEruo/Documents/Monero/wallets/')

rsacrypt.set_key(multiwallet.public_comm_key('merchant'), 'code')

identifier = "geruoff:Bigh0rse10!!"

enc_message = rsacrypt.encrypt(identifier)
print("\n\n encrypted message: "+enc_message)
# print(rsacrypt.decrypt(enc_message))
# print(len(enc_message))

arduino.connect("COM3")
print('connecting to arduino')
time.sleep(3)

input('place card on reader and press return')

arduino.send('w')
arduino.send(enc_message)
while(1):

    if(arduino.serialport.in_waiting):
        print(arduino.serialport.readline())
        # arduino.send('a')
    # time.sleep(1)