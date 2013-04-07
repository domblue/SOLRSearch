<?php
	
	$vars = array();

	if($guid = get_input("guid")){
		if($entity = get_entity($guid)){
			if($entity instanceof ProfileManagerCustomField){
				$vars["entity"] = $entity;
			}
		}
	}
	
	echo elgg_view("forms/solrsearch/profile_field", $vars);