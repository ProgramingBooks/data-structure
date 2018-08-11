# 双向链表
之前我们讨论的单向链表中的结点中只有一个指示直接后继的指针域,由此,从某个结点出发只能顺指针往后查询其他结点.如果要查找结点的直接前趋, 则需从表头指针出发.为了克服单链表这种单向性的缺点,可以利用**双向链表**.  

双向链表的结点中有两个指针域,其一指向直接后继, 另一个指向直接前趋.

![doubly_linked_list1](../images/doubly_linked_list1.png)



![doubly_linked_list](../images/doubly_linked_list.png)

