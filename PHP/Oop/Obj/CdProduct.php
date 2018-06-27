<?php
namespace Demo1;

// use Demo1\ShopProduct;

require './ShopProduct.php';

class CdProduct extends ShopProduct
{
    private $playLength =0;
    public function __construct($title, $firstName, $mainName, $price, $playLength)
    {
        parent::__construct($title, $firstName, $mainName, $price);
        $this->playLength = $playLength;
    }

    public function getPlayLength()
    {
        return $this->playLength;
    }

    public function getSummeryLine()
    {
        $base = parent::getSummeryLine();
        return $base . ": playing time - {$this->getPlayLength}";
    }
}
