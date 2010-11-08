<?php require_once("data/setting.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html>
<head>
<title><?php show_content_area('WebSite Name'); ?> &raquo; <?php show_title(); ?></title>
<meta name="description" content="nanoCMS Community Build" />
<meta name="keywords" content="nanocms, cms, flat, file, open, source, php, " />
<meta name="author" content="Andrew Emmett" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<style type="text/css">
a {
text-decoration:none;
}
</style>
</head>
<body>
<div id="wrapper">
<div id="head1">
<div id="title1"><?php show_content_area('WebSite Name'); ?></div>
<div id="title2"><?php show_content_area('WebSite slogan'); ?></div>
</div>
<div id="picture1"><img src="pic1.jpg" alt="header graphic"></div>
<div id="topnav">
	  <?php 
	  	//show_content_area('Top Navigation');
		//show_links( link_place, format[ nolist->with out <li> or default <li>%s</li>, before, after )
		show_links('top-navigation','nolist');
	  ?>
</div>
<div id="main">
<div id="left"><div id="leftnav">
		  <?php show_sidebar(); ?>
		  <?php show_content_area('Below Navigation'); ?>
	  </div></div>
<div id="right"><?php show_content_slug(); ?></div>
</div>
<div id="thefooter" align="center"><?php show_content_area('Copyright Notice'); ?><BR>Sunset template &copy; <a href="http://www.andrewemmett.co.uk">Andrew Emmett </a></div>
</div>
</body>
</html>
