# 有序的集合，可以随时添加和删除其中的元素
classmates = ['henry', 'lily', 123]
print(classmates[len(classmates) - 1])
classmates.append('code')
print(classmates)
classmates.insert(2, 'PHP')
print(classmates)
multily = ['python', 'java', ['asp', 'php'], 'scheme']  # 4
print(len(multily))

squares = [1, 4, 9, 16, 25]
print(squares[0] + squares[-1])
print(squares[-3:])


# 可变的:允许修改元素
squares[3] = 44
print(squares[:])

squares[4:6] = ['A', 'B']  # 切片赋值
print(squares[:])

print(squares + [25, 49, 64, 81, 100])
print([['a', 'b', 'c'], squares])

squares.extend(['d', 'e', 'f'])
print(squares[:])

print(squares.index('A'))
print(squares.count('A'))

nums = [25, 49, 100, 64, 81, ]
nums.sort()
print(nums)
nums.reverse()
print(nums)
a = nums.copy()
a.pop()
print(a)  # [100, 81, 64, 49]
print(nums)  # [100, 81, 64, 49, 25]

print(squares.pop())
print(squares.pop(4))
print(squares[:])

# 清空
squares[0:2] = []
print(squares[:])
squares.clear()
# del squares[:]
print(squares[:])

# slice 切片：取一个list或tuple的部分元素
L = list(range(100))
print(L[:10:2])
print(L[0:2], L[:2], L[1:], L[-2:])
print(L[::4])
print((0, 1, 2, 3, 4, 5)[:3])

# 列表生成式 List Comprehensions 受到内存限制，列表容量肯定是有限的
print([x * x for x in range(10) if x % 2 == 0])  # [4, 16, 36, 64, 100]

# ['AX', 'AY', 'AZ', 'BX', 'BY', 'BZ', 'CX', 'CY', 'CZ']
print([m + n for m in 'abc' for n in 'ABC'])

L = ['Hello', 'World', 'IBM', 'Apple']
[s.lower() for s in L]


d = {'x': 'A', 'y': 'B', 'z': 'C'}
print([k + '=' + v for k, v in d.iteritems()])
