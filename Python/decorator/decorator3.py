# property
from functools import wraps

def logging(func):
   @wraps(func)
   def wrapper(*args, **kwargs):
       """print log before a function."""
       print("[DEBUG] {}: enter {}()".format(datetime.now(), func.__name__))
       return func(*args, **kwargs)
   return wrapper

# def getx(self):
#     return self._x

# def setx(self, value):
#     self._x = value

# def delx(self):
#     del self._x

# # classmethod
# class classmethod(object):
#    """
#    classmethod(function) -> method
#    """
#    def __init__(self, function):  # for @classmethod decorator
#        pass
#    # ...
# class staticmethod(object):
#    """
#    staticmethod(function) -> method
#    """
#    def __init__(self, function):  # for @staticmethod decorator
#        pass
#    # ...
# class Foo(object):
#    @staticmethod
#    def bar():
#        pass
#    # 等同于 bar = staticmethod(bar)


@logging
def say(something):
   """say something"""
   print("say {}!".format(something))
   print(say.__name__)  # say
   print(say.__doc__)  # say something
