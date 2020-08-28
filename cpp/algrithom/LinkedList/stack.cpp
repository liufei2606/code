#include <stdio.h>

#include <queue>

// 通过队列实现栈
// push 的元素 要插入到top
class MyStack {
 public:
  MyStack() {}
  void push(int x) {
    std::queue<int> temp_queue;
    temp_queue.push(x);
    // 原来拍好数据追加
    while (!_data.empty()) {
      temp_queue.push(_data.front());
      _data.pop();
    }
    // 复制一遍
    while (!temp_queue.empty()) {
      _data.push(temp_queue.front());
      temp_queue.pop();
    }
  }
  int pop() {
    int x = _data.front();
    _data.pop();
    return x;
  }
  int top() {
    return _data.front();
  }
  bool empty() {
    return _data.empty();
  }

 private:
  std::queue<int> _data;
};

int main(int argc, char const *argv[]) {
  MyStack s;
  s.push(1);
  s.push(2);
  s.push(3);
  s.push(4);
  s.push(5);
  s.push(6);
  printf("s.top =%d\n", s.top());
  s.pop();
  printf("s.top =%d\n", s.top());
  s.push(7);
  printf("s.top =%d\n", s.top());
  return 0;
}
