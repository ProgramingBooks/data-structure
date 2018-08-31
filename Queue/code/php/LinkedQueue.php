<?php
/**
 * 链队列基本操作(基于单向链表)
 * @author phachon@163.com
 */
class LinkedQueue {

	/**
	 * 队列头指针
	 * @var null
	 */
	private $_queueFront = NULL;

	/**
	 * 队列尾指针
	 * @var null
	 */
	private $_queueRear = NULL;

	/**
	 * 队列长度
	 * @var int
	 */
	private $_length = 0;

	/**
	 * 构造空链队列
	 * 头指针和尾指针均指向头结点
	 * LinkedQueue constructor.
	 */
	public function __construct() {
		$node = new SinglyNode();
		$this->_queueFront = $node;
		$this->_queueRear = $node;
		$this->_queueFront->next = NULL;
	}

	/**
	 * @return LinkedQueue
	 */
	public static function create() {
		return new self();
	}

	/**
	 * 销毁队列
	 */
	public function destroy() {
		while($this->_queueFront != NULL){
			$next = $this->_queueFront->next;
			unset($this->_queueFront);
			$this->_queueFront = $next->next;
			unset($next);
		}
		$this->_queueFront = $this->_queueRear = NULL;
		$this->_length = 0;
	}

	/**
	 * 清空队列
	 */
	public function clear() {
		$current = $this->_queueFront->next;
		while ($current != NULL) {
			$next = $current;
			unset($current);
			$current = $next->next;
		}
		$this->_queueRear = $this->_queueFront;
		$this->_length = 0;
	}

	/**
	 * 是否为空队列
	 */
	public function isEmpty() {
		return $this->_queueFront == $this->_queueRear;
	}

	/**
	 * 返回队列的长度
	 */
	public function length() {
		return $this->_length;
	}

	/**
	 * 返回头元素
	 */
	public function getHead() {
		if ($this->_queueFront != NULL) {
			return $this->_queueFront->next;
		}
		return NULL;
	}

	/**
	 * 队尾插入队列元素
	 * @param $data
	 */
	public function insert($data) {
		$node = new SinglyNode($data);
		$node->next = NULL;
		$this->_queueRear->next = $node;
		$this->_length ++;
	}

	/**
	 * 删除队列头元素,并返回元素值
	 */
	public function del() {
		// 队列为空,返回
		if ($this->_queueFront == $this->_queueRear) {
			return;
		}
		$p = $this->_queueFront->next;
		$data = $p->data;
		$this->_queueFront = $p->next;

		// 队列的最后一个元素删除,尾指针会被删除
		if ($this->_queueRear == $p) {
			$this->_queueRear = $this->_queueFront;
		}
		unset($p);
		$this->_length --;
		return $data;
	}

	/**
	 * 循环遍历
	 * @param $func
	 */
	public function visit($func) {
		$current = $this->_queueFront->next;
		while ($current != NULL) {
			$func($current->data);
			$current = $current->next;
		}
	}
}