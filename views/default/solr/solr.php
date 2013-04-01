<?php

/**
 * Elgg solr plugin
 *
 * @author Daniel Scholz
 * @copyright Forbiddenroses 2013
 * 
 * accessing solr and executing the query
 * 
 */


$base = elgg_get_plugins_path() . 'SOLRSearch/vendor';
require $base . '/autoload.php';

$config = array(
		'endpoint' => array(
				'localhost' => array(
						'host' => '127.0.0.1',
						'port' => 8983,
						'path' => '/solr/collectionElgg',
				)
		)
);

// create a client instance
$client = new Solarium\Client($config);

$queryStr = array($vars['query']);
// get a select query instance
$query = $client->createQuery($client::QUERY_SELECT, $queryStr );

// this executes the query and returns the result
$resultset = $client->execute($query);

// display the total number of documents found by solr
echo 'NumFound: '.$resultset->getNumFound();

// show documents using the resultset iterator
foreach ($resultset as $document) {

    echo '<hr/><table>';

    // the documents are also iterable, to get all fields
    foreach($document AS $field => $value)
    {
        // this converts multivalue fields to a comma-separated string
        if(is_array($value)) $value = implode(', ', $value);

        echo '<tr><th>' . $field . '</th><td>' . $value . '</td></tr>';
    }

    echo '</table>';
}
