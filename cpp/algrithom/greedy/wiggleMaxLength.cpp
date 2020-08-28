#include <stdio.h>

#include <vector>

class Solution {
 private:
  /* data */
 public:
  int wiggleMaxLength(std::vector<int> &a) {
    int len = a.size();

    if (len <= 2) {
      return len;
    }

    static const int BEGIN = 0;
    static const int UP = 1;
    static const int DOWN = 2;
    int STATE = BEGIN;
    int max_length = 1;

    for (int i = 0; i < len; i++) {
      switch (STATE) {
        case BEGIN:
          if (a[i - 1] < a[i]) {
            STATE = UP;
            max_length++;
          } else if (a[i - 1] > a[i]) {
            STATE = DOWN;
            max_length++;
          }
          break;
        case UP:
          if (a[i] < a[i - 1]) {
            STATE = DOWN;
            max_length++;
          }
          break;
        case DOWN:
          if (a[i] > a[i - 1]) {
            STATE = UP;
            max_length++;
          }
          break;
      }
    }
    return max_length;
  }
};

int main(int argc, char const *argv[]) {
  std::vector<int> a;
  a.push_back(1);
  a.push_back(17);
  a.push_back(5);
  a.push_back(10);
  a.push_back(13);
  a.push_back(15);
  a.push_back(10);
  a.push_back(5);
  a.push_back(16);
  a.push_back(8);

  Solution slove;

  printf("%d\n", slove.wiggleMaxLength(a));
  return 0;
}
