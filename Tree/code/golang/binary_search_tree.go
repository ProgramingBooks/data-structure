package golang

import (
	"errors"
	"fmt"
)

// 二叉树节点
type BinaryTreeNode struct {

	// 左子树节点
	Left *BinaryTreeNode

	// 右子树节点
	Right *BinaryTreeNode

	// 父节点
	Parent *BinaryTreeNode

	// 数据
	Data int
}

// 二叉查找树的实现
// left < root < right
type BinarySearchTree struct {
	// 根节点
	Root *BinaryTreeNode
}

// 初始化一个二叉查找树, root 节点为 nil
func NewBinarySearchTree() *BinarySearchTree {
	return &BinarySearchTree{
		Root: nil,
	}
}

// 插入一个节点到二叉搜索树
func (b *BinarySearchTree) Insert(data int) error {
	// 判断 root 是否为空
	if b.Root == nil {
		b.Root = &BinaryTreeNode{
			Data: data,
		}
		return nil
	}

	current := b.Root
	flag := 0 // 标记是左节点 0 还是 右节点 1
	for current != nil {
		if data > current.Data {
			if current.Right == nil {
				flag = 1
				break
			}else {
				current = current.Right
			}
		}
		if data < current.Data {
			if current.Left == nil {
				flag = 0
				break
			}else {
				current = current.Left
			}
		}
		if data == current.Data {
			return errors.New("Insert failed, data is already exists! ")
		}
	}
	node := &BinaryTreeNode{
		Data: data,
	}
	node.Parent = current
	if flag == 0 {
		current.Left = node
	}else {
		current.Right = node
	}
	return nil
}

// 查找树中 key 对应的结点
func (b *BinarySearchTree) Search(key int) *BinaryTreeNode {
	current := b.Root
	for current != nil {
		if key == current.Data {
			return current
		}
		if key > current.Data {
			current = current.Right
		}
		if key < current.Data {
			current = current.Left
		}
	}
	return current
}

// 更新节点数据
func (b *BinarySearchTree) Set(key int, val int) error {
	s := b.Search(key)
	if s == nil {
		return errors.New("Set failed, node not found! ")
	}
	s.Data = val
	return nil
}

// 删除 val 的节点
func (b *BinarySearchTree) Del(val int) error {

	s := b.Search(val)
	if s == nil {
		return errors.New("Del failed, node not found! ")
	}
	parent := s.Parent
	// s 有左右节点
	if s.Left != nil && s.Right == nil {
		// 替换为让左子树的最大节点或右子树的最小节点
		left := s.Left
		leftMax := left
		for leftMax != nil {
			if leftMax.Right == nil {
				break
			}
			leftMax = leftMax.Right
		}
		leftMax.Parent = parent
		leftMax.Left = s.Left
		leftMax.Right = s.Right
		// 判断删除的结点是左节点还是右节点
		if parent.Left == s {
			parent.Left = leftMax
		} else {
			parent.Right = leftMax
		}
	}
	// s 只有左节点
	if s.Left != nil && s.Right == nil {
		left := s.Left
		left.Parent = parent
		// 判断删除的结点是左节点还是右节点
		if s.Parent.Left == s {
			parent.Left = left
		} else {
			parent.Right = left
		}
	}
	// s 只有右节点
	if s.Left == nil && s.Right != nil {
		right := s.Right
		right.Parent = parent
		// 判断删除的结点是左节点还是右节点
		if s.Parent.Left == s {
			parent.Left = right
		} else {
			parent.Right = right
		}
	}
	// s 为叶子节点
	if s.Left == nil && s.Right == nil {
		parent.Parent = nil
		parent.Left = nil
		parent.Right = nil
	}

	return nil
}

// 获取最大值
func (b *BinarySearchTree) Max() int {
	current := b.Root
	for current != nil {
		if current.Right != nil {
			current = current.Right
		}else {
			break
		}
	}
	return current.Data
}

// 获取最小值
func (b *BinarySearchTree) Min() int {
	current := b.Root
	for current != nil {
		if current.Left != nil {
			current = current.Left
		}else {
			break
		}
	}
	return current.Data
}

// 获取节点的深度
func (b *BinarySearchTree) Depth() int {
	return b.depth(b.Root)
}

// 获取节点的深度
func (b *BinarySearchTree) depth(node *BinaryTreeNode) int {
	if node == nil {
		return 0
	}

	leftDepth := b.depth(node.Left)
	rightDepth := b.depth(node.Right)

	if leftDepth > rightDepth {
		return leftDepth + 1
	}else {
		return rightDepth + 1
	}
}

// 先序遍历(根-左-右)
func (b *BinarySearchTree) DLR() {
	b.dlr(b.Root)
}
func (b *BinarySearchTree) dlr(node *BinaryTreeNode) {
	if node == nil {
		return
	}
	fmt.Printf("%d|", node.Data)
	b.dlr(node.Left)
	b.dlr(node.Right)
}

// 中序遍历(左-根-右)
func (b *BinarySearchTree) LDR() {
	b.ldr(b.Root)
}
func (b *BinarySearchTree) ldr(node *BinaryTreeNode)  {
	if node == nil {
		return
	}
	b.ldr(node.Left)
	fmt.Printf("%d|",  node.Data)
	b.ldr(node.Right)
}

// 后序遍历(左-右-根)
func (b *BinarySearchTree) LRD() {
	b.lrd(b.Root)
}
func (b *BinarySearchTree) lrd(node *BinaryTreeNode) {
	if node == nil {
		return
	}
	b.lrd(node.Left)
	b.lrd(node.Right)
	fmt.Printf("%d|", node.Data)
}