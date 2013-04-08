<?php 
	/**
	* Profile Manager
	* 
	* Group Fields add form
	* 
	* @package profile_manager
	* @author ColdTrick IT Solutions
	* @copyright Coldtrick IT Solutions 2009
	* @link http://www.coldtrick.com/
	*/

	$form_title = elgg_echo('profile_manager:group_fields:add');
	
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
		</h3>
	</div>
	<div class="elgg-body">
		<?php echo $form; ?>
	</div>
</div>