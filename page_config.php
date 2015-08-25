<?php

	header('Content-Type: text/html; charset=utf-8');

	/* Configuration vars for the page, passed through to the layout. */
	$page_vars = array();

	$page_vars['asset_version'] = 35;


	#include('css.php');
	#include('javascript.php');



	/* The current year */
	$page_vars['year'] = (int) date('Y');

	$page_vars['first_year'] = (int) 2005;



	/* The year for the home page (and rss) */
	if (time()>=strtotime('2014-11-01 00:00:00')) {
		$page_vars['home_year'] = 2014;
	}else{
		$page_vars['home_year'] = 2013;
	}

	if ($page_vars['year'] > $page_vars['home_year']) $page_vars['year'] = $page_vars['home_year'];


	$page_vars['theme'] = 'year-2014';
	$page_vars['section'] = 'home';



	/* Title of the page */
	$page_vars['page_title']    = perch_pages_title(true);

	/* Current day (during advent) and maximum day to show as active */
	$page_vars['current_day']   = false;

	if ($page_vars['year']<date('Y')) {
		$page_vars['max_day'] = 25;
	}else{
		$page_vars['max_day'] = date('d');
	}

	PerchSystem::set_var('asset_path', ASSET_PATH);