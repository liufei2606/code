#include <stdio.h>

/**
 * 节点 struct：值与指针
 * 确定需要改变的节点
*/
struct ListNode {
  int val;
  ListNode* next;
  ListNode(int x) : val(x), next(NULL) {}
};

class Solution {
 public:
  ListNode* reverseList(ListNode* head) {
    ListNode* new_head = NULL;
    while (head) {
      // 1 and 4 迭代：打断成单独结构
      ListNode* next = head->next;
      // 2 3 改变数据结构：连上旧数据并以此为开始节点
      head->next = new_head;
      new_head = head;
      head = next;
    }

    return new_head;
  }

 public:
  ListNode* reverseBetween(ListNode* head, int m, int n) {
    int change_len = n - m + 1;
    ListNode* pre_head = NULL;
    ListNode* result = head;
    // 获取 m 的前驱
    while (head && --m) {
      pre_head = head;
      head = head->next;
    }
    // 逆置
    ListNode* modify_list_tail = head;
    ListNode* new_head = NULL;
    while (head && change_len--) {
      ListNode* next = head->next;
      head->next = new_head;
      new_head = head;
      head = next;
    }
    // 前后连接
    modify_list_tail->next = head;
    if (pre_head) {
      pre_head->next = new_head;
    } else {
      result = new_head;
    }
    return result;
  }
};

int main(int argc, char const* argv[]) {
  ListNode a(10);
  ListNode b(20);
  ListNode c(30);
  ListNode d(40);
  ListNode e(50);
  a.next = &b;
  b.next = &c;
  c.next = &d;
  d.next = &e;

  ListNode* head = &a;
  Solution solve;

  printf("Array:\n");
  while (head) {
    printf("%d\n", head->val);
    head = head->next;
  }

  head = solve.reverseBetween(&a, 2, 4);
  printf("Reverse between \n");
  while (head) {
    printf("%d\n", head->val);
    head = head->next;
  }

  head = solve.reverseList(&a);
  printf("Reverse\n");
  while (head) {
    printf("%d\n", head->val);
    head = head->next;
  }

  return 0;
}
