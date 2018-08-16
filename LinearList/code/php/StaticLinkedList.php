<?php
/**
 * 静态链表的基本操作实现
 * @author: phachon@163.com
 */
class StaticLinkedList {

    /**
     * 默认最大容量
     */
    const MAX = 100;

    /**
     * 链表最大容量
     * @var int
     */
    private $_max = 0;

    /**
     * 链表长度
     * @var int
     */
    private $_length = 0;

    /**
     * 存放结点的数组空间（数据空间 + 已用空间）
     * @var null
     */
    private $_data = NULL;

	/**
	 * 头结点数组下标
	 * @var null
	 */
    private $_headerNodeIndex = NULL;

	/**
	 * 初始化备用空间（0 位置的结点为备用空间的头结点）
	 * StaticLinkedList constructor.
	 * @param int $max
	 * @throws Exception
	 */
    public function __construct($max = self::MAX) {
    	if ($max < 3) {
    		throw new Exception("Init failed, 'max' value is at least 3");
		}
        $this->_max = $max;
        $this->_data = new SplFixedArray($max);
        // 初始化备用空间，也是一个链表
        for ($i = 0; $i < $this->_max; $i++) {
        	$node = new StaticNode();
			$node->cur = $i + 1;
        	$this->_data[$i] = $node;
        }
        // 最后一个元素的结点游标指向0
        $this->_data[$this->_max - 1]->cur = 0;
        // 申请一个结点作为头结点
        $this->_headerNodeIndex = $this->mallocSL();
    }

    /**
     * 从备用空间中申请结点空间（每次取备用空间头结点指向的结点）
	 * 返回数组下标
	 * @return int
     */
    public function mallocSL() {
        $mallocIndex = $this->_data[0]->cur;
        if ($mallocIndex) {
        	// 从备用空间删除结点
        	$this->_data[0]->cur = $this->_data[$mallocIndex]->cur;
        	// 修改申请空间的游标
        	$this->_data[$mallocIndex]->cur = 0;
        	return $mallocIndex;
        }else {
            return 0;
        }
    }

	/**
	 * 回收结点空间（回收的结点始终为备用空间头结点的指向的结点）
	 * @param $index
	 * @throws Exception
	 */
    public function freeSL($index) {
    	if ($index <= 0 || $index > $this->_max - 1) {
			throw new Exception("free failed, index error");
		}
		$this->_data[$index]->cur = $this->_data[0]->cur;
		$this->_data[$index]->data = "";
		$this->_data[0]->cur = $index;
    }

	/**
	 * 创建空链表
	 * @param int $max
	 * @return StaticLinkedList
	 * @throws Exception
	 */
    public static function create($max = self::MAX) {
        return new self($max);
    }

    /**
     * 获取链表的长度
     * @return int
     */
    public function length() {
        return $this->_length;
    }

    /**
     * 添加结点
     * @param $data
     * @throws Exception
     */
    public function addNode($data) {
        $current = $this->_data[$this->_headerNodeIndex];
        while ($current->cur != 0) {
            $current = $this->_data[$current->cur];
        }
        // 申请结点空间
        $nodeIndex = $this->mallocSL();
        if (!$nodeIndex) {
        	throw new Exception("Add failed, has reached the maximum");
		}
        $this->_data[$nodeIndex]->data = $data;
		$current->cur = $nodeIndex;

		$this->_length += 1;
    }

    /**
     * 链表头部添加结点
     * @param $data
     * @throws Exception
     */
    public function addFirstNode($data) {
    	// 申请结点空间
    	$nodeIndex = $this->mallocSL();
    	$this->_data[$nodeIndex]->data = $data;
    	$this->_data[$nodeIndex]->cur = $this->_data[$this->_headerNodeIndex]->cur;
    	$this->_data[$this->_headerNodeIndex]->cur = $nodeIndex;

    	$this->_length += 1;
    }

	/**
	 * 在链表的第 index 位置插入结点
	 * @param $index
	 * @param $data
	 * @throws Exception
	 */
    public function addIndexNode($index, $data) {
    	if ($index <= 0 || $index > $this->_length) {
			throw new Exception("Add index node failed, index error");
		}
    	// 查找到 index 的前驱结点
		$indexPreNode = $this->_data[$this->_headerNodeIndex];
    	for ($i = 0; $i < $index - 1; $i++) {
			$indexPreNode = $this->_data[$indexPreNode->cur];
		}
		// 申请结点空间
		$nodeIndex = $this->mallocSL();
    	$this->_data[$nodeIndex]->cur = $indexPreNode->cur;
    	$this->_data[$nodeIndex]->data = $data;
    	$indexPreNode->cur = $nodeIndex;

    	$this->_length += 1;
	}

	/**
	 * 获取链表的第 index 个结点数据
	 * @param $index
	 * @throws Exception
	 * @return mixed
	 */
    public function get($index) {
    	if ($index <= 0 || $index > $this->_length) {
			throw new Exception("Get failed, index error");
		}

		$indexNodeCur = $this->_data[$this->_headerNodeIndex]->cur;
    	for ($i = 0; $i < $index - 1; $i++) {
			$indexNodeCur = $this->_data[$indexNodeCur]->cur;
		}
		return $this->_data[$indexNodeCur]->data;
	}

	/**
	 * 修改链表的第 index 个结点数据
	 * @param $index
	 * @param $data
	 * @throws Exception
	 */
	public function set($index, $data) {
		if ($index <= 0 || $index > $this->_length) {
			throw new Exception("Set failed, index error");
		}
		$indexNodeCur = $this->_data[$this->_headerNodeIndex]->cur;
		for ($i = 0; $i < $index - 1; $i++) {
			$indexNodeCur = $this->_data[$indexNodeCur]->cur;
		}
		$this->_data[$indexNodeCur]->data = $data;
	}

	/**
	 * 删除链表的第 index 个结点数据
	 * @param $index
	 * @throws Exception
	 */
	public function delIndexNode($index) {
		if ($index <= 0 || $index > $this->_length) {
			throw new Exception("Del index node failed, index error");
		}
		// 查找到 index 的前驱结点
		$indexPreNode = $this->_data[$this->_headerNodeIndex];
		for ($i = 0; $i < $index - 1; $i++) {
			$indexPreNode = $this->_data[$indexPreNode->cur];
		}
		$currentIndex = $indexPreNode->cur;
		$indexPreNode->cur = $this->_data[$currentIndex]->cur;
		// 释放 index 结点空间
		$this->freeSL($currentIndex);

		$this->_length -= 1;
	}

	/**
	 * 链表是否为空
	 */
	public function isEmpty() {
		return $this->_length == 0;
	}

	/**
	 * 数据元素是否存在
	 * @param $data
	 * @return bool
	 */
	public function isExist($data) {
		$currentIndex = $this->_data[$this->_headerNodeIndex]->cur;
		while($currentIndex != 0) {
			if ($this->_data[$currentIndex]->data == $data) {
				return true;
			}
			$currentIndex= $this->_data[$currentIndex]->cur;
		}
		return false;
	}

	/**
	 * 输出链表元素
	 */
	public function printlnList() {
		$printStr = "[";
		$currentIndex = $this->_data[$this->_headerNodeIndex]->cur;
		while ($currentIndex != 0) {
			$printStr = $printStr.$this->_data[$currentIndex]->data.",";
			$currentIndex = $this->_data[$currentIndex]->cur;
		}
		$printStr = rtrim($printStr, ",");
		$printStr .= "]";
		echo $printStr."\r\n";
	}

	/**
	 * 清空链表结点
	 */
    public function clear() {
    	$currentIndex = $this->_data[$this->_headerNodeIndex]->cur;
		// 回收每个结点空间
    	while($currentIndex != 0) {
			$this->_data[$this->_headerNodeIndex]->cur = $this->_data[$currentIndex]->cur;
			$this->freeSL($currentIndex);
			$currentIndex = $this->_data[$this->_headerNodeIndex]->cur;
		}
		$this->_length = 0;
	}

	/**
	 * 销毁链表
	 */
	public function destroy() {
    	$this->clear();
    	// 释放头结点
		$this->freeSL($this->_headerNodeIndex);
		$this->_data[$this->_headerNodeIndex]->cur = 0;
		$this->_length = 0;
	}
}