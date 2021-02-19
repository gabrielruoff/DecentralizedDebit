from flask import Flask
from flask_restful import reqparse, abort, Api, Resource, request
from api_ref import accounts, account

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

    def post(self, username):
        content = request.get_json()
        # get request method and body
        method, body = content['method'], content['body']
        # METHODS
        # createwalletbtc: url/Account/<username> { method: createwalletbtc } body = { password }
        with account() as a:
            func = getattr(a, method)
            print(func)
            return func(username, body)


api.add_resource(Accounts, '/Account')
api.add_resource(Account, '/Account/<username>')

if __name__ == '__main__':
    app.run(debug=True)