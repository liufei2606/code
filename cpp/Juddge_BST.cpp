// 给定一个二叉树，判断它是否是一颗类似于红黑树一样的高度平衡的二叉树。

using namespace std;

struct Node {
  int key;
  Node *left, *right;
};

/* 创建一个新的结点 */
Node *newNode(int key) {
  Node *node = new Node;
  node->key = key;
  node->left = node->right = NULL;
  return (node);
}

// 判断二叉树是否与
bool isBalancedUtil(Node *root, int &maxh, int &minh) {
  // 如果是叶子结点，必然是平衡结点，返回true
  if (root == NULL) {
    maxh = minh = 0;
    return true;
  }

  int lmxh, lmnh;  // 存储左子树的最大与最小高度
  int rmxh, rmnh;  // 存储右子树的最大与最小高度

  // 检查左子树是否平衡，并设置左子的最大与最小高度
  if (isBalancedUtil(root->left, lmxh, lmnh) == false)
    return false;

  // 检查右子树是否平衡，并设置右子树的最大与最小高度
  if (isBalancedUtil(root->right, rmxh, rmnh) == false)
    return false;

  // root 的最大高度为左子树与右子树最大高度的最大值+1
  // root 的最小高度为左右子树的最小高度的最小值 + 1
  maxh = max(lmxh, rmxh) + 1;
  minh = min(lmnh, rmnh) + 1;

  // 如果结点的最大高度小于等于最小高度的两倍，返回true
  if (maxh <= 2 * minh)
    return true;

  return false;
}

// 对 isBalancedUtil() 进行包装
bool isBalanced(Node *root) {
  int maxh, minh;
  return isBalancedUtil(root, maxh, minh);
}

int main() {
  Node *root = newNode(16);
  root->left = newNode(5);
  root->right = newNode(65);
  root->right->left = newNode(32);
  root->right->right = newNode(75);
  root->right->left->left = newNode(30);
  isBalanced(root) ? cout << "Balanced" : cout << "Not Balanced";

  return 0;
}