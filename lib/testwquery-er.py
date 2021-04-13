import requests
import json

local = 'http://localhost:5000'
remote = 'http://45.61.54.203:5000'
pc = 'http://192.168.1.2:5000'

# url = local+"/Account/apitest"
# data = {'method':'authenticate', 'body':{'password':'test2'}}
# headers = {'Content-type': 'application/json', 'Accept': 'text/plain'}

url =pc+"/Account/apitest"
data = {'method':'generatesessionid', 'body':{'username':'apitest', 'password':'test2'}}
headers = {'Content-type': 'application/json', 'Accept': 'text/plain'}
r = requests.post(url, data=json.dumps(data), headers=headers)
session_id = r.json()['data']['session_id']
print(session_id)

# url = pc+"/Account/apitest"
# data = {'method':'validatesession', 'body':{'session_id': session_id}}
# headers = {'Content-type': 'application/json', 'Accept': 'text/plain'}

# url = pc+"/Account/apitest"
# data = {'method':'destroysession', 'body':{'session_id': session_id}}
# headers = {'Content-type': 'application/json', 'Accept': 'text/plain'}

# url = "http://localhost:5000/Accounts"
# data = {'method':'createaccount', 'body':{'username':'apitest', 'password':'test2', 'merchant':'False'}}
# headers = {'Content-type': 'application/json', 'Accept': 'text/plain'}

# url = "http://localhost:5000/Accounts"
# data = {'method':'becomemerchant', 'body':{'username':'merchant', 'password':'test2'}}
# headers = {'Content-type': 'application/json', 'Accept': 'text/plain'}

# url = pc+"/Wallet/apitest/btc"
# data = {'method':'getbalance', 'body':{'session_id':session_id}}
# headers = {'Content-type': 'application/json', 'Accept': 'text/plain'}

# url = pc+"/Merchant/apitest"
# data = {'method':'submittokendeposit', 'body':{'session_id':session_id, 'tx': {'create_time':'2021-03-10T23:31:43Z','update_time':'2021-03-10T23:31:53Z','id':'8UT64064Y1885783P','intent':'CAPTURE','status':'COMPLETED','payer':{'email_address':'sb-yttsx5369489@personal.example.com','payer_id':'DSYBPTKZKHK6L','address':{'address_line_1':'1 Main St','admin_area_2':'San Jose','admin_area_1':'CA','postal_code':'95131','country_code':'US'},'name':{'given_name':'John','surname':'Doe'},'phone':{'phone_number':{'national_number':'4083753851'}}},'purchase_units':[{'description':'Token Deposit','reference_id':'default','amount':{'value':'600.00','currency_code':'USD'},'payee':{'email_address':'barco.03-facilitator@gmail.com','merchant_id':'YQZCHTGHUK5P8'},'shipping':{'name':{'full_name':'John Doe'},'address':{'address_line_1':'1 Main St','admin_area_2':'San Jose','admin_area_1':'CA','postal_code':'95131','country_code':'US'}},'payments':{'captures':[{'status':'COMPLETED','id':'5JS73574N9053032X','final_capture':'true','create_time':'2021-03-10T23:31:53Z','update_time':'2021-03-10T23:31:53Z','amount':{'value':'600.00','currency_code':'USD'},'seller_protection':{'status':'ELIGIBLE','dispute_categories':['ITEM_NOT_RECEIVED','UNAUTHORIZED_TRANSACTION']},'links':[{'href':'https://api.sandbox.paypal.com/v2/payments/captures/5JS73574N9053032X','rel':'self','method':'GET','title':'GET'},{'href':'https://api.sandbox.paypal.com/v2/payments/captures/5JS73574N9053032X/refund','rel':'refund','method':'POST','title':'POST'},{'href':'https://api.sandbox.paypal.com/v2/checkout/orders/8UT64064Y1885783P','rel':'up','method':'GET','title':'GET'}]}]}}],'links':[{'href':'https://api.sandbox.paypal.com/v2/checkout/orders/8UT64064Y1885783P','rel':'self','method':'GET','title':'GET'}]}}}
# headers = {'Content-type': 'application/json', 'Accept': 'text/plain'}

# url = pc+"/Merchant/apitest"
# data = {'method':'listtransactions', 'body':{'session_id':session_id, 'amount': 50000, 'destination': 'sb-yttsx5369489@personal.example.com'}}
# headers = {'Content-type': 'application/json', 'Accept': 'text/plain'}

url = pc+"/Wallet/apitest/btc"
data = {'method':'listtransactions', 'body':{'session_id':session_id}}
headers = {'Content-type': 'application/json', 'Accept': 'text/plain'}

# url = pc+"/Wallet/apitest/btc"
# data = {'method':'sendoffchain', 'body':{'session_id':session_id, 'rx': 'test3', 'amount': 0.001}}
# headers = {'Content-type': 'application/json', 'Accept': 'text/plain'}

# url =pc+"/Wallet/apitest/btc"
# data = {'method':'withdrawcrypto', 'body':{'session_id':session_id, 'rx': 'bc1qfxkq08npxk2qxvxjqlp7nwwlw90sy5xfhmsan2', 'amount': 0.0001}}
# headers = {'Content-type': 'application/json', 'Accept': 'text/plain'}

# url =pc+"/Wallet/apitest/tok"
# data = {'method':'sendtoaddress', 'body':{'session_id':session_id}}
# headers = {'Content-type': 'application/json', 'Accept': 'text/plain'}

# url =pc+"/Wallet/apitest/btc"
# data = {'method':'getnewaddress', 'body':{'session_id':session_id}}
# headers = {'Content-type': 'application/json', 'Accept': 'text/plain'}
# build a transaction from this data. Encrypt to server masterkey

# url = "http://45.61.54.203:5000/Merchant/merchant"
# data = {'method':'submittransaction', 'body':{'rx_data':'J2QQvssBeiL2ujqEVhJs3fs6Fc2vQf13x6wdcdRdUTKu1dUJXDt6QR5fWehXqjZwySJ0E0aW4iLOfqQoZ4XpP05zS3ZsnQi9RU7CRLF2j2MDHQXvUdpDGfjZG0W9HE85lFCxZsJQRPkDvhvzREtZsUoFmFPebAkJ6IBkS5BJG8b95wfKGVkn9+WZH0Mo1+gAU47WrVveX3+PXugsnqL41H19G68slrBK1ZOdca7zSH3fjGO8AGcCZUyPkkNo0t2IGXlQpQa1YIBK/iD0Z+QXntgh6Q4/8qdTrN4a9aBoVkNPNlRqsGsE0AQPHl8DFdpcNGVWbLpT2YHmmxwfOpeqbw==',
#                                               'tx_data':'ApLlP8BYrs4YqlXglOYU8dc5pO2+VvjZVesYeZAh2P8JCTAuYnpZachM8iKv1avAwgv676xMw4rnVvadmXzSiGCV19W/XcKESPCL5Mdvx/Xew3dr9hgoNBwidqdGTTpm/COaEO+q7WmK3X3SjGrKJJE3PIOwi0HisLF3xib1anc0plmkj24BGlgeRDCiCVMCArUActHEpWYlRkcnZIr0t0bOgstYORVL7EdOQwbArk3pV5bPZqvpm0Y+Dio7DVhnTS//6dsXTEDoZ1NjfpBWIX/kZP/t7NA5oTDvoBtLVL9AwOkF/KZuC+TLcSUSsJOJuBWJoDyz7rwSe5fGsawjOQ==',
#                                               'signed_hash': b'u\x1c\xfc?\xc4\xca\xd9$\xeeh\xa1w;\x16\xc1[\x95o\xb8\xff_\x8dus3Y{K\xf3zY-\x816w~\xfa<\xa0\xbeb\x83\xa5\xbc\xf4\xea\xcc\xb17v\xabtf\xc3D-\xd16\x19\xc6\x82x\x8e\xee\xaa\xb1"\xbb\xc9?\xd4_{\xf81Y0\x86\xd9qk\xda\xc7\x14\xe1\xca~\x01\x91Y3\xb9\x93\xaf\x12[\xbe\xdb\n@K?\x07\x10q\xb66\x16\x89;\xc1\xbe\xf7C\xf4\xeb\x17I\xfd;\xa4\xf0\xffUM>\x02\xbaI\xeb{\x06\x1c\x99\xbbj\xe8\x0e[\x11iRF\x8d(\xe2\xc0_yC\x07l|\x83\xa4\xcfU\xe7&\xb1\xda\xd1\xde\xb2Ij\x02{\xfc\x81y\x93\x028S\x0bm\xad\xaf0\xa0T\x87\xa0&M\xec\x1d"\x0c2\xf5\x95oh\xd1t\xe7^8#\x00\xdd\xdf\'k\xb7\x93iF\x02\xc8\xbdo\xf0\xc7\x03\xf0\xdey$4U\xed\x8a\xed%\xf4\x12wYl\x831Q\x89\xbe\xe2]ZJ\x97\xf5\xac\x1a~\xbdN\xbb\x8a\xac\x98k\xe60\x0c'.strip().decode('utf-8', 'replace'),
#                                               'signer':'merchant' ,'password':'test2'}}
# headers = {'Content-type': 'application/json', 'Accept': 'text/plain'}

r = requests.post(url, data=json.dumps(data), headers=headers)

print(r.json())
