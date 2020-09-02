<?php
// use Demo1\BookProduct;
// use Demo1\CdProduct;
// use Demo1\ShopProductWriter;

// require 'CdProduct.php';
// require 'BookProduct.php';
// require './ShopProductWriter.php';

$cd = new CdProduct('Cd', 'Henry', 'Lee', 40, 70);

$book = new BookProduct('Book', "Wenger", "wenger", 60, 80);
die(var_dump([$cd, $book]));

$writer = new ShopProductWriter;

$writer->addProduct($cd);
$writer->addProduct($book);

$writer->write();
