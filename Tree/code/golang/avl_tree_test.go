package golang

import "testing"

// Run AvlTree test: go test -v avl_tree_test.go avl_tree.go

func TestNewAvlTree(t *testing.T) {
	NewAvlTree()
}

func TestAvlTree_Insert(t *testing.T) {
	avl := NewAvlTree()

	avl.Insert(10)
	avl.Insert(20)
	avl.Insert(21)
	avl.Insert(11)
}