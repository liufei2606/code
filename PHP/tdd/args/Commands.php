<?php


namespace Tdd\Args;

class Commands
{
    public $commands = [];

    /**
     * Commands constructor.
     *
     * @param  string  $string
     */
    public function __construct(string $string)
    {
        $commandsArr = explode(' ', $string);

        while (next($commandsArr)) {
            $value = prev($commandsArr);

            if (strpos($value, '-') !== false) {
                $this->commands[substr($value, 1)] = next($commandsArr);
            }
//            $value = current($commandsArr);
//            if ($arr = strstr($value, '-')) {
//                if (!is_int($arr[0])) {
//                    $this->commands[$arr[0]] = next($commandsArr);
//                } else {
//
//                    $this->commands[prev($commandsArr)] = $value;
//                }
//            }
        }
    }

    public function getValue(string $string)
    {
        return $this->commands[$string];
    }
}

$ins = new Commands('-l true -d /usr/bin/bash');
var_dump($ins->commands);
