#include <stdio.h>

#include <stack>

// 通过栈 实现队列，新入元素加到栈底
class MyQueue {
 private:
  std::stack<int> _data;

 public:
  void push(int x) {
    std::stack<int> temp_stack;

    while (!_data.empty()) {
      temp_stack.push(_data.top());
      _data.pop();
    }
    temp_stack.push(x);
    while (!temp_stack.empty()) {
      _data.push(temp_stack.top());
      temp_stack.pop();
    }
  }
  int pop() {
    int x = _data.top();
    _data.pop();
    return x;
  }
  int top() {
    return _data.top();
  }
  bool empty() {
    return _data.empty();
  }
};

int main(int argc, char const *argv[]) {
  MyQueue Q;
  Q.push(5);
  Q.push(6);
  Q.push(10);
  Q.push(11);
  printf("Q.top is %d\n", Q.top());
  Q.pop();
  printf("Q.top = %d\n", Q.top());
  return 0;
}
