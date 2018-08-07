<?php
/**
 * Created by PhpStorm.
 */

include 'Arr.php';

$arr = new Arr(100);

for ($i = 0; $i < 10; $i++) {
    $arr->addLast($i);
}

echo $arr;

$arr->addFirst(199);

var_dump($arr);

