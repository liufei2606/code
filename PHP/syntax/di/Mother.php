<?php


class Mother
{
    public function narrate(iReader $book)
    {
        echo "妈妈开始讲故事\n";
        echo $book->getcontext();
    }
}