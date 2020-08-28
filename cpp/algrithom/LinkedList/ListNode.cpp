#include <stdio.h>

struct ListNode {
  int val;
  ListNode *next;
  ListNode(int x) : val(x), next(NULL){};
};

class Solution {
};

int main(int argc, char const *argv[]) {
  ListNode a(10);
  ListNode b(20);
  ListNode c(30);
  ListNode d(40);
  ListNode e(50);
  a.next = &b;
  b.next = &c;
  c.next = &d;
  d.next = &e;
  e.next = NULL;

  ListNode *head = &a;
  while (head) {
    printf("%d\n", head->val);
    head = head->next;
  }

  return 0;
}
