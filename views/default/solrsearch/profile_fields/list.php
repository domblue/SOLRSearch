<?php
/**
 * SOLRSearch
 *
 * Profile Fields list view
 *
 * @package SOLRSearch
 * @author Daniel Scholz
 * @copyright ForbiddenRoses
 * @link

 */

$options = array(
		"type" => "object",
		"subtype" => CUSTOM_PROFILE_FIELDS_PROFILE_SUBTYPE,
		"limit" => false,
		"order_by_metadata" => array(array('name' => 'order', 'direction' => "asc", 'as' => "integer")),
		"owner_guid" => elgg_get_site_entity()->getGUID(),
		"pagination" => false,
		"full_view" => false
);

$list = elgg_list_entities_from_metadata($options);

if (empty($list)) {
	$list = elgg_echo("solrsearch:profile_fields:no_fields");
}

?>
<div class="elgg-module elgg-module-inline">
	<div class="elgg-head">
		<h3>
			<?php echo elgg_echo('solrsearch:profile_fields:list:title'); ?>
			<span class='custom_fields_more_info'
				id='more_info_profile_field_additional'></span>
		</h3>
	</div>
	<div class="elgg-body" id="custom_fields_ordering">
		<?php echo $list; ?>
	</div>
</div>

<div class="custom_fields_more_info_text"
	id="text_more_info_profile_field">
	<?php echo elgg_echo("solrsearch:tooltips:profile_field");?>
</div>
<div class="custom_fields_more_info_text"
	id="text_more_info_profile_field_additional">
	<?php echo elgg_echo("solrsearch:tooltips:profile_field_additional");?>
</div>
