<?php
/**
 * 链栈测试
 * @author phachon@163.com
 */

require_once 'LinkedStack.php';
require_once 'SinglyNode.php';
// run test
LinkedStack_Test::run();

class LinkedStack_Test {

	/**
	 * 运行测试
	 */
	public static function run() {
		try {
			$instance = new ReflectionClass("LinkedStack_Test");
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
	 * 创建一个空栈
	 */
	public function create_test() {
		$linkedStack = LinkedStack::create();
		$this->_success();
	}

	/**
	 * 是否是空栈
	 */
	public function isEmpty_test() {
		$linkedStack = LinkedStack::create();
		if ($linkedStack->isEmpty()) {
			$this->_success();
		}else {
			$this->_error();
		}
	}

	/**
	 * 插入元素到栈顶
	 */
	public function push_test() {
		$linkedStack = LinkedStack::create();
		$linkedStack->push("a");
		$linkedStack->push("b");
		$linkedStack->push("c");
		if ($linkedStack->printStr() == "[c,b,a]") {
			$this->_success();
		}else {
			$this->_error();
		}
	}

	/**
	 * 删除栈顶元素,并返回元素值
	 */
	public function pop_test() {
		$linkedStack = LinkedStack::create();
		$linkedStack->push("a");
		$linkedStack->push("b");
		$linkedStack->push("c");
		$linkedStack->pop();
		if ($linkedStack->printStr() == "[b,a]") {
			$this->_success();
		}else {
			$this->_error();
		}
	}

	/**
	 * 获取栈的长度
	 */
	public function length_test() {
		$linkedStack = LinkedStack::create();
		$linkedStack->push("a");
		$linkedStack->push("b");
		$linkedStack->push("c");
		if ($linkedStack->length() == 3) {
			$this->_success();
		}else {
			$this->_error();
		}
	}

	/**
	 * 清空栈
	 */
	public function clear_test() {
		$linkedStack = LinkedStack::create();
		$linkedStack->push("a");
		$linkedStack->push("b");
		$linkedStack->push("c");
		$linkedStack->clear();
		$this->_success();
	}

	/**
	 * 销毁一个栈
	 */
	public function destroy_test() {
		$linkedStack = LinkedStack::create();
		$linkedStack->push("a");
		$linkedStack->push("b");
		$linkedStack->push("c");
		$linkedStack->destroy();
		$this->_success();
	}

	/**
	 * 从栈底到栈顶遍历栈元素
	 */
	public function visit_test() {
		$linkedStack = LinkedStack::create();
		$linkedStack->push("a");
		$linkedStack->push("b");
		$linkedStack->push("c");
		$linkedStack->push("d");
		$linkedStack->push("e");
		$linkedStack->visit(function (&$item){
			$item->data = $item->data."1";
		});
		echo $linkedStack->printStr();
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