<?php 
/**
 *SOLRSearch
 *
 * Export Data Import SQL for profile/group fields
 *
 * @package solrsearch
 * @author Daniel Scholz
 * @copyright ForbiddenRoses 2013
 * @link
 */

// We'll be outputting a txt
// header("Content-Type: text/xml");
mb_internal_encoding("UTF-8");
header("Content-Type: text/xml; charset=utf-8");

// It will be called custom_profile_fields.backup.json.txt
header('Content-Disposition: attachment; filename="solr_profile.xml"');


$db_prefix = elgg_get_config('dbprefix');
// send an empty name so we just get the first part of the namespace



$fieldtype = get_input("fieldtype" , CUSTOM_PROFILE_FIELDS_PROFILE_SUBTYPE);

$options = array(
		"type" => "object",
		"subtype" => $fieldtype,
		"limit" => false,
		"owner_guid" => elgg_get_site_entity()->getGUID()
);

$entities = elgg_get_entities($options);

$access_level = elgg_get_plugin_setting('solr_access_id', 'solrsearch');

$info = array("fieldtype" => $fieldtype);

$fields = array();

// Get all single valued data

$sql_profile_single = 'SELECT ';

$root_user_entities = "SELECT u.name AS name, u.username AS username, u.guid AS entity_guid,";
$root_user_entities .= "from_unixtime(e.time_updated) AS time_updated FROM elgg_users_entity u ";
$root_user_entities .= "JOIN elgg_entities e WHERE e.guid = u.guid AND (";
$root_user_entities .= '${dataimporter.request.clean}';
$root_user_entities .=	' != FALSE ';
$root_user_entities .= 'OR time_updated > UNIX_TIMESTAMP("${dataimporter.last_index_time}"))';



// $output_as_tags = $vars["entity"]->output_as_tags;
$multicount = 0;
$sql_profile_multi = array();
$fFirst = true;
foreach ($entities as $entity) {
	if ($entity->searchable == 'yes') {
		// Get name id

		$q = "SELECT s.* FROM {$db_prefix}metastrings s where s.string = '" . $entity->metadata_name . "'";
		$metastring = get_data($q);
		$name_id = $metastring[0]->id;
		$solr_name = resolve_default_solr_field_name($entity);

		if ($entity->metadata_type != "multiselect"
				&& $entity->metadata_type != "tags" && $entity->multifield != 'yes') {
			// It is a single field
			if (!$fFirst) {
				$sql_profile_single .= ', ';
			}
			if (must_convert_to_solr_date($entity)) {
				$sql_profile_single .= "MAX(CASE WHEN d.name_id = '" . $metastring[0]->id .
				"' AND sv.id = d.value_id THEN DATE_FORMAT((STR_TO_DATE(sv.string, '%m/%d/%Y')), '%Y-%m-%dT%H:%i:%sZ') END ) AS " .
				$solr_name;
			} else {
				$sql_profile_single .= "MAX(CASE WHEN d.name_id = '" . $metastring[0]->id .
				"' AND sv.id = d.value_id THEN sv.string END ) AS " . $solr_name;
			}
			$fFirst = false;

		} else {
			// it is a multi


			$sql_profile_multi[$entity->metadata_name] = "SELECT CASE WHEN d.name_id = '" . $metastring[0]->id .
			"' AND sv.id = d.value_id THEN sv.string END AS " . $solr_name;
			$sql_profile_multi[$entity->metadata_name] .= " FROM {$db_prefix}metadata d " .
			" JOIN {$db_prefix}metastrings sv ON d.value_id = sv.id " .
			'WHERE d.entity_guid = ${ElggUser.entity_guid} ' .
			"AND d.name_id = '" . $metastring[0]->id . "' " .
			"AND d.enabled = 'yes' " .
			"AND d.access_id >= '" . $access_level . "' ";

		}
	}
}
$sql_profile_single .= " FROM {$db_prefix}metadata d " .
"JOIN {$db_prefix}metastrings sv ON d.value_id = sv.id " .
'WHERE d.entity_guid = ${ElggUser.entity_guid} ' .
"AND d.value_id = sv.id " .
"AND d.enabled = 'yes' " .
"AND d.access_id >= '" . $access_level . "' ";




$dom = new DOMDocument('1.0', 'UTF-8');
$dom->formatOutput = true;

// config node
$data_config = $dom->createElement('dataConfig');
$dom->appendChild($data_config);
$data_source = $dom->createElement("dataSource");
$data_config->appendChild($data_source);
$data_source->setAttribute("type", "JdbcDataSource");
$data_source->setAttribute("driver", "com.mysql.jdbc.Driver");
$data_source->setAttribute("url", "jdbc:mysql://" . get_config('dbhost') . "/" . get_config('dbname'));
$data_source->setAttribute("user", get_config('dbuser'));
$data_source->setAttribute("password", get_config('dbpass'));



// document node

$root = $dom->createElement('document');
$data_config->appendChild($root);

// User entity node

$firstNode = $dom->createElement("entity");
$root->appendChild($firstNode);
$firstNode->setAttribute("name", "ElggUser");
$firstNode->setAttribute("PK", "entity_guid");
$firstNode->setAttribute("query", $root_user_entities);

// Add single statement node

$singleNode = $dom->createElement("entity");
$firstNode->appendChild($singleNode);
$singleNode->setAttribute("name", "ElggUserMetaSingle");
$singleNode->setAttribute("query", $sql_profile_single);

// Add the multi nodes

foreach ($sql_profile_multi as $key => $value) {
	$multiNode = $dom->createElement("entity");
	$firstNode->appendChild($multiNode);
	$multiNode->setAttribute("name", "ElggUserMeta_ " . $key);
	$multiNode->setAttribute("query", $value);

}


// @todo don't know how to do this properly
echo str_replace(array('&lt;', '&gt;', '&quot;'), array('<', '>', "'"),$dom->saveXML($dom->documentElement));
// echo str_replace(array('&lt;', '&gt;'), array('<', '>',),$dom->saveXML($dom->documentElement));
// echo $str = domdoc->saveXML(domdoc->documentElement);


exit();