<?php

class ListNode
{
    public $val = 0;
    public $next = null;

    public function __construct($val)
    {
        $this->val = $val;
    }
}

class Solution
{
    public $list;

    public function __construct($arr)
    {
        $curr = new ListNode(null);
        foreach ($arr as $val) {
            $next = new ListNode($val);
            $curr->next = $next;
            $curr = $next;
            $this->list[] = $curr;
        }

    }

    public function delete($target)
    {
//        $head = new ListNode(null);
//        $first = new ListNode(4);
//        $head->next = $first;
//        $second = new ListNode(1);
//        $first->next = $second;
//        $third = new ListNode(2);
//        $second->next = $third;
//        $fouth = new ListNode(5);
//        $third->next = $fouth;

        $curr = $this->list[0];
        $pre = $this->list[1];
        while ($curr->val || $curr->next) {
            echo $curr->val.PHP_EOL;
            if ($curr->val == $target) {
                $pre->next = $curr->next;
                unset($curr);
                return true;
            }
            $pre = $curr;
            $curr = $curr->next;
        }

        return false;
    }
}

$instance = new Solution([4, 1, 3, 5]);
//var_dump($instance->delete(5));
var_dump($instance->list);