<?php
	/*
		Article page.

		TODO: Refactor! This is messy, and brings a lot of debt from previous site builds. 

	*/


	include(__DIR__.'/../../../_inc/page_config.php');

	$year 	 = $page_vars['year'];

	$year = (int) perch_get('year');
	if ($year<2005 || $year>date('Y')) {
		PerchUtil::redirect('/');
	}

	if ($year<date('Y')) {
		$page_vars['max_day'] = 25;
	}else{
		$page_vars['max_day'] = date('d');
	}

	$page_vars['theme'] = 'year-'.$year;

	PerchSystem::set_var('domain', $domain);
	PerchSystem::set_var('year', $year);

	$articles = perch_collection('Articles', [
		'template'=>'articles/article.html',
		'filter'=> [
				[
					'filter'=>'slug',
					'value'=>perch_get('slug')
				],
				[
					'filter'=>'date',
					'match'=>'lte',
					'value'=>date('Y-m-d')
				]
		],
		'skip-template'=>true,
		'return-html'=>true
	]);

	if (PerchUtil::count($articles) && isset($articles[0])) {
		$article      = $articles[0];
		$current_day  = date('j', strtotime($article['date']));
		$page_title   = $article['title'];
		$article_html = $articles['html'];
	}else{
		$article_html = '';
		PerchUtil::redirect('/'.$year.'/');
	}

	$page_vars['current_day'] 	= $current_day;
	$page_vars['page_title'] 	= $page_title;

	// Author
	$authors = perch_collection('Authors', [
		'filter' => '_id',
		'value' => $article['author'][0],
		'skip-template' => true,
	]);

	if (PerchUtil::count($authors)) {
		$author = $authors[0];
		if (isset($author['twitter'])) {
			$page_vars['page_author']  = '@'.$author['twitter'];
			$page_vars['page_image']  = '//cloud.24ways.org/authors/'.$author['slug'].'160.jpg';
		}

	}

	$page_vars['page_desc']  = strip_tags($article['excerpt']);


	// PREV / NEXT

	$page_vars['section']  = 'article';

		// PREV
		$prev = perch_collection('Articles', array(
				'filter'        => 'date',
				'match'         => 'lt',
				'value'         => $article['date'],
				'count'         => 1,
				'sort'          => 'date',
				'sort-order'    => 'DESC',
				'skip-template' => true,
			));
		if (PerchUtil::count($prev)) {
			$page_vars['traverse']  = true;
			$page_vars['prev_url']  = '/'.date('Y', strtotime($prev[0]['date'])).'/'.$prev[0]['slug'].'/';
			$page_vars['prev_title']= $prev[0]['title'];
		}

		// NEXT
		$next = perch_collection('Articles', array(
				'filter'=>'date',
				'match'=>'between',
				'value'=>$article['date'].','.date('Y-m-d 23:59:59'),
				'count'=>1,
				'sort'=>'date',
				'sort-order'=>'ASC',
				'skip-template'=>true,
			));
		if (PerchUtil::count($next)) {
			$page_vars['traverse']  = true;
			$page_vars['next_url']  = '/'.date('Y', strtotime($next[0]['date'])).'/'.$next[0]['slug'].'/';
			$page_vars['next_title']= $next[0]['title'];
		}



	perch_layout('2013/above', $page_vars);

	// comments
 	if ($article_html) {
 		$comment_count = (int)perch_comments_count(date('Yd', strtotime($articles[0]['date'])), true);
 		$comment_word = 'comments';
 		if ($comment_count > 0) {
 			if ($comment_count==1) {
 				$comment_message = sprintf('View %s reader comment', $comment_count);
 				$comment_word = 'comment';
 			}else{
 				$comment_message = sprintf('View %s reader comments', $comment_count);
 			}
 		}else{
 			$comment_message = sprintf('No comments yet - leave yours', $comment_count);
 		}

	 	$article_html = str_replace('<!-- replaced with comment count -->', ($comment_count ?: 'No'), $article_html);
	 	$article_html = str_replace('<!-- replaced with comment message -->', $comment_message, $article_html);
	 	$article_html = str_replace('<!-- replaced with comment word -->', $comment_word, $article_html);
	}

	// Related
 	if ($article_html && isset($articles[0]['category'])) {

 		PerchSystem::set_var('show_year', true);
 		$related = perch_collection('Articles', array(
			'template' => 'articles/related.html',
			'count'    => 6,
			'filter'   => array(
				array(
						'filter'=>'category',
						'value'=>$articles[0]['category']
					),
				array(
						'filter'=>'date',
						'match'=>'lte',
						'value'=>date('Y-m-d')
					),
				array(
						'filter'=>'slug',
						'match'=>'neq',
						'value'=>$articles[0]['slug']
					)
			),
			'each'=>function($item){
				$item['comment_count'] = (perch_comments_count(date('Yd', strtotime($item['date'])), true) ?: 'No' );
				return $item;
			}
		), true);
		$article_html = str_replace('<!-- replaced with related articles -->', $related, $article_html);
 	}

	echo $article_html;


	perch_layout('2013/below', $page_vars);