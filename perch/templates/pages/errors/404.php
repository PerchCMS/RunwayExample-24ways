<?php 
	include(__DIR__.'/../../../../_inc/page_config.php');

	$page_vars['theme'] = 'about';
	$page_vars['section'] = 'about';
	$page_vars['page_title'] = 'Not found';

	PerchSystem::set_page('/404');
	PerchSystem::set_var('domain', $domain);


	header("HTTP/1.0 404 Not Found");

	perch_layout('2013/above', $page_vars);
?>
	<main class="main" role="main">
		<article>
			<header class="preface">
				<h1 class="preface_title">404</h1>
			</header><!--/.preface-->

			<section class="section" id="sectionname">
				<header class="section_header">
					<h1 class="section_title">Page not found</h1>
				</header>
				<div class="section_main">
					<p class="lede">Sorry, but we can&#8217;t find that page.</p>
					<p>The page you requested wasn&#8217;t found in the location specified. You may have an incorrect <abbr title="Uniform Resouce Locator">URL</abbr>, or the file could have been moved or renamed.</p>
					<p>If you&#8217;re having problems finding a particular page, try searching the site or return to the homepage.</p>
				</div>
			</section><!--/.section-->

			<form id="comment" method="get" action="/search/">
				<fieldset class="section">
					<legend class="section_header">
						<span class="section_title">Search 24 ways</span>
					</legend>
					<div class="section_main">
						<p class="field field-search">
							<label class="field_label label" for="q">Search</label>
							<input class="field_input input" type="search" name="q" placeholder="e.g. CSS, Design, Research&#8230;"/>
							<input class="field_button button" type="submit" value="Search"/>
						</p>
					</div>
				</fieldset><!--/.section-->
			</form>
		</article><!--/.article-->
	</main><!--/@main-->

<?php
	perch_layout('2013/below', $page_vars);