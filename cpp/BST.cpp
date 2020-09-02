struct Node {
  int data;
  bool color;
  Node *left, *right, *parent;

  // 构造器
  Node(int data) {
    this->data = data;
    left = right = parent = NULL;
    this->color = RED;
  }
};

/*标准的二叉排序树的插入操作*/
Node *BSTInsert(Node *root, Node *x) {
  /* 如果树为空，则插入的结点作为根结点返回 */
  if (root == NULL)
    return x;

  /* x的值小于根结点的值，则向左子树走 */
  if (x->data < root->data) {
    root->left = BSTInsert(root->left, x);
    root->left->parent = root;
  } else if (x->data > root->data) {
    root->right = BSTInsert(root->right, x);
    root->right->parent = root;
  }

  /* 返回插入结点 x 的树根*/
  return root;
}

void RBTree::rotateLeft(Node *&root, Node *&g) {
  Node *p = g->right;

  g->right = p->left;  //g->right = T3

  if (g->right != NULL)    //T3 != NULL
    g->right->parent = g;  //T3->parent = g

  p->parent = g->parent;

  if (g->parent == NULL) {
    root = p;
  } else if (g == g->parent->left) {
    g->parent->left = p;
  } else {
    g->parent->right = p;
  }

  p->left = g;
  g->parent = p;
}

void RBTree::rotateRight(Node *&root, Node *&g) {
  Node *p = g->left;

  g->left = p->right;

  if (g->left != NULL)
    g->left->parent = g;

  p->parent = g->parent;

  if (g->parent == NULL)
    root = p;

  else if (g == g->parent->left)
    g->parent->left = p;

  else
    g->parent->right = p;

  p->right = g;
  g->parent = p;
}
// 处理由于红黑树结点的插入操作所造成的平衡问题
void RBTree::fixViolation(Node *&root, Node *&pt) {
  Node *parent_pt = NULL;
  Node *grand_parent_pt = NULL;

  while ((pt != root) && (pt->color != BLACK) &&
         (pt->parent->color == RED)) {
    parent_pt = pt->parent;
    grand_parent_pt = pt->parent->parent;

    /* 情况一:
   pt的父结点parent_pt 是其爷爷结点grand_parent_pt的左孩子 */
    if (parent_pt == grand_parent_pt->left) {
      Node *uncle_pt = grand_parent_pt->right;

      /* Case : a) pt 的叔叔结点 uncle_pt 为红色结点
      只需要调整结点颜色，不需要旋转*/
      if (uncle_pt != NULL && uncle_pt->color == RED) {
        grand_parent_pt->color = RED;
        parent_pt->color = BLACK;
        uncle_pt->color = BLACK;
        pt = grand_parent_pt;
      } else  // Case :b) x 的叔叔结点为黑色
      {
        /* Case : 2
    pt 是其父结点的右孩子
    需要左旋操作 */
        if (pt == parent_pt->right) {
          rotateLeft(root, parent_pt);
          pt = parent_pt;
          parent_pt = pt->parent;
        }

        /* Case : 3
    pt 是其父结点的左孩子
    需要右旋操作 */
        rotateRight(root, grand_parent_pt);
        swap(parent_pt->color, grand_parent_pt->color);
        pt = parent_pt;
      }
    }

    /* 情况二:
  pt的父结点parent_pt 是其爷爷结点grand_parent_pt的左孩子 */
    else {
      Node *uncle_pt = grand_parent_pt->left;

      /* Case : a) pt 的叔叔结点 uncle_pt 为红色结点
      只需要调整结点颜色，不需要旋转*/
      if ((uncle_pt != NULL) && (uncle_pt->color == RED)) {
        grand_parent_pt->color = RED;
        parent_pt->color = BLACK;
        uncle_pt->color = BLACK;
        pt = grand_parent_pt;
      } else  // Case :b) x 的叔叔结点为黑色
      {
        /* Case : 2
    pt 是其父结点的右孩子
    需要左旋操作 */
        if (pt == parent_pt->left) {
          rotateRight(root, parent_pt);
          pt = parent_pt;
          parent_pt = pt->parent;
        }

        /* Case : 3
    pt 是其父结点的左孩子
    需要右旋操作 */
        rotateLeft(root, grand_parent_pt);
        swap(parent_pt->color, grand_parent_pt->color);
        pt = parent_pt;
      }
    }
  }

  //如果是根结点，颜色置为黑色
  root->color = BLACK;
}

// 红黑树插入操作
void RBTree::insert(const int &data) {
  Node *pt = new Node(data);

  // 执行标准的BST插入操作
  root = BSTInsert(root, pt);

  // 进行平衡处理
  fixViolation(root, pt);
}