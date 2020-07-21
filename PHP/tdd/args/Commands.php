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

        while ($value = next($commandsArr)) {
            $key = prev($commandsArr);
            $current = current($commandsArr);
            if (strpos($key, '-') !== false) {
                $this->commands[substr($key, 1)] = $value;
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
            next($commandsArr);
        }
    }

    public function getValue(string $string)
    {
        return $this->commands[$string];
    }
}
