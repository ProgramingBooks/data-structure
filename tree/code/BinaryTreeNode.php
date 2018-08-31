<?php
/**
 * 二叉树结点
 * @author phachon@163.com
 */
class BinaryTreeNode {

	/**
	 * 左子树指针
	 * @var null
	 */
	public $left = NULL;

	/**
	 * 右子树指针
	 * @var null
	 */
	public $right = NULL;

	/**
	 * 父结点指针
	 * @var null
	 */
	public $parent = NULL;

	/**
	 * 结点数据
	 * @var string
	 */
	public $value = "";

	/**
	 * 初始化二叉树结点
	 * TreeNode constructor.
	 * @param string $value
	 */
	public function __construct($value = "") {
		$this->left = NULL;
		$this->right = NULL;
		$this->parent = NULL;
		$this->value = $value;
	}
}
