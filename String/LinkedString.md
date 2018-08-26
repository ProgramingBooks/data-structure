# 块链存储
和线性表的链式存储结构相类似,也可以采用链表方式来存储串值.由于串结构的特殊性--结构中的每个数据元素是一个字符,则用链表存储串值时,存在一个""结点大小"的问题,即每个结点可以存放一个字符,也可以存放多个字符.  

为了方便串的操作,当以链表存储串值时,除头指针外还可以附设一个尾指针指示链表中的最后一个结点,并给串当前串的长度.称如此定义的串存储结构为**块链结构**