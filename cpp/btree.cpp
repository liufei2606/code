class BTreeNode {
  int *keys;      // 存储关键字的数组
  int t;          // 最小度 (定义一个结点包含关键字的个数 t-1 <= num <= 2t -1)
  BTreeNode **C;  // 存储孩子结点指针的数组
  int n;          // 记录当前结点包含的关键字的个数
  bool leaf;      // 叶子结点的一个标记，如果是叶子结点则为true,否则false
 public:
  BTreeNode(int _t, bool _leaf);

  // 中序遍历
  void BTreeNode::traverse() {
    // 有 n 个关键字和 n+1 个孩子
    // 遍历 n 个关键字和前 n 个孩子
    int i;
    for (i = 0; i < n; i++) {
      // 如果当前结点不是叶子结点, 在打印 key[i] 之前,
      // 先遍历以 C[i] 为根的子树.
      if (leaf == false)
        C[i]->traverse();
      cout << " " << keys[i];
    }

    // 打印以最后一个孩子为根的子树
    if (leaf == false)
      C[i]->traverse();
  }

  // 查找一个关键字
  BTreeNode *search(int k);  // 如果没有出现，则返回 NULL

  // 设置友元，以便访问BTreeNode类中的私有成员
  friend class BTree;
};

// B-树
class BTree {
  BTreeNode *root;  //指向B-树根节点的指针
  int t;            // 最小度
 public:
  // 构造器（初始化一棵树为空树）
  BTree(int _t) {
    root = NULL;
    t = _t;
  }

  // 进行中序遍历
  void traverse() {
    if (root != NULL) root->traverse();
  }

  // B-树中查找一个关键字 k
  BTreeNode *search(int k) {
    return (root == NULL) ? NULL : root->search(k);
  }

  // B-树中插入一个新的结点 k 主函数
  void BTree::insert(int k) {
    // 如果树为空树
    if (root == NULL) {
      // 为根结点分配空间
      root = new BTreeNode(t, true);
      root->keys[0] = k;  //插入结点 k
      root->n = 1;        // 更新根结点高寒的关键字的个数为 1
    } else {
      // 当根结点已满，则对B-树进行生长操作
      if (root->n == 2 * t - 1) {
        // 为新的根结点分配空间
        BTreeNode *s = new BTreeNode(t, false);

        // 将旧的根结点作为新的根结点的孩子
        s->C[0] = root;

        // 将旧的根结点分裂为两个，并将一个关键字上移到新的根结点
        s->splitChild(0, root);

        // 新的根结点有两个孩子结点
        //确定哪一个孩子将拥有新插入的关键字
        int i = 0;
        if (s->keys[0] < k)
          i++;
        s->C[i]->insertNonFull(k);

        // 新的根结点更新为 s
        root = s;
      } else  //根结点未满，调用insertNonFull()函数进行插入
        root->insertNonFull(k);
    }
  }

  // 将关键字 k 插入到一个未满的结点中
  void BTreeNode::insertNonFull(int k) {
    // 初始化 i 为结点中的最后一个关键字的位置
    int i = n - 1;

    // 如果当前结点是叶子结点
    if (leaf == true) {
      // 下面的循环做两件事：
      // a) 找到新插入的关键字位置并插入
      // b) 移动所有大于关键字 k 的向后移动一个位置
      while (i >= 0 && keys[i] > k) {
        keys[i + 1] = keys[i];
        i--;
      }

      // 插入新的关键字，结点包含的关键字个数加 1
      keys[i + 1] = k;
      n = n + 1;
    } else {
      //找到第一个大于关键字 k 的关键字 keys[i] 的孩子结点
      while (i >= 0 && keys[i] > k)
        i--;

      // 检查孩子结点是否已满
      if (C[i + 1]->n == 2 * t - 1) {
        // 如果已满，则进行分裂操作
        splitChild(i + 1, C[i + 1]);

        // 分裂后，C[i] 中间的关键字上移到父结点，
        // C[i] 分裂称为两个孩子结点
        // 找到新插入关键字应该插入的结点位置
        if (keys[i + 1] < k)
          i++;
      }
      C[i + 1]->insertNonFull(k);
    }
  }

  // 结点 y 已满，则分裂结点 y
  void BTreeNode::splitChild(int i, BTreeNode *y) {
    // 创建一个新的结点存储 t - 1 个关键字
    BTreeNode *z = new BTreeNode(y->t, y->leaf);
    z->n = t - 1;

    //将结点 y 的后 t -1 个关键字拷贝到 z 中
    for (int j = 0; j < t - 1; j++)
      z->keys[j] = y->keys[j + t];

    // 如果 y 不是叶子结点，拷贝 y 的后 t 个孩子结点到 z中
    if (y->leaf == false) {
      for (int j = 0; j < t; j++)
        z->C[j] = y->C[j + t];
    }

    //将 y 所包含的关键字的个数设置为 t -1
    //因为已满则为2t -1 ，结点 z 中包含 t - 1 个
    //一个关键字需要上移
    //所以 y 中包含的关键字变为 2t-1 - (t-1) -1
    y->n = t - 1;

    // 给当前结点的指针分配新的空间，
    //因为有新的关键字加入，父结点将多一个孩子。
    for (int j = n; j >= i + 1; j--)
      C[j + 1] = C[j];

    // 当前结点的下一个孩子设置为z
    C[i + 1] = z;

    //将所有父结点中比上移的关键字大的关键字后移
    //找到上移结点的关键字的位置
    for (int j = n - 1; j >= i; j--)
      keys[j + 1] = keys[j];

    // 拷贝 y 的中间关键字到其父结点中
    keys[i] = y->keys[t - 1];

    //当前结点包含的关键字个数加 1
    n = n + 1;
  }
};