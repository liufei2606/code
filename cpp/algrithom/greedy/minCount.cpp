#include <stdio.h>

int main(int argc, char const *argv[]) {
  const int RMB[] = {100, 50, 20, 10, 5, 2, 1};
  const int NUM = 7;
  int count = 0;
  int X = 628;

  for (int i = 0; i < NUM; i++) {
    int use = X / RMB[i];
    count += use;
    X -= RMB[i] * use;
    printf("需要 %d 面额 %d 张,剩余需支付 RMB %d.\n", RMB[i], use, X);
  }

  printf("Total count %d\n", count);

  return 0;
}
