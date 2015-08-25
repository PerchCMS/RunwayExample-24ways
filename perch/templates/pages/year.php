<?php 
	include(__DIR__.'/../../../_inc/page_config.php');

	$year = (int) perch_get('year');
	if ($year<2005 || $year>date('Y')) {
		PerchUtil::redirect('/');
	}

	$page_vars['page_title'] = $year;
	$page_vars['theme']      = 'year-'.$year;

	PerchSystem::set_var('domain', $domain);
	PerchSystem::set_var('year', $year);

	$page_vars['page_title']  = 'Articles from advent '.$year;
	$page_vars['page_desc']   = perch_content('Default desc', true);
	$page_vars['page_author'] = '@24ways';

	$page_vars['section']  = 'archives';

	if ($year<=$page_vars['home_year'] && $year>2005) {
		$page_vars['traverse']   = true;
		$page_vars['prev_url']   = '/'.($year-1).'/';
		$page_vars['prev_title'] = ($year-1);
	}

	if ($year<$page_vars['home_year']) {
		$page_vars['traverse']   = true;
		$page_vars['next_url']   = '/'.($year+1).'/';
		$page_vars['next_title'] = ($year+1);
	}

	if ($year == $page_vars['home_year']) {
		$max = 'Y-m-d';
	}else{
		$max = $year.'-12-24';
	}

	$null = perch_content('Intros', true);


	perch_layout('2013/above', $page_vars);

		PerchSystem::set_var('intro', perch_content_custom('Intros', [
				'filter' => 'year',
				'value'  => $year,
			], true));

		perch_collection('Articles', [
			'template' => 'articles/article_listing.html',
			'filter'   => [
							[
							'filter' => 'date',
							'match'  => 'eqbetween',
							'value'  => date("$year-11-01, $max")
							],
			],
			'sort'       => 'date',
			'sort-order' => 'DESC',
			
			'each'       => function($item){
				$item['comment_count'] = (perch_comments_count(date('Yd', strtotime($item['date'])), true) ?: 'No' );
				return $item;
			}
			
		]); 

	perch_layout('2013/below', $page_vars);
