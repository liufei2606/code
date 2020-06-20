<?php

/**
 * 通过 PHP 数组模拟实现单链表
 */
class LinkedList
{
    private $list = [];

    // 获取链表指定位置的元素值，从0开始
    public function get($index)
    {
        $value = null;
        reset($this->list);
        while (current($this->list)) {
            if (key($this->list) == $index) {
                $value = current($this->list);
                break;
            }
            next($this->list);
        }

        return $value;
    }

    // 在链表指定位置插入值，默认插到链表头部
    public function add($value, $index = 0)
    {
        array_splice($this->list, $index, 0, $value);
    }

    // 从链表指定位置删除元素
    public function remove($index)
    {
        array_splice($this->list, $index, 1);
    }

    public function isEmpty()
    {
        return !next($this->list);
    }

    public function size()
    {
        return count($this->list);
    }
}

$linkedList = new LinkedList();
$linkedList->add(4);
$linkedList->add(5);
$linkedList->add(3);
print $linkedList->get(1);   # 输出5
$linkedList->add(1, 1);      # 在结点1的位置上插入1
print $linkedList->get(1);   # 输出1
$linkedList->remove(1);      # 移除结点1上的元素
print $linkedList->get(1);   # 输出5
print $linkedList->size();   # 输出3