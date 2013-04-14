<?php 
/**
 * SOLRSearch
 *
 * Object view of a custom group field
 *
 * @package solrsearch
 * @author Daniel Scholz
 * @copyright ForbiddenRoses
 * @link
 */

$handle = "<div onclick='$(\"#" . $vars['entity']->guid . "\").toggle();' class='custom_field_handle'></div>";

$title = "<div class='field_config_title'>";
$title .= "<b>" . $vars['entity']->metadata_name . "</b> [" . $vars['entity']->metadata_type . "]";
$title .= "<a href='" . $vars["url"] . "solrsearch/forms/group_field/" . $vars['entity']->guid  .
"' class='solr-search-popup'><span class='elgg-icon elgg-icon-settings-alt' title='" . elgg_echo("edit") . "'></span></a>";
$title .= "</div>";

$searchable = $vars["entity"]->searchable;
if (!$searchable) {
	$vars["entity"]->searchable = 'yes'; // init to yes
}

$metadata = "<div class='field_config_metadata'>";

// searchable
$metadata .= elgg_view("solrsearch/toggle_metadata", array("entity" => $vars['entity'], "metadata_name" => "searchable"));

$metadata .= "</div>";

$info = $handle . $metadata . $title;

echo "<div id='custom_profile_field_" . $vars['entity']->guid . "' class='custom_field' rel=''>"  . $info . "</div>";
