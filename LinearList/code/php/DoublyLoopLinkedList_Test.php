<?php
/**
 * 双向链表测试
 * @author: phachon@163.com
 */

require_once 'DoublyLoopLinkedList.php';
require_once 'DoublyNode.php';
// run test
DoublyLoopLinkedList_Test::run();

class DoublyLoopLinkedList_Test {

    /**
     * 运行测试
     */
    public static function run() {
        try {
            $instance = new ReflectionClass("DoublyLoopLinkedList_Test");
        }catch (Exception $e) {
            exit($e->getMessage());
        }
        $sequenceList = $instance->newInstance();
        $methods = $instance->getMethods();
        foreach ($methods as $method) {
            if (strpos($method->name, "_test")) {
                $instance->getMethod($method->name)->invokeArgs($sequenceList, []);
            }
        }
    }

    /**
     * SequenceList_Test constructor.
     */
    public function __construct() {}


    /**
     * 创建一个空链表
     */
    public function create_test() {
        DoublyLoopLinkedList::create();
        $this->_success();
    }

    /**
     * 添加结点
     */
    public function addNode_test() {
        $doublyLoopList = DoublyLoopLinkedList::create();
	    $doublyLoopList->addNode("a");
	    $doublyLoopList->addNode("b");
	    $doublyLoopList->addNode("c");
	    $doublyLoopList->printlnList();
        $this->_success();
    }

    /**
     * 获取链表的长度
     */
    public function length_test() {
        $doublyLoopList = DoublyLoopLinkedList::create();
        $doublyLoopList->addNode("a");
        $doublyLoopList->addNode("b");
        $doublyLoopList->addNode("c");
        if ($doublyLoopList->length() == 3) {
            $this->_success();
        }else {
            $this->_error();
        }
    }

    /**
     * 链表头部添加结点
     */
    public function addFirstNode_test() {
        $doublyLoopList = DoublyLoopLinkedList::create();
        $doublyLoopList->addFirstNode("a");
        $doublyLoopList->addFirstNode("b");
        $doublyLoopList->addFirstNode("c");
        $doublyLoopList->printlnList();
        $this->_success();
    }

    /**
     * 在第 index 位置添加新结点
     */
    public function addIndexNode_test() {
        $doublyLoopList = DoublyLoopLinkedList::create();
        $doublyLoopList->addNode("a");
        $doublyLoopList->addNode("b");
        $doublyLoopList->addNode("c");
        $doublyLoopList->printlnList();
        $doublyLoopList->addIndexNode(2, "d");
        $doublyLoopList->printlnList();
        $this->_success();
    }

    /**
     * 删除第 index 个结点
     */
    public function delNode_test() {
        $doublyLoopList = DoublyLoopLinkedList::create();
        $doublyLoopList->addNode("a");
        $doublyLoopList->addNode("b");
        $doublyLoopList->addNode("c");
        $doublyLoopList->printlnList();
        $doublyLoopList->delIndexNode(2);
        $doublyLoopList->printlnList();
        $this->_success();
    }

    /**
     * 获取第 index 个结点
     */
    public function get_test() {
        $doublyLoopList = DoublyLoopLinkedList::create();
        $doublyLoopList->addNode("a");
        $doublyLoopList->addNode("b");
        $doublyLoopList->addNode("c");
        $doublyLoopList->printlnList();
        if ($doublyLoopList->get(2) == "b") {
            $this->_success();
        }else {
            $this->_error();
        }
    }

    /**
     * 修改第 index 个结点
     */
    public function set_test() {
        $doublyLoopList = DoublyLoopLinkedList::create();
        $doublyLoopList->addNode("a");
        $doublyLoopList->addNode("b");
        $doublyLoopList->addNode("c");
        $doublyLoopList->printlnList();
        $doublyLoopList->set(2, "d");
        if ($doublyLoopList->get(2) == "d") {
            $this->_success();
        }else {
            $this->_error();
        }
    }

    /**
     * 链表是否为空
     */
    public function isEmpty_test() {
        $doublyLoopList = DoublyLoopLinkedList::create();
        if ($doublyLoopList->isEmpty()) {
            $this->_success();
        }else {
            $this->_error();
        }
    }

    /**
     * 元素是否存在
     */
    public function isExist_test() {
        $doublyLoopList = DoublyLoopLinkedList::create();
        $doublyLoopList->addNode("a");
        $doublyLoopList->addNode("b");
        $doublyLoopList->addNode("c");
        if ($doublyLoopList->isExist("c")) {
            $this->_success();
        }else {
            $this->_error();
        }
    }

    /**
     * test success
     */
    private function _success() {
        $this->_println("Pass");
    }

    /**
     * test error
     * @param string $error
     */
    private function _error($error = "") {
        if ($error != "") {
            $message = "NoPass, $error";
        }else {
            $message = "NoPass";
        }
        $this->_println($message);
    }

    /**
     * println test result
     * @param string $message
     */
    private function _println($message = "") {
        $backtrace = debug_backtrace();
        $class = str_replace("_Test", "", $backtrace[0]["class"]);
        $method = str_replace("_test", "", $backtrace[2]["function"]);
        echo "Class $class::$method Test Result: $message"."\r\n";
    }
}