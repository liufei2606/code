<?php

require './../vendor/autoload.php';

use Elasticsearch\ClientBuilder;

//$logger = ClientBuilder::defaultLogger('./../logs/es.log', Logger::INFO);
$logger = new \Monolog\Logger('es');
$client = ClientBuilder::create()->setHosts(['localhost:9200'])
    ->setLogger($logger)
    ->build();

$params = [
    'index' => 'my_index',
    'type' => 'my_type',
    'id' => 'my_id',
    'body' => ['testField' => 'abc']
];
$response = $client->index($params);

$params = [
    'index' => 'my_index',
    'type' => 'my_type',
    'id' => 'my_id'
];
$response = $client->get($params);

$params = [
    'index' => 'my_index',
    'type' => 'my_type',
    'body' => [
        'query' => [
            'match' => [
                'testField' => 'abc'
            ]
        ]
    ]
];
try {
    $response = $client->search($params);
} catch (Elasticsearch\Common\Exceptions\TransportException $e) {
    $previous = $e->getPrevious();
    if ($previous instanceof \Elasticsearch\Common\Exceptions\MaxRetriesException) {
        echo "Max retries!";
    }
}

$params = [
    'index' => 'my_index',
    'type' => 'my_type',
    'id' => 'my_id'
];
//$response = $client->delete($params);

$deleteParams = [
    'index' => 'my_index'
];
//$response = $client->indices()->delete($deleteParams);

$params = [
    'index' => 'my_index',
    'body' => [
        'settings' => [
            'number_of_shards' => 2,
            'number_of_replicas' => 0
        ]
    ]
];
$response = $client->indices()->create($params);
