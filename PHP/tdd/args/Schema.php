<?php


namespace Tdd\Args;

class Schema
{
    private $schemas;

    /**
     * Schema constructor.
     *
     * @param  string  $string
     */
    public function __construct(string $string)
    {
        $schemasArray = explode(',', $string);
        foreach ($schemasArray as $nameValue) {
            if ($arr = strstr($nameValue, ':')) {
                $this->schemas[$arr[0]] = $arr[1];
            }
        }
    }

    public function getValue(string $string, $default)
    {
        if (isset($this->schemas[$string])) {
            $type = $this->schemas[$string];

            switch ($type) {
                case 'bool':
                    return $default === true;
                case 'int':
                    return (int) $default;
                default:
                    return $default;
            }
        }

        return $default;
    }
}
