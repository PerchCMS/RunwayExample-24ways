<?php 
	include(__DIR__.'/../../../_inc/page_config.php');

	$ajax = (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest');

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

	PerchSystem::set_page('/'.$year);
	PerchSystem::set_var('domain', $domain);
	PerchSystem::set_var('year', $year);

	$articles = perch_collection('Articles', array(
		'template'=>'articles/comments_wrapper.html',
		'filter'=> array(
			array(
					'filter'=>'slug',
					'value'=>perch_get('slug')
				),
			array(
					'filter'=>'date',
					'match'=>'lte',
					'value'=>date('Y-m-d')
				)
		),
		'skip-template'=>true,
		'return-html'=>true
	));

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
	$page_vars['page_title'] 	= 'Comments on '.$page_title;



	/* TODO 
	$page_vars['page_desc']  = perch_content('Default desc', true);
	$page_vars['page_author']  = '@24ways';
	*/

	if (!$ajax) perch_layout('2013/above', $page_vars);

	// comments
 	if ($article_html) {
	 	$comments = perch_comments(date('Yd', strtotime($articles[0]['date'])), array(
	 			'sort'=>'commentScore',
	 			'sort-order'=>'DESC'
	 		), true); 
	 	$comments = str_replace('<!-- replaced with comment count -->', (perch_comments_count(date('Yd', strtotime($articles[0]['date'])), true) ?: 'No'), $comments);
	 	$comments = str_replace('___URL___', '/'.perch_get('year').'/'.perch_get('slug').'/comments/', $comments);

	 	$article_html = str_replace('<!-- replaced with comments listing -->', $comments, $article_html);

	 	$form = perch_comments_form(date('Yd', strtotime($articles[0]['date'])), $articles[0]['title'], false, true);
	 	$form = str_replace('___URL___', '/'.perch_get('year').'/'.perch_get('slug').'/comments/', $form);
	 	$article_html = str_replace('<!-- replaced with comments form -->', $form, $article_html);

	 	
	 	
	}

	if ($ajax) {
		echo $comments;
		echo $form;
	}else{
		echo $article_html;
	}
	

	


	if (!$ajax) perch_layout('2013/below', $page_vars);
