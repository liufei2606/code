def debug():
   import inspect
   caller_name = inspect.stack()[1][3]
   print("[DEBUG]: enter {}()".format(caller_name))

def say_hello():
  debug()
  print("hello!")

def say_goodbye():
   debug()
   print("Goodbye!")

if __name__ == '__main__':
   say_hello()
   say_goodbye()
