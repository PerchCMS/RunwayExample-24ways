<?php
	include(__DIR__.'/../../../../_inc/page_config.php');

	$page_vars['theme']      = 'about';
	$page_vars['section']    = 'about';
	$page_vars['page_title'] = 'The Book';

	PerchSystem::set_var('domain', $domain);

	perch_layout('2013/above', $page_vars);

	perch_content('About the book');

	perch_layout('2013/below', $page_vars);
