<?php

	/**
	 * Elgg solr plugin
	 *
	 * @author Daniel Scholz
	 * @copyright Forbiddenroses 2013
	 */

	 elgg_register_event_handler('init','system','solr_init');

	 function solr_init() {

		elgg_register_page_handler('solr', 'solr_page_handler');

		
		//Replace default search box for topbar
		elgg_unextend_view('page/elements/header', 'search/header');
	    elgg_extend_view('page/elements/header', 'search/header');




	}

function solr_page_handler($page) { 
	elgg_set_context('solr');

    $base = elgg_get_plugins_path() . 'SOLRSearch/pages/solr';

	switch ($page[0]) {
		case 'search' :
			solr_search_page();
			break;
		
               default:
                   include $base . '/search.php';
               break;
               }
               exit;
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
	$body  = elgg_view('solr/solr', $vars);

	$params = array(
		'title' => $title,
		'content' => $body,
		'sidebar' => elgg_view('solr/sidebar'),
		);

	$layout = elgg_view_layout('one_sidebar', $params);
	echo elgg_view_page($title, $layout);

	
	

}
?>
