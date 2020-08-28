#include <stdio.h>

#include <queue>

// 寻找中位数
class MedianFinder {
 private:
  std::priority_queue<int, std::vector<int>, std::less<int>> big_queue;
  std::priority_queue<int, std::vector<int>, std::greater<int>> small_queue;

 public:
  void addNum(int x) {
    if (big_queue.empty()) {
      big_queue.push(x);
      return;
    }

    // 两个堆的构建
    if (big_queue.size() == small_queue.size()) {
      if (x < big_queue.top()) {
        big_queue.push(x);
      } else {
        small_queue.push(x);
      }
    } else if (big_queue.size() > small_queue.size()) {
      if (x > big_queue.top()) {
        small_queue.push(x);
      } else {
        small_queue.push(big_queue.top());
        big_queue.pop();
        big_queue.push(x);
      }
    } else if (big_queue.size() < small_queue.size()) {
      if (x < big_queue.top()) {
        big_queue.push(x);
      } else {
        big_queue.push(small_queue.top());
        small_queue.pop();
        small_queue.push(x);
      }
    }
  }

  double findMedian() {
    if (big_queue.size() == small_queue.size()) {
      return (big_queue.top() + small_queue.top()) / 2;
    } else if (big_queue.size() > small_queue.size()) {
      return big_queue.top();
    }

    return small_queue.top();
  }
};

int main(int argc, char const *argv[]) {
  MedianFinder M;
  int test[] = {6, 10, 1, 7, 99, 4, 33};
  for (int i = 0; i < 7; i++) {
    M.addNum(test[i]);
    printf("%1f\n", M.findMedian());
  }

  return 0;
}
