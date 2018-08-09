<?php
/**
 * 数组的基本使用
 * @author: phachon
 */

// 数组的初始化

// 初始化一个空数组
$arr1 = [];
// 初始化包含三个元素的数组
$arr = ["Volvo","BMW","Toyota"];

// 根据索引获取元素
echo "数组的第一个元素: ".$arr[0]."\r\n";

// 数组的遍历
foreach ($arr as $item) {
    echo $item."\r\n";
}

// 修改某个元素的值
$arr[1] = "ppp";

// 删除指的位置的元素
unset($arr[0]);

foreach ($arr as $item) {
    echo $item."\r\n";
}