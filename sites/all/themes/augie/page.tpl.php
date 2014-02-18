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
      <h1 class="<?php print $title_class; ?>"><?php print $title_class; ?></h1>
      <?php
    if ($breadcrumb != '') {
      print $breadcrumb;
    }?>  
    
    </div>
  
    <div id="content" class="clearfix">
    <?php  if ($left != '') { ?>
      <div id="sidebar">
        <?php print $left; ?>
      </div><!--END SIDEBAR -->
    <?php  } ?>
      
      <div id="main">
      
    <?php  
    if ($tabs != '') {
      print '<div class="tabs">'. $tabs .'</div>';
    }
    
    if ($messages != '') {
      print '<div id="messages">'. $messages .'</div>';
    }
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
<?php
  $path_url = $_REQUEST['q'];
  $path_root_array =  explode('/', $path_url);
  $path_count = count($path_root_array);
  $path_root = $path_root_array[0];

    if ($path_root_array[0] == 'admission' &&
	$path_root_array[1] != 'financing-your-education') 
 {
        print ' 
		<!-- BEGIN ProvideSupport.com Graphics Chat Button Code -->
		<div id="ciqPoR" style="z-index:100;position:absolute"></div>
		<div id="scqPoR" style="display:inline;position:fixed;z-index:9999;top:10%;right:0%;"></div>
		<div id="sdqPoR" style="display:none"></div>
		<script type="text/javascript">var seqPoR=document.createElement("script");seqPoR.type="text/javascript";var seqPoRs=(location.protocol.indexOf("https")==0?"https":"http")+"://image.providesupport.com/js/0githn4ybsbe20qaiwm1fwmkby/safe-standard.js?ps_h=qPoR&ps_t="+new Date().getTime();setTimeout("seqPoR.src=seqPoRs;document.getElementById(\'sdqPoR\').appendChild(seqPoR)",1)</script>
		<noscript>
		<div style="display:inline"><a href="http://www.providesupport.com?messenger=0githn4ybsbe20qaiwm1fwmkby">Chat Support</a></div>
		</noscript>
		<!-- END ProvideSupport.com Graphics Chat Button Code -->
		';
        }
?>

</body>
<?php print $closure; ?>
</html>



