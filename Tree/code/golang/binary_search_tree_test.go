package golang

import (
	"testing"
	"fmt"
)

// Run binary search tree test: go test -v binary_search_tree_test.go binary_search_tree.go

func TestNewBinarySearchTree(t *testing.T) {
	NewBinarySearchTree()
}

func TestBinarySearchTree_Insert(t *testing.T) {

	bst := NewBinarySearchTree()
	err := bst.Insert(19)
	if err != nil {
		t.Error(err.Error())
	}
	err = bst.Insert(20)
	if err != nil {
		t.Error(err.Error())
	}
	err = bst.Insert(21)
	if err != nil {
		t.Error(err.Error())
	}
}

func TestBinarySearchTree_Search(t *testing.T) {

	bst := NewBinarySearchTree()
	err := bst.Insert(19)
	if err != nil {
		t.Error(err.Error())
	}
	err = bst.Insert(20)
	if err != nil {
		t.Error(err.Error())
	}
	n := bst.Search(20)
	if n.Data != 20 {
		t.Error(err.Error())
	}
}

func TestBinarySearchTree_Set(t *testing.T) {
	bst := NewBinarySearchTree()
	err := bst.Insert(19)
	if err != nil {
		t.Error(err.Error())
	}
	err = bst.Insert(20)
	if err != nil {
		t.Error(err.Error())
	}

	err = bst.Set(20, 21)
	if err != nil {
		t.Error(err.Error())
	}
}

func TestBinarySearchTree_Del(t *testing.T) {
	bst := NewBinarySearchTree()
	bst.Insert(19)
	bst.Insert(2)
	bst.Insert(38)
	bst.Insert(22)
	bst.Insert(6)
	bst.Insert(100)
	bst.Insert(89)
	bst.Insert(27)

	err := bst.Del(100)
	if err != nil {
		t.Error(err.Error())
	}
}

func TestBinarySearchTree_Max(t *testing.T) {
	bst := NewBinarySearchTree()
	bst.Insert(19)
	bst.Insert(2)
	bst.Insert(38)
	bst.Insert(22)
	bst.Insert(6)
	bst.Insert(100)
	bst.Insert(89)
	bst.Insert(27)

	max := bst.Max()
	if max != 100 {
		t.Fail()
	}
}

func TestBinarySearchTree_Min(t *testing.T) {
	bst := NewBinarySearchTree()
	bst.Insert(19)
	bst.Insert(2)
	bst.Insert(38)
	bst.Insert(22)
	bst.Insert(6)
	bst.Insert(100)
	bst.Insert(89)
	bst.Insert(27)

	min := bst.Min()
	if min != 2 {
		t.Fail()
	}
}

func TestBinarySearchTree_Depth(t *testing.T) {
	bst := NewBinarySearchTree()
	bst.Insert(19)
	bst.Insert(2)
	bst.Insert(38)
	bst.Insert(22)
	bst.Insert(6)
	bst.Insert(100)
	bst.Insert(89)
	bst.Insert(27)

	dep := bst.Depth()
	fmt.Println(dep)
}

func TestBinarySearchTree_DLR(t *testing.T) {

	bst := NewBinarySearchTree()
	bst.Insert(19)
	bst.Insert(2)
	bst.Insert(38)
	bst.Insert(22)
	bst.Insert(6)
	bst.Insert(100)
	bst.Insert(89)
	bst.Insert(27)

	bst.DLR()
	fmt.Println()
}


func TestBinarySearchTree_LDR(t *testing.T) {

	bst := NewBinarySearchTree()
	bst.Insert(19)
	bst.Insert(2)
	bst.Insert(38)
	bst.Insert(22)
	bst.Insert(6)
	bst.Insert(100)
	bst.Insert(89)
	bst.Insert(27)

	bst.LDR()
	fmt.Println()
}

func TestBinarySearchTree_LRD(t *testing.T) {

	bst := NewBinarySearchTree()
	bst.Insert(19)
	bst.Insert(2)
	bst.Insert(38)
	bst.Insert(22)
	bst.Insert(6)
	bst.Insert(100)
	bst.Insert(89)
	bst.Insert(27)

	bst.LRD()
	fmt.Println()
}