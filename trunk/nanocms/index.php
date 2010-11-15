<?php require_once("data/setting.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php show_content_area('WebSite Name'); ?> &raquo; <?php show_title(); ?></title>
<meta name="description" content="NanoCMS is the smallest text file based cms written in php. As the nano name suggests the cms is really tiny, small,elegant, easy to use interface. You can create saperate pages and also sidebar content pages. The sidebar links are added automatically" />
<meta name="keywords" content="NanoCMS, nano, cms, tiny, small, easy to use, easy, free, opensource, easy, interface, pages, static, dynamic content, beginners" />
<meta name="author" content="Kalyan Chakravarthy" />
<?php runTweak('head'); ?>
</head>
<body>
<div id="wrapper">
  <div id="content">
    
    <div id="mainimg">
      <h3><?php show_content_area('WebSite Name'); ?></h3>
        <h4><?php show_content_area('WebSite slogan'); ?></h4>
    </div>
        <div id="header">
      <div id="links">
        <ul>
          <?php
                                //show_links( link_place, format[ nolist->with out <li> or default <li>%s</li>, before, after )
                                show_links('top-navigation');
                              ?>
        </ul>
      </div>
    
    </div>
    <div id="contentarea">
      <div id="leftbar">
        <?php show_content_slug(); ?>
      </div>
    </div>
    <div id="bottom">
      <div id="footer">
                <?php show_links('Footer-Right', ' | %s'); ?><br>
                powered by <a href='http://NanoCMS.in'>NanoCMS</a>
                  <?php show_content_area('Copyright Notice'); ?>
          </div>
    </div>
  </div>
</div>
<?php runTweak('end-body'); ?>
</body>
</html>
