<?php
/**
 * 实现的动态数组
 * @author: phachon
 */

class Arr {

    /**
     * 数组最大容量
     * @var int
     */
    private $_maxSize = 0;

    /**
     * 数组存储
     * @var array
     */
    private $_data = [];

    /**
     * 构造函数
     * MyArray constructor.
     * @param int $maxSize
     */
    public function __construct($maxSize = 10) {
        $this->_maxSize = $maxSize;
        $this->_data = [];
    }

    /**
     * 数组是否为空
     * @return bool
     */
    public function isEmpty() {
        return count($this->_data) == 0;
    }

    /**
     * 获取数组的个数
     * @return int
     */
    public function size() {
        return count($this->_data);
    }

    /**
     * 获取数组的容量
     * @return int
     */
    public function maxSize() {
        return $this->_maxSize;
    }

    /**
     * 判断数组是否已满
     * @return bool
     */
    public function isFull() {
        return $this->_maxSize == count($this->_data);
    }

    /**
     * 某个值是否在数组中存在
     * @param string $val
     * @return bool
     */
    public function isExists($val = '') {
        foreach ($this->_data as $item) {
            if ($item == $val) {
                return true;
            }
        }
        return false;
    }

    /**
     * 向数组首部插入新元素
     * @param string $val
     * @throws Exception
     */
    public function addFirst($val = '') {
        $this->add(0, $val);
    }

    /**
     * 向数组末尾插入新元素
     * @param string $val
     * @throws Exception
     */
    public function addLast($val = '') {
        $this->add(count($this->_data), $val);
    }

    /**
     * 向数组的指定位置插入数组
     * @param $index
     * @param string $val
     * @throws Exception
     */
    public function add($index, $val = '') {
        if ($this->_maxSize == count($this->_data)) {
            throw new Exception("Add failed, Array is full!");
        }

        if ($index < 0 || $index > $this->_maxSize) {
            throw new Exception("Add failed, index require 0 ~ ".$this->_maxSize);
        }

        for ($i = count($this->_data) - 1; $i >= $index; $i--) {
            $this->_data[$i+1] = $this->_data[$i];
        }
        $this->_data[$index] = $val;
    }

    /**
     * 修改指定位置的元素
     * @param $index
     * @param string $val
     * @throws Exception
     */
    public function set($index, $val = '') {
        if ($index < 0 || $index > count($this->_data)) {
            throw new Exception("Set failed, index require 0 ~ ".count($this->_data));
        }
        $this->_data[$index] = $val;
    }

	/**
	 * 修改指定位置的元素
	 * @param $index
	 * @return mixed
	 * @throws Exception
	 */
	public function get($index) {
		if ($index < 0 || $index > count($this->_data)) {
			throw new Exception("Get failed, index require 0 ~ ".count($this->_data));
		}
		return $this->_data[$index];
	}

	/**
	 * data
	 * @return array
	 */
	public function data() {
		return $this->_data;
	}

    /**
     * 删除指定位置的元素
     * @param $index
     * @throws Exception
     */
    public function delete($index) {
        if ($index < 0 || $index > count($this->_data)) {
            throw new Exception("Delete failed, index require 0 ~ ".count($this->_data));
        }
        unset($this->_data[$index]);
    }

    public function __toString() {
        return "Arr max size: ".$this->_maxSize.", Arr size: ".$this->size();
    }
}