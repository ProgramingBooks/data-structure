<?php
/**
 * 双向链表结点
 * @author phachon@163.com
 */
class DoublyNode {

	/**
	 * 结点数据
	 * @var string
	 */
	public $data = "";

	/**
	 * 前驱结点
	 * @var null
	 */
	public $prev = NULL;

	/**
	 * 后继结点指针
	 * @var null
	 */
	public $next = NULL;

	/**
	 * SinglyNode constructor.
	 * @param $data
	 */
	public function __construct($data = "") {
		$this->data = $data;
		$this->prev = NULL;
		$this->next = NULL;
	}
}