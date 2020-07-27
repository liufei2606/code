<?php


class Client
{
    public static function main()
    {
        $mother = new Mother();
        $mother->narrate(new Book());
        $mother->narrate(new Newspaper());
    }
}

$client = new Client();
$client::main();