<?php
// $Id: //Internal/AugustanaCollege/www/dev/sites/all/themes/augie5/template.php#3 $

// Custome theme regions
function augie_regions() {
  return array(
    'top' => t('Top'),
    'bottom' => t('Bottom'),
    'left' => t('Left'),
    'right' => t('Right'),
     'footer' => t('Header'),
    'search' => t('Search'),
    'channel' => t('Channel Image'),
    'gateway' => t('Gateway Sidebar'),
    'homepage_left' => t('Homepage Left'),
    'homepage_right' => t('Homepage Right'),
  );
}

/**
 * Override theme_page(). We need to do this in order to set proper page titles.
 *
 * In a nutshell we are intercepting the page call, before phptemplate renders everything.
 */

function augie_page($content = '') {
  
  $title = drupal_get_title();
    $headers = drupal_set_header();

    // wrap taxonomy listing pages in quotes and prefix with topic
    if (arg(0) == 'taxonomy' && arg(1) == 'term' && is_numeric(arg(2))) {
      $title = t('Topic') .' &#8220;'. $title .'&#8221;';
    }
  
    // if this is a 403 and they aren't logged in, tell them they need to log in
    else if (strpos($headers, 'HTTP/1.1 403 Forbidden') && !$user->uid) {
      $title = t('Please login to continue');
    }

    drupal_set_title($title);

    return phptemplate_page($content);
}

/**
 * Intercept template variables
 *
 * @param $hook
 *   The name of the theme function being executed
 * @param $vars
 *   A sequential array of variables passed to the theme function.
 */
function _phptemplate_variables($hook, $vars = array()) {
  global $user;
  
  //set path variables
  $path = base_path() . path_to_theme() .'/';
  $path_theme = path_to_theme() .'/';

  // set global vars
    $vars['path'] = $path;
    $vars['user'] = $user;
  
    //extract current URL for detecting paths
  $path_url = $_REQUEST['q'];
  $path_root_array =  explode('/', $path_url);
  $path_count = count($path_root_array);
    $path_root = $path_root_array[0];
    $vars['path_root_array'] = $path_root_array;
    
    if ($path_root_array[2] == "edit") { $path_root = "administrator"; }
    if ($path_root_array[1] == "add" || $path_root == "devel") { $path_root = "administrator"; }

    
    /** These are the allowed path roots as defined in style.css to display custom headers
    on channel pages. Any page without a defined header will default to 'node') **/
    
    $allowed_paths = array('about', 
    'privacy',
    'contact',
    'academics',
    'admission',
    'arts',
    'campuslife',
    'giving',
    'news',
    'events',
    'in-the-news',
    'alumni',
    'students',
    'parents',
    'prospective',
    'facstaff',
    'community',
    'information-technology',
    'photos',
    'alerts',
    'administrator',
    'node');
  
  if (!in_array($path_root,$allowed_paths)) {
      $path_root = 'node';
    }
    
    // Set the .title_class for style.css page headers
    $vars['title_class']= $path_root;
 
  //set final path root
  $vars['path_root'] =  $path_root;
  $vars['path_count'] = $path_count;
  
  // Set node type
    $vars['node_type'] = $node->type;
  
  // Menutrails helper
     if ($path_root == "events" ) {
      $menu_id = 400;
    }

    switch ($hook) {

    case 'page':
      // set the primary links
      $vars['primary_links'] = menutrails_primary_links(1);
      // you may want to also override secondary_links
      $vars['secondary_links'] = menutrails_primary_links(2);
      
      // add in CSS and JS files so they get aggregated and compressed properly
        drupal_add_css($path_theme .'css/style.css', 'theme', 'screen, projection');
         drupal_add_css($path_theme .'css/style.custom.css', 'theme', 'screen, projection');

      // show regions by default
          $vars['show_regions'] = 1;
     
      //titles are now ignored by specific node type when they are anomalous in the design 
       $vars['breadcrumb_title'] = $vars['title'];
      
      $vars['left'] = $vars['sidebar_left'];
          $vars['right'] =  $vars['sidebar_right'];
      
      if ($path_root == "administrator") {
      
         $vars['show_regions'] = '';
            $vars['left'] = '';
            $vars['right'] = '';
            $vars['center'] = 'col-center span-24';
            $vars['body_class'] = 'col-1';
          }

      // SEO optimization, add in the node's teaser, or if on the homepage, the mission statement
          // as a description of the page that appears in search engines
          if ($vars['is_front'] && $vars['mission'] != '') {
            $vars['meta'] .= '<meta name="description" content="'. augie_trim_text($vars['mission']) .'" />'. "\n";
          }
          else if ($vars['node']->teaser != '') {
            $vars['meta'] .= '<meta name="description" content="'. augie_trim_text($vars['node']->teaser) .'" />'. "\n";
          }
          
          // SEO optimization, if the node has tags, use these as keywords for the page
          if ($vars['node']->taxonomy) {
            $keywords = array();
            foreach($vars['node']->taxonomy as $term) {
                $keywords[] = $term->name;
            }
            $vars['meta'] .= '<meta name="keywords" content="'. implode(',', $keywords) .'" />'. "\n";
          }

          // Set special class for front page
          if ($vars['is_front']) {
            $vars['body_class'] = 'front';
          }
      
      // rebuild CSS and JS after all theme modifications to these structures
      $new_css = drupal_add_css();
          
      // removed unnessecary CSS styles
          // unset($new_css['all']['all']['sites/all/modules/contrib/tagadelic/tagadelic.css']);
      $css = drupal_add_css();
          unset($css['all']['module']['modules/system/system.css']);
          unset($css['all']['module']['modules/system/defaults.css']);
  
        $vars['styles'] = drupal_get_css($css);
      
          // rebuild CSS and JS
          $vars['styles'] = drupal_get_css($new_css);
          $vars['scripts'] = drupal_get_js();

      //titles are now ignored by specific node type when they are anomalous in the design 
      $vars['breadcrumb_title'] = $vars['title'];
      if (arg(0) == 'node' && is_numeric(arg(1))) {
          $node = node_load(arg(1));
          if (in_array($node->type, array('channel'))) {
            $vars['title'] = '';
          }
      }
      
      $vars['title'] = '<h2 class=" '. $admin_class .'">'. $vars['title'] .'</h2>'; 
          
        
      
      break;

    case 'node':
          $node = $vars['node']; // for easy reference
          // for easy variable adding for different node types
          switch ($node->type) {
            case 'page':
            break;
          }

          $vars['links'] = theme('links', $vars['node']->links, array('class' => 'links inline'));
      
      break;

    case 'comment':
          // if the author of the node comments as well, highlight that comment
          $node = node_load($vars['comment']->nid);
          if ($vars['comment']->uid == $node->uid) {
            $vars['author_comment'] = TRUE;
          }
      
          // only show links for users that can administer links
          if (!user_access('administer comments')) {
            $vars['links'] = '';
          }
      
          // if subjects in comments are turned off, don't show the title then
          if (!variable_get('comment_subject_field', 1)) {
            $vars['title'] = '';
          }
      
          // if user has no picture, add in a filler
          if ($vars['picture'] == '') {
            $vars['picture'] = '<div class="no-picture">&nbsp;</div>';
          }

          break;
    
        case 'box':
          // rename to more common text
          if (strpos($vars['title'], 'Post new comment') === 0) {
            $vars['title'] = 'Add your comment';
          }
          break;
      }

      return $vars;
  }

/**
 * Override, add rel="nofollow" to comment poster's homepage, remove "not verified", confusing
 *
 * Format a username.
 *
 * @param $object
 *   The user object to format, usually returned from user_load().
 * @return
 *   A string containing an HTML link to the user's page if the passed object
 *   suggests that this is a site user. Otherwise, only the username is returned.
 */
function phptemplate_username($object) {

  if ($object->uid && $object->name) {
    // Shorten the name when it is too long or it will break many tables.
    if (drupal_strlen($object->name) > 20) {
      $name = drupal_substr($object->name, 0, 15) .'...';
    }
    else {
      $name = $object->name;
    }

    if (user_access('access user profiles')) {
      $output = l($name, 'user/'. $object->uid, array('title' => t('View user profile.')));
    }
    else {
      $output = check_plain($name);
    }
  }
  else if ($object->name) {
    // Sometimes modules display content composed by people who are
    // not registered members of the site (e.g. mailing list or news
    // aggregator modules). This clause enables modules to display
    // the true author of the content.
    if ($object->homepage) {
      $output = l($object->name, $object->homepage, array('rel' => 'nofollow'));
    }
    else {
      $output = check_plain($object->name);
    }
  }
  else {
    $output = variable_get('anonymous', t('Anonymous'));
  }

  return $output;
}

/**
 * Override, remove previous/next links for forum topics
 *
 * Makes forums look better and is great for performance
 * More: http://www.sysarchitects.com/node/70
 */
function phptemplate_forum_topic_navigation($node) {
  return '';
}

/**
 * Override, make sure Drupal doesn't return empty <P>
 *
 * Return a themed help message.
 *
 * @return a string containing the helptext for the current page.
 */
function phptemplate_help() {
  $help = menu_get_active_help();
  // Drupal sometimes returns empty <p></p> so strip tags to check if empty
  if (strlen(strip_tags($help)) > 1) {
    return '<div class="help">'. $help .'</div>';
  }
}

/**
 * Override, use a better default breadcrumb separator.
 *
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return a string containing the breadcrumb output.
 */
function phptemplate_breadcrumb($breadcrumb) {
//extract current URL for detecting paths
 global $node;
  $path_url = $_REQUEST['q'];
  $path_root_array =  explode('/', $path_url);
  $path_root = $path_root_array[0];
  $path_count = count($path_root_array);

  //dprint_r($path_root_array);
  
  if (count($breadcrumb) >= 1) {
  
  // custom handling for alumni 
  if ($path_root == "alumni") {
       if ($path_count > 1) {
        array_insert(&$breadcrumb, l('Alumni','alumni', '', NULL, NULL,FALSE,FALSE), 1);
    }
    }
    
  // custom handling for campuslife galleries 
  if ($path_root == 'campuslife' &&  $path_root_array[1] == 'augustana-experience') {
    //if ($path_count > 2) {
      //$breadcrumb[2] = '<a href="/campuslife/augustana-experience">The Augustana Experience</a>';
    //}
  }
    

    // news 
     if ($path_root == "news") {
       
       
       if ($path_count == 1) {
         $breadcrumb[] = 'News';  
       } else {
         $breadcrumb[1] = '<a href="/news">News</a>';
       }
       
     } elseif ($path_root == "events") {
       
       if ($path_count == 1 || $path_count == 2) {
       $breadcrumb[] = 'Events';  
       } else {
       $breadcrumb[] = drupal_get_title();
       }
       
     } elseif ($path_root == "privacy" || $path_root == "photos" || $path_root == "contact" || $path_root == "contact") {
       
       $breadcrumb[] = drupal_get_title();
     
     } elseif ($path_root == "campuslife" && $path_root_array[1] == 'augustana-experience') {
       
       $breadcrumb[] = drupal_get_title();
        
    
     } else {

       $breadcrumb[] = menu_get_active_title();
       //$breadcrumb[] = drupal_get_title();
     
     }
    
  
     
  
    return '<div class="breadcrumb">'. implode(' &rsaquo; ', $breadcrumb) .'</div>';
  }
}

/**
 * Rewrite of theme_form_element() to suppress ":" if the title ends with a punctuation mark.
 */
function phptemplate_form_element() {
  $args = func_get_args();
  return preg_replace('@([.!?]):\s*(</label>)@i', '$1$2', call_user_func_array('theme_form_element', $args));
}

/**
 * This override adds an ID to the label for all checkboxes, useful for jQuery.
 *
 * Format a checkbox.
 *
 * @param $element
 *   An associative array containing the properties of the element.
 *   Properties used:  title, value, return_value, description, required
 * @return
 *   A themed HTML string representing the checkbox.
 */

function phptemplate_checkbox($element) {
  _form_set_class($element, array('form-checkbox'));
  $checkbox = '<input ';
  $checkbox .= 'type="checkbox" ';
  $checkbox .= 'name="'. $element['#name'] .'" ';
  $checkbox .= 'id="'. $element['#id'].'" ' ;
  $checkbox .= 'value="'. $element['#return_value'] .'" ';
  $checkbox .= $element['#value'] ? ' checked="checked" ' : ' ';
  $checkbox .= drupal_attributes($element['#attributes']) . ' />';

  if (!is_null($element['#title'])) {
    $checkbox = '<label id="checkbox-'. $element['#id'] .'" class="option">'. $checkbox .' '. $element['#title'] .'</label>';
  }

  unset($element['#title']);
  return theme('form_element', $element, $checkbox);
}

/**
 * Set status messages to use Blueprint CSS classes.
 */
function phptemplate_status_messages($display = NULL) {
  $output = '';
  foreach (drupal_get_messages($display) as $type => $messages) {
    // blueprint can either call this success or notice
    if ($type == 'status') {
      $type = 'success';
    }
    $output .= "<div class=\"messages $type\">\n";
    if (count($messages) > 1) {
      $output .= " <ul>\n";
      foreach ($messages as $message) {
        $output .= '  <li>'. $message ."</li>\n";
      }
      $output .= " </ul>\n";
    }
    else {
      $output .= $messages[0];
    }
    $output .= "</div>\n";
  }
  return $output;
}

/**
 * Override, use better icons, source: http://drupal.org/node/102743#comment-664157
 *
 * Format the icon for each individual topic.
 *
 * @ingroup themeable
 */
function phptemplate_forum_icon($new_posts, $num_posts = 0, $comment_mode = 0, $sticky = 0) {
  if ($num_posts > variable_get('forum_hot_topic', 15)) {
    $icon = $new_posts ? 'hot-new' : 'hot';
  }
  else {
    $icon = $new_posts ? 'new' : 'default';
  }

  if ($comment_mode == COMMENT_NODE_READ_ONLY || $comment_mode == COMMENT_NODE_DISABLED) {
    $icon = 'closed';
  }

  if ($sticky == 1) {
    $icon = 'sticky';
  }

  $output = theme('image', path_to_theme() . "/images/icons/forum-$icon.png");

  if ($new_posts) {
    $output = "<a name=\"new\">$output</a>";
  }

  return $output;
}

/**
 * Override comment wrapper to show you must login to comment.
 */
function phptemplate_comment_wrapper($content) {
  global $user;
  $output = '';

  if (arg(0) == 'node' && is_numeric(arg(1))) {
    $node = node_load(arg(1));
    if ($node->type != 'forum') {
      $count = $node->comment_count .' '. format_plural($node->comment_count, 'comment', 'comments');
      $comment_text .= ($count > 0) ? $count : 'No comments';
      $output .= '<h3 id="comment-number">'. $comment_text .'</h3>';
    }
  }

  $output .= '<div id="comments">';
  $msg = '';
  if (!user_access('post comments')) {
    $dest = 'destination='. $_GET['q'] .'#comment-form';
    $msg = '<div id="messages"><div class="error-wrapper"><div class="messages error">'.t('Please <a href="!register">register</a> or <a href="!login">sign in</a> to post a comment.', array('!register' => url("user/register", $dest), '!login' => url('user', $dest))).'</div></div></div>';
  }
  $output .= $content;
  $output .= $msg;
  return $output .'</div>';
}

/**
 * Trim a post to a certain number of characters, removing all HTML.
 */
function augie_trim_text($text, $length = 150) {
  // remove any HTML or line breaks so these don't appear in the text
  $text = trim(str_replace(array("\n", "\r"), ' ', strip_tags($text)));
  $text = trim(substr($text, 0, $length));
  $lastchar = substr($text, -1, 1);
  // check to see if the last character in the title is a non-alphanumeric character, except for ? or !
  // if it is strip it off so you don't get strange looking titles
  if (preg_match('/[^0-9A-Za-z\!\?]/', $lastchar)) {
    $text = substr($text, 0, -1);
  }
  // ? and ! are ok to end a title with since they make sense
  if ($lastchar != '!' and $lastchar != '?') {
    $text .= '...';
  }

  return $text;
}

/**
 * views template to output a view.
 * This code was generated by the views theming wizard
 * Date: Sun, 06/15/2008 - 01:14
 * View: channel_image
 *
 * This function goes in your template.php file
 */
function phptemplate_views_view_list_channel_image($view, $nodes, $type) {
  $fields = _views_get_fields();

  $taken = array();

  // Set up the fields in nicely named chunks.
  foreach ($view->field as $id => $field) {
    $field_name = $field['field'];
    if (isset($taken[$field_name])) {
      $field_name = $field['queryname'];
    }
    $taken[$field_name] = true;
    $field_names[$id] = $field_name;
  }

  // Set up some variables that won't change.
  $base_vars = array(
    'view' => $view,
    'view_type' => $type,
  );

  foreach ($nodes as $i => $node) {
    $vars = $base_vars;
    $vars['node'] = $node;
    $vars['count'] = $i;
    $vars['stripe'] = $i % 2 ? 'even' : 'odd';
    foreach ($view->field as $id => $field) {
      $name = $field_names[$id];
      $vars[$name] = views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $node, $view);
      if (isset($field['label'])) {
        $vars[$name . '_label'] = $field['label'];
      }
    }
    $items[] = _phptemplate_callback('views-list-channel_image', $vars);
  }
  if ($items) {
    return theme('item_list', $items);
  }
}

/**
* Override node form
*/
function phptemplate_node_form($form) {
  
  //dprint_r($form);
  
 // $form['hierarchy']['nodehierarchy_create_menu']['#attributes']  = array('checked' => 'checked');
    
                    
  // Remove 'Log message' text area
  $form['log']['#weight'] = 40;
  $form['body_filter']['format']['#access'] = FALSE;
  $form['field_teaser'][0]['format']['#access'] = FALSE;
  $form['menu']['#weight'] = 30;
  $form['path']['#weight'] = 31;
  $form['author']['#weight'] = 32;
  $form['options']['#weight'] = 33;
  $form['attachments']['#weight'] = 34; 
  $form['xmlsitemap_node']['#weight'] = 35;   
  $form['nodewords']['#weight'] = -4;    
  $form['page_title']['#weight'] = -3;    
  $form['hierarchy']['#weight'] = -2;  
  
  $form['xmlsitemap_node']['#access'] = FALSE;    
  
  return drupal_render($form);
}

function phptemplate_album_image_node_form($form) {
  
  //dprint_r($form);
  
 // $form['hierarchy']['nodehierarchy_create_menu']['#attributes']  = array('checked' => 'checked');
    
                    
  // Remove 'Log message' text area
  $form['log']['#weight'] = 40;
  $form['body_filter']['format']['#access'] = FALSE;
  $form['field_teaser'][0]['format']['#access'] = FALSE;
  $form['menu']['#weight'] = 30;
  $form['path']['#weight'] = 31;
  $form['author']['#weight'] = 32;
  $form['options']['#weight'] = 33;
  $form['attachments']['#weight'] = 34; 
  $form['xmlsitemap_node']['#weight'] = 35;   
  $form['nodewords']['#weight'] = -4;    
  $form['page_title']['#weight'] = -3;    
  $form['hierarchy']['#weight'] = -2;  
  $form['menu']['#access'] = FALSE;   
  //$form['author']['#access'] = FALSE; 

   $form['xmlsitemap_node']['#access'] = FALSE; 

   $form['path']['#access'] = FALSE;
   $form['log']['#access'] = FALSE;
       $form['preview']['#access'] = FALSE; 
 
  
  return drupal_render($form);
}


function phptemplate_event_node_form($form) {
  
   //dprint_r($form);
  // Remove 'Log message' text area
  $form['log']['#weight'] = 40;
  $form['body_filter']['format']['#access'] = FALSE;
  $form['field_teaser'][0]['format']['#access'] = FALSE;
  $form['field_time'][0]['format']['#access'] = FALSE;
  $form['field_contact'][0]['format']['#access'] = FALSE;
  $form['menu']['#weight'] = 30;
  $form['path']['#weight'] = 31;
  $form['author']['#weight'] = 32;
  $form['options']['#weight'] = 33;
  $form['attachments']['#weight'] = 34; 
  $form['xmlsitemap_node']['#weight'] = 35;   
  $form['nodewords']['#weight'] = -4;    
  $form['author']['#access'] = FALSE;   
  $form['menu']['#access'] = FALSE;   
  $form['xmlsitemap_node']['#access'] = FALSE;    
 // $form['created']['#value'] = FALSE; 
  //$form['path']['#access'] = FALSE;
  return drupal_render($form);
}


function phptemplate_news_node_form($form) {
  
   //dprint_r($form);
  // Remove 'Log message' text area
  $form['log']['#weight'] = 40;
  $form['body_filter']['format']['#access'] = FALSE;
  $form['field_teaser'][0]['format']['#access'] = FALSE;
  $form['menu']['#weight'] = 30;
  $form['path']['#weight'] = 31;
  $form['author']['#weight'] = 32;
  $form['options']['#weight'] = 33;
  $form['attachments']['#weight'] = 34; 
  $form['xmlsitemap_node']['#weight'] = 35;   
  $form['nodewords']['#weight'] = -4;    
  $form['author']['#access'] = FALSE;   
  $form['menu']['#access'] = FALSE;   
  $form['xmlsitemap_node']['#access'] = FALSE;    
 // $form['created']['#value'] = FALSE; 
  //$form['path']['#access'] = FALSE;
  return drupal_render($form);
}


function phptemplate_resource_node_form($form) {
  
  // dprint_r($form['author']);
  // Remove 'Log message' text area
  $form['log']['#weight'] = 40;
  $form['body_filter']['format']['#access'] = FALSE;
  $form['field_teaser'][0]['format']['#access'] = FALSE;
  $form['menu']['#weight'] = 30;
  $form['path']['#weight'] = 31;
  $form['author']['#weight'] = 32;
  $form['options']['#weight'] = 33;
  $form['attachments']['#weight'] = 34; 
  $form['xmlsitemap_node']['#weight'] = 35;   
  $form['taxonomy']['#weight'] = -6;

  $form['menu']['#access'] = FALSE;   
  $form['author']['#access'] = FALSE; 
   $form['xmlsitemap_node']['#access'] = FALSE; 

   $form['path']['#access'] = FALSE;
   $form['log']['#access'] = FALSE;
  return drupal_render($form);
}
function phptemplate_link_node_form($form) {
  
  // dprint_r($form['author']);
  // Remove 'Log message' text area
  $form['log']['#weight'] = 40;
  $form['body_filter']['format']['#access'] = FALSE;
  $form['menu']['#weight'] = 30;
  $form['path']['#weight'] = 31;
  $form['author']['#weight'] = 32;
  $form['options']['#weight'] = 33;
  $form['attachments']['#weight'] = 34; 
  $form['xmlsitemap_node']['#weight'] = 35;   
   $form['taxonomy']['#weight'] = -6;

  $form['menu']['#access'] = FALSE;   
  $form['author']['#access'] = FALSE; 

   $form['xmlsitemap_node']['#access'] = FALSE; 

   $form['path']['#access'] = FALSE;
   $form['log']['#access'] = FALSE;
       $form['preview']['#access'] = FALSE; 
  return drupal_render($form);
}
function phptemplate_pressclip_node_form($form) {
  
  // dprint_r($form['author']);
  // Remove 'Log message' text area
 

  $form['menu']['#access'] = FALSE;   
  $form['author']['#access'] = FALSE; 
   $form['xmlsitemap_node']['#access'] = FALSE; 

   $form['path']['#access'] = FALSE;
   $form['log']['#access'] = FALSE;
  return drupal_render($form);
}



function augie_menu_tree($pid = 1) {
  
  if ($pid == 313) { // set a custom style for the "choose your path" sidebar nav
    $class = "secondary-nav";
  } elseif ($pid == 450) {
    $class = 'gateway';
  } else {
    $class="side-nav"; // default sidebar class
  }
  
  
if ($tree = menu_tree($pid)) {
   return "\n<ul class=\"". $class ."\">\n". $tree ."\n</ul>\n";
  }
}



function phptemplate_menu_tree_improved($pid = 1) {
  $menu = menu_get_menu();
  $output = '';

  if (isset($menu['visible'][$pid]) && $menu['visible'][$pid]['children']) {
    $num_children = count($menu['visible'][$pid]['children']);
    
    for ($i=0; $i < $num_children; ++$i) {
      $mid = $menu['visible'][$pid]['children'][$i];
      $type = isset($menu['visible'][$mid]['type']) ? $menu['visible'][$mid]['type'] : NULL;
      $children = isset($menu['visible'][$mid]['children']) ? $menu['visible'][$mid]['children'] : NULL;
      $extraclass = $i == 0 ? 'first' : ($i == $num_children-1 ? 'last' : '');
      $output .= theme('menu_item', $mid, menu_in_active_trail($mid) || ($type & MENU_EXPANDED) ? theme('menu_tree', $mid) : '', count($children) == 0, $extraclass);     
   
    }
  }

  return $output;
}



function home_menu_tree($pid = 1) {
  
  if ($tree = phptemplate_menu_tree_improved($pid)) {
    return "\n<ul id=\"feature-nav\">\n". $tree ."\n</ul>\n";
  }
}
// Add 'active' class to <li>


function phptemplate_menu_item($mid, $children = '', $leaf = TRUE, $extraclass = '') {
    
  
    if (menu_get_active_nontask_item() == $mid) {
      if ($children) {
        $class_active = 'highlight';
      } else {
        $class_active = ' here';
        }
  
  }
  
 
    
    //extract current URL for detecting paths
     $menu_id = array();
    $path_url = $_REQUEST['q'];
     $path_root_array =  explode('/', $path_url);
    $path_root = $path_root_array[0];
    $path_count = count($path_root_array);
   
    
    
   if ($path_root == "news" ) {
     if ($path_root_array[1] == 'archive') {
        $menu_id[] = 520;
     } else {
        $menu_id[] = 462;
     }
      $class_active = in_array($mid,$menu_id) ? ' here' : '';
    }
     
   if ($path_root == "events" ) {
     $menu_id[] = 400;
        $class_active = in_array($mid,$menu_id) ? ' here' : '';
    }
    
 if ($path_root == "campuslife" && $path_root_array[1] == "augustana-experience" ) {

   $menu_id[] = 200;
   $class_active = in_array($mid,$menu_id) ? ' here' : '';
 }
    
    return '<li class="'. ($leaf ? 'leaf' . $class_active  : ($children ? 'expanded here ' . $class_active : 'collapsed')) . ($extraclass ? ' ' . $extraclass : '') . '">'. menu_item_link($mid, TRUE, $extraclass) . $children . "</li>\n";
  //  return '<li class="'. ($leaf ? 'leaf' : ($children ? 'expanded' : 'collapsed')) . ($extraclass ? ' ' . $extraclass : '') . '">'. menu_item_link($mid, TRUE, $extraclass) . $children ."</li>\n";  
}



/**
 * views template to output a view.
 * This code was generated by the views theming wizard
 * Date: Fri, 08/01/2008 - 12:31
 * View: homepage_ads
 *
 * This function goes in your template.php file
 */
function phptemplate_views_view_list_home_stories($view, $nodes, $type) {
  $fields = _views_get_fields();

  $taken = array();

  // Set up the fields in nicely named chunks.
  foreach ($view->field as $id => $field) {
    $field_name = $field['field'];
    if (isset($taken[$field_name])) {
      $field_name = $field['queryname'];
    }
    $taken[$field_name] = true;
    $field_names[$id] = $field_name;
  }

  // Set up some variables that won't change.
  $base_vars = array(
    'view' => $view,
    'view_type' => $type,
  );

  foreach ($nodes as $i => $node) {
    $vars = $base_vars;
    $vars['node'] = $node;
    $vars['count'] = $i;
    $vars['stripe'] = $i % 2 ? 'even' : 'odd';
    foreach ($view->field as $id => $field) {
      $name = $field_names[$id];
      $vars[$name] = views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $node, $view);
      if (isset($field['label'])) {
        $vars[$name . '_label'] = $field['label'];
      }
    }
    $items[] = _phptemplate_callback('views-list-home_stories', $vars);
  }
  if ($items) {
    return theme('item_list', $items);
  }
}

function phptemplate_views_view_list_home_events($view, $nodes, $type) {
  $fields = _views_get_fields();

  $taken = array();

  // Set up the fields in nicely named chunks.
  foreach ($view->field as $id => $field) {
    $field_name = $field['field'];
    if (isset($taken[$field_name])) {
      $field_name = $field['queryname'];
    }
    $taken[$field_name] = true;
    $field_names[$id] = $field_name;
  }

  // Set up some variables that won't change.
  $base_vars = array(
    'view' => $view,
    'view_type' => $type,
  );

  foreach ($nodes as $i => $node) {
    $vars = $base_vars;
    $vars['node'] = $node;
    $vars['count'] = $i;
    $vars['stripe'] = $i % 2 ? 'even' : 'odd';
    foreach ($view->field as $id => $field) {
      $name = $field_names[$id];
      $vars[$name] = views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $node, $view);
      if (isset($field['label'])) {
        $vars[$name . '_label'] = $field['label'];
      }
    }
    $items[] = _phptemplate_callback('views-list-home_events', $vars);
  }
  if ($items) {
    return theme('item_list', $items);
  }
}

function phptemplate_views_view_list_homepage_ads($view, $nodes, $type) {
  $fields = _views_get_fields();

  $taken = array();

  // Set up the fields in nicely named chunks.
  foreach ($view->field as $id => $field) {
    $field_name = $field['field'];
    if (isset($taken[$field_name])) {
      $field_name = $field['queryname'];
    }
    $taken[$field_name] = true;
    $field_names[$id] = $field_name;
  }

  // Set up some variables that won't change.
  $base_vars = array(
    'view' => $view,
    'view_type' => $type,
  );

  foreach ($nodes as $i => $node) {
    $vars = $base_vars;
    $vars['node'] = $node;
    $vars['count'] = $i;
    $vars['stripe'] = $i % 2 ? 'even' : 'odd';
    foreach ($view->field as $id => $field) {
      $name = $field_names[$id];
      $vars[$name] = views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $node, $view);
      if (isset($field['label'])) {
        $vars[$name . '_label'] = $field['label'];
      }
    }
    $items[] = _phptemplate_callback('views-list-homepage_ads', $vars);
  }
  if ($items) {
    return theme('item_list', $items);
  }
}



/**
 * views template to output a view.
 * This code was generated by the views theming wizard
 * Date: Mon, 08/04/2008 - 14:18
 * View: news
 *
 * This function goes in your template.php file
 */
function phptemplate_views_view_list_news($view, $nodes, $type) {
  $fields = _views_get_fields();

  $taken = array();

  // Set up the fields in nicely named chunks.
  foreach ($view->field as $id => $field) {
    $field_name = $field['field'];
    if (isset($taken[$field_name])) {
      $field_name = $field['queryname'];
    }
    $taken[$field_name] = true;
    $field_names[$id] = $field_name;
  }

  // Set up some variables that won't change.
  $base_vars = array(
    'view' => $view,
    'view_type' => $type,
  );

  foreach ($nodes as $i => $node) {
    $vars = $base_vars;
    $vars['node'] = $node;
    $vars['count'] = $i;
    $vars['stripe'] = $i % 2 ? 'even' : 'odd';
    foreach ($view->field as $id => $field) {
      $name = $field_names[$id];
      $vars[$name] = views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $node, $view);
      if (isset($field['label'])) {
        $vars[$name . '_label'] = $field['label'];
      }
    }
    $items[] = _phptemplate_callback('views-list-news', $vars);
  }
  if ($items) {
    return theme('item_list', $items);
  }
}

/**
 * views template to output a view.
 * This code was generated by the views theming wizard
 * Date: Mon, 08/04/2008 - 14:18
 * View: news
 *
 * This function goes in your template.php file
 */
function phptemplate_views_view_list_events($view, $nodes, $type) {
  $fields = _views_get_fields();

  $taken = array();

  // Set up the fields in nicely named chunks.
  foreach ($view->field as $id => $field) {
    $field_name = $field['field'];
    if (isset($taken[$field_name])) {
      $field_name = $field['queryname'];
    }
    $taken[$field_name] = true;
    $field_names[$id] = $field_name;
  }

  // Set up some variables that won't change.
  $base_vars = array(
    'view' => $view,
    'view_type' => $type,
  );

  foreach ($nodes as $i => $node) {
    $vars = $base_vars;
    $vars['node'] = $node;
    $vars['count'] = $i;
    $vars['stripe'] = $i % 2 ? 'even' : 'odd';
    foreach ($view->field as $id => $field) {
      $name = $field_names[$id];
      $vars[$name] = views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $node, $view);
      if (isset($field['label'])) {
        $vars[$name . '_label'] = $field['label'];
      }
    }
    $items[] = _phptemplate_callback('views-list-events', $vars);
  }
  if ($items) {
    return theme('item_list', $items);
  }
}

/**
 * views template to output a view.
 * This code was generated by the views theming wizard
 * Date: Mon, 08/18/2008 - 01:31
 * View: top_stories
 *
 * This function goes in your template.php file
 */
function phptemplate_views_view_list_top_stories($view, $nodes, $type) {
  $fields = _views_get_fields();

  $taken = array();

  // Set up the fields in nicely named chunks.
  foreach ($view->field as $id => $field) {
    $field_name = $field['field'];
    if (isset($taken[$field_name])) {
      $field_name = $field['queryname'];
    }
    $taken[$field_name] = true;
    $field_names[$id] = $field_name;
  }

  // Set up some variables that won't change.
  $base_vars = array(
    'view' => $view,
    'view_type' => $type,
  );
 
  foreach ($nodes as $i => $node) {
    $vars = $base_vars;
    $vars['node'] = $node;
    $vars['count'] = $i;
    $vars['stripe'] = $i % 2 ? 'even' : 'odd';
    foreach ($view->field as $id => $field) {
      $name = $field_names[$id];

      $vars[$name] = views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $node, $view);
      if (isset($field['label'])) {
        $vars[$name . '_label'] = $field['label'];
      }
    }
    $items[] = _phptemplate_callback('views-list-news', $vars);
  }
  if ($items) {
    return theme('item_list', $items);
  }
}
/**
 * views template to output a view.
 * This code was generated by the views theming wizard
 * Date: Mon, 08/18/2008 - 01:31
 * View: top_stories
 *
 * This function goes in your template.php file
 */
function phptemplate_views_view_list_top_events($view, $nodes, $type) {
  $fields = _views_get_fields();

  $taken = array();

  // Set up the fields in nicely named chunks.
  foreach ($view->field as $id => $field) {
    $field_name = $field['field'];
    if (isset($taken[$field_name])) {
      $field_name = $field['queryname'];
    }
    $taken[$field_name] = true;
    $field_names[$id] = $field_name;
  }

  // Set up some variables that won't change.
  $base_vars = array(
    'view' => $view,
    'view_type' => $type,
  );
 
  foreach ($nodes as $i => $node) {
    $vars = $base_vars;
    $vars['node'] = $node;
    $vars['count'] = $i;
    $vars['stripe'] = $i % 2 ? 'even' : 'odd';
    foreach ($view->field as $id => $field) {
      $name = $field_names[$id];

      $vars[$name] = views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $node, $view);
      if (isset($field['label'])) {
        $vars[$name . '_label'] = $field['label'];
      }
    }
    $items[] = _phptemplate_callback('views-list-events', $vars);
  }
  if ($items) {
    return theme('item_list', $items);
  }
}

function phptemplate_views_view_list_top_pressclips($view, $nodes, $type) {
  $fields = _views_get_fields();

  $taken = array();

  // Set up the fields in nicely named chunks.
  foreach ($view->field as $id => $field) {
    $field_name = $field['field'];
    if (isset($taken[$field_name])) {
      $field_name = $field['queryname'];
    }
    $taken[$field_name] = true;
    $field_names[$id] = $field_name;
  }

  // Set up some variables that won't change.
  $base_vars = array(
    'view' => $view,
    'view_type' => $type,
  );
 
  foreach ($nodes as $i => $node) {
    $vars = $base_vars;
    $vars['node'] = $node;
    $vars['count'] = $i;
    $vars['stripe'] = $i % 2 ? 'even' : 'odd';
    foreach ($view->field as $id => $field) {
      $name = $field_names[$id];

      $vars[$name] = views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $node, $view);
      if (isset($field['label'])) {
        $vars[$name . '_label'] = $field['label'];
      }
    }
    $items[] = _phptemplate_callback('views-list-recent_in_the_news', $vars);
  }
  if ($items) {
    return theme('item_list', $items);
  }
}

/**
 * views template to output a view.
 * This code was generated by the views theming wizard
 * Date: Mon, 08/18/2008 - 02:45
 * View: recent_in_the_news
 *
 * This function goes in your template.php file
 */
function phptemplate_views_view_list_in_the_news($view, $nodes, $type) {
  $fields = _views_get_fields();

  $taken = array();

  // Set up the fields in nicely named chunks.
  foreach ($view->field as $id => $field) {
    $field_name = $field['field'];
    if (isset($taken[$field_name])) {
      $field_name = $field['queryname'];
    }
    $taken[$field_name] = true;
    $field_names[$id] = $field_name;
  }

  // Set up some variables that won't change.
  $base_vars = array(
    'view' => $view,
    'view_type' => $type,
  );

  foreach ($nodes as $i => $node) {
    $vars = $base_vars;
    $vars['node'] = $node;
    $vars['count'] = $i;
    $vars['stripe'] = $i % 2 ? 'even' : 'odd';
    foreach ($view->field as $id => $field) {
      $name = $field_names[$id];
      $vars[$name] = views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $node, $view);
      if (isset($field['label'])) {
        $vars[$name . '_label'] = $field['label'];
      }
    }
    $items[] = _phptemplate_callback('views-list-recent_in_the_news', $vars);
  }
  if ($items) {
    return theme('item_list', $items);
  }
}
function phptemplate_views_view_list_archive($view, $nodes, $type) {
  $fields = _views_get_fields();

  $taken = array();

  // Set up the fields in nicely named chunks.
  foreach ($view->field as $id => $field) {
    $field_name = $field['field'];
    if (isset($taken[$field_name])) {
      $field_name = $field['queryname'];
    }
    $taken[$field_name] = true;
    $field_names[$id] = $field_name;
  }

  // Set up some variables that won't change.
  $base_vars = array(
    'view' => $view,
    'view_type' => $type,
  );

  foreach ($nodes as $i => $node) {
    $vars = $base_vars;
    $vars['node'] = $node;
    $vars['count'] = $i;
    $vars['stripe'] = $i % 2 ? 'even' : 'odd';
    foreach ($view->field as $id => $field) {
      $name = $field_names[$id];
      $vars[$name] = views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $node, $view);
      if (isset($field['label'])) {
        $vars[$name . '_label'] = $field['label'];
      }
    }
    $items[] = _phptemplate_callback('views-list-news-archive', $vars);
  }
  if ($items) {
    return theme('item_list', $items);
  }
}

function phptemplate_views_view_list_gallery($view, $nodes, $type) {
  $fields = _views_get_fields();

  $taken = array();

  // Set up the fields in nicely named chunks.
  foreach ($view->field as $id => $field) {
    $field_name = $field['field'];
    if (isset($taken[$field_name])) {
      $field_name = $field['queryname'];
    }
    $taken[$field_name] = true;
    $field_names[$id] = $field_name;
  }

  // Set up some variables that won't change.
  $base_vars = array(
    'view' => $view,
    'view_type' => $type,
  );

  foreach ($nodes as $i => $node) {
    $vars = $base_vars;
    $vars['node'] = $node;
    $vars['count'] = $i;
    $vars['stripe'] = $i % 2 ? 'even' : 'odd';
    foreach ($view->field as $id => $field) {
      $name = $field_names[$id];
      $vars[$name] = views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $node, $view);
      if (isset($field['label'])) {
        $vars[$name . '_label'] = $field['label'];
      }
    }
    $items[] = _phptemplate_callback('views-list-gallery', $vars);
  }
  if ($items) {
    return theme('item_list', $items);
  }
}

function theme_views_view_list_myview($view, $nodes, $type) {

  global $pager_page_array;
  $is_the_first_page = ($pager_page_array[0] == 0); // are we on "page 1" in the listing?
   
  $output = '';
     
  if ($is_the_first_page) {
    $the_first_node = array_shift($nodes);
    if ($the_first_node) {
      $output .= node_view(node_load($the_first_node->nid), 1);
    }
  }

  $output .=  theme_views_view_list($view, $nodes, $type);
  return $output;
}

/**
 * views template to output a view.
 * This code was generated by the views theming wizard
 * Date: Thu, 08/21/2008 - 10:32
 * View: recent_news
 *
 * This function goes in your template.php file
 */
function phptemplate_views_view_list_recent_news($view, $nodes, $type) {
  $fields = _views_get_fields();

  $taken = array();

  // Set up the fields in nicely named chunks.
  foreach ($view->field as $id => $field) {
    $field_name = $field['field'];
    if (isset($taken[$field_name])) {
      $field_name = $field['queryname'];
    }
    $taken[$field_name] = true;
    $field_names[$id] = $field_name;
  }

  // Set up some variables that won't change.
  $base_vars = array(
    'view' => $view,
    'view_type' => $type,
  );

  foreach ($nodes as $i => $node) {
    $vars = $base_vars;
    $vars['node'] = $node;
    $vars['count'] = $i;
    $vars['stripe'] = $i % 2 ? 'even' : 'odd';
    foreach ($view->field as $id => $field) {
      $name = $field_names[$id];
      $vars[$name] = views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $node, $view);
      if (isset($field['label'])) {
        $vars[$name . '_label'] = $field['label'];
      }
    }
    $items[] = _phptemplate_callback('views-list-recent_news', $vars);
  }
  if ($items) {
    return theme('item_list', $items);
  }
}

function phptemplate_views_view_list_upcoming_events($view, $nodes, $type) {
  $fields = _views_get_fields();

  $taken = array();

  // Set up the fields in nicely named chunks.
  foreach ($view->field as $id => $field) {
    $field_name = $field['field'];
    if (isset($taken[$field_name])) {
      $field_name = $field['queryname'];
    }
    $taken[$field_name] = true;
    $field_names[$id] = $field_name;
  }

  // Set up some variables that won't change.
  $base_vars = array(
    'view' => $view,
    'view_type' => $type,
  );

  foreach ($nodes as $i => $node) {
    $vars = $base_vars;
    $vars['node'] = $node;
    $vars['count'] = $i;
    $vars['stripe'] = $i % 2 ? 'even' : 'odd';
    foreach ($view->field as $id => $field) {
      $name = $field_names[$id];
      $vars[$name] = views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $node, $view);
      if (isset($field['label'])) {
        $vars[$name . '_label'] = $field['label'];
      }
    }
    $items[] = _phptemplate_callback('views-list-upcoming_events', $vars);
  }
  if ($items) {
    return theme('item_list', $items);
  }
}
function array_insert(&$array, $value, $offset)
{
    if (is_array($array)) {
        $array  = array_values($array);
        $offset = intval($offset);
        if ($offset < 0 || $offset >= count($array)) {
            array_push($array, $value);
        } elseif ($offset == 0) {
            array_unshift($array, $value);
        } else {
            $temp  = array_slice($array, 0, $offset);
            array_push($temp, $value);
            $array = array_slice($array, $offset);
            $array = array_merge($temp, $array);
        }
    } else {
        $array = array($value);
    }
    return count($array);
}

/**
 * views template to output a view.
 * This code was generated by the views theming wizard
 * Date: Fri, 08/01/2008 - 12:31
 * View: homepage_ads
 *
 * This function goes in your template.php file
 */

/**
 * views template to output a view.
 * This code was generated by the views theming wizard
 * Date: Thu, 08/28/2008 - 13:03album_image
 * View: albums
 *
 * This function goes in your template.php file
 */




function phptemplate_views_view_list_album($view, $nodes, $type) {
  $fields = _views_get_fields();
  $count = 0;
  $total = count($nodes);
  $halfway_point = floor($total) / 2;
  $break_point  = floor($total)/3;
  
  
  $left_items = array();
  $right_items = array(); 
 
  $taken = array();

  // Set up the fields in nicely named chunks.
  foreach ($view->field as $id => $field) {
    $field_name = $field['field'];

    if ($field['field'] == 'edit' && user_access('create link content')) {
        $item .= ' (' . views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $node, $view) . ')';
        } else {
        $item .=  views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $node, $view);
       }
    
    if (isset($taken[$field_name])) {
      $field_name = $field['queryname'];
    }
    $taken[$field_name] = true;
    $field_names[$id] = $field_name;
  }

  // Set up some variables that won't change.
  $base_vars = array(
    'view' => $view,
    'view_type' => $type,
  );

  foreach ($nodes as $i => $node) {
    $count++;
    
    $vars = $base_vars;
    $vars['node'] = $node;
    $vars['count'] = $i;
    $vars['stripe'] = $i % 2 ? 'even' : 'odd';
    foreach ($view->field as $id => $field) {
      $name = $field_names[$id];
      
       if ($field['field'] == 'edit' && user_access('create album content')) {
      $vars[$name] = ' (' . views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $node, $view) . ')';
       } else {
           $vars[$name] = views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $node, $view);
       }
      if (isset($field['label'])) {
        $vars[$name . '_label'] = $field['label'];
      }
    }
    $items[] = _phptemplate_callback('views-list-album', $vars);
    /*if($count > $halfway_point)  {
        $right_items[] = _phptemplate_callback('views-list-album_tags', $vars);
      } else {
        $left_items[] = _phptemplate_callback('views-list-album_tags', $vars);
      }
   */
}
  
  
 // $col1 = array_slice($items, 0, $break_point);
  //$col2 = array_slice($items, 0, $break_point + $breakpoint);
  //$col3 = $items;
     // returns "a", "b", and "c"
  
  //if ($items) {
  //  return theme('item_list', $items);
  //}

  //  return theme('item_list',  $left_items) . theme('item_list', $right_items);
   return theme('item_list',  $items);
  
}

function phptemplate_item_list_test($items = array(), $title = NULL, $type = 'ul', $attributes = NULL) {
  $output = '<div class="item-list">';
  if (isset($title)) {
    $output .= '<h3>'. $title .'</h3>';
  }

  if (!empty($items)) {
    $output .= "<$type" . drupal_attributes($attributes) . '>';
    foreach ($items as $item_key=>$item) {
      $attributes = array();
      $children = array();
      if (is_array($item)) {
        foreach ($item as $key => $value) {
          if ($key == 'data') {
            $data = $value;
          }
          elseif ($key == 'children') {
            $children = $value;
          }
          else {
            $attributes[$key] = $value;
          }
        }
      }
      else {
        $data = $item;
      }
      if (count($children) > 0) {
        $data .= theme_item_list($children, NULL, $type, $attributes); // Render nested list
      }
     
      if($item_key == 0) {
        $attributes['class'] = (isset($attributes['class'])? $attributes['class'] .= ' first' : 'first');
      } elseif($item_key == count($items)-1){
        $attributes['class'] = (isset($attributes['class'])? $attributes['class'] .= ' last' : 'last');
      }
     
      $output .= '<li' . drupal_attributes($attributes) . '>'. $data .'</li>';
    }
    $output .= "</$type>";
  }
  $output .= '</div>';
  return $output;
}
function phptemplate_item_list($items = array(), $title = NULL, $type = 'ul', $attributes = NULL) {
  $output = '<div class="item-list">';
  if (isset($title)) {
    $output .= '<h3>'. $title .'</h3>';
  }

  if (!empty($items)) {
    $output .= "<$type" . drupal_attributes($attributes) . '>';
    foreach ($items as $item_key=>$item) {
      $attributes = array();
      $children = array();
      if (is_array($item)) {
        foreach ($item as $key => $value) {
          if ($key == 'data') {
            $data = $value;
          }
          elseif ($key == 'children') {
            $children = $value;
          }
          else {
            $attributes[$key] = $value;
          }
        }
      }
      else {
        $data = $item;
      }
      if (count($children) > 0) {
        $data .= theme_item_list($children, NULL, $type, $attributes); // Render nested list
      }
     
      if($item_key == 0) {
        $attributes['class'] = (isset($attributes['class'])? $attributes['class'] .= ' first' : 'first');
      } elseif($item_key == count($items)-1){
        $attributes['class'] = (isset($attributes['class'])? $attributes['class'] .= ' last' : 'last');
      }
     
      $output .= '<li' . drupal_attributes($attributes) . '>'. $data .'</li>';
    }
    $output .= "</$type>";
  }
  $output .= '</div>';
  return $output;
}

/**
 * views template to output a view.
 * This code was generated by the views theming wizard
 * Date: Thu, 08/14/2008 - 01:04
 * View: links_resources
 *
 * This function goes in your template.php file
 */


function augie_views_view_list_links_resources($view, $nodes, $type) {
  $fields = _views_get_fields();
  $count = 0;
  
  $total = count($nodes);
  $halfway_point = floor($total) / 2;
  
  $left_items = array();
  $right_items = array(); 
 
  //dprint_r($nodes);
  
  foreach ($nodes as $node) {

    $count++;
    $item = '';   
    
      foreach ($view->field as $field) {
      //$vars[$count-1][$field['field']] = views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $node, $view);
        if ($field['field'] == 'edit' && user_access('create link content')) {
        $item .= ' (' . views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $node, $view) . ')';
        } else {
        $item .=  views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $node, $view);
       }
        //echo $item . '<hr>';
      }
      // $item  = substr($item , 0, -3);  
    
      if ($total > 5) {
      if($count > $halfway_point)  {
        $right_items[] = $item; // l($node->title, "node/$node->nid");
      } else {
        $left_items[] = $item; // l($node->title, "node/$node->nid");   
      }
      } else {
         $left_items[] = $item; // l($node->title, "node/$node->nid");
  
      }
  }
 
  
  
  if ($left_items || $right_items) {
    return theme('item_list_test', $left_items) . theme('item_list_test', $right_items);
  }
}

function augie_imagefield_image_imagecache_lightbox2($view_preset, $field, $item, $node, $rel = 'lightbox') {

  // Can't show current node page in a lightframe on the node page.
  // Switch instead to show it in a lightbox.
  if ($rel == 'lightframe' && arg(0) == 'node' && arg(1) == $node->nid) {
    $rel = 'lightbox';
    $item['lightbox_preset'] = 'original';
  }
  $orig_rel = $rel;

  // Set up the caption.
  $node_link = '';
  $attributes = array();
  if (!empty($item['nid'])) {
    $target = variable_get('lightbox2_node_link_target', FALSE);
    if (!empty($target)) {
      $attributes = array('target' => $target);
    }
   /* $node_link_text = variable_get('lightbox2_node_link_text', 'View Image Details');
    if (!empty($node_link_text)) {
      $node_link .= '<br /><br />'. l($node_link_text, 'node/'. $item['nid'], $attributes);
    } */
  }

  if ($orig_rel == 'lightframe') {
    $frame_width = variable_get('lightbox2_default_frame_width', 600);
    $frame_height = variable_get('lightbox2_default_frame_height', 400);
    $frame_size = 'width:'. $frame_width .'px; height:'. $frame_height .'px;';
    $rel = preg_replace('/\]$/', "|$frame_size]", $rel);
  }
  
  $image_title = (!empty($item['title']) ? $item['title'] : $item['alt']);
  
  if (variable_get('lightbox2_imagefield_use_node_title', FALSE)) {
    
    $node = node_load($node->nid);
    
    $image_title = '<div class="img_title">'.$node->title.'</div>';
    
    if ($node->body) {
    $image_title .= $node->body;
    }
  }
  
 if ($node->body) {
    $caption = $node->body;
   
  } else {
    $caption = '';
  }

  $item['alt'] = $node->title;
  $item['title'] = $node->title;

  // Set up the rel attribute.
  $imagefield_grouping = variable_get('lightbox2_imagefield_group_node_id', 1);
  if ($imagefield_grouping == 1) {
    $rel = $rel .'['. $field['field_name'] .']['. $caption .']';
  }
  else if ($imagefield_grouping == 2 && !empty($item['nid'])) {
    $rel = $rel .'['. $item['nid'] .']['. $caption .']';
  }
  else if ($imagefield_grouping == 3 && !empty($item['nid'])) {
    $rel = $rel .'['. $field['field_name'] . $item['nid'] .']['. $caption .']';
  }
  else {
    $rel = $rel .'[]['. $caption .']';
  }

  $link_attributes = array(
    'rel' => $rel,
  );

  if ($view_preset == 'original') {
    $image = theme('lightbox2_image', $item['filepath'], $item['alt'], $item['title'], $attributes);
  }
  else {
    $image = theme('imagecache', $view_preset, $item['filepath'], $item['alt'], $item['title'], $attributes);
  }
  if ($item['lightbox_preset'] == 'node') {
    $output = l($image, 'node/'. $node->nid .'/lightbox2', $link_attributes, NULL, NULL, FALSE, TRUE);
  }
  else if ($item['lightbox_preset'] == 'original') {
    $output = l($image, file_create_url($item['filepath']), $link_attributes, NULL, NULL, FALSE, TRUE);
  }
  else {
    $output = l($image, lightbox2_imagecache_create_url($item['lightbox_preset'], $item['filepath']), $link_attributes, NULL, NULL, FALSE, TRUE);
  }

  return $output;
}



/**
 * Render a panel pane like a block.
 *
 * A panel pane can have the following fields:
 *
 *  - $pane->type -- the content type inside this pane
 *  - $pane->subtype -- The subtype, if applicable. If a view it will be the
 *    view name; if a node it will be the nid, etc.
 *  - $content->title -- The title of the content
 *  - $content->content -- The actual content
 *  - $content->links -- Any links associated with the content
 *  - $content->more -- An optional 'more' link (destination only)
 *  - $content->admin_links -- Administrative links associated with the content
 *  - $content->feeds -- Any feed icons or associated with the content
 *  - $content->subject -- A legacy setting for block compatibility
 *  - $content->module -- A legacy setting for block compatibility
 *  - $content->delta -- A legacy setting for block compatibility
 */
function augie_panels_pane($content, $pane, $display) {
  if (!empty($content->content)) {
    $idstr = $classstr = '';
    if (!empty($content->css_id)) {
      $idstr = ' id="' . $content->css_id . '"';
    }
    if (!empty($content->css_class)) {
      $classstr = ' ' . $content->css_class;
    }

    $output = "<div class=\"entry split clearfix\">\n";
    
    if (!empty($content->title)) {
      $output .= "<h3>".$content->title."</h3>\n";
    }

   

    $output .= $content->content;

  

 

    $output .= "</div>\n";
    return $output;
  }
}

/**
 * Display the XML document.
 */
function augie_slideshowpro_feed($view, $nodes, $type) {
  global $base_url;
  if ($type != 'page' || $view->type != 'slideshowpro_xml') {
    return drupal_not_found();
  }

  $size = 'preview';
  foreach ($view->filter as $filter) {
    if ($filter['field'] == 'slideshowpro.tid') {
      $size = $filter['options'];
    }
  }
  
  $album_terms = array();
  $albums = array();
  $output = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
  $output .= "<gallery>\n";

  foreach ($nodes as $n) {
    $node = node_load($n->nid);
    $tids = array();
    if ($n->tid) {
      $tids = array($n->tid);
      $album_terms[$n->tid] = taxonomy_get_term($n->tid);
    }
    // If no image gallery tid was passed in and image gallery is installed, get tids from node.
    else if (module_exists('image_gallery')) {
      foreach ($node->taxonomy as $term) {
        if ($term->vid == _image_gallery_get_vid()) {
          $album_terms[$term->tid] = $term;
          $tids[] = $term->tid;
        }
      }
    
    } else {
    foreach ($node->taxonomy as $term) {
            if ($term->vid == 7) {
              $album_terms[$term->tid] = $term;
              $tids[] = $term->tid;
            }
          }
    }
    // Stick images with no album in an album called "In no album"
    if (!count($tids)) {
      $tids = array(0);
      $album->name = t('In no album');
      $album_terms[0] = $album;
    }
    $image = theme('slideshowpro_xml_image', $node, $size);
    // An image can be in more than one album.
    foreach ($tids as $tid) { 
      $albums[$tid][] = $image;
    }
  }
  ksort($albums);
  foreach ($albums as $tid => $images) {
    $output .= _slideshowpro_xml_album($album_terms[$tid], $images);
  }

  $output .= "</gallery>\n";
  drupal_set_header('Content-Type: text/xml; charset=utf-8');
  print $output;
  module_invoke_all('exit');
  exit; 
}


function augie_views_bonus_view_grid($view, $nodes, $type) {
  drupal_add_css(drupal_get_path('module', 'views_bonus_grid') .'/views_bonus.css');
  $fields = _views_get_fields();
  $content = '<table class="view-grid view-grid-' . $view->name . '">';
  
  // set default count.
  $cols = $view->gridcount ? $view->gridcount : 4;

  $count = 0;
  $total = count($nodes);
  foreach ($nodes as $node) {
    $item = '';
    if ($count % $cols == 0) { 
      $content .= '<tr>'; 
    }

    foreach ($view->field as $field) {
      if ($fields[$field['id']]['visible'] !== FALSE) {
        if ($field['label']) {
          $item .= "<div class='view-label view-label-$field[queryname]'>" . $field['label'] . "</div>";
          }

       if ($field['field'] == 'edit' && user_access('create album content')) {
        $item .= "(" . views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $node, $view) . ")";
       } else {
             $item .= "<div class='view-field view-data-$field[queryname]'>" . views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $node, $view) . "</div>";
       }
        
      
      }
    }
    $content .= "<td class='view-grid-item'><div class='view-item view-item-$view->name'>$item</div></td>\n"; 

    $count++;
    if ($count % $cols == 0 || $count == $total) {
      $content .= '</tr>';
    }
  }
  $content .= '</table>';
  
  if ($content) {
    return $content;
  }
}
?>