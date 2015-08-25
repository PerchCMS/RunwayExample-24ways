<?php 
	include(__DIR__.'/../../../_inc/page_config.php');

	$year = perch_get('year');
	$day  = perch_get('day');

	$date = $year.'-12-'.$day;

	if (strtotime($date.' 00:00:00') > time()) {
		PerchUtil::redirect('/'.$year.'/');
	} 


	$article = perch_collection('Articles', array(
				'skip-template'=>true,
				'page'=>'/'.$year,
				'filter'=>'date',
				'match'=>'eq',
				'value'=>$date
			), true);

	if (is_array($article) && isset($article[0]['slug'])) {
		PerchUtil::redirect('/'.$year.'/'.$article[0]['slug'].'/');
	}
