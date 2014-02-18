<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title><?php print $head_title ?><?php if ($site_slogan != '' && !$is_front) print ' &ndash; '. $site_slogan; ?></title>
	<meta http-equiv="content-language" content="<?php print $language ?>" />
	<?php print $meta; ?>
  	<?php print $head; ?>
  	<?php print $styles; ?>
  	<?php print $scripts ?>
  	<!--[if lte IE 6]>
  	<link href="<?php print $path; ?>css/ie.css" rel="stylesheet"  type="text/css"  media="screen, projection" />
  	<![endif]--> 
	<!--[if lte IE 7]>
  	<link href="<?php print $path; ?>css/ie7.css" rel="stylesheet"  type="text/css"  media="screen, projection" />
  	<![endif]--> 
</head>



<body class="<?php print $body_class; ?>">

<div id="header">
	
	<h1 id="logo"><a href="/">Augustana College</a></h1>
	
	<?php if ($path_root != 'admin') { ?>
	<ul id="tools">

		<li><a href="http://events.augie.edu/cgi-bin/publish/webevent.cgi?cmd=opencal&cal=cal3">Calendar</a></li>
	</ul>
	


	<?php echo $search; ?>
	
	
	<?php } ?>
	<?php print theme('links', $primary_links, array('id' => 'nav')); ?>
</div> <!--END HEADER -->


<?php 

if ($is_front){
		$page = 'front';
	} else {
		$page = $node->type;
	}
if ($path_root == 'administrator' ) {
	$page = 'administrator';
}

if ($path_root == 'news' || $path_root == 'events' || $path_root == 'in-the-news' ) {
	$page = 'news';
}

if ($path_root == 'photos' ) {
	$page = 'photos';
}

switch ($page) {
case 'front':
//    include 'templates/front.tpl.php';
    break;
case 'channel':
//    include 'templates/section.tpl.php';
    break;
case 'channel_image':
//    include 'templates/single.tpl.php';
    break;
case 'panel':
//    include 'templates/single.tpl.php';
    break;
case 'gateway':
//    include 'templates/gateway.tpl.php';
    break;
case 'homepage_ad':
//    include 'templates/single.tpl.php';
    break;
case 'page':
//    include 'templates/content.tpl.php';
	break;
case 'webform':
//    include 'templates/content.tpl.php';
	break;
case 'news':
    include 'templates/news.tpl.php';
	break;
case 'album':
    include 'templates/album.tpl.php';
	break;
case 'administrator':
    include 'templates/admin.tpl.php';
	break;
case 'photos':
    include 'templates/gallery.tpl.php';
	break;
default:
//    include 'templates/content.tpl.php';
	break;
	
}
 ?>
 
 

<div id="footer">
	<div id="footer-bar-right">&nbsp;</div>
	<div id="footer-bar">
		<a href="http://www.augie.edu/giving" id="make-a-gift">Make a Gift to Augustana</a>
		<p>&copy; 2011 Augustana College.  All rights reserved.</p>
		<p>2001 S. Summit Avenue, Sioux Falls, SD 57197  |  800.727.2844   |    605.274.0770 | +001 605.274.5516 (outside the United States) </p> 
		<span><a href="/privacy">Privacy Policy</a>   |   <a href="/contact">Contact Augustana</a> | <a href="/about/college-offices-and-affiliates/marketing/connect">Connect with Augustana</a></span>
	</div>
</div><!--END FOOTER -->


</body>
<?php print $closure; ?>
</html>



