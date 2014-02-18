<!doctype html>

<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

?>
<html lang="en">
<head>
	<title><?php print $head_title ?><?php if ($site_slogan != '' && !$is_front) print ' &ndash; '. $site_slogan; ?></title>
	<meta http-equiv="content-language" content="<?php //print $language ?>" />
	<?php //print $meta; ?>
	<?php print $head; ?>
	<?php print $styles; ?>
	<?php print $scripts ?>
</head>



<body class="<?php print $body_classes; ?>">

<div id="header">
	
	<h1 id="logo"><a href="/">Augustana College</a></h1>
	
	<?php //if ($path_root != 'admin') { ?>
	<ul id="tools">

		<li><a href="http://www.augie.edu/calendar">Calendar</a></li>
	</ul>
	


	<?php echo $search; ?>
	
	
	<?php // } ?>
	<?php print theme('links', $primary_links, array('id' => 'nav')); ?>
</div> <!--END HEADER -->


<div id="wrapper">
	<div id="wrapper-shade">
		<div id="feature">
<div id="block-views-channel_image-block_1" class="block block-views">
	<div class="content">
		<div class="view view-channel-image view-id-channel_image view-display-id-block_1 view-dom-id-2">
			<div class="view-content">
				<div class="views-row views-row-1 views-row-odd views-row-first views-row-last">
					<div class="views-field-field-image-fid">
						<span class="field-content">
							<a href="http://www.augie.edu/science" title="Future of Science @ Augustana">
							<img src="http://www.augie.edu/sites/default/files/siteimages/future.of.science.channel.image.jpg" alt="" title="" class="imagecache imagecache-channel imagecache-default imagecache-channel_default" width="854" height="322" /></a>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

			<h2 id="nav-flag">Choose Your Path</h2> 
<?php $filename = '/var/www/html/alerts/alert.html';

if (file_exists($filename)) { ?>
			<iframe src="/alerts/alert.html" id="alert-img" scrolling="no">
			</iframe> <?php } ?>
<?php 
		
			$menuhtml = menu_tree('menu-secondary-menu');
			print $menuhtml;
			?>
		</div>
<!--END FEATURE NAV-->
		<div id="content" class="clearfix">
			<div id="main">
				<div id="leadin">
<p class="lead">Augustana has announced plans to build a new, $30 million science facility following the largest gift in College history. The new building will be named in honor of Dr. Sven G. Froiland, professor of biology who served Augustana from 1946 to 1987. Phase two of the project features a $10 million renovation to the College’s Gilbert Science Center. <a href="http://www.augie.edu/science">Learn more.</a></p>
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
<?php print $right; ?>
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
		<p>&copy; 2012 Augustana College.  All rights reserved.</p>
		<p>2001 S. Summit Avenue, Sioux Falls, SD 57197  |  800.727.2844   |    605.274.0770 | +001 605.274.5516 (outside the United States) </p> 
		<span><a href="/privacy">Privacy Policy</a>   |   <a href="/contact">Contact Augustana</a> | <a href="/about/college-offices-and-affiliates/marketing/connect">Connect with Augustana</a></span>
	</div>
</div><!--END FOOTER -->


</body>
<?php print $closure; ?>
</html>



