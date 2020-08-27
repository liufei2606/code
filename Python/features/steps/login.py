# -*- coding: utf-8 -*-
# __author__ = 'henry'
from behave import *
from features.utils.seleniumapi import SeleniumApi
import time


@given('打开后台登录页面并且通过后台验证')
def step_open(self):
    SeleniumApi.step_startup(self)


@when('输入{username}和{password}并点击登录')
def step_login(self, username, password):
    time.sleep(1)
    SeleniumApi.step_send_keys(self, "//*[@placeholder='邮箱']", username)
    time.sleep(1)
    SeleniumApi.step_send_keys(self, "//*[@placeholder='密码']", password)
    SeleniumApi.step_click(self, "//*[@type='button']")
    time.sleep(3)


@then('正确跳转进入系统后台')
def step_forward_top(self):
    if '用户名' in SeleniumApi.step_text_cssselector(self, "hidden-sm"):
        assert True
    else:
        assert False
    SeleniumApi.step_quit(self)
