# 堆分配存储
这种存储方式的特点是,仍以一组地址连续的存储单元存放串值字符序列,但它们的存储空间是在程序的执行过程中动态分配的, 在 C 语言中,存在一个称之为**堆**的自由存储区,并由
动态分配函数 malloc() 和 free() 来管理.利用函数  malloc() 为每个新产生的串分配一块实际串所需要的存储空间,若分配成功,则返回一个指向起始地址的指针,作为串的基址,同时, 为了方便
处理,约定串和从串长也作为存储结构的一部分.  


由于堆分配存储结构的串既有顺序存储结构的特点,处理方便,操作中对串长又没有任何限制,更显灵活,因此在串处理的应用程序中也常被选中