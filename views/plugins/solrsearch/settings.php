<?php
	/**
	* SOLRSearch
	* 
	* Admin settings
	* 
	* @package profile_manager
	* @author ColdTrick IT Solutions
	* @copyright Coldtrick IT Solutions 2009
	* @link http://www.coldtrick.com/
	*/

	
	

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
			<?php echo elgg_echo('solrsearch:settings:path'); ?>
		</td>
	</tr>
		<tr>
		<td colspan="2">
			<?php echo elgg_view("input/text", array("name" => "params[solr_path]", "value" => $vars['entity']->solr_path)); ?>
		</td>
	</tr>

</table>
<br />