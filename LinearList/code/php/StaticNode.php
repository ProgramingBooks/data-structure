<?php
/**
 * 静态链表结点(cur(游标) + data(数据))
 * @author phachon@163.com
 */
class StaticNode {

    /**
     * 结点指向下一结点的游标
     * @var int
     */
    public $cur = 0;

    /**
     * 结点数据
     * @var string
     */
    public $data = "";

    /**
     * StaticNode constructor.
     * @param string $data
     */
    public function __construct($data = "") {
        $this->data = $data;
        $this->cur = 0;
    }
}