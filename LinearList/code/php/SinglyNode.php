<?php
/**
 * 单向链表结点
 * @author phachon@163.com
 */
class SinglyNode {

	/**
	 * 结点数据
	 * @var string
	 */
	public $data = "";

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
		$this->next = NULL;
	}
}