<?php
/**
 * 顺序表的基本操作实现
 * @author: phachon@163.com
 */

class SequenceList {

    /**
     * 默认最大容量
     */
    const Max = 100;

    /**
     * 顺序表的最大容量
     * @var int
     */
    private $_max = 0;

    /**
     * 顺序表元素个数
     * @var int
     */
    private $_num = 0;


    /**
     * 数据元素
     * @var array
     */
    private $_data = NULL;

    /**
     * SequenceList constructor.
     * @param int $max
     */
    public function __construct($max = self::Max) {
        $this->_max = $max;
        $this->_num = 0;
        $this->_data = new SplFixedArray($max);
    }

    /**
     * 创建顺序表
     * @param $max
     * @return SequenceList
     */
    public static function create($max) {
        return new SequenceList($max);
    }

    /**
     * 添加数据元素到起始位置
     * @param string $val
     * @throws Exception
     */
    public function addFirst($val = '') {
        $this->add(0, $val);
    }

    /**
     * 添加数据元素到末尾位置
     * @param string $val
     * @throws Exception
     */
    public function addLast($val = '') {
        $this->add($this->_num, $val);
    }

    /**
     * 添加数据元素到任意位置
     * @param $index
     * @param string $val
     * @throws Exception
     */
    public function add($index, $val = '') {
        if (!is_integer($index)) {
            throw new Exception("Add failed, index must be a number!");
        }
        if ($index > ($this->_max - 1) || $index < 0) {
            throw new Exception("Add failed, index error!");
        }

        for ($i = $this->_num - 1; $i > $index; $i--) {
            $this->_data[$i] = $this->_data[$i-1];
        }

        $this->_data[$index] = $val;
        $this->_num += 1;
    }

    /**
     * 查找指定位置的数据元素
     * @param $index
     * @return mixed
     * @throws Exception
     */
    public function get($index) {
        if (!is_integer($index)) {
            throw new Exception("Get failed, index must be a number!");
        }
        if ($index > ($this->_num - 1) || $index < 0) {
            throw new Exception("Get failed, index error!");
        }

        return $this->_data[$index];
    }

    /**
     * 修改指定位置的数据元素
     * @param $index
     * @param string $val
     * @throws Exception
     */
    public function set($index, $val = '') {
        if (!is_integer($index)) {
            throw new Exception("Set failed, index must be a number!");
        }
        if ($index > ($this->_num - 1) || $index < 0) {
            throw new Exception("Set failed, index error!");
        }

        $this->_data[$index] = $val;
    }

    /**
     * 删除指定位置的元素
     * @param $index
     * @throws Exception
     */
    public function del($index) {
        if (!is_integer($index)) {
            throw new Exception("Del failed, index must be a number!");
        }
        if ($index > ($this->_num - 1) || $index < 0) {
            throw new Exception("Del failed, index error!");
        }

        for ($i = $index; $i < $this->_num; $i++) {
            $this->_data[$i] = $this->_data[$i+1];
        }

        $this->_num -= 1;
    }

    /**
     * 顺序表是否为空
     * @return bool
     */
    public function isEmpty() {
        return empty($this->_num);
    }

    /**
     * 顺序表是否已满
     */
    public function isFull() {
        return $this->_num == $this->_max;
    }

    /**
     * 遍历输出数据元素
     */
    public function printlnItem() {
        $printStr = "[";
        foreach ($this->_data as $item) {
            if ($item == "") {
                continue;
            }
            $printStr = $printStr.$item.",";
        }
        $printStr = rtrim($printStr, ",");
        $printStr .= "]";
        echo $printStr."\r\n";
    }

    /**
     * 获取顺序表的元素个数
     * @return int
     */
    public function count() {
        return $this->_num;
    }

    /**
     * 元素是否存在
     * @param string $val
     * @return bool
     */
    public function isExist($val = '') {
        foreach ($this->_data as $item) {
            if ($item == $val) {
                return true;
            }
        }
        return false;
    }

    /**
     * 根据值查找元素的位置
     * @param string $val
     * @return int
     */
    public function find($val = '') {
        foreach ($this->_data as $index => $item) {
            if ($item == $val) {
                return $index;
            }
        }
        return -1;
    }

    /**
     * 销毁顺序表
     */
    public function destroy() {
        $this->__construct();
    }
}