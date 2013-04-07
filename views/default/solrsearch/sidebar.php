<?php
/**
 * SOLR Search sidebar
 * 
 * @author Daniel Scholz
 * @copyright ForbiddenRoses 2013
 * 
 * Copy / paste of original adapted to solr
 */

// Entities search
$params = array(
	'method' => 'get',
	'action' => elgg_get_site_url() . 'solrsearch/search/entities',
	'disable_security' => true,
);

$body = elgg_view_form('solrsearch/entity_search', $params);

echo elgg_view_module('aside', elgg_echo('solrsearch:searchentities'), $body);

