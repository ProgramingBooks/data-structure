<?php
/**
 * 二叉搜索树 (BST) 的实现
 * @author phachon@163.com
 */

class BinarySearchTree {

	/**
	 * 根结点
	 * @var null
	 */
	private $_root = NULL;

	/**
	 * 初始化二叉搜索树(根节点为空)
	 * BinarySearchTree constructor.
	 */
	public function __construct() {
		$binaryNode = new BinaryTreeNode();
		$this->_root = $binaryNode;
	}

	/**
	 * 插入一个结点元素到二叉搜索表
	 * @param string $value
	 * @throws Exception
	 */
	public function insert($value) {
		// root 是否存在
		if ($this->_root->value == "") {
			$this->_root->value = $value;
			return;
		}

		$binaryNode = new BinaryTreeNode($value);
		$current = $this->_root;
		while($current != NULL) {
			if ($value == $current->value) {
				throw new Exception("Insert failed, node is exists!");
			}
			if ($value > $current->value) {
				if ($current->right == NULL) {
					$binaryNode->parent = $current;
					$current->right = $binaryNode;
					break;
				}else {
					$current = $current->right;
				}
			}
			if ($value < $current->value){
				if ($current->left == NULL) {
					$binaryNode->parent = $current;
					$current->left = $binaryNode;
					break;
				}else {
					$current = $current->left;
				}
			}
		}
	}

	/**
	 * 查找树中 value 对应的结点, 未找到返回 NULL (二分查找)
	 * @param $value
	 * @return BinaryTreeNode|null
	 */
	public function search($value) {
		$current = $this->_root;
		while ($current != NULL) {
			if ($current->value == $value) {
				return $current;
			}else if ($value > $current->value) {
				$current = $current->right;
			}else if ($value < $current->value) {
				$current = $current->left;
			}
		}
		return NULL;
	}

	/**
	 * 更新节点数据
	 * @param $value
	 * @throws Exception
	 */
	public function set($value) {
		$node = $this->search($value);
		if ($node == NULL) {
			throw new Exception("Set failed, node is not exists!");
		}
		$node->value = $value;
	}

	/**
	 * 删除一个 value 节点
	 * @param $value
	 * @throws Exception
	 */
	public function del($value) {
		$node = $this->search($value);
		if ($node == NULL) {
			throw new Exception("Del failed, node not exists!");
		}

		// 该结点如果是叶子节点,只需要将父结点左右子树指向空
		if ($node->left == NULL && $node->right == NULL) {
			$node->parent->left = NULL;
			$node->parent->right = NULL;
			return;
		}
		// 该结点只有左子树
		if ($node->left != NULL && $node->right == NULL) {
			// 判断该结点是父结点的左子树还是右子树
			if ($node->parent->left == $node) {
				$node->parent->left = $node->left;
			}else {
				$node->parent->right = $node->left;
			}
			$node->left->parent = $node->parent;
			return;
		}
		// 只有右子树
		if ($node->left == NULL && $node->right != NULL) {
			if ($node->parent->left == $node) {
				$node->parent->left = $node->right;
			}else {
				$node->parent->right = $node->right;
			}
			$node->left->parent = $node->parent;
			return;
		}
		// 左右子树都存在, 需要把该结点的左子树的最大结点或者右子树的最小结点移动到该结点的位置
		if ($node->left != NULL && $node->right != NULL) {
			// 查找左子树的最大结点
			$leftMaxNode = $node;
			while($leftMaxNode != NULL) {
				$leftMaxNode = $leftMaxNode->right;
			}
			// 去除替换节点与父结点的连接
			$leftMaxNode->parent->right = NULL;
			// 替换结点的左右子树
			$leftMaxNode->left = $node->left;
			$leftMaxNode->right = $node->right;
			// 移动替换节点到删除的位置
			if ($node->parent->left == $node) {
				$node->parent->left = $leftMaxNode;
			}else {
				$node->parent->right = $leftMaxNode;
			}
		}

		unset($node);
	}

	/**
	 * 获取最大的值
	 */
	public function max() {
		$current = $this->_root;
		while ($current != NULL) {
			$current = $current->right;
		}
		return $current->value;
	}

	/**
	 * 获取最小的值
	 */
	public function min() {
		$current = $this->_root;
		while ($current != NULL) {
			$current = $current->left;
		}
		return $current->value;
	}

	/**
	 * 获取结点的深度
	 * @param $node
	 * @return int
	 */
	public function _nodeDepth($node) {
		if ($node == NULL) {
			return 0;
		}

		$leftDep = $this->_nodeDepth($node->left);
		$rightDep = $this->_nodeDepth($node->right);

		return ($leftDep > $rightDep ? $leftDep: $rightDep) + 1;
	}

	/**
	 * 获取二叉查找树的深度
	 */
	public function depth() {
		return $this->_nodeDepth($this->_root);
	}

	/**
	 * 是否是空的二叉搜索树
	 */
	public function isEmpty() {
		return $this->_root->value == "";
	}
}
