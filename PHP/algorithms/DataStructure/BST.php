<?php


namespace Algorithms\Search\DataStructure;

include '../../vendor/autoload.php';

class BST
{

	public $root = null;

	public function __construct(int $data)
	{
		$this->root = new Node($data);
	}

	public function isEmpty(): bool
	{
		return $this->root === null;
	}

	public function insert(int $data)
	{
		if ($this->isEmpty()) {
			$node = new Node($data);
			$this->root = $node;
			return $node;
		}
		$node = $this->root;
		while ($node) {
			if ($data > $node->data) {
				if ($node->right) {
					$node = $node->right;
				} else {
					$node->right = new Node($data, $node);
					$node = $node->right;
					break;
				}
			} elseif ($data < $node->data) {
				if ($node->left) {
					$node = $node->left;
				} else {
					$node->left = new Node($data, $node);
					$node = $node->left;
					break;
				}
			} else {
				break;
			}
		}
		return $node;
	}

	public function traverse(Node $node, string $type = "in-order")
	{
		switch ($type) {
			case "in-order":
				$this->inOrder($node);
				break;
			case "pre-order":
				$this->preOrder($node);
				break;
			case "post-order":
				$this->postOrder($node);
				break;
		}
	}

	public function preOrder(Node $node)
	{
		if ($node) {
			echo $node->data." ";
			if ($node->left) {
				$this->traverse($node->left);
			}
			if ($node->right) {
				$this->traverse($node->right);
			}
		}
	}

	public function inOrder(Node $node)
	{
		if ($node) {
			if ($node->left) {
				$this->traverse($node->left);
			}
			echo $node->data." ";
			if ($node->right) {
				$this->traverse($node->right);
			}
		}
	}

	public function postOrder(Node $node)
	{
		if ($node) {
			if ($node->left) {
				$this->traverse($node->left);
			}
			if ($node->right) {
				$this->traverse($node->right);
			}
		}
	}

	public function search(int $data)
	{
		if ($this->isEmpty()) {
			return false;
		}
		$node = $this->root;
		while ($node) {
			if ($data > $node->data) {
				$node = $node->right;
			} elseif ($data < $node->data) {
				$node = $node->left;
			} else {
				break;
			}
		}
		return $node;
	}


	public function remove(int $data)
	{
		$node = $this->search($data);
		if ($node) {
			$node->delete();
		}
	}
}

$tree = new BST(10);
$tree->insert(12);
$tree->insert(6);
$tree->insert(3);
$tree->insert(8);
$tree->insert(15);
$tree->insert(13);
$tree->insert(36);
$tree->traverse($tree->root);
echo PHP_EOL;
echo $tree->search(14) ? "Found"."\n" : "Not Found"."\n";
echo $tree->search(36) ? "Found"."\n" : "Not Found"."\n";
$tree->remove(15);
$tree->traverse($tree->root);
echo PHP_EOL;

$tree->traverse($tree->root, 'pre-order');

echo PHP_EOL;
$tree->traverse($tree->root, 'in-order');

echo PHP_EOL;
$tree->traverse($tree->root, 'post-order');
