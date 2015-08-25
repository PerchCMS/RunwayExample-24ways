<?php 
	include(__DIR__.'/../../../_inc/page_config.php');

	PerchSystem::set_var('domain', $domain);

	$page_vars['year']        = $page_vars['home_year'];
	$page_vars['page_title']  = perch_content('Default title', true);
	$page_vars['page_desc']   = perch_content('Default desc', true);
	$page_vars['page_author'] = '@24ways';


	if (date('Y') == $page_vars['home_year']) {
		$max = 'Y-m-d';
	}else{
		$max = $page_vars['home_year'].'-12-24';
	}

	perch_layout('2013/above', $page_vars);

		PerchSystem::set_var('about', perch_content('About', true));

		perch_collection('Articles', [
			'template' => 'articles/home_listing.html',
			'filter'=> [
						[
							'filter' => 'date',
							'match'  => 'eqbetween',
							'value'  => date($page_vars['year'].'-11-01, '.$max)
						]
					],
			'sort'       => 'date',
			'sort-order' => 'DESC',
			'each'       => function($item) {
				$item['comment_count'] = (perch_comments_count(date('Yd', strtotime($item['date'])), true) ?: 'No' );
				return $item;
			}
		]); 

	perch_layout('2013/below', $page_vars);
