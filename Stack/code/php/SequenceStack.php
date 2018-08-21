<?php
/**
 * 顺序栈的基本操作
 * @author phachon@163.com
 */
class SequenceStack {

	/**
	 * 默认初始化分配量
	 */
	const MAX = 100;

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
	 * 栈数据
	 * @var array
	 */
	private $_data = [];

	/**
	 * SequenceStack constructor.
	 */
	public function __construct() {
		$this->_base = new SplFixedArray(self::MAX);
		$this->_base = 0;
		$this->_top = $this->_base;
	}

	/**
	 * 创建一个空栈
	 * @return SequenceStack
	 */
	public static function create() {
		return new self();
	}

	/**
	 * 销毁一个栈
	 */
	public function destroy() {
		for ($i = $this->_base; $i < $this->_top; $i++) {
			unset($this->_data[$i]);
		}
		$this->_base = NULL;
	}

	/**
	 * 清空一个栈
	 */
	public function clear(){
		for ($i = $this->_base; $i < $this->_top; $i++) {
			unset($this->_data[$i]);
		}
		$this->_top = 0;
	}

	/**
	 * 是否是空栈
	 */
	public function isEmpty() {
		return $this->_top == 0;
	}

	/**
	 * 获取栈的长度
	 */
	public function length() {
		return $this->_top - $this->_base;
	}

	/**
	 * 获取栈顶元素
	 */
	public function getTop() {
		return $this->_data[$this->_top - 1];
	}

	/**
	 * 插入元素到栈顶
	 * @param $data
	 */
	public function push($data) {
		$this->_data[$this->_top] = $data;
		$this->_top++;
	}

	/**
	 * 删除栈顶元素,并返回元素值
	 */
	public function pop() {
		$top = $this->_data[$this->_top - 1];
		unset($this->_data[$this->_top - 1]);
		return $top;
	}

	/**
	 * 从栈底到栈顶遍历栈元素
	 * @param $funcName
	 */
	public function visit($funcName) {
		for ($i = $this->_base; $i < $this->_top; $i++) {
			$funcName($this->_data[$i]);
		}
	}

	/**
	 * 从栈底到栈顶遍历栈元素打印输出
	 */
	public function printStr() {
		$printStr = "[";
		foreach ($this->_data as $item) {
			if ($item == "") {
				continue;
			}
			$printStr = $printStr.$item.",";
		}
		$printStr = rtrim($printStr, ",");
		$printStr .= "]";
		return $printStr;
	}
}