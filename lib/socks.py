import socket

class server:

    def __init__(self):

        self.sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

        self.conn = None
        self.client_addr = None
        self.addr = None
        self.port = None

    def connect(self, raddr, rport):
        self.sock.connect((raddr, int(rport)))

    def bind(self, addr='127.0.0.1', port=12000):
        self.addr = addr
        self.port = port
        self.sock.bind((self.addr, int(self.port)))

    def accept(self, timeout=3):
        self.sock.listen(1)
        self.sock.settimeout(timeout)

        try:
            self.conn, self.client_addr = self.sock.accept()
            print('accepted a connection from '+str(self.conn.getpeername()))
            return True
        except socket.timeout:
            print('request timed out')
        return False

    def close(self):
        self.conn.close()

    def send(self, data, timeout=3):
        # if self.conn is None:
        #     print('send failed: no client connected')
        #     return False
        self.sock.settimeout(timeout)

        try:
            self.sock.sendall(bytes(str(len(data)).zfill(3), "utf-8"))
            if isinstance(data, bytes):
                self.sock.sendall(data)
            elif isinstance(data, str):
                self.sock.sendall(data.encode('utf-8'))
            else:
                self.sock.sendall(bytes(data, "utf-8"))
            return True
        except socket.timeout:
            print('request timed out')
        return False

    def receive(self, timeout=3, prefix=3):
        self.conn.settimeout(timeout)

        # receive prefix describing the length of the string to receive
        # then receive that number of bytes
        x = int(self.conn.recv(prefix))
        return self.conn.recv(x)