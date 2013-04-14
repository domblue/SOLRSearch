<?php
/**
 * SOLRSearch
 *
 * Group Profile Fields Search Config page
 *
 * @package solrsearch
 * @author Daniel Scholz
 * @copyright ForbiddenRoses
 * @link
 */

elgg_set_view_location('object/custom_group_field', elgg_get_plugins_path() . 'solrsearch/views/', 'default');
$fields = elgg_view("solrsearch/group_fields/list");
$actions = elgg_view("solrsearch/group_fields/actions");

$page_data = $fields . $actions;

echo elgg_view("solrsearch/admin/tabs", array("group_fields_selected" => true));
echo $page_data;