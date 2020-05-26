import base64
import datetime
import hashlib
import hmac
import json
import time

import requests

base_url = "https://api.sandbox.gemini.com"
endpoint = "/v1/order/new"
url = base_url + endpoint

gemini_api_key = "account-zfH54R7RFqV5UJvIGrAy"
gemini_api_secret = "3CkbywAquaXPVRYpZrhUHJ4QAuPj".encode()

t = datetime.datetime.now()
payload_nonce = str(int(time.mktime(t.timetuple()) * 1000))

payload = {
    "request": "/v1/order/new",
    "nonce": payload_nonce,
    "symbol": "btcusd",
    "amount": "5",
    "price": "3633.00",
    "side": "buy",
    "type": "exchange limit",
    "options": ["maker-or-cancel"]
}

encoded_payload = json.dumps(payload).encode()
b64 = base64.b64encode(encoded_payload)
signature = hmac.new(gemini_api_secret, b64, hashlib.sha384).hexdigest()

request_headers = {
    'Content-Type': "text/plain",
    'Content-Length': "0",
    'X-GEMINI-APIKEY': gemini_api_key,
    'X-GEMINI-PAYLOAD': b64,
    'X-GEMINI-SIGNATURE': signature,
    'Cache-Control': "no-cache"
}

response = requests.post(url, data=None, headers=request_headers)

new_order = response.json()
print(new_order)