<?php 
	include(__DIR__.'/../../../_inc/page_config.php');

	$topic = perch_category('topics/'.perch_get('slug'), [
		'skip-template' => true,
	]);

	if (!$topic[0]) {
		PerchUtil::redirect('/topics/');
	}

	$page_vars['page_title'] = $topic[0]['catTitle'];
	$page_vars['theme'] = 'topic-'.$topic[0]['catSlug'];
	
	$page_vars['section']  = 'topics';

	// PREV TOPIC
	$prev_topic = perch_categories([
		'set'           => 'topics',
		'skip-template' => true,
		'filter'        => 'catOrder',
		'match'         => 'lt',
		'value'         => $topic[0]['catOrder'],
		'count'         => 1,
		'sort'          => 'catOrder',
		'sort-order'    => 'DESC',
	]); 
	if (PerchUtil::count($prev_topic)) {
		$page_vars['traverse']  = true;
		$page_vars['prev_url']  = '/topics/'.$prev_topic[0]['catSlug'].'/';
		$page_vars['prev_title']= $prev_topic[0]['catTitle'];
	}


	// NEXT TOPIC
	$next_topic = perch_categories([
		'set'           => 'topics',
		'skip-template' => true,
		'filter'        => 'catOrder',
		'match'         => 'gt',
		'value'         => $topic[0]['catOrder'],
		'count'         => 1,
		'sort'          => 'catOrder',
		'sort-order'    => 'ASC',
	]); 
	if (PerchUtil::count($next_topic)) {
		$page_vars['traverse']  = true;
		$page_vars['next_url']  = '/topics/'.$next_topic[0]['catSlug'].'/';
		$page_vars['next_title']= $next_topic[0]['catTitle'];
	}



	perch_layout('2013/above', $page_vars);

		PerchSystem::set_var('topic_name', $topic[0]['catTitle']);
		PerchSystem::set_var('topic_blurb', $topic[0]['blurb']);
		PerchSystem::set_var('unicode_char', $topic[0]['unicode_char']);
		PerchSystem::set_var('show_year', true);

		perch_collection('Articles', array(
			'category'   => $topic[0]['catPath'],
			'template'   => 'topics/article_listing.html',		
			'filter'     => 'date',
			'match'      => 'lte',
			'value'      => date('Y-m-d'),
			'sort'       => 'date',
			'sort-order' => 'DESC',
			'each'       => function($item){
				$item['comment_count'] = (perch_comments_count(date('Yd', strtotime($item['date'])), true) ?: 'No' );
				return $item;
			}
		)); 

	perch_layout('2013/below', $page_vars);
