<?php 
	/**
	* SOLRSearch
	* 
	* Profile Field Search Options
	* 
	* @package solrsearch
	* @author Daniel Scholz
	* @copyright ForbiddenRoses
	* @link
	*/
// domblue - added searchable
	$form_title = elgg_echo('solrsearch:profile_fields:searchparams');
	
	if($vars["entity"]){
		
		$guid = $vars["entity"]->guid;
		$search_rule = $vars["entity"]->search_rule;
		$search_type = $vars["entity"]->search_type;
	

		$searchable =$vars["entity"]->searchable;
		if (!$searchable)
		{
			$searchable = 'yes'; // init to yes
		}
	}


	
	$yes_no_options = array('yes' => elgg_echo('option:yes'),'no' => elgg_echo('option:no'));
	$no_yes_options = array_reverse($yes_no_options);

	
	
	$formbody .= elgg_echo('solrsearch:admin:search_rule') . ":" . elgg_view('input/text', array('name' => 'metadata_name', "value" => $search_rule));
	$formbody .= elgg_echo('solrsearch:admin:search_type') . ":" . elgg_view('input/text', array('name' => 'metadata_name', "value" => $search_type));
	
	
	if(array_key_exists("searchable", $option_classes)){
		$class = $option_classes['searchable'];
	} else {
		$class = "";
	}
	$formbody .= "<tr>";
	$formbody .= "<td>" . elgg_echo('solrsearch:admin:searchable') . ":</td>";

	$formbody .= "<td>" . elgg_view('input/dropdown', array('name' => 'searchable', 'options_values' => $yes_no_options, 'value'=> $searchable)) . "</td>";
	
	$formbody .= "<td>" . elgg_echo('solrsearch:admin:searchable:description') . "</td>";
	$formbody .= "</tr>";
	
	
	
	$formbody .= "</table></div></div>";
	
	$formbody .= elgg_view('input/hidden', array('name' => 'guid', "value" => $guid));
	$formbody .= elgg_view('input/submit', array('value' => elgg_echo('save')));
	
	$form = elgg_view('input/form', array('body' => $formbody, 'action' => $vars['url'] . 'action/solrsearch/new'));

?>
<div class="elgg-module elgg-module-inline" id="custom_fields_form">
	<div class="elgg-head">
		<h3>
			<?php echo $form_title; ?>
			<span class='custom_fields_more_info' id='more_info_profile_field'></span>
		</h3>
	</div>
	<div class="elgg-body">
		<?php echo $form; ?>
	</div>
</div>
