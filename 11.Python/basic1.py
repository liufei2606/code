#!/usr/bin/env python
# -*- coding: utf-8 -*- python

# 1.输入与输出
print('这个')
print('Hello Again!')
print('The quick brown fox', 'jump over', 'the lazy dog')
print('100 + 200 =', 100 + 200)
print('Please input you name:')
# name = raw_input()
# print('Hello,', name

# 数据类型：整型、浮点型、字符串、空型、布尔型
print('I\'m \"OK\"!')
print('''line1
line2
line3''')
print(True and True)
print(True or False)
print(not True)
print(None)
PI = 3.1415926
print(PI)
print(ord('A'))
print(chr(65))

# 编码
print(u'中文')
print(len(u'中文'))
# print(u'中文'.encode('utf-8'))
print(len(u'中文'.encode('utf-8')))
# print('abc'.decode('utf-8'))

# 格式化输出
print('Hi, %s, you have $%d.' % ('Michael', 100000))
print('Today:%2d-%02d' % (3, 1))
print('Growth rate:%d%%' % 7)

# list
classmates = ['henry', 'lily', 123]
print(classmates[len(classmates) - 1])
print(classmates[- 1])
classmates.append('code')
print(classmates)
classmates.insert(2, 'PHP')
print(classmates)
classmates.pop(1)
print(classmates)
classmates[1] = 'go'
print(classmates)
multily = ['python', 'java', ['asp', 'php'], 'scheme']
print(len(multily))
# multily.sort()
print(multily)

# tuple
classmates = ('henry', 'lily', 123)
print(classmates[1])
classmates = (123,)
print(classmates)
classmates = ('henry', 'lily', ['A', 'B'])
classmates[2][0] = 'X'
classmates[2][1] = 'Y'
print(classmates)

# 控制语句
age = 20
# age = int(raw_input('age:'))
if age >= 6:
    print('kid')
elif age >= 18:
    print('adult')
else:
    print('teenager')

# n = 1
# while n <= 100:
#     if n > 10:  # 当n = 11时，条件满足，执行break语句
#         break  # break语句会结束当前循环
#     if n % 2 == 0:  # 如果n是偶数，执行continue语句
#         continue  # continue语句会直接继续下一轮循环，后续的print()语句不会执行
#     print(n)
#     n = n + 1
# print('END')

sum1 = 0
# for x in xrange(1, 10):
for x in range(10):
    sum1 = sum1 + x
print(sum1)

sum1 = 0
n = 99
while n > 0:
    sum1 = sum1 + n
    n = n - 10
print(sum1)

# dict key不能变 获取的key必须存在 插入与查找快，占内存
d = {'henry': 80, 'michael': 75, 'Tracy': 85}
print('henry' in d)
print(d.get('tomas', -1))
print(d['henry'])
d.pop('michael')
print(d)

# set
s = set([1, 1, 2, 2, 3, 3])
print(s)
s.add(4)
print(s)
s.remove(4)
print(s)
s1 = set([2, 4, 6])
print(s & s1)
print(s | s1)

a = 'abc'
b = a.replace('a', 'A')
print(a, b)

# function
a = -100
b = 200
# print(abs(a), cmp(a, b), range(10))
print(abs(a), range(10))


def my_abs(x):
    if not isinstance(x, (int, float)):
        raise TypeError('bad operand type')
    if x >= 0:
        return x
    else:
        return -x


print(my_abs(-101))


def power(x, n=2):
    s = 1
    while n > 0:
        n = n - 1
        s = s * x
    return s


print(power(2, 4), power(3))

# null function


def nop():
    pass

# 可变参数：*args接受的是tuple 在list或tuple前面加一个 * 号，把list或tuple的元素变成可变参数


def calc(*numbers):
    sum1 = 0
    for n in numbers:
        sum1 = sum1 + n * n
    return sum1


nums = [1, 3, 5, 7]
print(calc(*nums))

# 关键字参数 kw接收的是一个dict


def person(name, age, **kw):
    print('name:', name, 'age:', age, 'other:', kw)


kw = {'city': 'Beijing', 'job': 'Engineer'}
person('Jack', 24, **kw)


def func(a, b, c=0, *args, **kw):
    print('a =', a, 'b =', b, 'c =', c, 'args =', args, 'kw =', kw)


func(1, 2, 3, 'a', 'b', x=99)

# 递归:注意防止栈溢出


def fact(n):
    if n == 1:
        return 1
    return n * fact(n - 1)
# 优化：尾递归是指，在函数返回的时候，调用自身本身，并且，return语句不能包含表达式。把每一步的乘积传入到递归函数中


def facta(n):
    return fact_iter(n, 1)


def fact_iter(num, product):
    if n == 1:
        return 1
    return fact_iter(num - 1, num * product)


print(fact(6))

# 迭代


# Python中，代码不是越多越好，而是越少越好。代码不是越复杂越好，而是越简单越好
# slice:对tuple与list
L = ['Michael', 'Sarah', 'Tracy']
print(L[0:2], L[:2], L[1:], L[-2:])
L = range(30)
print(L[::4])

# 数据类型转换
print(int('123'), int(12.34), str(123), bool(''))

# 列表生成式即List Comprehensions
print([x * x for x in range(10) if x % 2 == 0])
print([m + n for m in 'abc' for n in 'ABC'])
# d = {'x': 'A', 'y': 'B', 'z': 'C'}
# print([k + '=' + v for k, v in d.iteritems()])

# 生成器:每次调用 next() 的时候执行，遇到 yield 语句返回,在 for 循环的过程中不断计算出下一个元素，并在适当的条件结束 for 循环
g = (x * x for x in range(10))
for n in g:
    print(n)


def fib(max):
    n, a, b = 0, 0, 1
    while n < max:
        yield b
        a, b = b, a + b
        n = n + 1
        pass


for n in fib(6):
    print(n)

# functional programming:允许把函数本身作为参数传入另一个函数，还允许返回一个函数.没有变量
# 函数名其实就是指向函数的变量


def add(x, y, f):
    return f(x) + f(y)


print(add(5, -6, abs))

from functools import reduce


def str2int(s):
    def fn(x, y):
        return x * 10 + y

    def char2num(s):  # 获取数组下标
        return {'0': 0, '1': 1, '2': 2, '3': 3, '4': 4, '5': 5, '6': 6, '7': 7, '8': 8, '9': 9}[s]
    return reduce(fn, map(char2num, s))


print(str2int('45666'))


def upperFirstWord(inStr):
    return "%s" % (inStr[:1].upper() + inStr[1:].lower())


print(list(map(upperFirstWord, ['adam', 'LISA', 'barT'])))


def prod(s):
    def multiply(x, y):
        return x * y
    return reduce(multiply, s)


print(prod([2, 5, 6]))


def not_empty(s):
    return s and s.strip()
    pass


print(list(filter(not_empty, ['A', '', 'B', None, 'C', '  '])))

# 排序算法
L = [36, 5, 12, 9, 22]


def reversed_cmp(x, y):
    if x > y:
        return -1
    if x < y:
        return 1
    return 0
    pass


print(sorted(L))
# print(sorted(L, reversed_cmp))


def lazy_sum(*args):
    def sum():
        ax = 0
        for n in args:
            ax = ax + n
        return ax
        pass
    return sum
    pass


f = lazy_sum(1, 3, 5, 7, 9)
print(f())

# 闭包：返回函数不要引用任何循环变量，或者后续会发生变化的变量
# 方法是再创建一个函数，用该函数的参数绑定循环变量当前的值，无论该循环变量后续如何更改，已绑定到函数参数的值不变


def count():
    fs = []
    for i in range(1, 4):
        def f(j):
            def g():
                return j * j
            return g
        fs.append(f(i))
    return fs


f1, f2, f3 = count()
print(f1(), f2(), f3())

# lambda:表示匿名函数，冒号前面的 x 表示函数参数,只能有一个表达式,也可以把匿名函数赋值给一个变量，再利用变量来调用该函数


def f(x, y, z): return x + y + z


print(f(2, 4, 5))

# 装饰器:代码运行期间动态增加功能的方式,参数为函数名称的高阶函数
import functools


def log(func):
    @functools.wraps(func)
    def wrapper(*args, **kw):
        print('call %s():' % func.__name__)
        return func(*args, **kw)
    return wrapper


@log
def now():
    print('2015-3-25')


now()


def log(text):
    def decorator(func):
        @functools.wraps(func)
        def wrapper(*args, **kw):
            print('%s %s():' % (text, func.__name__))
            return func(*args, **kw)
        return wrapper
    return decorator


@log('execute')
def now():
    print('2015-3-25')


now()

# 偏函数
int2 = functools.partial(int, base=2)
print(int2('1000000'))
