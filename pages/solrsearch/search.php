<?php
	/**
         * Elgg SOLR plugin
         *
         * @author Daniel Scholz
         * @copyright ForbiddenRoses 2013
         * 
         * Search box on titlebar
         */


$query = stripslashes(get_input('q', get_input('tag', '')));

if ($query) {
        $display_query = preg_replace("/[^\x01-\x7F]/", "", $query);
        $display_query = htmlspecialchars($display_query, ENT_QUOTES, 'UTF-8', false);

        $title = sprintf(elgg_echo('search:results'), "\"$display_query\"");
        $vars = array('query' => $display_query);
        $body  = elgg_view('solrsearch/content_search', $vars);

        $params = array(
        'title' => $title,
        'content' => $body,
        'sidebar' => elgg_view('solrsearch/sidebar'),
        );

        $layout = elgg_view_layout('one_sidebar', $params);
        echo elgg_view_page($title, $layout);
}

return;



