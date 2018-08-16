<?php
/**
 * 单向链表测试
 * @author: phachon@163.com
 */

require_once 'StaticLinkedList.php';
require_once 'StaticNode.php';
// run test
StaticLinkedList_Test::run();

class StaticLinkedList_Test {

    /**
     * 运行测试
     */
    public static function run() {
        try {
            $instance = new ReflectionClass("StaticLinkedList_Test");
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
    	try {
			StaticLinkedList::create();
		}catch (Exception $e) {
    		$this->_error($e->getMessage());
			return;
		}
        $this->_success();
    }

    /**
     * 添加结点
     */
    public function addNode_test() {
        $staticList = StaticLinkedList::create();
        $staticList->addNode("a");
        $staticList->addNode("b");
        $staticList->addNode("c");
        $staticList->printlnList();
        $this->_success();
    }

    /**
     * 获取链表的长度
     */
    public function length_test() {
        $staticList = StaticLinkedList::create();
        $staticList->addNode("a");
        $staticList->addNode("b");
        $staticList->addNode("c");
        if ($staticList->length() == 3) {
            $this->_success();
        }else {
            $this->_error();
        }
	}

    /**
     * 链表头部添加结点
     */
    public function addFirstNode_test() {
        $staticList = StaticLinkedList::create();
        $staticList->addFirstNode("a");
        $staticList->addFirstNode("b");
        $staticList->addFirstNode("c");
        $staticList->printlnList();
        if ($staticList->get(3) == "a") {
			$this->_success();
		}else {
        	$this->_error();
		}
	}

    /**
     * 在第 index 位置添加新结点
     */
    public function addIndexNode_test() {
        $staticList = StaticLinkedList::create();
        $staticList->addNode("a");
        $staticList->addNode("b");
        $staticList->addNode("c");
        $staticList->printlnList();
        $staticList->addIndexNode(2, "d");
        $staticList->printlnList();
		if ($staticList->get(2) === "d") {
			$this->_success();
		}else {
			$this->_error();
		}

	}

    /**
     * 删除第 index 个结点
     */
    public function delNode_test() {
        $staticList = StaticLinkedList::create();
        $staticList->addNode("a");
        $staticList->addNode("b");
        $staticList->addNode("c");
        $staticList->printlnList();
        $staticList->delIndexNode(2);
        $staticList->printlnList();
        $this->_success();
	}

    /**
     * 获取第 index 个结点
     */
    public function get_test() {
        $staticList = StaticLinkedList::create();
        $staticList->addNode("a");
        $staticList->addNode("b");
        $staticList->addNode("c");
        $staticList->printlnList();
        if ($staticList->get(2) == "b") {
            $this->_success();
        }else {
            $this->_error();
        }

	}

    /**
     * 修改第 index 个结点
     */
    public function set_test() {
        $staticList = StaticLinkedList::create();
        $staticList->addNode("a");
        $staticList->addNode("b");
        $staticList->addNode("c");
        $staticList->printlnList();
        $staticList->set(2, "d");
        if ($staticList->get(2) == "d") {
            $this->_success();
        }else {
            $this->_error();
        }
	}

    /**
     * 链表是否为空
     */
    public function isEmpty_test() {
        $staticList = StaticLinkedList::create();
        if ($staticList->isEmpty()) {
            $this->_success();
        }else {
            $this->_error();
        }
	}

    /**
     * 元素是否存在
     */
    public function isExist_test() {
        $staticList = StaticLinkedList::create();
        $staticList->addNode("a");
        $staticList->addNode("b");
        $staticList->addNode("c");
        if ($staticList->isExist("c")) {
            $this->_success();
        }else {
            $this->_error();
        }
	}

	/**
	 * 清空链表结点
	 */
	public function clear_test() {
		$staticList = StaticLinkedList::create();
		$staticList->addNode("a");
		$staticList->addNode("b");
		$staticList->addNode("c");
		$staticList->clear();
		$staticList->printlnList();
		$this->_success();
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