<?php
include "./bootstrap.php";

// add
$options = array
(
	'hostname' => SOLR_SERVER_HOSTNAME,
//	'login' => SOLR_SERVER_USERNAME,
//	'password' => SOLR_SERVER_PASSWORD,
	'port' => SOLR_SERVER_PORT,
);

$client = new SolrClient($options);

$doc = new SolrInputDocument();

$doc->addField('id', 334455);
$doc->addField('cat', 'Software');
$doc->addField('cat', 'Lucene');

$updateResponse = $client->addDocument($doc);

print_r($updateResponse->getResponse());
die;

## merge
$doc = new SolrDocument();

$second_doc = new SolrDocument();

$doc->addField('id', 1123);

$doc->features = "PHP Client Side";
$doc->features = "Fast development cycles";

$doc['cat'] = 'Software';
$doc['cat'] = 'Custom Search';
$doc->cat   = 'Information Technology';

$second_doc->addField('cat', 'Lucene Search');

$second_doc->merge($doc, true);

print_r($second_doc->toArray());

## search
$options = array
(
	'hostname' => SOLR_SERVER_HOSTNAME,
	'login'    => SOLR_SERVER_USERNAME,
	'password' => SOLR_SERVER_PASSWORD,
	'port'     => SOLR_SERVER_PORT,
);

$client = new SolrClient($options);

$query = new SolrQuery();

$query->setQuery('lucene');

$query->setStart(0);

$query->setRows(50);

$query->addField('cat')->addField('features')->addField('id')->addField('timestamp');

$query_response = $client->query($query);
$query_response->setParseMode(SolrQueryResponse::PARSE_SOLR_DOC);

$response = $query_response->getResponse();

print_r($response);

#  TermsComponent

$query->setTerms(true);

$query->setTermsField('cat');

$prefix = 'c';
$query->setTermsField('cat')->setTermsPrefix($prefix);

/* Return only terms with a frequency of 2 or greater */
$min_frequency = 2;
$query->setTermsField('cat')->setTermsPrefix($prefix)->setTermsMinCount($min_frequency);

$updateResponse = $client->query($query);

print_r($updateResponse->getResponse());


$query->addFacetField('cat')->addFacetField('name')->setFacetMinCount(2);

$updateResponse = $client->query($query);

$response_array = $updateResponse->getResponse();

$facet_data = $response_array->facet_counts->facet_fields;

print_r($facet_data);


$query->addFacetField('cat')->addFacetField('name')->setFacetMinCount(2)->setFacetMinCount(4, 'name');

$updateResponse = $client->query($query);

$response_array = $updateResponse->getResponse();

$facet_data = $response_array->facet_counts->facet_fields;

print_r($facet_data);


$query = new SolrQuery('*:*');

$query->setFacet(true);

$query->addFacetDateField('manufacturedate_dt');

$query->setFacetDateStart('2006-02-13T00:00:00Z');

$query->setFacetDateEnd('2012-02-13T00:00:00Z');

$query->setFacetDateGap('+1YEAR');

$query->setFacetDateHardEnd(1);

$query->addFacetDateOther('before');

$updateResponse = $client->query($query);

$response_array = $updateResponse->getResponse();

$facet_data = $response_array->facet_counts->facet_dates;

print_r($facet_data);


$query = new SolrQuery('*:*');

$query->setFacet(true);

$query->addFacetField('cat')->addFacetField('name')->setFacetMinCount(2)->setFacetMinCount(4, 'name');

$updateResponse = $client->query($query);

$response_array = $updateResponse->getResponse();

$facet_data = $response_array->facet_counts->facet_fields;

print_r($facet_data);



$query->addFacetDateField('manufacturedate_dt');

$query->setFacetDateStart('2006-02-13T00:00:00Z');

$query->setFacetDateEnd('2012-02-13T00:00:00Z');

$query->setFacetDateGap('+1YEAR');

$query->setFacetDateHardEnd(1);

$query->addFacetDateOther('before');

$updateResponse = $client->query($query);

$response_array = $updateResponse->getResponse();

$facet_data = $response_array->facet_counts->facet_dates;

print_r($facet_data);
