<?php
/**
 * 顺序表测试
 * @author: phachon@163.com
 */

require_once 'SequenceList.php';
// run test
SequenceList_Test::run();

class SequenceList_Test {

    /**
     * 运行测试
     */
    public static function run() {
        try {
            $instance = new ReflectionClass("SequenceList_Test");
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
     * 创建顺序表
     */
    public function create_test() {
        SequenceList::create(200);
        $this->_success();
    }

    /**
     * 添加数据元素到起始位置
     */
    public function addFirst_test() {
        $seqList = SequenceList::create(200);
        try {
            $seqList->addFirst("first1");
            $seqList->addFirst("first2");
            $seqList->addFirst("first3");
        }catch (Exception $e) {
            $this->_error($e->getMessage());
            return;
        }
        if ($seqList->get(0) != "first3") {
            $this->_error();
            return;
        }
        $this->_success();
    }

    /**
     * 添加数据元素到末尾位置
     * @throws Exception
     */
    public function addLast_test() {
        $seqList = SequenceList::create(200);

        try {
            $seqList->addLast("last1");
            $seqList->addLast("last2");
            $seqList->addLast("last3");
        }catch (Exception $e) {
            $this->_error($e->getMessage());
            return;
        }
        if ($seqList->get(2) != "last3") {
            $this->_error();
            return;
        }
        $this->_success();
    }

    /**
     * 添加数据元素到末尾位置
     * @throws Exception
     */
    public function add_test() {
        $seqList = SequenceList::create(200);

        $seqList->addFirst("uu");
        $seqList->addFirst("pp");
        $seqList->addFirst("dd");

        try {
            $seqList->add(1, "add");
        }catch (Exception $e) {
            $this->_error($e->getMessage());
            return;
        }
        if ($seqList->get(1) != "add") {
            $this->_error();
            return;
        }
        $this->_success();
    }

    /**
     * 查找指定位置的数据元素
     * @throws Exception
     */
    public function get_test() {
        $seqList = SequenceList::create(200);

        $seqList->addFirst("uu");

        try {
            $val = $seqList->get(0);
        }catch (Exception $e) {
            $this->_error($e->getMessage());
            return;
        }
        if ($val != "uu") {
            $this->_error();
            return;
        }
        $this->_success();
    }

    /**
     * 修改指定位置的数据元素
     * @throws Exception
     */
    public function set_test() {
        $seqList = SequenceList::create(200);

        $seqList->addFirst("uu");

        try {
            $seqList->set(0, "set");
        }catch (Exception $e) {
            $this->_error($e->getMessage());
            return;
        }
        if ($seqList->get(0) != "set") {
            $this->_error();
            return;
        }
        $this->_success();
    }

    /**
     * 删除指定位置的元素
     * @throws Exception
     */
    public function del_test() {
        $seqList = SequenceList::create(200);

        $seqList->addLast("uu1");
        $seqList->addLast("uu2");
        $seqList->addLast("uu3");
        $seqList->addLast("uu4");
        $seqList->addLast("uu5");

        try {
            $seqList->del(2);
        }catch (Exception $e) {
            $this->_error($e->getMessage());
            return;
        }
        if ($seqList->get(2) != "uu4") {
            $this->_error();
            return;
        }
        $this->_success();
    }

    /**
     * 顺序表是否为空
     * @throws Exception
     */
    public function isEmpty_test() {
        $seqList = SequenceList::create(200);

        if ($seqList->isEmpty()) {
            $this->_success();
        }else {
            $this->_error();
        }
    }

    /**
     * 顺序表是否为空
     * @throws Exception
     */
    public function isFull_test() {
        $seqList = SequenceList::create(2);

        $seqList->addLast("1");
        $seqList->addLast("2");

        if ($seqList->isFull()) {
            $this->_success();
        }else {
            $this->_error();
        }
    }

    /**
     * 获取顺序表的元素个数
     */
    public function count_test() {
        $seqList = SequenceList::create(2);

        $seqList->addLast("1");
        $seqList->addLast("2");

        if ($seqList->count() == 2) {
            $this->_success();
        }else {
            $this->_error();
        }
    }

    /**
 * 元素是否存在
 */
    public function isExist_test() {
        $seqList = SequenceList::create(2);

        $seqList->addLast("ii");
        $seqList->addLast("pp");

        if ($seqList->isExist("pp")) {
            $this->_success();
        }else {
            $this->_error();
        }
    }

    /**
     * 根据值查找元素的位置
     */
    public function find_test() {
        $seqList = SequenceList::create(2);

        $seqList->addLast("ii");
        $seqList->addLast("pp");

        if ($seqList->find("pp") == 1) {
            $this->_success();
        }else {
            $this->_error();
        }
    }

    /**
     * 销毁顺序表
     */
    public function destroy_test() {
        $seqList = SequenceList::create(2);

        $seqList->addLast("ii");
        $seqList->addLast("pp");
        $seqList->destroy();

        if ($seqList->count() == 0) {
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