from Crypt import RSAcrypt
from Serial import arduino
import time

rsacrypt = RSAcrypt()
rsacrypt.set_key('code')
arduino = arduino()

arduino.connect("COM3")
print('connecting to arduino')
time.sleep(3)

print("\n\n")
arduino.send('r')
recv = arduino.receive()
recv = rsacrypt.decrypt(recv)

print("decrypted message: "+recv)

# while(1):
#
#     if(arduino.serialport.in_waiting):
#         print(arduino.serialport.readline())
