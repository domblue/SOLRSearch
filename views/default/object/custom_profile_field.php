<?php 
/**
 * SOLRSearch
 *
 * Object view of a custom profile field
 *
 * @package solrsearch
 * @author Daniel Scholz
 * @copyright ForbiddenRoses 2013
 * @link
 */
$handle = "<div onclick='$(\"#" . $vars['entity']->guid . "\").toggle();' class='custom_field_handle'></div>";

$title = "<div class='field_config_title'>";
$title .= "<b>" . $vars['entity']->metadata_name . "</b> [" . $vars['entity']->metadata_type . "]";
$title .= "<a href='" . $vars["url"] . "solrsearch/forms/profile_field/" . $vars['entity']->guid  . 
		"' class='solr-search-popup'><span class='elgg-icon elgg-icon-settings-alt' title='" . elgg_echo("edit") . "'></span></a>";
$title .= "</div>";

$searchable = $vars["entity"]->searchable;
if (!$searchable) {
	$vars["entity"]->searchable = 'yes'; // init to yes
}
$multifield = $vars["entity"]->multifield;
if (!$multifield) {
	$vars["entity"]->multifield = 'no'; // init to no
}

$metadata = "<div class='field_config_metadata'>";

// searchable
$metadata .= elgg_view("solrsearch/toggle_metadata", array("entity" => $vars['entity'], "metadata_name" => "searchable"));
// multi field
$metadata .= elgg_view("solrsearch/toggle_metadata", array("entity" => $vars['entity'], "metadata_name" => "multifield"));


$metadata .= "</div>";
	
$info = $handle . $metadata . $title;

echo "<div id='custom_profile_field_" . $vars['entity']->guid . "' class='custom_field' rel='" . 
		$vars['entity']->category_guid . "'>"  . $info . "</div>";
