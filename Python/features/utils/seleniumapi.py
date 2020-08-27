# -*- coding: utf-8 -*-
# __author__ = 'henry'
from selenium.webdriver.common.alert import Alert
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys


class SeleniumApi:
    def step_click(self, xpath):
        self.driver.find_element_by_xpath(xpath).click()

    def step_send_keys(self, xpath, xpath_value):
        self.driver.find_element_by_xpath(xpath).send_keys(xpath_value)

    def step_text_cssselector(self, cssselector):
        result = self.driver.find_element_by_css_selector(cssselector).text
        return result

    def step_text_xpath(self, xpath):
        result = self.driver.find_element_by_xpath(xpath).text