<?php

namespace Demo1;

// use Demo1\ShopProduct;
require './ShopProduct.php';

class BookProduct extends ShopProduct
{
    private $numPages = 0;

    public function __construct($title, $firstName, $mainName, $price, $numPages)
    {
        parent::__construct($title, $firstName, $mainName, $price);
        $this->numPages = $numPages;
    }

    public function getNumPages()
    {
        return $this->numPages;
    }

    public function getSummeryLine()
    {
        $base = parent::getSummeryLine();
        return $base.":page count - {$this->numPages}";
    }

    public function getPrice()
    {
        return $this->price;
    }
}
