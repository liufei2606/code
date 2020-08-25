#!/usr/bin python
# coding:utf8
###############################################
# File Name: tests.py
# Author: henry
# mail: 343434343@gmail.com
# Created Time: 五 11/16 11:26:02 2018
# Description:
###############################################
import json

import requests

event = "notify"
url = "https://maker.ifttt.com/trigger/notify/with/key/saghgfjfjhdgkgkjkfhjkjh"

payload = {
    "value1": "哈哈哈，测一个发的试试",
    "value2": "post",
    "value3": "http://aliadsdmg.chadasdasdasd.com/photo/basadasder/3d23dsd78fef54d1d64e.png",
}
headers = {
    "Content-Type": "application/json"
}
resp = requests.post(url, data=json.dumps(payload), headers=headers)
print(resp.status_code)
print(resp.text)
