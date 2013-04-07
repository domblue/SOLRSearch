<?php
	/**
	* Profile Manager
	* 
	* Action to toggle profile field metadata
	* 
	* @package solrsearch
	* @author Daniel Scholz
	* @copyright ForbiddenRoses
	* @link
	*/

//domblue added searchable
 	
//	$allowed = array("mandatory", "show_on_register", "user_editable", "output_as_tags", "admin_only", "count_for_completeness", "searchable");
	$allowed = array("searchable");
	$guid = get_input("guid");
	$field = get_input("field");
	
	if(!empty($guid) && in_array($field, $allowed)){
		$entity = get_entity($guid);
		if($entity->getSubtype() == CUSTOM_PROFILE_FIELDS_PROFILE_SUBTYPE || $entity->getSubtype() == CUSTOM_PROFILE_FIELDS_GROUP_SUBTYPE){
			if($entity->$field == "yes"){
				$entity->$field = "no";
			} else {
				$entity->$field = "yes";
			}
			// need to save to trigger a memcache update
			$entity->save();
			echo "true";		
		}
	}

	exit();