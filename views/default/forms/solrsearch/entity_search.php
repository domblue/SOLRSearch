<?php

/**
 * Elgg SOLR plugin
 *
 * @author Daniel Scholz
 * @copyright ForbiddenRoses 2013
 *
 * Entity Search Form on Sidebar
 */

$vars['entities'] = get_input('entities');
$vars['searchon'] = get_input('searchon');
$vars['searchtype'] = get_input('searchtype');
$params = array(
	'name' => 'entities',
	'class' => 'mbm',
	'value'	=> $vars['entities']
);


echo elgg_view('input/text', $params);

$searchon_label = elgg_echo('solrsearch:searchon');
// echo "<a>$searchon_label</a>";
$searchon_input = elgg_view('input/dropdown', array(
// echo elgg_view('input/dropdown', array(
		'name' => 'searchon',
		'id' => 'solrsearch_searchon',
		'value' => $vars['searchon'],
		'options_values' => array(
				'all' => elgg_echo('solr:searchon:all'),
				'title' => elgg_echo('solr:searchon:title'),
				'desc' => elgg_echo('solr:searchon:desc')
		)
));
?>
<div>
<label>
<?php echo $searchon_label; ?><br />
		<?php echo $searchon_input;
		?>
	</label>
</div>
<?php



$searchtype_label = elgg_echo('solrsearch:searchtype');
// echo "<a>$searchtype_label</a>";
$searchtype_input = elgg_view('input/dropdown', array(
// echo elgg_view('input/dropdown', array(
		'name' => 'searchtype',
		'id' => 'solrsearch_searchtype',
		'value' => $vars['searchtype'],
		'options_values' => array(
				'all' => elgg_echo('solrsearch:searchtype:all'),
				'blog' => elgg_echo('solrsearch:searchtype:blogs'),
				'bookmarks' => elgg_echo('solrsearch:searchtype:bookmarks'),
				'groupforumtopic' => elgg_echo('solrsearch:searchtype:groupforumtopic'),
				'file' => elgg_echo('solrsearch:searchtype:file'),
				'thewire' => elgg_echo('solrsearch:searchtype:thewire'),
		)
));

?>
<div>
<label>
<?php echo $searchtype_label; ?><br />
		<?php echo $searchtype_input;
		?>
	</label>
</div>
<?php


echo elgg_view('input/submit', array('value' => elgg_echo('search')));
