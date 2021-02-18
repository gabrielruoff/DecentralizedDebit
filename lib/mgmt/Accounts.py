from hashlib import sha256
from MySqlBackend import _backend


def create_account(user, passwd):
    return _backend.create_account(user, passwd)