<!DOCTYPE html>
<html lang="en-gb">
<head>
    <meta charset="utf-8" />
    <link rel="dns-prefetch" href="//fonts.googleapis.com" />
    <link rel="dns-prefetch" href="//themes.googleusercontent.com" />
    <link rel="dns-prefetch" href="//www.google-analytics.com" />
    <link rel="dns-prefetch" href="//cloud.24ways.org" />
    <link rel="dns-prefetch" href="//media.24ways.org" />
    <script>
        // Cut the mustard
        var enhanced=false, ddecn='';
        if (document.querySelector && window.addEventListener){ddecn+=' js-enhanced'; enhanced=true;}
        // Detect support for SVG
        if(document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure", "1.1")){ddecn+=' svg';}
        document.documentElement.className += ddecn;
    </script>
<!--[if lt IE 9]>
    <script src="<?php echo ASSET_PATH; ?>/js/html5shiv.min.js"></script>
<![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo ASSET_PATH; ?>/css/styles_v<?php perch_layout_var('asset_version'); ?>.css" />
    <link rel="alternate" type="application/rss+xml" href="http://feeds.feedburner.com/24ways" />
    <link rel="icon" href="<?php echo ASSET_PATH; ?>/icons/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon-precomposed" href="<?php echo ASSET_PATH; ?>/icons/apple-touch-icon.png" />
    <link rel="author" href="/humans.txt" />
    <?php PerchUtil::flush_output(); ?>
    <meta name="robots" content="index, follow" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="application-name" content="24 ways" />
    <meta name="apple-mobile-web-app-title" content="24 ways" />
    <meta name="twitter:site" content="@24ways" />
    <meta name="twitter:title" content="<?php echo PerchUtil::html(perch_layout_var('page_title', true), true); ?>" />
    <meta name="twitter:description" content="<?php echo PerchUtil::html(perch_layout_var('page_desc', true), true); ?>" />
    <meta name="twitter:creator" content="<?php echo PerchUtil::html(perch_layout_var('page_author', true), true); ?>" />
    <meta name="twitter:image" content="<?php echo PerchUtil::html(perch_layout_var('page_image', true), true); ?>" />
    <meta name="twitter:card" content="summary" />

    <title><?php perch_layout_var('page_title'); ?> &#9670; 24 ways</title>
</head>

<body class="<?php perch_layout_var('theme'); ?>">
<?php
    perch_layout('2013/banner');
    perch_layout('2013/menu');
