<?php 
	include(__DIR__.'/../../../_inc/page_config.php');
	
	$page_vars['body_class'] = 'archives';
	$page_vars['page_title'] = 'Search';

	PerchSystem::set_var('domain', $domain);

	perch_layout('2013/above', $page_vars);

		perch_content_search(perch_get('q'), array(
			'template' => 'article_listing.html',
			'paginate' => true,
			'count'    => 24,
		)); 

		//perch_content('About');

	perch_layout('2013/below', $page_vars);
