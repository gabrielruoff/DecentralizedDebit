# Gabriel Ruoff, geruoff@syr.edu
# RESTapi to facilitate server-client communication

from flask import Flask
from flask_restful import reqparse, abort, Api, Resource, request
from api_ref import *

app = Flask(__name__)
api = Api(app)

# manage general accounts
class Accounts(Resource):

    def post(self):
        content = request.get_json()
        # get request method and body
        method, body = content['method'], content['body']
        # METHODS
        # - createaccount: { method: createaccount } body = { username, password, is_merchant)
        # - becomemerchant: {method: becomemerchant } body = { username, password)
        with accounts() as a:
            func = getattr(a, method)
            print(func)
            return func(body)

# manage a specific account
class Account(Resource):

    # def get(self, username):
    #     return usage(["createwalletbtc: url /Account/<username> { method: createwalletbtc } body = { password }"])

    def post(self, username):
        content = request.get_json()
        # get request method and body
        method, body = content['method'], content['body']
        # METHODS
        # createwalletbtc: url /Account/<username> { method: createwalletbtc } body = { password }
        with account() as a:
            func = getattr(a, method)
            print(func)
            return func(username, body)


# manage a specific wallet
class Wallet(Resource):

    def post(self, username, currency):
        content = request.get_json()
        # get request method and body
        method, body = content['method'], content['body']
        # METHODS
        # getbalance: url /Wallet/<username>/<currency> { method: getbalance } body = { password }
        # getnewaddress: url /Wallet/<username>/<currency> { method: getnewaddress } body = { password }
        with wallet() as w:
            func = getattr(w, method)
            print(func)
            return func(username, currency, body)


class Merchant(Resource):

    def post(self, username):
        content = request.get_json()
        # get request method and body
        method, body = content['method'], content['body']
        # METHODS
        # submittransaction: url /Merchant/<username> { method: submittransaction } body = { rx_data, tx_data, signed_hash, password }
        with merchant() as w:
            func = getattr(w, method)
            print(func)
            return func(username, body)

# helper function to return usage cases
# def usage(examples):
#     print(tuple(examples))
#     print('eval' + eval(list("{'methods': {"+(("\'%s\'")*len(examples))+"}}" % tuple(examples))))
#     return eval(list("{'methods': {"+(("\'%s\'")*len(examples))+"}}" % tuple(examples)))


# add all to API
api.add_resource(Accounts, '/Accounts')
api.add_resource(Account, '/Account/<username>')
api.add_resource(Wallet, '/Wallet/<username>/<currency>')
api.add_resource(Merchant, '/Merchant/<username>')

if __name__ == '__main__':
    app.run(debug=True)