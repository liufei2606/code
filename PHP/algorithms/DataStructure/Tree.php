<?php


namespace Algorithms\Search\DataStructure;
include '../../vendor/autoload.php';


class Tree
{

	public $root = null;

	public function __construct(TreeNode $node)
	{
		$this->root = $node;
	}

	public function traverse(TreeNode $node, int $level = 0)
	{

		if ($node) {
			echo str_repeat("-", $level);
			echo $node->data."\n";

			foreach ($node->children as $childNode) {
				$this->traverse($childNode, $level + 1);
			}
		}
	}

}

try {

	$ceo = new TreeNode("CEO");

	$tree = new Tree($ceo);

	$cto = new TreeNode("CTO");
	$cfo = new TreeNode("CFO");
	$cmo = new TreeNode("CMO");
	$coo = new TreeNode("COO");

	$ceo->addChildren($cto);
	$ceo->addChildren($cfo);
	$ceo->addChildren($cmo);
	$ceo->addChildren($coo);

	$seniorArchitect = new TreeNode("Senior Architect");
	$softwareEngineer = new TreeNode("Software Engineer");
	$userInterfaceDesigner = new TreeNode("User Interface Designer");
	$qualityAssuranceEngineer = new TreeNode("Quality Assurance Engineer");

	$cto->addChildren($seniorArchitect);
	$seniorArchitect->addChildren($softwareEngineer);
	$cto->addChildren($qualityAssuranceEngineer);
	$cto->addChildren($userInterfaceDesigner);

	$tree->traverse($tree->root);

} catch (Exception $e) {
	echo $e->getMessage();
}
