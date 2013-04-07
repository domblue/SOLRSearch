<?php
	/**
	* Profile Manager
	* 
	* Group Profile Fields Config page
	* 
	* @package solrsearch
	* @author Daniel Scholz
	* @copyright ForbiddenRoses
	* @link
	*/

	$fields = elgg_view("profile_manager/group_fields/list");
	$actions = elgg_view("profile_manager/group_fields/actions");
	
	$page_data = $fields . $actions;
	
	echo elgg_view("profile_manager/admin/tabs", array("group_fields_selected" => true));
	echo $page_data;	