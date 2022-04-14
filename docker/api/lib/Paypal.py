from numpy import unicode
from paypalcheckoutsdk.core import PayPalHttpClient, SandboxEnvironment
from paypalcheckoutsdk.orders import OrdersGetRequest
from paypalcheckoutsdk.payments import captures_get_request
# from paypalcheckoutsdk.core import
import sys

client_id = "AaXLm-til0Fm_1kR5ejwOSVmypDBlvxuFb7leQed2QRaABTxQs07mSKci01iL4IXxCx0lq-XonT_ybFk"
client_secret = "EEEF954O2paNulcAQ9Jj4t0zLfmCeEacEJD4r-qH2prkV1mvRkbm2SW3AganGgmes6e7EhBxmaMFe46k"

environment = SandboxEnvironment(client_id=client_id, client_secret=client_secret)
client = PayPalHttpClient(environment)

request = CapturesGetRequest("51U6715065418315X")
request.headers['prefer'] = 'return=representation'
#3. Call PayPal to get the transaction
response = client.execute(request)
from paypalcheckoutsdk.orders import OrdersCreateRequest, OrdersGetRequest

order = response
print(order.status)