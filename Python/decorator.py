def debug(func):
    def wrapper():
        print ("[DEBUG]: enter {}()".format(func.__name__))
        return func()
    return wrapper

@debug
def say_hello():
  print("hello!")

if __name__ == '__main__':
   say_hello()
