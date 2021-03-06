<?php
	/**
	* Profile Manager
	* 
	* JS (admin pages only, so no extend)
	*
	* 
	* @package solrsearch
	* @author Daniel Scholz
	* @copyright ForbiddenRoses
	* @link
	*/

?>
//<script>
$(document).ready(function(){
	filterCustomFields(0);
	$('#custom_fields_ordering').sortable({
  		update: function(event, ui) { 
   			reorderCustomFields();			   		
   		},
   		opacity: 0.6,
   		tolerance: 'pointer',
   		items: 'li'
	});

	$('#custom_fields_category_list_custom .elgg-list').sortable({
		update: function(event, ui) { 
   			reorderCategories();			   		
   		},
		opacity: 0.6,
		tolerance: 'pointer',
		items: 'li',
		handle: '.elgg-icon-drag-arrow'
	});

	$('#custom_profile_field_category_0, #custom_fields_category_list_custom .elgg-item').droppable({
		accept: "#custom_fields_ordering .elgg-item",
		hoverClass: 'droppable-hover',
		tolerance: 'pointer',
		drop: function(event, ui) {
			var dropped_on = $(this).attr("id");  
			var dragged_field = $(ui.draggable);
			changeFieldCategory(dragged_field, dropped_on); 
		}
	});

	$(".elgg-icon-profile-manager-user-summary-config-add").live("click", function(){
		$("#profile-manager-user-summary-config-options").clone().insertBefore($(this)).removeAttr("id").attr("name", $(this).parent().attr("rel") + "[]");
	});

	$(".profile-manager-user-summary-config-options-delete").live("click", function(){
		$(this).parent().remove();
	});

	// add buttons
	$(".solr-search-popup").fancybox();
});

function solr_toggleOption(field, guid){
	$.post(elgg.security.addToken('<?php echo $vars['url']; ?>action/solrsearch/toggleOption?&guid=' + guid + '&field=' + field), function(data){
		if(data == 'true'){
			$("#" + field + "_" + guid).toggleClass("field_config_metadata_option_disabled field_config_metadata_option_enabled");
		} else {
			alert(elgg.echo("solrsearch:actions:toggle_option:error:unknown"));
		}
	});
}

function reorderCustomFields(){
	var strArray = $('#custom_fields_ordering').sortable('serialize');
	$.post(elgg.security.addToken('<?php echo $vars['url'];?>action/profile_manager/reorder?'), strArray);
}

function reorderCategories(){
	var strArray = $('#custom_fields_category_list_custom .elgg-list').sortable('serialize');
	$.post(elgg.security.addToken('<?php echo $vars['url'];?>action/profile_manager/categories/reorder?'), strArray);
}

function filterCustomFields(category_guid){
	$("#custom_fields_ordering .elgg-item").hide();
	$("#custom_fields_category_list_custom .custom_fields_category_selected").removeClass("custom_fields_category_selected");
	if(category_guid === 0){
		// show default
		$("#custom_fields_ordering .custom_field[rel='']").parent().show();
		$("#custom_profile_field_category_0").addClass("custom_fields_category_selected");
	} else {
		if(category_guid === undefined){
			// show all
			$("#custom_fields_ordering .custom_field").parent().show();
			$("#custom_profile_field_category_all").addClass("custom_fields_category_selected");
		} else {
			//show selected category
			$("#custom_fields_ordering .custom_field[rel='" + category_guid + "']").parent().show();
			$("#custom_profile_field_category_" + category_guid).parent().addClass("custom_fields_category_selected");
		}
	}		
}

function changeFieldType(){
	var selectedType = $("#custom_fields_form select[name='metadata_type']").val();
	
	$("#custom_fields_form .custom_fields_form_field_option").attr("disabled", "disabled");
	$("#custom_fields_form .field_option_enable_" + selectedType).removeAttr("disabled");
}

