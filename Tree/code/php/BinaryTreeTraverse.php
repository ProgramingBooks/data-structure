<?php
/**
 * 二叉树的遍历
 * 先序、中序、后序、层序
 */

class BinaryTreeTraverse {

	/**
	 * 二叉树的节点
	 * @var null
	 */
	private $_binaryTreeNode = NULL;

	/**
	 * BinaryTreeTraverse constructor.
	 * @param BinaryTreeNode $binaryTreeRoot
	 */
	public function __construct(BinaryTreeNode $binaryTreeRoot) {
		$this->_binaryTreeNode = $binaryTreeRoot;
	}

	/**
	 * 先序遍历（根-左-右）递归实现
	 */
	public function NLR() {
		return $this->_nlr($this->_binaryTreeNode);
	}
	private function _nlr($node) {
		static $data = [];
		if ($node == NULL) {
			return;
		}
		array_push($data, $node->value);
		$this->_nlr($node->left);
		$this->_nlr($node->right);
		return $data;
	}

	/**
	 * 中序遍历（左-根-右）递归实现
	 */
	public function LNR() {
		return $this->_lnr($this->_binaryTreeNode);
	}
	private function _lnr($node) {
		static $data = [];
		if ($node == NULL) {
			return;
		}
		$this->_lnr($node->left);
		array_push($data, $node->value);
		$this->_lnr($node->right);
		return $data;
	}

	/**
	 * 后序遍历（左-右-根）递归实现
	 */
	public function LRN() {
		return $this->_lrn($this->_binaryTreeNode);
	}
	private function _lrn($node) {
		static $data = [];
		if ($node == NULL) {
			return;
		}
		$this->_lrn($node->left);
		$this->_lrn($node->right);
		array_push($data, $node->value);

		return $data;
	}

	/**
	 * 先序遍历（根-左-右）非递归实现
	 */
	public function NLR1() {

		$data = [];
		$stack = new SplStack();
		$stack->push($this->_binaryTreeNode);
		while (!$stack->isEmpty()) {
			$node = $stack->pop();
			array_push($data, $node->value);
			if ($node->right) {
				$stack->push($node->right);
			}
			if ($node->left) {
				$stack->push($node->left);
			}
		}
		return $data;
	}

	/**
	 * 中序遍历（左-根-右）非递归实现
	 */
	public function LNR1() {

		$data = [];
		$stack = new SplStack();
		$current = $this->_binaryTreeNode;
		while (!$stack->isEmpty() || $current != NULL) {
			// 先找到最左节点，一路压左节点
			while($current != NULL) {
				$stack->push($current);
				$current = $current->left;
			}

			// 出左节点
			$current = $stack->pop();
			array_push($data, $current->value);
			$current = $current->right;
		}
		return $data;
	}

	/**
	 * 后序遍历（左-右-根）非递归实现, 双栈法
	 */
	public function LRN1() {

		$data = [];
		$stack = new SplStack();
		$outStack = new SplStack();
		$stack->push($this->_binaryTreeNode);
		while (!$stack->isEmpty()) {
			$node = $stack->pop();
			$outStack->push($node);
			if ($node->right != NULL) {
				$stack->push($node->right);
			}
			if ($node->left != NULL) {
				$stack->push($node->left);
			}
		}

		// 出栈
		while (!$outStack->isEmpty()) {
			$node = $outStack->pop();
			array_push($data, $node->value);
		}

		return $data;
	}

	/**
	 * 层序遍历（队列实现）
	 */
	public function CNN() {

		$data = [];
		$queue = new SplQueue();
		$queue->push($this->_binaryTreeNode);
		while(!$queue->isEmpty()) {
			$node = $queue->shift();
			array_push($data, $node->value);
			if ($node->left) {
				$queue->push($node->left);
			}
			if ($node->right) {
				$queue->push($node->right);
			}
		}
		return $data;
	}

	/**
	 * 层序遍历延伸，分层打印
	 * 二维数组，按层次记录
	 */
	public function CNN1() {
		$data = [];
		$queue = new SplQueue();
		$queue->push($this->_binaryTreeNode);
		while(!$queue->isEmpty()) {
			$count = $queue->count();
			$item = [];
			while ($count--) {
				$node = $queue->shift();
				array_push($item, $node->value);
				if ($node->left) {
					$queue->push($node->left);
				}
				if ($node->right) {
					$queue->push($node->right);
				}
			}
			array_push($data, $item);
		}
		return $data;
	}
}