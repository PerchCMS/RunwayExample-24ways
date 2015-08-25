<?php 
	include(__DIR__.'/../../../_inc/page_config.php');
	
	$page_vars['theme'] 	= 'year';

	$page_vars['page_title'] = 'Vote on a comment';

	$type = perch_get('type');

	if ($type!='up') $type='down'; // normalise.

	$commentID = perch_get('commentID');

	PerchSystem::set_page('/comments/vote');
	PerchSystem::set_var('domain', $domain);
	PerchSystem::set_var('year', $page_vars['year']);

	perch_layout('2013/above', $page_vars);

		PerchSystem::set_var('votetype', $type);
		PerchSystem::set_var('commentID', $commentID);
		perch_comment($commentID, array('template'=>'vote_preview.html'));


	perch_layout('2013/below', $page_vars);
