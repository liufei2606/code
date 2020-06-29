import sys
from unittest import TestCase

from basic.Caculator import Caculator

class TestCalculator(TestCase):
    def test_add(self):
        self.calculator = Caculator()
        self.assertEqual(self.calculator.add(3,4), 7)

    # def test_multiply(self):
    #     assert False
