<?php
/**
 * 实现数组测试
 */

include 'Arr.php';

$arr = new Arr(100);

for ($i = 0; $i < 10; $i++) {
    $arr->addLast($i);
}

echo $arr;

$arr->addFirst(199);

$arr->add(5, 100);

var_dump($arr);

echo $arr->isExists(100);

$arr->set(5, 900);

