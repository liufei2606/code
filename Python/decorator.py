def logging(level):
    def wrapper(func):
        def inner_wrapper(*args, **kwargs):
            print ("[{level}]: enter function {func}()".format(
                level=level,
                func=func.__name__))
            return func(*args, **kwargs)
        return inner_wrapper
    return wrapper

@logging(level='INFO')
def say_hello(something):
  print("say {}!".format(something))

@logging(level='DEBUG')
def do(something):
   print("do {}...".format(something))

if __name__ == '__main__':
   say_hello('hello')
   do('my work')
