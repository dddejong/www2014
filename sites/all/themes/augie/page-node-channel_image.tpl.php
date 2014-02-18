<!doctype html>
<html lang="en">
<head>
	<title><?php print $head_title ?><?php if ($site_slogan != '' && !$is_front) print ' &ndash; '. $site_slogan; ?></title>
	<meta http-equiv="content-language" content="<?php // print $language ?>" />
	<?php //print $meta; ?>
	<?php print $head; ?>
	<?php print $styles; ?>
	<?php print $scripts ?>
</head>

<body class="<?php print $body_classes; ?>">

<div id="header">
  
  <h1 id="logo"><a href="/">Augustana College</a></h1>
  
  <?php // if ($path_root != 'admin') { ?>
  <ul id="tools">
                <li><a href="https://my.augie.edu/ics/">my.augie.edu</a></li>
    <li><a href="http://www.augie.edu/calendar">Calendar</a></li>
  </ul>
  


  <?php echo $search; ?>
  
  
  <?php //} ?>
  <?php print theme('links', $primary_links, array('id' => 'nav')); ?>
</div> <!--END HEADER -->



<div id="wrapper">
	<div id="wrapper-shade">
	
	  <div id="titlebar">
		
	
	<?php// print $channel; ?>

	 
	  			<?php
		if ($breadcrumb != '') {
			print $breadcrumb;
		} ?>
	  </div>
	  <!--END TITLE BAR -->

		<div id="content" class="clearfix">
		
		
			
			<div id="main-single">
		<?php	
			if ($tabs != '') {
			print '<div class="tabs">'. $tabs .'</div>';
		}
		
		if ($messages != '') {
			print '<div id="messages">'. $messages .'</div>';
		}
				      
	 
			if ($title != '') {
			print '<h2>'. $title .'</h2>';
		}      	
		print $help; // Drupal already wraps this one in a class      
				
		print $content; ?>
			
			
				
				
				
			</div><!--END MAIN-->
			
		</div><!--END CONTENT -->
	</div><!--END WRAPPER SHADE-->
</div><!--END WRAPPER-->



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



