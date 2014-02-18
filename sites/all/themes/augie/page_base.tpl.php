<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

/**
 * @file
 * Displays a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $css: An array of CSS files for the current page.
 * - $directory: The directory the theme is located in, e.g. themes/garland or
 *   themes/garland/minelli.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Page metadata:
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or
 *   'rtl'.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   element.
 * - $head: Markup for the HEAD element (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $body_classes: A set of CSS classes for the BODY tag. This contains flags
 *   indicating the current layout (multiple columns, single column), the
 *   current path, whether the user is logged in, and so on.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled in
 *   theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $mission: The text of the site mission, empty when display has been
 *   disabled in theme settings.
 *
 * Navigation:
 * - $search: HTML to display the search box, empty if search has been
 *   disabled.
 * - $primary_links (array): An array containing primary navigation links for
 *   the site, if they have been configured.
 * - $secondary_links (array): An array containing secondary navigation links
 *   for the site, if they have been configured.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $left: The HTML for the left sidebar.
 * - $breadcrumb: The breadcrumb trail for the current page.
 * - $title: The page title, for use in the actual HTML content.
 * - $help: Dynamic help text, mostly for admin pages.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs: Tabs linking to any sub-pages beneath the current page (e.g., the
 *   view and edit tabs when displaying a node).
 * - $content: The main content of the current Drupal page.
 * - $right: The HTML for the right sidebar.
 * - $node: The node object, if there is an automatically-loaded node associated
 *   with the page, and the node ID is the second argument in the page's path
 *   (e.g. node/12345 and node/12345/revisions, but not comment/reply/12345).
 *
 * Footer/closing data:
 * - $feed_icons: A string of all feed icons for the current page.
 * - $footer_message: The footer message as defined in the admin settings.
 * - $footer : The footer region.
 * - $closure: Final closing markup from any modules that have altered the page.
 *   This variable should always be output last, after all other dynamic
 *   content.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title><?php print $head_title ?><?php if ($site_slogan != '' && !$is_front) print ' &ndash; '. $site_slogan; ?></title>
  <meta http-equiv="content-language" content="<?php // print $language ?>" />
  <?php //print $meta; ?>
    <?php print $head; ?>
    <?php print $styles; ?>
    <?php print $scripts ?>
    <!--[if lte IE 6]>
    <link href="<?php print $directory; ?>css/ie.css" rel="stylesheet"  type="text/css"  media="screen, projection" />
    <![endif]--> 
  <!--[if lte IE 7]>
    <link href="<?php print $directory; ?>css/ie7.css" rel="stylesheet"  type="text/css"  media="screen, projection" />
    <![endif]--> 
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

<!-- *******************
page template goes here 
****************** -->

<div id="footer">
  <div id="footer-bar-right">&nbsp;</div>
  <div id="footer-bar">
    <a href="http://www.augie.edu/giving" id="make-a-gift">Make a Gift to Augustana</a>
    <p>&copy; 2013 Augustana College.  All rights reserved.</p>
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



