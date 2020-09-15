// 已知前序遍历为{1,2,4,7,3,5,6,8}，中序遍历为{4,7,2,1,5,3,8,6}，它的二叉树是怎么样的？

// 定义结点
// class TreeNode{
//     constructor(data){
//         this.data = data;
//         this.left = null;
//         this.right = null;
//     }
// }

// 参数：前序遍历数组 ~ 中序遍历数组
const reConstructBinaryTree =
    (pre, vin) => {
      // 判断前序数组和中序数组是否为空
      if (!pre || pre.length === 0 || !vin || vin.length === 0) {
        return;
      }
      // 新建二叉树的根节点
      var treeNode = {val: pre[0]}
      // 查找中序遍历中的根节点
      for (var i = 0; i < pre.length; i++) {
        if (vin[i] === pre[0]) {
          // 将左子树的前中序遍历分割开
          treeNode.left =
              reConstructBinaryTree(pre.slice(1, i + 1), vin.slice(0, i));
          // 将右子树的前中序遍历分割开
          treeNode.right =
              reConstructBinaryTree(pre.slice(i + 1), vin.slice(i + 1));
        }
      }
      // 返回该根节点
      return treeNode;
    }

let pre = [1, 2, 4, 7, 3, 5, 6, 8];
let vin = [4, 7, 2, 1, 5, 3, 8, 6];
console.log(reConstructBinaryTree(pre, vin));