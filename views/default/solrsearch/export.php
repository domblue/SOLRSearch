<?php
	/**
	* Profile Manager
	* 
	* Export view
	* 
	* @package SOLRSearch
	* @author Daniel Scholz
	* @copyright ForbiddenRoses
	* @link
	*/

	// $fieldtype = $vars['fieldtype'];

/*	if($fieldtype == CUSTOM_PROFILE_FIELDS_PROFILE_SUBTYPE){
		$fields = elgg_get_config('profile_fields');
	} elseif($fieldtype == CUSTOM_PROFILE_FIELDS_GROUP_SUBTYPE){
		$fields = elgg_get_config('group');
	}
	*/
	// Process User Metadata First
	$fields = elgg_get_config('profile_fields');
	echo elgg_echo('solrsearch:export:description:' . CUSTOM_PROFILE_FIELDS_PROFILE_SUBTYPE);
?>
	<div class="elgg-module elgg-module-inline">
		<div class="elgg-head">
			<h3><?php echo elgg_echo('solrsearch:export:list:title'); ?></h3>
		</div>
		<div class="elgg-body">
	
<?php 
	
	if($fields){
		
		echo "<form action='" . $vars['url'] . "action/solrsearch/export' method='POST'>";
		echo "<input type='hidden' name='fieldtype' value='" . $fieldtype . "'></hidden>";
		echo elgg_view("input/securitytoken");
				
		echo "<table>";
/**		if($fieldtype == CUSTOM_PROFILE_FIELDS_PROFILE_SUBTYPE){
			
			$default_fields = array("guid" => 0, "username" => 0, "name" => 0, "email" => 0, "time_created" => 0, "time_updated" => 0, "last_login" => 0, "validated" => 0, "validated_method" => 0);
			$fields = $default_fields + $fields; 			
		}
		
		if($fieldtype == CUSTOM_PROFILE_FIELDS_GROUP_SUBTYPE){

			$default_fields = array("guid" => 0, "name" => 0);
			$fields = $default_fields + $fields;
		}
	*/	
		foreach($fields as $metadata_name => $type){
			?>
			<tr>
				<td>
					<?php echo $metadata_name;?>
				</td>
				<td>
					<input type='checkbox' name='export[<?php echo $metadata_name;?>]' value='<?php echo $metadata_name;?>'></input>
				</td>
			</tr>
			<?php 
		}
		echo "</table>";
		} else {
			echo elgg_echo("solrsearch:export:nofields");
		}
		echo elgg_echo('solrsearch:export:description:' . CUSTOM_PROFILE_FIELDS_GROUP_SUBTYPE);
		?>
			<div class="elgg-module elgg-module-inline">
				<div class="elgg-head">
					<h3><?php echo elgg_echo('solrsearch:export:list:title'); ?></h3>
				</div>
				<div class="elgg-body">
			
		<?php 
		echo "<table>";
	/*	if($fieldtype == CUSTOM_PROFILE_FIELDS_PROFILE_SUBTYPE){
				
			$default_fields = array("guid" => 0, "username" => 0, "name" => 0, "email" => 0, "time_created" => 0, "time_updated" => 0, "last_login" => 0, "validated" => 0, "validated_method" => 0);
			$fields = $default_fields + $fields;
		}
		
		if($fieldtype == CUSTOM_PROFILE_FIELDS_GROUP_SUBTYPE){
		
			$default_fields = array("guid" => 0, "name" => 0);
			$fields = $default_fields + $fields;
		}
		*/

$fields = elgg_get_config('group');
if($fields){

		foreach($fields as $metadata_name => $type){
			?>
					<tr>
						<td>
							<?php echo $metadata_name;?>
						</td>
						<td>
							<input type='checkbox' name='export[<?php echo $metadata_name;?>]' value='<?php echo $metadata_name;?>'></input>
						</td>
					</tr>
					<?php 
				}
				echo "</table>";
		
		
	
		
		// buttons
		echo elgg_view("input/submit", array("value" => elgg_echo("export")));
		echo "</form>";
	} else {
		echo elgg_echo("solrsearch:export:nofields");
}
?>
	</div>
</div>