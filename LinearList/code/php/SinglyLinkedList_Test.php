<?php
/**
 * 单向链表测试
 * @author: phachon@163.com
 */

require_once 'SinglyLinkedList.php';
// run test
SinglyLinkedList_Test::run();

class SinglyLinkedList_Test {

    /**
     * 运行测试
     */
    public static function run() {
        try {
            $instance = new ReflectionClass("SinglyLinkedList_Test");
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
        SinglyLinkedList::create();
        $this->_success();
    }

    /**
     * 添加结点
     */
    public function addNode_test() {
        $singlyList = SinglyLinkedList::create();
        $singlyList->addNode("a");
        $singlyList->addNode("b");
        $singlyList->addNode("c");
        $singlyList->printlnList();
        $this->_success();
    }

    /**
     * 获取链表的长度
     */
    public function length_test() {
        $singlyList = SinglyLinkedList::create();
        $singlyList->addNode("a");
        $singlyList->addNode("b");
        $singlyList->addNode("c");
        if ($singlyList->length() == 3) {
            $this->_success();
        }else {
            $this->_error();
        }
    }

    /**
     * 链表头部添加结点
     */
    public function addFirstNode_test() {
        $singlyList = SinglyLinkedList::create();
        $singlyList->addFirstNode("a");
        $singlyList->addFirstNode("b");
        $singlyList->addFirstNode("c");
        $singlyList->printlnList();
        $this->_success();
    }

    /**
     * 在第 index 位置添加新结点
     */
    public function addPrevNode_test() {
        $singlyList = SinglyLinkedList::create();
        $singlyList->addNode("a");
        $singlyList->addNode("b");
        $singlyList->addNode("c");
        $singlyList->printlnList();
        $singlyList->addIndexNode(2, "d");
        $singlyList->printlnList();
        $this->_success();
    }

    /**
     * 删除第 index 个结点
     */
    public function delNode_test() {
        $singlyList = SinglyLinkedList::create();
        $singlyList->addNode("a");
        $singlyList->addNode("b");
        $singlyList->addNode("c");
        $singlyList->printlnList();
        $singlyList->delIndexNode(2);
        $singlyList->printlnList();
        $this->_success();
    }

    /**
     * 获取第 index 个结点
     */
    public function get_test() {
        $singlyList = SinglyLinkedList::create();
        $singlyList->addNode("a");
        $singlyList->addNode("b");
        $singlyList->addNode("c");
        $singlyList->printlnList();
        if ($singlyList->get(2) == "b") {
            $this->_success();
        }else {
            $this->_error();
        }
    }

    /**
     * 修改第 index 个结点
     */
    public function set_test() {
        $singlyList = SinglyLinkedList::create();
        $singlyList->addNode("a");
        $singlyList->addNode("b");
        $singlyList->addNode("c");
        $singlyList->printlnList();
        $singlyList->set(2, "d");
        if ($singlyList->get(2) == "d") {
            $this->_success();
        }else {
            $this->_error();
        }
    }

    /**
     * 链表是否为空
     */
    public function isEmpty_test() {
        $singlyList = SinglyLinkedList::create();
        if ($singlyList->isEmpty()) {
            $this->_success();
        }else {
            $this->_error();
        }
    }

    /**
     * 元素是否存在
     */
    public function isExist_test() {
        $singlyList = SinglyLinkedList::create();
        $singlyList->addNode("a");
        $singlyList->addNode("b");
        $singlyList->addNode("c");
        if ($singlyList->isExist("c")) {
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