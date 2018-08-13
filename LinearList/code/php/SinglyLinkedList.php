<?php
/**
 * 单向链表的基本操作实现
 * @author: phachon@163.com
 */

class Node {

    /**
     * 结点数据
     * @var string
     */
    public $data = "";

    /**
     * 结点指针，指向下一个结点
     * @var string
     */
    public $next = NULL;

    /**
     * Node constructor.
     * @param $data
     * @param $next
     */
    public function __construct($data, $next) {
        $this->data = $data;
        $this->next = $next;
    }
}


class SinglyLinkedList {

    /**
     * 头结点
     * @var Node|null
     */
    private $_headerNode = NULL;

    /**
     * SinglyLinkedList constructor.
     */
    public function __construct() {
        $this->_headerNode = new Node("", NULL);
    }

    /**
     * 创建一个空链表
     * @return SinglyLinkedList
     */
    public static function create() {
        return new SinglyLinkedList();
    }

    /**
     * 获取链表的长度
     * @return int
     */
    public function length() {
        $i = 0;
        $current = $this->_headerNode;
        while ($current->next != NULL) {
            $i++;
            $current = $current->next;
        }
        return $i;
    }

    /**
     * 添加结点
     * @param $data
     */
    public function addNode($data) {
        $node = new Node($data, NULL);
        $current = $this->_headerNode;
        while($current->next != NULL) {
            $current = $current->next;
        }
        $current->next = $node;
    }

    /**
     * 链表头部添加结点
     * @param $data
     */
    public function addFirstNode($data) {
        $node = new Node($data, $this->_headerNode->next);
        $this->_headerNode->next = $node;
    }

    /**
     * 在第 index 位置添加新结点
     * @param $index
     * @param $data
     * @throws Exception
     */
    public function addIndexNode($index, $data) {
        if ($index <= 0 || $index > $this->length()) {
            throw new Exception("Add index node failed, index is error!");
        }
        // 查找 index 的前置结点
        $indexPrevNode = $this->_headerNode;
        for ($i = 0; $i < $index - 1; $i++) {
            $indexPrevNode = $indexPrevNode->next;
        }
        $node = new Node($data, $indexPrevNode->next);
        $indexPrevNode->next = $node;
    }

    /**
     * 删除第 index 个结点
     * @param $index
     * @throws Exception
     */
    public function delIndexNode($index) {
        if ($index <= 0 || $index > $this->length()) {
            throw new Exception("Del node failed, index is error!");
        }
        // 查找 index 的前置结点
        $indexPrevNode = $this->_headerNode;
        for ($i = 0; $i < $index - 1; $i++) {
            $indexPrevNode = $indexPrevNode->next;
        }
        $indexPrevNode->next = $indexPrevNode->next->next;
    }

    /**
     * 获取第 index 个结点
     * @param $index
     * @return string
     * @throws Exception
     */
    public function get($index) {
        if ($index <= 0 || $index > $this->length()) {
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
        if ($index <= 0 || $index > $this->length()) {
            throw new Exception("Del node failed, index is error!");
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
        return $this->_headerNode->next == NULL;
    }

    /**
     * 元素是否存在
     * @param $data
     * @return bool
     */
    public function isExist($data) {
        $current = $this->_headerNode->next;
        while($current != NULL) {
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
        while ($current != NULL) {
            $printStr = $printStr.$current->data.",";
            $current = $current->next;
        }
        $printStr = rtrim($printStr, ",");
        $printStr .= "]";
        echo $printStr."\r\n";
    }
}