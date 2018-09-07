package golang

import (
	"errors"
	"fmt"
	"strings"
)

// 顺序表的操作实现

type SequenceList struct {
	// 最大容量
	max int

	// 长度
	length int

	// 数据
	data []interface{}
}

// 创建顺序表
func NewSequenceList(max int) *SequenceList {
	return &SequenceList{
		max: max,
		length: 0,
		data: make([]interface{}, max),
	}
}

// 添加元素到起始位置
func (s *SequenceList) AddFirst(val interface{}) error {
	return s.add(0, val)
}

// 添加元素到末尾位置
func (s *SequenceList) AddLast(val interface{}) error {
	return s.add(s.length - 1, val)
}

// 添加元素到指定位置 index
func (s *SequenceList) add(index int, val interface{}) error {
	if s.length == s.max {
		return errors.New("Add failed, list is full! ")
	}
	if index < 0 || index > s.max {
		return errors.New("Add failed, index out of range! ")
	}
	for i := s.length; i >= index; i-- {
		s.data[i+1] = s.data[i]
	}
	s.data[index] = val
	s.length++

	return nil
}

// 获取指定位置的数据元素
func (s *SequenceList) Get(index int) (interface{}, error) {
	if index < 0 || index > s.length {
		return nil, errors.New("Get failed, index out of range! ")
	}
	return s.data[index], nil
}

// 修改指定位置的元素
func (s *SequenceList) Set(index int, val interface{}) error {
	if index < 0 || index > s.length {
		return errors.New("Set failed, index out of range! ")
	}
	s.data[index] = val
	return nil
}

// 删除指定位置的元素
func (s *SequenceList) Del(index int) error {
	if index < 0 || index > s.length {
		return errors.New("Del failed, index out of range! ")
	}

	for i := index; i < s.length; i++ {
		s.data[i] = s.data[i+1]
	}
	s.data[s.length - 1] = nil
	s.length --
}

// 顺序表是否为空
func (s *SequenceList) IsEmpty() bool {
	return s.length == 0
}

// 顺序表是否已满
func (s *SequenceList) IsFull() bool {
	return s.length == s.max
}

// 遍历输出数据元素
func (s *SequenceList) PrintlnItem() {
	str := ""
	for _, val := range s.data {
		str += fmt.Sprintf("%v,", val)
	}
	str = strings.TrimRight(str, ",")
	fmt.Println(str)
}

// 获取顺序表的元素个数
func (s *SequenceList) Count() int {
	return s.length
}

// 元素是否存在
func (s *SequenceList) IsExist(val interface{}) bool {

	for i := 0; i < s.length; i++ {
		if s.data[i] == val {
			return true
		}
	}
	return false
}

// 根据值查找元素的位置
func (s *SequenceList) Find(val interface{}) int {
	for i := 0; i < s.length; i++ {
		if s.data[i] == val {
			return i
		}
	}
	return -1
}

// 销毁顺序表
func (s *SequenceList) Destroy() {
	for i := 0; i < s.length; i++ {
		s.data[i] = nil
	}
	s.max = 0
	s.length = 0
}

// 清空顺序表
func (s *SequenceList) Clear() {
	for i := 0; i < s.length; i++ {
		s.data[i] = nil
	}
	s.length = 0
}