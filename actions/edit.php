<?php 
/**
 * SOLRSearch
 *
 * Action to edit profile field search params
 *
 * @package solrsearch
 * @author Daniel Scholz
 * @copyright ForbiddenRoses 2013
 * @link
 */

$site_guid = elgg_get_site_entity()->getGUID();

$search_rule = trim(get_input("search_rule"));
$search_type = trim(get_input("search_type"));
$solr_name = trim(get_input("solr_name"));
$searchable = trim(get_input("searchable"));
$multifield = trim(get_input("multifield"));


$type = get_input("type", "profile");

$guid = get_input("guid");

if ($guid) {
	$current_field = get_entity($guid);
} else {
	register_error(elgg_echo("solrsearch:action:editfield:error:noguid"));
}
if ($current_field->getSubtype() != CUSTOM_PROFILE_FIELDS_PROFILE_SUBTYPE 
	&& $current_field->getSubtype() != CUSTOM_PROFILE_FIELDS_GROUP_SUBTYPE) {
	// wrong custom field type
	register_error(elgg_echo("solrsearch:action:new:error:type"));
}


$field = $current_field;


if (!empty($search_rule)) {
	$field->search_rule = $search_rule;
} else {
	unset($field->search_rule);
}

if (!empty($search_type)) {
	$field->search_type = $search_type;
} else {
	unset($field->search_type);
}

if (!empty($solr_name)) {
	$field->solr_name = $solr_name;
} else {
	unset($field->solr_name);
}

$field->searchable = $searchable;
$field->multifield = $multifield;

if ($field->save()) {
	system_message(elgg_echo("solrsearch:actions:edit:success"));
} else {
	register_error(elgg_echo("solrsearch:actions:edit:error:unknown"));
}
	

forward(REFERER);