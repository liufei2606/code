<?php

interface iReader
{
    public function getContent();
}

class book implements iReader
{
    public function getContent()
    {
        return "很久很久以前有一个阿拉伯的故事……\n";
    }
}

class newspaper implements iReader
{
    public function getContent()
    {
        return "林书豪17+9助尼克斯击败老鹰……\n";
    }
}

class mother
{
    public function narrate(iReader $book)
    {
        echo "妈妈开始讲故事\n";
        echo $book->getContent();
    }
}

class client
{
    public static function main()
    {
        $mother = new mother();
        $mother->narrate(new book());
        $mother->narrate(new newspaper());
    }
}

$client = new client();

$client::main();
