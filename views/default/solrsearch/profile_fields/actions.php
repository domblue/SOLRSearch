<?php 
/**
 * Profile Manager
 *
 * Profile Fields actions view
 *
 * @package solrsearch
 * @author Daniel Scholz
 * @copyright ForbiddenRoses
 * @link
 */

?>
<div class="elgg-module elgg-module-inline">
	<div class="elgg-head">
		<h3>
			<?php echo elgg_echo('profile_manager:actions:title'); ?>
			<span class='custom_fields_more_info' id='more_info_actions'></span>
		</h3>
	</div>
	<div class="elgg-body solr-search-actions">
		<?php 
			
		echo elgg_view("output/confirmlink", array("text" => elgg_echo("solrsearch:actions:export_profile_search"),
		"href" => "/action/solrsearch/export_profile_search?fieldtype=" . CUSTOM_PROFILE_FIELDS_PROFILE_SUBTYPE,
		"confirm" => elgg_echo("solrsearch:actions:export_profile_search:description"),
		"class" => "elgg-button elgg-button-action"));


		?>
	</div>
</div>

<div class="custom_fields_more_info_text" id="text_more_info_actions">
	<?php echo elgg_echo("solrsearch:tooltips:actions");?>
</div>
