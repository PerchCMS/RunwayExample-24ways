<?php 
	include(__DIR__.'/../../../_inc/page_config.php');

	$page_vars['page_title'] = 'Authors';
	$page_vars['theme'] = '';
	$page_vars['section']  = 'authors';

	PerchSystem::set_var('domain', $domain);

	perch_layout('2013/above', $page_vars);

		perch_collection('Authors', array(
			'template' => 'authors/author_listing.html',
			'sort'     => 'lastname',
			'filter'   => 'active',
			'match'    => 'lte',
			'value'    => date('Y-m-d'),
		)); 

	perch_layout('2013/below', $page_vars);
