<?php
/**
 * 循环队列的基本操作
 * @author phachon@163.com
 */
class LoopQueue {

	/**
	 * 默认分配的最大内存
	 */
	const MAX = 100;

	/**
	 * 最大内存
	 * @var int
	 */
	private $_max = 0;

	/**
	 * 头指针
	 * @var int
	 */
	private $_front = 0;

	/**
	 * 尾指针
	 * @var int
	 */
	private $_rear = 0;

	/**
	 * 动态分配的内存
	 * @var array
	 */
	private $_data = [];

	/**
	 * LoopQueue constructor.
	 * @param int $max
	 */
	public function __construct($max = self::MAX) {
		$this->_data = new SplFixedArray($max);
		$this->_front = 0;
		$this->_rear = 0;
	}

	/**
	 * 初始化队列
	 * @param $max
	 * @return LoopQueue
	 */
	public static function create($max) {
		return new self($max);
	}

	/**
	 * 销毁队列
	 */
	public function destroy() {
		for ($i=0; $i < $this->_max; $i++) {
			unset($this->_max[$i]);
		}
		$this->_front = 0;
		$this->_rear = 0;
	}

	/**
	 * 清空队列
	 */
	public function clear() {
		$this->_front = $this->_rear = 0;
	}

	/**
	 * 判断队列是否为空
	 */
	public function isEmpty() {
		return $this->_rear == $this->_front;
	}

	/**
	 * 返回队列的长度
	 */
	public function length() {
		return ($this->_rear - $this->_front + $this->_max) % $this->_max;
	}

	/**
	 * 返回队列头元素
	 */
	public function getHead() {
		return $this->_max[$this->_front];
	}

	/**
	 * 插入元素到队尾
	 * @param $data
	 * @throws Exception
	 */
	public function insert($data) {
		if (($this->_rear + 1) % $this->_max == $this->_front) {
			throw new Exception("队列已满");
		}

		$this->_data[$this->_rear] = $data;
		$this->_rear = ($this->_rear + 1) % $this->_max;
	}

	/**
	 * 删除队头元素
	 */
	public function del() {
		if ($this->_front != $this->_rear) {
			$data = $this->_data[$this->_front];
			$this->_front = ($this->_front + 1) % $this->_max;
			return $data;
		}
		return "";
	}

	/**
	 * 循环遍历元素
	 * @param $func
	 */
	public function visit($func) {
		if ($this->_front != $this->_rear) {
			$current = $this->_front;
			while($current != $this->_rear) {
				$func($this->_data[$current]);
				$current = ($current + 1) % $this->_max;
			}
		}
	}
}