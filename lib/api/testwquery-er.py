import requests
import json

url = "http://localhost:5000/Account/apitest"
data = {'method':'createwalletbtc', 'body':{'password':'test2'}}
headers = {'Content-type': 'application/json', 'Accept': 'text/plain'}

# url = "http://localhost:5000/Accounts"
# data = {'method':'createaccount', 'body':{'username':'apitest', 'password':'test2'}}
# headers = {'Content-type': 'application/json', 'Accept': 'text/plain'}
r = requests.post(url, data=json.dumps(data), headers=headers)

# print(r)
print(r.json())