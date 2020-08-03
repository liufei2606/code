#include <stdio.h>

#include <set>

struct ListNode {
  int val;
  ListNode *next;
  ListNode(int x) : val(x), next(NULL){};
};

class Solution {
 public:
  ListNode *detectCycle(ListNode *head) {
    std::set<ListNode *> node_set;
    while (head) {
      if (node_set.find(head) != node_set.end()) {
        return head;
      }

      node_set.insert(head);
      head = head->next;
    }
    return NULL;
  }

 public:
  ListNode *detectCycle1(ListNode *head) {
    ListNode *fast = head;
    ListNode *slow = head;
    ListNode *meet = NULL;

    while (fast) {
      slow = slow->next;
      fast = fast->next;
      if (!fast) {
        return NULL;
      }
      fast = fast->next;

      if (fast == slow) {
        meet = fast;
        break;
      }
    }

    if (meet == NULL) {
      return NULL;
    }
    // head meet 出发，同样速度，相遇时为环起点
    while (head && meet) {
      if (head == meet) {
        return head;
      }

      head = head->next;
      meet = meet->next;
    }
    return NULL;
  }
};

int main(int argc, char const *argv[]) {
  ListNode a(10);
  ListNode b(20);
  ListNode c(30);
  ListNode d(40);
  ListNode e(50);
  ListNode f(60);
  ListNode g(70);
  a.next = &b;
  b.next = &c;
  c.next = &d;
  d.next = &e;
  e.next = &f;
  f.next = &g;
  g.next = &c;

  Solution solve;
  ListNode *node = solve.detectCycle1(&a);

  if (node) {
    printf("%d\n", node->val);
  } else {
    printf("NULL\n");
  }

  return 0;
}
