class Node {
  public int key, val;
  public Node next, prev;
  public Node(int k, int v) {
    this.key = k;
    this.val = v;
  }
}

class DoubleList {
  // 头尾虚节点
  private Node head, tail;
  // 链表元素数
  private int size;

  public DoubleList() {
    // 初始化双向链表的数据
    head = new Node(0, 0);
    tail = new Node(0, 0);
    head.next = tail;
    tail.prev = head;
    size = 0;
  }

  // 在链表尾部添加节点 x，时间 O(1)
  public void addLast(Node x) {
    x.prev = tail.prev;
    x.next = tail;
    tail.prev.next = x;
    tail.prev = x;
    size++;
  }

  // 删除链表中的 x 节点（x 一定存在）
  // 由于是双链表且给的是目标 Node 节点，时间 O(1)
  public void remove(Node x) {
    x.prev.next = x.next;
    x.next.prev = x.prev;
    size--;
  }

  // 删除链表中第一个节点，并返回该节点，时间 O(1)
  public Node removeFirst() {
    if (head.next == tail)
      return null;
    Node first = head.next;
    remove(first);
    return first;
  }

  // 返回链表长度，时间 O(1)
  public int size() {
    return size;
  }
}

class LRUCache {
  // key -> Node(key, val)
  private HashMap<Integer, Node> map;
  // Node(k1, v1) <-> Node(k2, v2)...
  private DoubleList cache;
  // 最大容量
  private int cap;

  public LRUCache(int capacity) {
    this.cap = capacity;
    map = new HashMap<>();
    cache = new DoubleList();
  }

  /* 将某个 key 提升为最近使用的 */
  private void makeRecently(int key) {
    Node x = map.get(key);
    // 先从链表中删除这个节点
    cache.remove(x);
    // 重新插到队尾
    cache.addLast(x);
  }

  /* 添加最近使用的元素 */
  private void addRecently(int key, int val) {
    Node x = new Node(key, val);
    // 链表尾部就是最近使用的元素
    cache.addLast(x);
    // 别忘了在 map 中添加 key 的映射
    map.put(key, x);
  }

  /* 删除某一个 key */
  private void deleteKey(int key) {
    Node x = map.get(key);
    // 从链表中删除
    cache.remove(x);
    // 从 map 中删除
    map.remove(key);
  }

  /* 删除最久未使用的元素 */
  private void removeLeastRecently() {
    // 链表头部的第一个元素就是最久未使用的
    Node deletedNode = cache.removeFirst();
    // 同时别忘了从 map 中删除它的 key
    int deletedKey = deletedNode.key;
    map.remove(deletedKey);
  }
  public int get(int key) {
    if (!map.containsKey(key)) {
      return -1;
    }
    // 将该数据提升为最近使用的
    makeRecently(key);
    return map.get(key).val;
  }
  public void put(int key, int val) {
    if (map.containsKey(key)) {
      // 删除旧的数据
      deleteKey(key);
      // 新插入的数据为最近使用的数据
      addRecently(key, val);
      return;
    }

    if (cap == cache.size()) {
      // 删除最久未使用的元素
      removeLeastRecently();
    }
    // 添加为最近使用的元素
    addRecently(key, val);
  }
}

/* 缓存容量为 2 */
LRUCache cache = new LRUCache(2);
// 你可以把 cache 理解成一个队列
// 假设左边是队头，右边是队尾
// 最近使用的排在队头，久未使用的排在队尾
// 圆括号表示键值对 (key, val)

cache.put(1, 1);
// cache = [(1, 1)]

cache.put(2, 2);
// cache = [(2, 2), (1, 1)]

cache.get(1); // 返回 1
// cache = [(1, 1), (2, 2)]
// 解释：因为最近访问了键 1，所以提前至队头
// 返回键 1 对应的值 1

cache.put(3, 3);
// cache = [(3, 3), (1, 1)]
// 解释：缓存容量已满，需要删除内容空出位置
// 优先删除久未使用的数据，也就是队尾的数据
// 然后把新的数据插入队头

cache.get(2); // 返回 -1 (未找到)
// cache = [(3, 3), (1, 1)]
// 解释：cache 中不存在键为 2 的数据

cache.put(1, 4);
// cache = [(1, 4), (3, 3)]
// 解释：键 1 已存在，把原始值 1 覆盖为 4
// 不要忘了也要将键值对提前到队头