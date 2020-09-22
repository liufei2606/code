<?php

use Oop\Popp\BookProduct;
use Oop\Popp\CdProduct;
use Oop\Popp\ShopProductWriter;

$cd = new CdProduct('Cd', 'Henry', 'Lee', 40, 70);
$book = new BookProduct('Book', "Wenger", "wenger", 60, 80);
$writer = new ShopProductWriter;

$writer->addProduct($cd);
$writer->addProduct($book);

$writer->write();
