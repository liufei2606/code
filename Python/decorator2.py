class logging(object):
    def __init__(self, func):
        self.func = func
    def __call__(self, func):  # 接受函数
        def wrapper(*args, **kwargs):
            print "[{level}]: enter function {func}()".format(
               level=self.level,
               func=func.__name__)
            func(*args, **kwargs)
            return wrapper  # 返回函数

@logging(level='INFO')
def say_hello(something):
  print("say {}!".format(something))

@logging(level='DEBUG')
def do(something):
   print("do {}...".format(something))

if __name__ == '__main__':
   say_hello('hello')
   do('my work')
