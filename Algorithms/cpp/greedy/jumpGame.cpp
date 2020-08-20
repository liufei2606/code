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

// 一只青蛙一次可以跳上1级台阶，也可以跳上2级。求该青蛙跳上一个n级的台阶总共有多少种跳法
//第一要素：明确你这个函数想要干什么
//函数功能：计算青蛙跳上一个n级的台阶总共有多少种跳法
long long jump(unsigned int n) {
  //第二要素：寻找递归结束条件
  if (n <= 2)
    return n;
  //第三要素：找出函数的等价关系式
  return jump(n - 1) + jump(n - 2);
}