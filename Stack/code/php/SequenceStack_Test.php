<?php
/**
 * 顺序栈测试
 * @author phachon@163.com
 */

require_once 'SequenceStack.php';
// run test
SequenceStack_Test::run();

class SequenceStack_Test {

	/**
	 * 运行测试
	 */
	public static function run() {
		try {
			$instance = new ReflectionClass("SequenceStack_Test");
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
		$sequenceStack = SequenceStack::create();
		$this->_success();
	}

	/**
	 * 是否是空栈
	 */
	public function isEmpty_test() {
		$sequenceStack = SequenceStack::create();
		if ($sequenceStack->isEmpty()) {
			$this->_success();
		}else {
			$this->_error();
		}
	}

	/**
	 * 插入元素到栈顶
	 */
	public function push_test() {
		$sequenceStack = SequenceStack::create();
		$sequenceStack->push("a");
		$sequenceStack->push("b");
		$sequenceStack->push("c");
		if ($sequenceStack->printStr() == "[a,b,c]") {
			$this->_success();
		}else {
			$this->_error();
		}
	}

	/**
	 * 删除栈顶元素,并返回元素值
	 */
	public function pop_test() {
		$sequenceStack = SequenceStack::create();
		$sequenceStack->push("a");
		$sequenceStack->push("b");
		$sequenceStack->push("c");
		$sequenceStack->pop();
		if ($sequenceStack->printStr() == "[a,b]") {
			$this->_success();
		}else {
			$this->_error();
		}
	}

	/**
	 * 获取栈的长度
	 */
	public function length_test() {
		$sequenceStack = SequenceStack::create();
		$sequenceStack->push("a");
		$sequenceStack->push("b");
		$sequenceStack->push("c");
		if ($sequenceStack->length() == 3) {
			$this->_success();
		}else {
			$this->_error();
		}
	}

	/**
	 * 清空栈
	 */
	public function clear_test() {
		$sequenceStack = SequenceStack::create();
		$sequenceStack->push("a");
		$sequenceStack->push("b");
		$sequenceStack->push("c");
		$sequenceStack->clear();
		$this->_success();
	}

	/**
	 * 销毁一个栈
	 */
	public function destroy_test() {
		$sequenceStack = SequenceStack::create();
		$sequenceStack->push("a");
		$sequenceStack->push("b");
		$sequenceStack->push("c");
		$sequenceStack->destroy();
		$this->_success();
	}

	/**
	 * 从栈底到栈顶遍历栈元素
	 */
	public function visit_test() {
		$sequenceStack = SequenceStack::create();
		$sequenceStack->push("a");
		$sequenceStack->push("b");
		$sequenceStack->push("c");
		$sequenceStack->push("d");
		$sequenceStack->push("e");
		$sequenceStack->visit(function (&$item){
			$item = $item."1";
		});
		echo $sequenceStack->printStr();
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