<?php 
	include(__DIR__.'/../../../_inc/page_config.php');
	$page_vars['theme'] = '';
	$page_vars['section']  = 'topics';
	$page_vars['page_title'] = 'Topics';

	perch_layout('2013/above', $page_vars);
		
		perch_categories([
			'set'      => 'topics',
			'template' => 'topic_listing.html',
			'sort'     => 'catTitle',
		]);

	perch_layout('2013/below', $page_vars);