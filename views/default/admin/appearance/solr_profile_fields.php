<?php
/**
 * SOLRSearch
 *
 *
 * User Profile Fields Config page
 *
 * @package SOLRSearch
 * @author Daniel Scholz
 * @copyright ForbiddenRoses
 * @link
 */

//	$types = elgg_view("SOLRSearch/profile_types/list");
elgg_set_view_location('object/custom_profile_field', elgg_get_plugins_path() . 'solrsearch/views/', 'default');
$categories = elgg_view("solrsearch/categories/list");
$fields = elgg_view("solrsearch/profile_fields/list");
$actions = elgg_view("solrsearch/profile_fields/actions");

$page_data = $categories . $fields . $actions;

// $page_data = $types . $categories . $fields . $actions;

echo elgg_view("solrsearch/admin/tabs", array("profile_fields_selected" => true));
echo $page_data;