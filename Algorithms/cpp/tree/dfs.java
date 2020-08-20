public class Solution {
  // 递归实现
  private static class Node {
    /**
     * 节点值
     */
    public int value;
    /**
     * 左节点
     */
    public Node left;
    /**
     * 右节点
     */
    public Node right;

    public Node(int value, Node left, Node right) {
      this.value = value;
      this.left = left;
      this.right = right;
    }
  }

  public static void dfs(Node treeNode) {
    if (treeNode == null) {
      return;
    }
    // 遍历节点
    process(treeNode)
        // 遍历左节点
        dfs(treeNode.left);
    // 遍历右节点
    dfs(treeNode.right);
  }
}

/**
 * 使用栈来实现 dfs
 * @param root
 */
public static void dfsWithStack(Node root) {
  if (root == null) {
    return;
  }

  Stack<Node> stack = new Stack<>();
  // 先把根节点压栈
  stack.push(root);
  while (!stack.isEmpty()) {
    Node treeNode = stack.pop();
    // 遍历节点
    process(treeNode)

        // 先压右节点
        if (treeNode.right != null) {
      stack.push(treeNode.right);
    }

    // 再压左节点
    if (treeNode.left != null) {
      stack.push(treeNode.left);
    }
  }

  /**
   * leetcode 104: 求树的最大深度
   * @param node
   * @return
   */
  public static int getMaxDepth(Node node) {
    if (node == null) {
      return 0;
    }
    int leftDepth = getMaxDepth(node.left) + 1;
    int rightDepth = getMaxDepth(node.right) + 1;
    return Math.max(leftDepth, rightDepth);
  }

  /**
   * leetcode 111: 求树的最小深度
   * @param node
   * @return
   */
  public static int getMinDepth(Node node) {
    if (node == null) {
      return 0;
    }
    int leftDepth = getMinDepth(node.left) + 1;
    int rightDepth = getMinDepth(node.right) + 1;
    return Math.min(leftDepth, rightDepth);
  }

  private static final List<List<Integer>> TRAVERSAL_LIST = new ArrayList<>();
  /**
   * leetcdoe 102: 二叉树的层序遍历, 使用 dfs
   * @param root
   * @return
   */
  private static void dfs(Node root, int level) {
    if (root == null) {
      return;
    }

    if (TRAVERSAL_LIST.size() < level + 1) {
      TRAVERSAL_LIST.add(new ArrayList<>());
    }

    List<Integer> levelList = TRAVERSAL_LIST.get(level);
    levelList.add(root.value);

    // 遍历左结点
    dfs(root.left, level + 1);

    // 遍历右结点
    dfs(root.right, level + 1);
  }
}