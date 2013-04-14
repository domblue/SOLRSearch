<?php
/**
 * Profile Manager
 *
 * Toggle metadata view
 *
 * @package solrsearch
 * @author Daniel Scholz
 * @copyright ForbiddenRoses
 * @link
 */

$entity = $vars['entity'];
$metadata_type = $entity->metadata_type;
$metadata_name = $vars['metadata_name'];


$id = $metadata_name . "_" . $entity->guid;

$class = "";
$onclick = "";

// if no option is available in the register, this metadata field can't be toggled
//	if(!empty($type_options) && array_key_exists($metadata_name, $type_options) && $type_options[$metadata_name]){
if ($entity->$metadata_name != "yes") {
	$class = " field_config_metadata_option_disabled";
} else {
	$class = " field_config_metadata_option_enabled";
}
$title = elgg_echo('profile_manager:admin:' . $metadata_name);
$onclick = "onclick='solr_toggleOption(\"" . $metadata_name . "\", " . $entity->guid . "); return false;'";
//	} else {
//		$title = elgg_echo('profile_manager:admin:option_unavailable');
//	}
echo "<span title='" . $title . "' class='field_config_metadata_option" . $class . "' id='" . $id . "' " . $onclick . "></span>";