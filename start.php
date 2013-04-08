<?php

	/**
	 * Elgg solr plugin
	 *
	 * @author Daniel Scholz
	 * @copyright Forbiddenroses 2013
	 */

	 elgg_register_event_handler('init','system','solr_init');

	 function solr_init() {

//		elgg_register_page_handler('solr', 'solr_page_handler');
		elgg_register_page_handler('solrsearch', 'solr_page_handler');
		elgg_register_admin_menu_item('administer', 'solr_export', 'administer_utilities');
		
		elgg_extend_view("css/admin", "solrsearch/css/admin");
		elgg_extend_view("js/admin", "solrsearch/js/admin");

		
		//Replace default search box for topbar
		elgg_unextend_view('page/elements/header', 'search/header');
	    elgg_extend_view('page/elements/header', 'search/header');
// Ensure Profile Manager gets the view by default
	    elgg_set_view_location('object/custom_profile_field', elgg_get_plugins_path() . 'profile_manager/views/', 'default');
	    elgg_set_view_location('object/custom_group_field', elgg_get_plugins_path() . 'profile_manager/views/', 'default');



	}

function solr_page_handler($page) { 
	elgg_set_context('solr');

    $base = elgg_get_plugins_path() . 'solrsearch/pages/solrsearch';
if (count($page) < 1)
{
	include $base . '/search.php';
	
}
else 
{

	switch ($page[0]) {
		case 'solrsearch' :
			solr_search_page();
			break;
			case "forms":
				$form = $page[1];
				if(!empty($form) && elgg_is_admin_logged_in()){
					set_input("guid", $page[2]);
					include(dirname(__FILE__) . "/pages/forms/" . $form . ".php");
					return true;
				}
				break;
		
               default:
                   include $base . '/search.php';
               break;
               }
               exit;
}
	}
function solr_search_page() {
		// elgg_push_breadcrumb(elgg_echo('search'));
	
	$entities = get_input('entities');
	$searchon = get_input('searchon');
	$searchtype = get_input('searchtype');	

	if(!$entities || !$searchon || !$searchtype)
		return;

	
	$queryStr = '';
	$query = stripslashes(get_input('entities'));
//	@todo:check whether solarium is doing all the nasty input checking 

	switch ($searchon) {
		case 'all':
			{
			break;	
			}
		case 'title':
			{
			$queryStr .= 'title:';	
			break;
			}
		case 'desc':
			{
			$queryStr .= 'description:';
			break;
			}
				
		default:
			break;
	}

	$queryStr .= '(' . $query . ')';	
	if ($searchtype != 'all')
	{
		$queryStr .= ' AND subtype:' . $searchtype;
	}
	$title = sprintf(elgg_echo('search:results'), "\"$queryStr\"");
	$vars = array('query' => $queryStr);
	$body  = elgg_view('solrsearch/content_search', $vars);

	$params = array(
		'title' => $title,
		'content' => $body,
		'sidebar' => elgg_view('solrsearch/sidebar'),
		);

	$layout = elgg_view_layout('one_sidebar', $params);
	echo elgg_view_page($title, $layout);

	
	

}
/**
 * Function to add menu items to the pages
 *
 * @return unknown_type
 */
function solrsearch_pagesetup(){
	if(elgg_in_context("admin") && elgg_is_admin_logged_in()){
		elgg_load_js('lightbox');
		elgg_load_css('lightbox');
			
			
		if(elgg_is_active_plugin("groups")){
			elgg_register_admin_menu_item('configure', 'solr_group_fields', 'appearance');
		}
		elgg_register_admin_menu_item('configure', 'solr_profile_fields', 'appearance');
			

		
	}
}

// Initialization functions
elgg_register_action("solrsearch/edit", dirname(__FILE__) . "/actions/edit.php", "admin");

elgg_register_event_handler('pagesetup', 'system', 'solrsearch_pagesetup');
elgg_register_action("solrsearch/toggleOption", dirname(__FILE__) . "/actions/toggleOption.php", "admin");
?>
