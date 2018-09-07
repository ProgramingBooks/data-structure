<?php
/**
 * AVL 平衡二叉树实现
 */
class AVL {

	/**
	 * 根节点
	 * @var null
	 */
	private $_root = NULL;

	/**
	 * 初始化空的 AVL 树, 跟结点值为 null
	 * AVL constructor.
	 */
	public function __construct() {
		$avlNode = new AVLTreeNode();
		$this->_root = $avlNode;
	}

	/**
	 * 插入结点
	 * @param $value
	 * @throws Exception
	 */
	public function insert($value) {
		// 判断跟结点是否为空
		if ($this->_root != NULL && $this->_root->value != "") {
			$this->_root->value = $value;
			return;
		}
		// 检测是否存在
		if ($this->search($value) != NULL) {
			throw new Exception("Insert failed, node is already exists");
		}
		// 开始插入

		$avlNode = new AVLTreeNode($value);
		$current = $this->_root;
		while ($current != NULL) {
			if ($value > $current->value) {
				if ($current->right == NULL) {
					$avlNode->parent = $current;
					$current->right = $avlNode;


					break;
				}else {
					$current = $current->right;
				}
			}
			if ($value < $current->value) {
				if ($current->left == NULL) {
					$avlNode->parent = $current;
					$current->left = $avlNode;
					break;
				}else {
					$current = $current->left;
				}
			}
		}

		// 判断是否需要旋转
	}

	/**
	 * 搜索值为 value 的结点
	 * @param $value
	 * @return AVLTreeNode|null
	 */
	public function search($value) {

		$current = $this->_root;
		while($current != NULL) {
			if($value == $current->value) {
				return $current;
			}
			if ($value > $current->value) {
				$current = $current->right;
			}
			if ($value < $current->value) {
				$current = $current->left;
			}
		}
		return NULL;
	}

	/**
	 * 对以 $currentRoot 为根结点的最小不平衡二叉树做右旋转处理
	 * @param $currentRoot
	 */
	private function _rightRotate($currentRoot) {
		$newRoot = $currentRoot->left;
		$tempRight = $newRoot->right;
		$tempRight->parent =
		$newRoot->right = $currentRoot;
		$currentRoot->left = $tempRight;

		$newRoot->parent = $currentRoot->parent;
	}
}