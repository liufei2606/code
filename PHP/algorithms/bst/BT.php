<?php

namespace Algorithms\Bst;

use Algrithoms\Bst\Node;

class BT
{

    /**
     * 前序遍历
     *
     * @param  Node  $tree
     */
    public static function preOrderTraverse($tree)
    {
        if ($tree == null) {
            return;
        }
        printf("%s\n", $tree->data);
        static::preOrderTraverse($tree->left);
        static::preOrderTraverse($tree->right);
    }

    /**
     * 中序遍历
     *
     * @param  Node  $tree
     */
    public static function midOrderTraverse($tree)
    {
        if ($tree == null) {
            return;
        }
        static::midOrderTraverse($tree->left);
        printf("%s\n", $tree->data);
        static::midOrderTraverse($tree->right);
    }

    /**
     * 后序遍历
     *
     * @param  Node  $tree
     */
    public static function postOrderTraverse($tree)
    {
        if ($tree == null) {
            return;
        }
        static::postOrderTraverse($tree->left);
        static::postOrderTraverse($tree->right);
        printf("%s\n", $tree->data);
    }
}

$node1 = new Node('A');
$node2 = new Node('B');
$node3 = new Node('C');
$node1->left = $node2;
$node1->right = $node3;
BST::preOrderTraverse($node1);
printf("========\n");
BST::midOrderTraverse($node1);
printf("========\n");
BST::postOrderTraverse($node1);
