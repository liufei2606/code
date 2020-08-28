package test.algrithom.tree;

class Solution {
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

  // public static void dfs(Node treeNode) {
  //   if (treeNode == null) {
  //     return;
  //   }
  //   // 遍历节点
  //   process(treeNode);
  //       // 遍历左节点
  //       dfs(treeNode.left);
  //   // 遍历右节点
  //   dfs(treeNode.right);
  // }
}
