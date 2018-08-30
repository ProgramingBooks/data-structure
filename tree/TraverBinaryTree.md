# 遍历二叉树
在二叉树的一些应用中,常常要求在树中查找具有某种特征的结点,或者对树中全部结点逐一进行某种处理, 这就提出了一个**遍历二叉树**的问题,
即如何按某条搜索路径寻访树中的每一个结点,使每个结点仅被访问一次

## 遍历二叉树的方式
若限定先左后右,则有三种遍历方式

- 先序遍历 DLR: 根结点-左子树-右子树
- 中序遍历 LDR: 左子树-根结点-右子树
- 后序遍历 LRD: 左子树-右子树-根结点