#include <stdio.h>

#include <stack>

class MinStack {
 private:
  std::stack<int> _data;
  std::stack<int> _min;

 public:
  MinStack(){};
  void push(int x) {
    _data.push(x);
    if (_min.empty() || x < _min.top()) {
      _min.push(x);
    } else {
      _min.push(_min.top());
    }
  }

  void pop() {
    _data.pop();
    _min.pop();
  }
  int top() {
    return _data.top();
  }
  int getMin() {
    return _min.top();
  }
};

int main(int argc, char const *argv[]) {
  MinStack ms;
  ms.push(-2);
  printf("top = [%d] ", ms.top());
  printf("min = [%d]\n", ms.getMin());
  ms.push(-0);
  printf("top = [%d] ", ms.top());
  printf("min = [%d]\n", ms.getMin());
  ms.push(-5);
  printf("top = [%d] ", ms.top());
  printf("min = [%d]\n", ms.getMin());

  return 0;
}
