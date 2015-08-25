<?php 
	include(__DIR__.'/../../../_inc/page_config.php');

	header('Content-type: text/xml;');
	
	PerchSystem::set_var('domain', $domain);
	PerchSystem::set_var('today', date('Y-m-d H:i:s'));


	if (date('Y') == $page_vars['home_year']) {
		$max = 'Y-m-d';
	}else{
		$max = $page_vars['home_year'].'-12-24';
	}

	perch_collection('Articles', array(
		'template'=>'articles/rss.html',
		'filter'=> array(
					array(
						'filter' => 'date',
						'match'  => 'eqbetween',
						'value'  => date($page_vars['home_year'].'-11-01, '.$max),
					)
		),
		'sort'=>'date',
		'sort-order'=>'DESC'
	)); 

