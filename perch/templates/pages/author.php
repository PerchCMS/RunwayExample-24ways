<?php 
	include(__DIR__.'/../../../_inc/page_config.php');

	$page_vars['page_title'] = 'Archives';
	$page_vars['theme'] = '';
	$page_vars['section']  = 'authors';

	PerchSystem::set_var('domain', $domain);


	$author = perch_collection('Authors', array(
		'template'      => 'authors/author.html',
		'skip-template' => true,
		'return-html'   => true,
		'filter'        => array(
					array(
						'filter'=>'slug',
						'value'=>perch_get('slug')
					),
					array(
						'filter'=>'active',
						'match'=>'lte',
						'value'=>date('Y-m-d')
						)
					),
	)); 

	if (!isset($author[0])) PerchUtil::redirect('/authors/');

	$page_vars['section']  = 'authors';

	// PREV AUTHOR
	$prev_author = perch_collection('Authors', array(
		'template'=>'authors/author.html',
		'page'=>'/authors',
		'skip-template'=>true,
		'filter'=> array(
					array(
						'filter'=>'_order',
						'match'=>'lt',
						'value'=>$author[0]['_sortvalue']
					),
					array(
						'filter'=>'active',
						'match'=>'lte',
						'value'=>date('Y-m-d')
						)
					),
		'count'=>1,
		'sort'=>'_order',
		'sort-order'=>'DESC',
	)); 
	if (PerchUtil::count($prev_author)) {
		$page_vars['traverse']  = true;
		$page_vars['prev_url']  = '/authors/'.$prev_author[0]['slug'].'/';
		$page_vars['prev_title']= $prev_author[0]['firstname'].' '.$prev_author[0]['lastname'];
	}


	// NEXT AUTHOR
	$next_author = perch_collection('Authors', array(
		'template'=>'authors/author.html',
		'page'=>'/authors',
		'skip-template'=>true,
		'filter'=> array(
					array(
						'filter'=>'_order',
						'match'=>'gt',
						'value'=>$author[0]['_sortvalue']
					),
					array(
						'filter'=>'active',
						'match'=>'lte',
						'value'=>date('Y-m-d')
						)
					),
		'count'=>1,
		'sort'=>'_order',
		'sort-order'=>'ASC',
	)); 
	if (PerchUtil::count($next_author)) {
		$page_vars['traverse']  = true;
		$page_vars['next_url']  = '/authors/'.$next_author[0]['slug'].'/';
		$page_vars['next_title']= $next_author[0]['firstname'].' '.$next_author[0]['lastname'];
	}


	$page_vars['page_title'] = $author[0]['firstname'].' '.$author[0]['lastname'];

	perch_layout('2013/above', $page_vars);


		PerchSystem::set_var('author_bio', $author['html']);
		PerchSystem::set_var('show_year', true);

		perch_collection('Articles', array(
			'template'=>'articles/author_listing.html',
			'filter'=> array(
				array(
					'filter'=>'author.slug',
					'value'=>perch_get('slug')
				),
				array(
					'filter'=>'date',
					'match'=>'lte',
					'value'=>date('Y-m-d')
				)
			),
			'sort'=>'date',
			'sort-order'=>'DESC',
			'each'=>function($item){
				$item['comment_count'] = (perch_comments_count(date('Yd', strtotime($item['date'])), true) ?: 'No' );
				return $item;
			}
		));

	perch_layout('2013/below', $page_vars);
