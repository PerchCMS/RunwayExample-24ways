<?php 
	include(__DIR__.'/../../../_inc/page_config.php');

	$page_vars['page_title'] = 'Archives';
	$page_vars['theme'] = '';
	$page_vars['section']  = 'archives';

	PerchSystem::set_var('domain', $domain);

	$page_vars['page_title'] = perch_content('Default title', true);
	$page_vars['page_desc']  = '';
	$page_vars['page_author']  = '@24ways';

	perch_layout('2013/above', $page_vars);

		perch_content_custom('Intros', array(
			'template'=>'archive_years.html',
			'page'=>'/year',
			'sort'=>'year',
			'sort-order'=>'DESC'
		)); 

	perch_layout('2013/below', $page_vars);
