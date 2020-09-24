<?php


use ModernPHP\features\traits\RetailStore;

/**
 * @todo FIX
 */
$adapter = new \Ivory\HttpAdapter\CurlHttpAdapter();
$geocoder = new \Geocoder\Provider\GoogleMaps($adapter);

$store = new RetailStore();
$store->setAddress('420 9th Avenue, New York, NY 10001 USA');
$store->setGeocoder($geocoder);

$latitude = $store->getLatitude();
$longitude = $store->getLongitude();

echo $latitude, ':', $longitude;
