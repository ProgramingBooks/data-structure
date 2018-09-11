package golang

// 平衡二叉树结点
type AvlTreeNode struct {

	// 左子树指针
	Left *AvlTreeNode

	// 右子树指针
	Right *AvlTreeNode

	// 数据
	Data int

	// 平衡因子
	bf int
}

const (
	BF_EQUAL_HEIGHT = 0 // 等高
	BF_LEFT_HEIGHT = 1  // 左高
	BF_RIGHT_HEIGHT = -1 // 右高
)

// avl 平衡二叉树
type AvlTree struct {

	// 根节点
	Root *AvlTreeNode
}

func NewAvlTree() *AvlTree {
	return &AvlTree{
		Root: nil,
	}
}

// 右旋转操作（适合左左处理）
func (a *AvlTree) rRotate(node *AvlTreeNode) {
	s := node.Left
	node.Left = s.Right
	s.Right = node
	node = s
}

// 左旋转操作（适合右右处理）
func (a *AvlTree) lRotate(node *AvlTreeNode) {
	s := node.Right
	node.Right = s.Left
	s.Left = node
	node = s
}

// 左平衡处理
func (a *AvlTree) leftBalance(node *AvlTreeNode) {

	s := node.Left
	if s == nil {
		return
	}
	// 平衡因子
	switch s.bf {
	    // 右高，双旋转处理
		case BF_RIGHT_HEIGHT:
			newS := s.Right
			switch newS.bf {
				case BF_RIGHT_HEIGHT:
					s.bf = BF_LEFT_HEIGHT
					node.bf = BF_EQUAL_HEIGHT
					break
				case BF_LEFT_HEIGHT:
					node.bf = BF_RIGHT_HEIGHT
					s.bf = BF_EQUAL_HEIGHT
					break
				case BF_EQUAL_HEIGHT:
					s.bf = BF_EQUAL_HEIGHT
					node.bf = BF_EQUAL_HEIGHT
					break
				}
			newS.bf = BF_EQUAL_HEIGHT

			// 先把 s 左旋
			a.lRotate(s)
			a.rRotate(node)
			break
		// 左高, 直接右旋转
		case BF_LEFT_HEIGHT:
			s.bf = BF_EQUAL_HEIGHT
			node.bf = BF_EQUAL_HEIGHT
			a.rRotate(node)
			break
	}
}

// 右平衡处理
func (a *AvlTree) rBalance(node *AvlTreeNode) {

	s := node.Right
	if s == nil {
		return
	}
	switch s.bf {
	// 右高，直接左旋转
	case BF_RIGHT_HEIGHT:
		s.bf = BF_EQUAL_HEIGHT
		node.bf = BF_EQUAL_HEIGHT
		a.lRotate(node)
		break
	// 左高，双旋转
	case BF_LEFT_HEIGHT:
		nS := s.Left
		switch nS.bf {
		case BF_LEFT_HEIGHT:
			s.bf = BF_RIGHT_HEIGHT
			node.bf = BF_EQUAL_HEIGHT
			break
		case BF_RIGHT_HEIGHT:
			node.bf = BF_LEFT_HEIGHT
			s.bf = BF_EQUAL_HEIGHT
			break
		case BF_EQUAL_HEIGHT:
			node.bf = BF_EQUAL_HEIGHT
			s.bf = BF_EQUAL_HEIGHT
			break
		}
		nS.bf = BF_EQUAL_HEIGHT

		// 先对 s 右旋转
		a.rRotate(s)
		// 整体左旋转
		a.lRotate(node)
		break
	}
}

// 插入一个节点
func (a *AvlTree) Insert(val int) bool {
	if a.Root == nil {
		a.Root = &AvlTreeNode{
			Data: val,
			bf: BF_EQUAL_HEIGHT,
		}
		return true
	}
	return a.insert(a.Root, val)
}

// 插入
func (a *AvlTree) insert(node *AvlTreeNode, val int) bool {

	if node == nil {
		// 插入新节点
		node = &AvlTreeNode{
			Data: val,
			bf: BF_EQUAL_HEIGHT,
		}
		// true, 插入成功，树长高
		return true
	}

	// 存在相同的数据
	if val == node.Data {
		return false

	// 大于，继续在左子树搜索
	}else if val > node.Data {
		ok := a.insert(node.Left, val)
		if !ok {
			return false
		}

		// 修改平衡因子
		switch node.bf {
		case BF_EQUAL_HEIGHT:
			node.bf = BF_LEFT_HEIGHT
			return true
			break
		// 原来是左高
		case BF_LEFT_HEIGHT:
			a.leftBalance(node)
			node.bf = BF_EQUAL_HEIGHT
			return false
			break
		// 原来是右高
		case BF_RIGHT_HEIGHT:
			node.bf = BF_EQUAL_HEIGHT
			return false
			break
		}
	}else {
		ok := a.insert(node.Right, val)
		if !ok {
			return false
		}
		// 修改平衡因子
		switch node.bf {
		case BF_EQUAL_HEIGHT:
			node.bf = BF_RIGHT_HEIGHT
			return true
			break
		// 原来是左高
		case BF_LEFT_HEIGHT:
			node.bf = BF_EQUAL_HEIGHT
			return false
			break
		// 原来是右高
		case BF_RIGHT_HEIGHT:
			a.rBalance(node)
			node.bf = BF_EQUAL_HEIGHT
			return false
			break
		}
	}

	return true
}