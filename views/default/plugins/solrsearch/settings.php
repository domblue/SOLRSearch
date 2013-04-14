<?php
	/**
	* SOLRSearch
	* 
	* Admin settings
	* 
	* @package SOLRSearch
	* @author Daniel Scholz
	* @copyright ForbiddenRoses
	* @link 
	*/

	
	
echo elgg_view("solrsearch/admin/tabs", array("settings_selected" => true));
?>
<table>
	<tr>
		<td colspan="2">
			<div class='elgg-module-inline'>
				<div class='elgg-head'>
				<h3><?php echo elgg_echo("solrsearch:settings:configuration"); ?></h3>
				</div>
			</div>
		</td>
	</tr>

	<tr>
		<td colspan="2">
			<?php echo elgg_echo('solrsearch:settings:host'); ?>
		</td>
	</tr>
		<tr>
		<td colspan="2">
			<?php echo elgg_view("input/text", array("name" => "params[solr_host]", "value" => $vars['entity']->solr_host)); ?>
		</td>
	</tr>
	<tr>
	
		<tr>
		<td colspan="2">
			<?php echo elgg_echo('solrsearch:settings:port'); ?>
		</td>
	</tr>
		<tr>
		<td colspan="2">
			<?php echo elgg_view("input/text", array("name" => "params[solr_port]", "value" => $vars['entity']->solr_port)); ?>
		</td>
	</tr>
	<tr>
	
		<tr>
		<td colspan="2">
			<?php echo elgg_echo('solrsearch:settings:entities:path'); ?>
		</td>
	</tr>
		<tr>
		<td colspan="2">
			<?php echo elgg_view("input/text", array("name" => "params[solr_entities_path]", "value" => $vars['entity']->solr_entities_path)); ?>
		</td>
	</tr>
	
	<tr>
		<td colspan="2">
			<?php echo elgg_echo('solrsearch:settings:profiles:path:'); ?>
		</td>
	</tr>
		<tr>
		<td colspan="2">
			<?php echo elgg_view("input/text", array("name" => "params[solr_profiles_path]", "value" => $vars['entity']->solr_profiles_path)); ?>
		</td>
	</tr>

		<tr>
		<td colspan="2">
			<?php echo elgg_echo('solrsearch:settings:access'); ?>
		</td>
	</tr>
		<tr>
		<td colspan="2">
			<?php echo elgg_view('input/access', array(
					"name" => "params[solr_access_id]", 
					"value" => $vars['entity']->solr_access_id)); ?>
		</td>
	</tr>
	
</table>
<br />

