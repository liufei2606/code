#include <stdio.h>

#include <set>

struct ListNode {
  int val;
  ListNode *next;
  ListNode(int x) : val(x), next(NULL){};
};

int get_list_length(ListNode *head) {
  int len = 0;
  while (head) {
    len++;
    head = head->next;
  }

  return len;
}

ListNode *forward_long_list(int long_len, int short_len, ListNode *head) {
  int delta = long_len - short_len;
  while (head && delta--) {
    head = head->next;
  }
  return head;
}

class Solution {
 public:
  ListNode *getIntersectionNode(ListNode *headA, ListNode *headB) {
    std::set<ListNode *> node_set;
    while (headA) {
      node_set.insert(headA);
      headA = headA->next;
    }
    while (headB) {
      if (node_set.find(headB) != node_set.end()) {
        return headB;
      }
      headB = headB->next;
    }
    return NULL;
  }

 public:
  ListNode *getIntersectionNode1(ListNode *headA, ListNode *headB) {
    int list_A_len = get_list_length(headA);
    int list_B_len = get_list_length(headB);

    if (list_A_len > list_B_len) {
      headA = forward_long_list(list_A_len, list_B_len, headA);
    } else {
      headB = forward_long_list(list_B_len, list_A_len, headB);
    }

    while (headA && headB) {
      if (headA == headB) {
        return headA;
      }
      headA = headA->next;
      headB = headB->next;
    }
    return NULL;
  }
};

int main(int argc, char const *argv[]) {
  ListNode a1(10);
  ListNode a2(20);
  ListNode b1(30);
  ListNode b2(40);
  ListNode b3(50);
  ListNode c1(60);
  ListNode c2(70);
  ListNode c3(80);
  a1.next = &a2;
  a2.next = &c1;
  c1.next = &c2;
  c2.next = &c3;
  b1.next = &b2;
  b2.next = &b3;
  b3.next = &c1;

  Solution slove;
  // ListNode *result = slove.getIntersectionNode(&a1, &a2);
  ListNode *result1 = slove.getIntersectionNode1(&a1, &a2);

  // printf("%d\n", result->val);
  printf("%d\n", result1->val);
  return 0;
}
