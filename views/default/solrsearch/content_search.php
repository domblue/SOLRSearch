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


// this executes the query and returns the result
$resultset = execute_solr_query(array($vars['query']), 'solr_entities_path');

// display the total number of documents found by solr
echo 'NumFound: ' . $resultset->getNumFound();

// show documents using the resultset iterator
foreach ($resultset as $document) {

	echo '<hr/><table>';

	// the documents are also iterable, to get all fields
	foreach ($document AS $field => $value) {
		// this converts multivalue fields to a comma-separated string
		if (is_array($value)) {
			$value = implode(', ', $value);
		}

		echo '<tr><th>' . $field . '</th><td>' . $value . '</td></tr>';
	}

	echo '</table>';
}
