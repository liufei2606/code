# encoding: utf-8
from selenium import webdriver
from features.utils.seleniumapi import SeleniumApi
# from features.utils.exceptioncatch import ExceptionCatch
import time
import os
import shutil


def before_feature(content, feature):
    content.driver = webdriver.Chrome()
    content.driver.get("https://tz:aa71fc62bfc06c02abe0ec27@backend.abc.com")
    content.driver.implicitly_wait(10)
    content.driver.maximize_window()
    time.sleep(1)
    SeleniumApi.step_send_keys(content, "//*[@placeholder='邮箱']", 'admin@abc.com')
    SeleniumApi.step_send_keys(content, "//*[@placeholder='密码']", 'admin')
    SeleniumApi.step_click(content, "//*[@type='button']")
    if '后台系统' == SeleniumApi.step_text_cssselector(content, ".navBarTitle"):
        assert True
    else:
        # ExceptionCatch.catch_exception(content)
        assert False


def after_feature(content, feature):
    content.driver.quit()