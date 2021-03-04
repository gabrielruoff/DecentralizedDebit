import serial
import time


class arduino:

    def __init__(self):
        self.serialport = None

    def __enter__(self):
        return self

    def __exit__(self, exc_type, exc_val, exc_tb):
        self.close()

    def connect(self, port, baud=9600, timeout=5, bytesize=8, parity='N', stopbits=1):
        self.serialport = serial.Serial(port, baud, bytesize, parity, stopbits, timeout)

    def close(self):
        self.serialport.close()

    def send(self, data):

        i=0
        j=0
        for character in data:
            self.serialport.write(bytes(character, "utf-8"))
            i += 1
            j += 1
            # wait every two bytes as to not overflow arduino buffer
            if i > 15:
                # print(i)
                time.sleep(0.17)
                i = 0
        print('sent:', j, 'byte(s)')

        self.serialport.flush()

    def receive(self):

        buf = ""

        recv = self.serialport.read()
        while recv != b'!':
            # print(buf)
            buf += recv.decode("utf-8")
            recv = self.serialport.read()

        # print(buf)
        return buf

    def read_card_data(self):
        self.send('r')
        return self.receive()
