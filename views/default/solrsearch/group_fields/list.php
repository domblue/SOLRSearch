<?php 
	/**
	* SOLRSearch
	* 
	* Group Fields list view
	* 
	* @package solrsearch
	* @author Daniel Scholz
	* @copyright ForbiddenRoses
	* @link
	*/
	
	$options = array(
			"type" => "object",
			"subtype" => CUSTOM_PROFILE_FIELDS_GROUP_SUBTYPE,
			"limit" => false,
			"order_by_metadata" => array(array('name' => 'order', 'direction' => "asc", 'as' => "integer")),
			"owner_guid" => elgg_get_site_entity()->getGUID(),
			"pagination" => false,
			"full_view" => false
		);
	
	$list = elgg_list_entities_from_metadata($options);	
	
	if(empty($list)){
		$list = elgg_echo("solrsearch:profile_fields:no_fields");
	}
?>

<div class="elgg-module elgg-module-inline">
	<div class="elgg-head">
		<h3>
			<?php echo elgg_echo('solrsearch:group_fields:list:title'); ?>
		</h3>
	</div>
	<div class="elgg-body" id="custom_fields_ordering">
		<?php echo $list; ?>
	</div>
</div>