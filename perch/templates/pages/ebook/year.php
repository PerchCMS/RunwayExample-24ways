<?php
	/*
		eBook template used for generating MOBI and ePub files.
	*/


	$year   = PerchUtil::html(perch_get('year'));
	$format = perch_get('format', 'pdf');

?><!DOCTYPE html>
<html dir="ltr" lang="en-US">
	<head>
	<meta charset="utf-8" />
	<title><?php echo $year; ?></title>
	<meta name="author" content="24ways.org"/>
	<meta name="subject" content="The <?php echo $year; ?> season of content from 24 ways"/>
	<meta name="keywords" content="web design, web development"/>
	<meta name="description" content="24 ways is the advent calendar for web geeks. For twenty-four days each December we publish a daily dose of web design and development goodness to bring you all a little Christmas cheer."/>
	<meta name="date" content="<?php echo date('Y-m-d'); ?>"/>
	</head>
	<body>
		<?php if ($format=='pdf') { ?>
		<div class="frontcover">
			<div class="pubyear"><?php echo $year; ?></div>
			<img src="../covers/pdfcover<?php echo $year; ?>.png" />
		</div>
		<?php } ?>

		<div class="credits">
			<h1>Credits</h1>

			<p class="lede">24 ways is the advent calendar for web geeks. For twenty-four days each December we publish a daily dose of web design and development goodness to bring you all a little Christmas cheer.</p>
			<ul>
				<li><em>24 ways</em> is brought to you by <a href="http://grabaperch.com/?ref=24w01">Perch <span class="caps">CMS</span></a></li>
				<li>Produced by <a href="http://allinthehead.com/">Drew McLellan</a>, <a href="http://suda.co.uk/">Brian Suda</a>, <a href="http://maban.co.uk/">Anna Debenham</a> and <a href="http://fullcreammilk.co.uk/">Owen Gregory</a>.</li>
				<li>Designed by <a href="http://paulrobertlloyd.com/">Paul Robert Lloyd</a>.</li>
				<li>eBook published by <a href="http://edgeofmyseat.com">edgeofmyseat.com</a> and produced by <a href="http://rachelandrew.co.uk/">Rachel Andrew</a>.</li>
				<li>Possible only with the help and dedication of <a href="http://24ways.org/authors/">our authors</a>.</li>
			</ul>
		</div>

		<div class="contents">
			<h1><?php echo $year; ?></h1>

			<div class="intro">
				<?php
					perch_content_custom('Intros', [
									'page' => '/year',
									'filter' => 'year',
									'value'  => $year,
								]);
				?>
			</div>

			<?php
				if ($format=='pdf') {
					perch_collection('Articles', [
						'template' => 'articles/ebook_toc_link.html',
						'filter'   => [
										[
										'filter' => 'date',
										'match'  => 'eqbetween',
										'value'  => date("$year-11-01, $year-12-31")
										],
						],
						'sort'       => 'date',
						'sort-order' => 'ASC',
					]);
				}
			?>
		</div>


		<?php
			perch_collection('Articles', [
				'template' => 'articles/ebook_item.html',
				'filter'   => [
								[
								'filter' => 'date',
								'match'  => 'eqbetween',
								'value'  => date("$year-11-01, $year-12-31")
								],
				],
				'sort'       => 'date',
				'sort-order' => 'ASC',

				'each'       => function($item){

					return $item;
				}

			]);
		?>


	</body>
</html>