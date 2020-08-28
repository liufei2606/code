#include <iostream>
using namespace std;

int main() {
  char name[100];
  printf("What is your name?\n");
  scanf("%s", name);
  printf("Hello,%s,nice to meet you!\n", name);

  cout << "Hello, world!" << endl;
  return 0;
}