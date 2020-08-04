#include <vector>

class Solution {
 private:
  /* data */
 public:
  bool canJump(std::vector<int> &a) {
    const int LEN = a.size();
    // 每步跳最远位置
    std::vector<int> index;
    for (int i = 0; i < LEN; i++) {
      index.push_back(i + a[i]);
    }
    int jump = 0;
    int max_index = index[0];
  }
};

int main(int argc, char const *argv[]) {
  Solution solve;
  printf("%d\n", solve.canJump(nums));
  return 0;
}
