<?php
function augie_preprocess_page(&$variables, $hook) {

  if ((arg(0) == 'node') && (arg(1) == 'add' || arg(2) == 'edit')) {
    $vars['template_files'][] =  'page-node-add-edit';
  } elseif ($variables['node']->type != "") {
    $variables['template_files'][] = "page-node-" . $variables['node']->type;
  }

}
function augie_preprocess(&$vars, $hook) {
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
    
 //   if ($path_root_array[2] == "edit") { $path_root = "administrator"; }
 //   if ($path_root_array[1] == "add" || $path_root == "devel") { $path_root = "administrator"; }

    
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
    'center-for-western-studies',
    'vikingdays',
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
  if (isset($node)) {
    $vars['node_type'] = $node->type;
  }
 
  // Menutrails helper
     if ($path_root == "events" ) {
      $menu_id = 400;
    }
/*
print '<pre>';
print_r($vars);
print '</pre>';
*/
      return $vars;
    }
    


function augie_breadcrumb($breadcrumb) {
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
       $bc = token_replace('[field_publish_date-yyyy]', 'node', $node);
       //print_r($bc);
       //drupal_set_message(print_r($breadcrumb, true));
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


function augie_preprocess_menu_block_wrapper(&$variables) {
  $variables['classes_array'][] = 'menu-block-' . $variables['delta'];
  $variables['classes_array'][] = 'menu-name-' . $variables['settings']['menu_name'];
  $variables['classes_array'][] = 'parent-mlid-' . $variables['settings']['parent_mlid'];
  $variables['classes_array'][] = 'menu-level-' . $variables['settings']['level'];
  $variables['classes'] = check_plain(implode(' ', $variables['classes_array']));
  $variables['template_files'][] = 'menu-block-wrapper-' . $variables['settings']['menu_name'];
}

?>
