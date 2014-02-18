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
                <li><a href="https://my.augie.edu/ics/">my.augie.edu</a></li>
		<li><a href="http://www.augie.edu/calendar">Calendar</a></li>
	</ul>

	<?php echo $search; ?>
	
	
	<?php // } ?>
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
		
			$menuhtml = menu_tree('menu-secondary-menu');
			print $menuhtml;
			?>
		</div>
<!--END FEATURE NAV-->
		<div id="content" class="clearfix">
			<div id="main">
			
<!--START LEAD IN-->
				<div id="leadin">
                    <div style="background: #e7e7e7; padding: 3px; margin-bottom: 20px; width: 590px;">
                        <div>
                            <iframe allowfullscreen="" frameborder="0" height="332" mozallowfullscreen="" src="//player.vimeo.com/video/73873716?title=0&amp;byline=0&amp;portrait=0&amp;color=e7e714" webkitallowfullscreen="" width="590"></iframe>
							<table cellpadding="0" cellspacing="0" style="margin-bottom: 0px; width: 580px; margin-top: 0px;">
								<tbody>
									<tr>
										<td style="padding: 10px 20px 10px 10px; font-size: 14px; line-height: 1.3em; text-align: justify; width: 90%;">
											<a href="http://www.augie.edu/admission/why-augustana/video-tours" style="border-bottom: 0px none;"><h3 class="title" style="margin: 0px 0px 1em;">Video Tours</h3></a>
											<div>Learn more about the academic experiences you'll discover at Augustana &mdash; from rich classroom discussions to lectures that will take you beyond the borders of campus to locations throughout the world. Learn about our Study Abroad programs, designed to give you a first-hand look at other cultures, traditions and economies in order to broaden your global perspective and understanding.</div>
										</td>
										<td style="width: 10%;  text-align: center; font-size: 43px; line-height: 12px;">
											<div ><a href="http://www.augie.edu/admission/why-augustana/video-tours" style="border-bottom: 0px none;"><span style="font-size: 10px; text-transform: uppercase; letter-spacing: 3px;">More</span><br />&#x2192;</a></div>
										</td>
									</tr>
								</tbody>
							</table>
                        </div>
                    </div>
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
		<p>&copy; <?php printf(date('Y')); ?> Augustana College.  All rights reserved.</p>
		<div>
		<a href="http://www.augielink.com/"><img alt="AugieLink" src="/sites/all/themes/augie/images/augielink53526.png" style="margin: 0 -9px 0 6px; float: right;"></a>
    <a href="http://www.augie.edu/rss.xml"><img alt="RSS" src="/sites/all/themes/augie/images/rss26.png" style="margin: 0 6px; float: right;"></a>
    <a href="http://www.youtube.com/AugustanaCollege"><img alt="YouTube" src="/sites/all/themes/augie/images/youtube26.png" style="margin: 0 6px; float: right;"></a>
    <a href="http://www.linkedin.com/company/227550"><img alt="LinkedIn" src="/sites/all/themes/augie/images/linkedin26.png" style="margin: 0 6px; float: right;"></a>
    <a href="https://plus.google.com/103965016830518541452"><img alt="Google+" src="/sites/all/themes/augie/images/google+26.png" style="margin: 0 6px; float: right;"></a>
    <a href="https://twitter.com/augustanasd"><img alt="Twitter" src="/sites/all/themes/augie/images/twitter26.png" style="margin: 0 6px; float: right;"></a>
    <a href="http://www.facebook.com/augustanacollegesd"><img alt="Facebook" src="/sites/all/themes/augie/images/facebook26.png" style="margin: 0 6px 0 9px; float: right;"></a>
		</div>
		<p>2001 S. Summit Avenue, Sioux Falls, SD 57197  |  800.727.2844   |    605.274.0770 | +001 605.274.5516 (outside the United States) </p> 
		<span><a href="/privacy">Privacy Policy</a>   |   <a href="/contact">Contact Augustana</a> | <a href="/about/college-offices-and-affiliates/marketing/connect">Connect with Augustana</a></span>
	</div>
</div><!--END FOOTER -->


</body>
<?php print $closure; ?>
</html>



