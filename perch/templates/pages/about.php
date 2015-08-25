<?php 
	include(__DIR__.'/../../../_inc/page_config.php');

	$page_vars['theme']      = 'about';
	$page_vars['section']    = 'about';
	$page_vars['page_title'] = 'About';

	PerchSystem::set_var('domain', $domain);

	perch_layout('2013/above', $page_vars);

	perch_content('About 24 ways');

	perch_layout('2013/below', $page_vars);
