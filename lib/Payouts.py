import requests, os
from paypalcheckoutsdk.core import PayPalHttpClient, SandboxEnvironment
from dotenv import load_dotenv
# load .env
load_dotenv()
# set env variables
PAYPAL_CLIENT_ID = os.environ.get("PAYPAL_CLIENT_ID")
PAYPAL_CLIENT_SECRET = os.environ.get("PAYPAL_CLIENT_SECRET")

environment = SandboxEnvironment(client_id=PAYPAL_CLIENT_ID, client_secret=PAYPAL_CLIENT_SECRET)
client = PayPalHttpClient(environment)

# request = CapturesGetRequest("51U6715065418315X")
# request.headers['prefer'] = 'return=representation'
# #3. Call PayPal to get the transaction
# response = client.execute(request)
# from paypalcheckoutsdk.orders import OrdersCreateRequest, OrdersGetRequest
#
# order = response
# print(order.status)

import json
import random
import string
from paypal_client import PayPalClient
from paypalpayoutssdk.payouts import PayoutsPostRequest
from paypalhttp.serializers.json_serializer import Json
from paypalhttp.http_error import HttpError
from paypalhttp.encoder import Encoder


class CreatePayouts(PayPalClient):
    """ Creates a payout batch with 5 payout items
    Calls the create batch api (POST - /v1/payments/payouts)
    A maximum of 15000 payout items are supported in a single batch request"""

    @staticmethod
    def build_request_body(include_validation_failure=False):
        senderBatchId = str(''.join(random.sample(
            string.ascii_uppercase + string.digits, k=7)))
        amount = "10.00"
        return \
            {
                "sender_batch_header": {
                    "recipient_type": "EMAIL",
                    "email_message": "SDK payouts test txn",
                    "note": "Enjoy your Payout!!",
                    "sender_batch_id": senderBatchId,
                    "email_subject": "This is a test transaction from SDK"
                },
                "items": [{
                    "note": "Your 1$ Payout!",
                    "amount": {
                        "currency": "USD",
                        "value": amount
                    },
                    "receiver": "geruoff@gmail.com",
                    "sender_item_id": "Test_txn_1"
                }]
            }

    def create_payout(self, rx, amount):
        request = PayoutsPostRequest()
        d = {"grant_type": "client_credentials"}
        h = {"Accept": "application/json", "Accept-Language": "en_US"}

        r = requests.post('https://api.sandbox.paypal.com/v1/oauth2/token', auth=(PAYPAL_CLIENT_ID, PAYPAL_CLIENT_SECRET), headers=h, data=d).json()
        print(r['access_token'])
        self.access_token = r['access_token']
        request.headers = {'Content-Type': 'application/json'}
        request.headers['Authorization'] = 'Bearer ' + self.access_token
        print(request.headers)

        senderBatchId = str(''.join(random.sample(
            string.ascii_uppercase + string.digits, k=7)))

        body = {
            "sender_batch_header": {
                "recipient_type": "EMAIL",
                "email_message": "SDK payouts test txn",
                "note": "Enjoy your Payout!!",
                "sender_batch_id": senderBatchId,
                "email_subject": "This is a test transaction from SDK"
            },
            "items": [{
                "note": "Your 1$ Payout!",
                "amount": {
                    "currency": "USD",
                    "value": "{:.2f}".format(amount)
                },
                "receiver": rx,
                "sender_item_id": "Test_txn_1"
            }]
        }

        request.request_body(body)
        response = self.client.execute(request)

        print("Status Code: ", response.status_code)
        print("Payout Batch ID: " +
                response.result.batch_header.payout_batch_id)
        print("Payout Batch Status: " +
                response.result.batch_header.batch_status)
        print("Links: ")
        for link in response.result.links:
            print('\t{}: {}\tCall Type: {}'.format(
                link.rel, link.href, link.method))

            # To toggle print the whole body comment/uncomment the below line
            # json_data = self.object_to_json(response.result)
            # print "json_data: ", json.dumps(json_data, indent=4)

        return response.status_code

"""This is the driver function which invokes the create_payouts function to create
   a Payouts Batch."""
# CreatePayouts().create_payout('geruoff@gmail.com', 100)
# Simulate failure in create payload to showcase validation failure and how to parse the reason for failure
# CreatePayouts().create_payouts_failure(debug=True)