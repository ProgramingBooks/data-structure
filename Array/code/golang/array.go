package golang

import "errors"

// 数组的基本操作

type Array struct {

	// 最大容量
	max int

	// 数组长度
	length int

	// 数组的存储
	data []interface{}
}

// 初始化一个 max 大小的数组
func NewArray(max int) *Array {
	return &Array {
		length: 0,
		max: max,
		data: make([]interface{}, max),
	}
}

// 判断数组是否为空
func (a *Array) IsEmpty() bool {
	return a.length == 0
}

// 获取数组的长度
func (a *Array) Length() int {
	return a.length
}

// 获取数组的最大容量
func (a *Array) MaxSize() int {
	return a.max
}

// 判断数组是否已满
func (a *Array) IsFull() bool {
	return a.max == a.length
}

// 某个值是否在数组中存在
func (a *Array) IsExists(key interface{}) bool {
	for _, val := range a.data {
		if val == key {
			return true
		}
	}
	return false
}

// 向数组首部插入新元素
func (a *Array) AddFirst(val interface{}) error {
	return a.add(0, val)
}

// 向数组尾部插入新元素
func (a *Array) AddLast(val interface{}) error {
	return a.add(a.length, val)
}

// 向数组的指定位置 index 插入元素
func (a *Array) add(index int, val interface{}) error {

	// 判读是否满
	if a.length == a.max {
		return errors.New("Add failed, Array is full! ")
	}
	// 判读是否越界
	if index < 0 || index > a.max - 1 {
		return errors.New("Add failed, Index out of range! ")
	}
	// 移动元素
	for i := a.length; i >= index; i-- {
		a.data[i+1] = a.data[i]
	}
	a.data[index] = val
	a.length ++

	return nil
}

// 修改指定位置的元素
func (a *Array) Set(index int, val interface{}) error {
	// 判读是否越界
	if index < 0 || index > a.length - 1 {
		return errors.New("Set failed, Index out of range! ")
	}
	a.data[index] = val

	return nil
}

// 获取指定位置的元素
func (a *Array) Get(index int) interface{}  {
	// 判读是否越界
	if index < 0 || index > a.length - 1 {
		return errors.New("Get failed, Index out of range! ")
	}

	return a.data[index]
}

// 获取所有的数据
func (a *Array) Data() []interface{} {
	return a.data
}

// 查找元素的位置
func (a *Array) Find(val interface{}) int {
	for i := 0; i < a.length; i++ {
		if a.data[i] == val {
			return i
		}
	}
	return -1
}

// 删除指定位置的元素
func (a *Array) Del(index int) error {
	// 判读是否越界
	if index < 0 || index > a.length - 1 {
		return errors.New("Del failed, Index out of range! ")
	}

	a.data[index] = nil

	return nil
}