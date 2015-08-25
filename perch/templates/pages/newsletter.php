<?php 
	include(__DIR__.'/../../../_inc/page_config.php');

	$page_vars['theme']      = 'about';
	$page_vars['section']    = 'about';
	$page_vars['page_title'] = 'Newsletter';


	PerchSystem::set_var('domain', $domain);

	perch_layout('2013/above', $page_vars);

	$null = perch_content('About the newsletter', true);
	
	PerchSystem::set_var('subscribe_form', perch_mailchimp_form('subscribe.html', [], true));

	perch_content_custom('About the newsletter', []);

	

	perch_layout('2013/below', $page_vars);
