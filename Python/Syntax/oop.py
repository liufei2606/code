# OOP 抽象出Class，根据Class创建Instance
# 类是抽象的模板,实例是根据类创建出来的一个个具体的“对象”
# 多态：逻辑在父类 实现在子类
# 属性的名称前加上两个下划线__ 变成了一个私有变量


class Student(object):
    # 类属性：实例属性优先级高于类属性
    className = 'G1C1'

    # 限制该class实例能添加的属性
    __slots__ = ('__name', 'age', 'score')

    def __init__(self, name, age, score):
        # 私有变量
        self.__name = name
        self.age = age
        self.score = score

    def print_score(self):
        print('%s: %s' % (self.__name, self.score))

    def get_grade(self):
        if self.score >= 90:
            return 'A'
        elif self.score >= 60:
            return 'B'
        else:
            return 'C'

    def __len__(self):
        return 100

    def __str__(self):
        return 'Student object (name: %s)' % self.__name

    # __str__()返回用户看到的字符串，而__repr__()返回程序开发者看到的字符串
    __repr__ = __str__

    def __iter__(self):
        return self  # 实例本身就是迭代对象，故返回自己


bart = Student('Bart Simpson', 59, 89)
lisa = Student('Lisa Simpson', 87, 98)
bart.print_score()
# lisa.print_score()
print(lisa)

print(isinstance(bart, Student))
print(type(lisa))

# 获得一个对象的所有属性和方法
print(dir('ABC'))
print(hasattr(lisa, 'name'))
# setattr(lisa, '_name', 'henry')
lisa.age = 'sdfasf'
print(getattr(lisa, 'age', 'default'))

print(lisa.score)
# list.score = 90


## 支持多继承
## MixIn的目的就是给一个类增加多个功能，这样，在设计类的时候，优先考虑通过多重继承来组合多个MixIn的功能，而不是设计多层次的复杂的继承关系。
