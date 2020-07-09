<?php


class FizzBuzz
{
    public static function main()
    {
        $res = '';
        for ($i = 0; $i < 100; $i++) {
            $res = self::printByDigit(i);
            $i .= $res ? $i : $res;
        }

        return $res;
    }

    public static function printByDigit(int $i): string
    {
        $res = '';
        if ($i % 3 === 0) {
            $res .= 'Fizz';
        }
        if ($i % 5 === 0) {
            $res .= 'Buzz';
        }

        return $res;
    }
}
