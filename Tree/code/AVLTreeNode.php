<?php
/**
 * AVL 树节点
 */
class AVLTreeNode {

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
	 * 平衡因子
	 * @var int
	 */
	public $bf = 0;

	/**
	 * 数据元素值
	 * @var string
	 */
	public $value = "";

	/**
	 * 初始化结点
	 * AVLTreeNode constructor.
	 * @param string $value
	 */
	public function __construct($value = "") {
		$this->value = $value;
		$this->left = NULL;
		$this->right = NULL;
		$this->parent = NULL;
		$this->bf = 0;
	}
}