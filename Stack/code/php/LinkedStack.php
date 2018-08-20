<?php
/**
 * 链栈的基本操作(单向链表实现)
 * @author phachon@163.com
 */
class LinkedStack {

	/**
	 * 头结点
	 * @var null
	 */
	private $_headerNode = NULL;

	/**
	 * 栈底指针
	 * @var null
	 */
	private $_base = NULL;

	/**
	 * 栈顶指针
	 * @var null
	 */
	private $_top = NULL;

	/**
	 * 链表的长度
	 * @var int
	 */
	private $_length = 0;

	/**
	 * LinkedStack constructor.
	 */
	public function __construct() {
		$this->_length = 0;
		$this->_headerNode = new SinglyNode();
	}

	/**
	 * 创建一个空栈
	 * @return LinkedStack
	 */
	public static function create() {
		return new self();
	}

	/**
	 * 销毁一个栈
	 */
	public function destroy() {

	}

	/**
	 * 清空一个栈
	 */
	public function clear(){

	}

	/**
	 * 是否是空栈
	 */
	public function isEmpty() {

	}

	/**
	 * 获取栈的长度
	 */
	public function length() {
		return $this->_length;
	}

	/**
	 * 获取栈顶元素
	 */
	public function getTop() {

	}

	/**
	 * 插入元素到栈顶
	 * @param $data
	 */
	public function push($data) {
		$node = new SinglyNode($data);
		$node->next = $this->_top;
		$this->_top = $node;
		$this->_length++;
	}

	/**
	 * 删除栈顶元素,并返回元素值
	 */
	public function pop() {

	}

	/**
	 * 从栈底到栈顶遍历栈元素
	 * @param $funcName
	 */
	public function visit($funcName) {

	}

	/**
	 * 打印输出
	 */
	public function printStr() {

	}
}