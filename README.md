# RunwayExample-24ways

These are the Perch Runway templates for 24ways.org, as it stood summer 2015.

Each reqest gets routed to a file in the `templates/pages` folder.

This was a site that started out on Perch before being ported to Perch Runway. As such there are plenty of improvements to make to make full use of the functionality. It's not the cleanest of structures, and could benefit from going back over to refactor before the 2015 advent run.

## About the structure

24 ways is very much based around date filtering. It has states of the current year (controlling things like the home page view) and the current day (which dictates which articles to reveal). To facilitate this, a bunch of standard data for the page is set up in `page_config.php`, which is simply included in each page. It sets up the `$page_vars` array you see - this isn't part of the CMS, it's part of how things are strung together for this one site. 

- [Home page](https://github.com/PerchCMS/RunwayExample-24ways/blob/master/perch/templates/pages/home.php)
- [Article page](https://github.com/PerchCMS/RunwayExample-24ways/blob/master/perch/templates/pages/article.php)