<?php 
/**
 * Elgg solr plugin
 * General Functions
 *
 * @author Daniel Scholz
 * @copyright Forbiddenroses 2013
 */

/**
 * resolve to a valid name for the SOLR schema
 *
 * @param string $field field to be converted
 * @return boolean true/false
 *
 */

function must_convert_to_solr_date($field) {
	
	$fix_solr_field_date = array("date", "calendar", "pm_datepicker");
	if (in_array(strtolower($field->metadata_type), $fix_solr_field_date)) { 
		return true;
	}
	return false;
	
}



/**
 * resolve to a valid name for the SOLR schema
 *
 * @param string $field field to be named
 * @return string name
 *
 */

function resolve_default_solr_field_name($field) {

	if (empty($field) || !$field->metadata_name) {
		register_error(elgg_echo("solrsearch:function:resolvefiled:error:nofieldname"));
		return NULL; // Let it crash
	}

	if (!empty($field->solr_name)) {
		return $field->solr_name; // return the given name in case one is already there
	}

	$fix_solr_field_names = array(
			"entity_guid", "site_guid","owner_guid", "container_guid", "access_id", "time_updated", "subtype", "title", "description",
			"url", "excerpt", "briefdescription", "address", "tags", "group_topic_post", "generic_comment"
	);

	if (in_array(strtolower($field->metadata_name), $fix_solr_field_names)) {
		return strtolower($field->metadata_name);
	}
	// Now trying to guess what it could be and add the dynamic extension
	$fix_solr_field_strings = array("url", "email", "dropdown", "radio", "pm_rating");
	$fix_solr_field_text = array("text", "longtext");
	$fix_solr_field_multi = array("tags", "multiselect");
	$fix_solr_field_date = array("date", "calendar", "pm_datepicker");
	$fix_solr_field_location = array("location");

	$appendix = "";
	if (in_array(strtolower($field->metadata_type), $fix_solr_field_strings)) {
		$appendix = "_s";
	} else if (in_array(strtolower($field->metadata_type), $fix_solr_field_text)) {
		$appendix = "_t";
	} else if (in_array(strtolower($field->metadata_type), $fix_solr_field_multi)) {
		$appendix = "_ss";
	} else if (in_array(strtolower($field->metadata_type), $fix_solr_field_date)) {
		$appendix = "_dt";
	} else if (in_array(strtolower($field->metadata_type), $fix_solr_field_location)) {
		$appendix = "_s"; // sepearate here due to future geo sensitivity
	} else {
		$appendix = "_t"; // last resort is text
	}
	return $field->metadata_name . $appendix;


}

/**
 * Execute a query
 *
 * @param string $queryStr   the query
 * @param string $collection and the collection - either solr_entities_path or solr_profiles_path
 * @return	ResultInterface
 * 
 */
function execute_solr_query($queryStr, $collection) {

	$base = elgg_get_plugins_path() . 'solrsearch/vendor';
	require $base . '/autoload.php';

	$config = array(
			'endpoint' => array(
					'localhost' => array(
							'host' => elgg_get_plugin_setting('solr_host', 'solrsearch'),
							'port' => elgg_get_plugin_setting('solr_port', 'solrsearch'),
							'path' => '/solr/' . elgg_get_plugin_setting($collection, "solrsearch")
					)
			)
	);

	// create a client instance
	$client = new Solarium\Client($config);

	// get a select query instance
	$query = $client->createQuery($client::QUERY_SELECT, $queryStr);

	// this executes the query and returns the result
	$resultset = array();
	
	try{
		$resultset = $client->execute($query);
	}catch(Solarium\Exception $e){
		register_error(elgg_echo("solrsearch:action:query:failed"));
		syslog(LOG_ALERT, $e->getMessage());
		return NULL;
	}
	return $resultset;
}