<?php
/**
 * 链栈的基本操作(基于单向链表)
 * @author phachon@163.com
 */
class LinkedStack {

	/**
	 * 栈底指针
	 * @var null
	 */
	private $_base = NULL;

	/**
	 * 栈顶指针，也就是第一个结点。
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
		$this->_top = NULL;
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
		while ($this->_top != NULL) {
			$next = $this->_top->next;
			unset($this->_top);
			$this->_top = $next;
		}
		$this->_base = NULL;
		$this->_length = 0;
	}

	/**
	 * 清空一个栈
	 */
	public function clear() {
		$current = $this->_top;
		while ($current != NULL) {
			$next = $current->next;
			unset($current);
			$current = $next;
		}

		$this->_top = NULL;
		$this->_base = NULL;
		$this->_length = 0;
	}

	/**
	 * 是否是空栈
	 */
	public function isEmpty() {
		return $this->_top == NULL;
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
		if ($this->_top != NULL) {
			return $this->_top->data;
		}
		return "";
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
		if ($this->_base == NULL) {
			$this->_base = $this->_top;
		}
	}

	/**
	 * 删除栈顶元素,并返回元素值
	 */
	public function pop() {
		if ($this->_top != NULL) {
			$data = $this->_top->data;
			$next = $this->_top->next;
			unset($this->_top);
			$this->_top = $next;
			$this->_length--;
			return $data;
		}
		return "";
	}

	/**
	 * 从栈顶到栈底遍历栈元素
	 * @param $funcName
	 */
	public function visit($funcName) {
		$current = $this->_top;
		while ($current != NULL) {
			$funcName($current);
			$current = $current->next;
		}
	}

	/**
	 * 从栈顶到栈底的元素打印输出
	 */
	public function printStr() {
		$printStr = "[";
		$current = $this->_top;
		while ($current != NULL) {
			$printStr = $printStr.$current->data.",";
			$current = $current->next;
		}
		$printStr = rtrim($printStr, ",");
		$printStr .= "]";
		return $printStr;
	}
}