<?php
$options = array
(
	'hostname' => "localhost",
	'path'     => 'solr/test',
	'port'     => '8983',
);

$client = new SolrClient($options);
$data = array(
	array(
		'id' => 'EN80922032',
		'name' => '男士打磨直筒休闲牛仔裤',
		'brand' => 'ENERGIE',
		'cat' => '牛仔裤',
		'price' => '1870.00'
	),
	array(
		'id' => 'EN70906025',
		'name' => '品牌LOGO翻领拉链外套',
		'brand' => 'ENERGIE',
		'cat' => '外套',
		'price' => '1680.00'
	),
);


//foreach($data as $key => $value) {
//	$doc = new SolrInputDocument();
//	foreach($value as $key2 =>$value2) {
//		$doc->addField($key2,$value2);
//	}
//	$client->addDocument($doc);
//
//}
//$client->commit();

$query = new SolrQuery();

$query->setQuery('打磨');

$query->setStart(0);

$query->setRows(50);

$query->addField('name');

$query_response = $client->query($query);

$response = $query_response->getResponse();

print_r($response);

$client->deleteByQuery('id:EN80922032');
$result = $client->commit();
print_r($result);
