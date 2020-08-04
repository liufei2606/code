#include <string>
#include <vector>

class Solution {
 private:
  /* data */
 public:
  std::string removeKdigits(std::string num, int k) {
    std::vector<int> s;
    std::string result = "";

    for (int i = 0; i < num.length(); i++) {
      int number = num[i] - '0';
      // 不空时可以删除。替换时 k-1
      while (s.size() != 0 && s[s.size() - 1] > number && k > 0) {
        s.pop_back();
        k--;
      }
      // 首个非零数字压近来
      if (number != 0 || s.size() != 0) {
        s.push_back(number);
      }
    }
    // 遍历完数字 k>0，去除后面的信心 1003000 3
    while (s.size() != 0 && k > 0) {
      s.pop_back();
      k--;
    }

    // 拼接字符串
    for (int i = 0; i < s.size(); i++) {
      result.append(1, '0' + s[i]);
    }
    if (result == "") {
      result = "0";
    }
    return result;
  }
};

int main(int argc, char const *argv[]) {
  Solution solve;
  std::string s = solve.removeKdigits("1432219", 3);
  printf("%s\n", s.c_str());
  std::string s1 = solve.removeKdigits("100200", 1);
  printf("%s\n", s1.c_str());

  return 0;
}
