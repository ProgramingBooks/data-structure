<?php
/**
 * 双向循环链表的基本操作实现
 * @author: phachon@163.com
 */

class DoublyLoopLinkedList {

	/**
	 * 头结点
	 * @var null
	 */
	private $_headerNode = NULL;

	/**
	 * 链表长度
	 * @var int
	 */
	private $_length = 0;

	/**
	 * DoublyLinkedList constructor.
	 */
	public function __construct() {
		$this->_headerNode = new DoublyNode();
		$this->_headerNode->next = $this->_headerNode;
		$this->_headerNode->prev = $this->_headerNode;
	}

	/**
	 * 创建一个空的双向链表
	 * @return DoublyLoopLinkedList
	 */
	public static function create() {
		return new self();
	}

	/**
	 * 获取链表的长度
	 * @return int
	 */
	public function length() {
		return $this->_length;
	}

	/**
	 * 添加结点
	 * @param $data
	 */
	public function addNode($data) {
		$node = new DoublyNode($data);
		$current = $this->_headerNode;
		while($current->next != $this->_headerNode) {
			$current = $current->next;
		}
		$current->next = $node;
		$node->prev = $current;
		$node->next = $this->_headerNode;
		$this->_headerNode->prev = $node;
		$this->_length += 1;
	}

	/**
	 * 链表头部添加结点
	 * @param $data
	 */
	public function addFirstNode($data) {
		$node = new DoublyNode($data);
		$node->prev = $this->_headerNode;
		$node->next = $this->_headerNode->next;
		$this->_headerNode->next = $node;
		$this->_length += 1;
	}

	/**
	 * 在第 index 位置添加新结点
	 * @param $index
	 * @param $data
	 * @throws Exception
	 */
	public function addIndexNode($index, $data) {
		if ($index <= 0 || $index > $this->_length) {
			throw new Exception("Add index node failed, index is error!");
		}
		// 查找 index 位置之前的结点
		$indexPrevNode = $this->_headerNode;
		for ($i=0; $i < $index-1; $i++) {
			$indexPrevNode = $indexPrevNode->next;
		}
		$node = new DoublyNode($data);
		$node->prev = $indexPrevNode;
		$node->next = $indexPrevNode->next;
		$indexPrevNode->next = $node;
		$this->_length += 1;
	}

	/**
	 * 删除第 index 个结点
	 * @param $index
	 * @throws Exception
	 */
	public function delIndexNode($index) {
		if ($index <= 0 || $index > $this->_length) {
			throw new Exception("Del node failed, index is error!");
		}
		// 查找 index 的前置结点
		$indexPrevNode = $this->_headerNode;
		for ($i = 0; $i < $index - 1; $i++) {
			$indexPrevNode = $indexPrevNode->next;
		}
		$indexNode = $indexPrevNode->next;
		$indexNextNode = $indexNode->next;
		if ($indexNextNode != $this->_headerNode) {
			$indexNextNode->prev = $indexPrevNode;
		}
		$indexPrevNode->next = $indexNextNode;
		$this->_length -= 1;
	}

	/**
	 * 获取第 index 个结点值
	 * @param $index
	 * @return string
	 * @throws Exception
	 */
	public function get($index) {
		if ($index <= 0 || $index > $this->_length) {
			throw new Exception("Get node failed, index is error!");
		}
		// 查找第 index 个结点
		$indexNode = $this->_headerNode;
		for ($i = 0; $i < $index; $i++) {
			$indexNode = $indexNode->next;
		}
		return $indexNode->data;
	}

	/**
	 * 修改第 index 个结点
	 * @param $index
	 * @param Node $data
	 * @throws Exception
	 */
	public function set($index, $data) {
		if ($index <= 0 || $index > $this->_length) {
			throw new Exception("Set node failed, index is error!");
		}
		// 查找第 index 个结点
		$indexNode = $this->_headerNode;
		for ($i = 0; $i < $index; $i++) {
			$indexNode = $indexNode->next;
		}
		$indexNode->data = $data;
	}

	/**
	 * 链表是否为空
	 */
	public function isEmpty() {
		return $this->_headerNode->next == $this->_headerNode;
	}

	/**
	 * 元素是否存在
	 * @param $data
	 * @return bool
	 */
	public function isExist($data) {
		$current = $this->_headerNode->next;
		while($current != $this->_headerNode) {
			if ($current->data == $data) {
				return true;
			}
			$current= $current->next;
		}
		return false;
	}

	/**
	 * 输出链表元素
	 */
	public function printlnList() {
		$printStr = "[";
		$current = $this->_headerNode->next;
		while ($current != $this->_headerNode) {
			$printStr = $printStr.$current->data.",";
			$current = $current->next;
		}
		$printStr = rtrim($printStr, ",");
		$printStr .= "]";
		echo $printStr."\r\n";
	}

    /**
     * 清空链表
     */
	public function clear() {
	    $this->_headerNode = NULL;
    }
}