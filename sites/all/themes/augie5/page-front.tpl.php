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


<div id="wrapper">
	<div id="wrapper-shade">
		<div id="feature">
<?php print $channel; ?>
			<h2 id="nav-flag">Choose Your Path</h2> 
<?php $filename = '/var/www/html/alerts/alert.html';

if (file_exists($filename)) { ?>
			<iframe src="/alerts/alert.html" id="alert-img" scrolling="no">
			</iframe> <?php } ?>
<?php 
		
			$menuhtml = home_menu_tree(313);
			print $menuhtml;
			?>
		</div>
<!--END FEATURE NAV-->
		<div id="content" class="clearfix">
			<div id="main">
				<div id="leadin">
<p class="lead">At Augustana, we believe certain individuals are called to “<em>Go</em> Viking.” They understand that in order to create an even better tomorrow, they must explore and discover bold concepts and important ideas today. Review our <a href="/admission/value">Value Proposition</a> and learn why your decision to “<em>Go</em> Viking” is so significant.</p>
			  </div>
<!--END LEAD IN -->
				<div class="column">
<?php print $homepage_left; ?>
					<a href="news">More news</a> 
				</div>
<!--END COLUMN 1 -->
				<div class="column">
<?php print $homepage_right; ?>
					<a href="events">All events</a> 
				</div>
<!--END COLUMN 2-->
			</div>
<!--END MAIN-->
			<div id="feature-bar">
<?print $right; ?>
			</div>
<!--END FEATURE BAR-->
		</div>
<!--END CONTENT -->
	</div>
<!--END WRAPPER SHADE-->
</div>
<!--END WRAPPER-->


 
 

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



