<?php
/**
 * 二叉树的遍历测试
 * 先序、中序、后序、层序
 */

include 'BinaryTreeNode.php';
include 'BinaryTreeTraverse.php';

// run test
BinaryTreeTraverse_Test::run();

class BinaryTreeTraverse_Test {

	/**
	 * 运行测试
	 */
	public static function run() {
		try {
			$instance = new ReflectionClass("BinaryTreeTraverse_Test");
		}catch (Exception $e) {
			exit($e->getMessage());
		}
		$sequenceList = $instance->newInstance();
		$methods = $instance->getMethods();
		foreach ($methods as $method) {
			if (strpos($method->name, "_test")) {
				$instance->getMethod($method->name)->invokeArgs($sequenceList, []);
			}
		}
	}

	/**
	 * 构建二叉树
	 */
	public function createBinaryTree() {
		$root = new BinaryTreeNode(10);
		$root->left = new BinaryTreeNode(12);
		$root->right = new BinaryTreeNode(18);

		$root->left->left = new BinaryTreeNode(16);
		$root->left->right = new BinaryTreeNode(2);

		$root->right->left = new BinaryTreeNode(17);
		$root->right->right = new BinaryTreeNode(24);

		$root->left->left->left = new BinaryTreeNode(19);
		$root->right->right->left = new BinaryTreeNode(222);
		return $root;
	}

	/**
	 * 先序遍历测试
	 */
	public function NLR_test() {
		$binaryTree = $this->createBinaryTree();
		$binaryTreeTraverse = new BinaryTreeTraverse($binaryTree);

		$data = $binaryTreeTraverse->NLR();
		echo implode(",", $data)."\r\n";
	}

	/**
	 * 中序遍历测试
	 */
	public function LNR_test() {
		$binaryTree = $this->createBinaryTree();
		$binaryTreeTraverse = new BinaryTreeTraverse($binaryTree);

		$data = $binaryTreeTraverse->LNR();
		echo implode(",", $data)."\r\n";
	}

	/**
	 * 后序遍历测试
	 */
	public function LRN_test() {
		$binaryTree = $this->createBinaryTree();
		$binaryTreeTraverse = new BinaryTreeTraverse($binaryTree);

		$data = $binaryTreeTraverse->LRN();
		echo implode(",", $data)."\r\n";
	}

	/**
	 * 先序遍历测试（非递归）
	 */
	public function NLR1_test() {
		$binaryTree = $this->createBinaryTree();
		$binaryTreeTraverse = new BinaryTreeTraverse($binaryTree);

		$data = $binaryTreeTraverse->NLR1();
		echo implode(",", $data)."\r\n";
	}

	/**
	 * 中序遍历测试（非递归）
	 */
	public function LNR1_test() {
		$binaryTree = $this->createBinaryTree();
		$binaryTreeTraverse = new BinaryTreeTraverse($binaryTree);

		$data = $binaryTreeTraverse->LNR1();
		echo implode(",", $data)."\r\n";
	}

	/**
	 * 后序遍历测试（非递归）
	 */
	public function LRN1_test() {
		$binaryTree = $this->createBinaryTree();
		$binaryTreeTraverse = new BinaryTreeTraverse($binaryTree);

		$data = $binaryTreeTraverse->LRN1();
		echo implode(",", $data)."\r\n";
	}

	/**
	 * 层序遍历测试
	 */
	public function CNN_test() {
		$binaryTree = $this->createBinaryTree();
		$binaryTreeTraverse = new BinaryTreeTraverse($binaryTree);

		$data = $binaryTreeTraverse->CNN();
		echo implode(",", $data)."\r\n";
	}

	/**
	 * 层序遍历延伸测试
	 */
	public function CNN1_test() {
		$binaryTree = $this->createBinaryTree();
		$binaryTreeTraverse = new BinaryTreeTraverse($binaryTree);

		$data = $binaryTreeTraverse->CNN1();
		foreach ($data as $val) {
			echo implode(",", $val)."\r\n";
		}
	}
}