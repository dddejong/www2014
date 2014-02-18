<div id="wrapper">
	<div id="wrapper-shade">
	
	  <div id="titlebar">
			<h1 class="<?php print $title_class; ?>"><?php print $title_class; ?></h1>
		
			<?php
			if ($breadcrumb != '') {
				print $breadcrumb;
			} ?>
	  </div>
	  
	 <div id="content" class="clearfix">
		
			<div id="sidebar">
			 <div class="gateway">
			
					<?php print $gateway; ?>
			
			</div>
			
			<?php print $left; ?>
			</div><!--END SIDEBAR -->
			
			<div id="main">
			<?php	
 		
				if ($tabs != '') {
				print '<div class="tabs">'. $tabs .'</div>';
				}
			
				if ($messages != '') {
				print '<div id="messages">'. $messages .'</div>';
				}
					      
		 
				if ($title != '') {
				//print '<h2>'. $title .'</h2>';
				}      	
			
				print $help; // Drupal already wraps this one in a class      
		
				if ( $user->uid ) {
				  	print '<div class="admin-right clearfix">';
						print l("Add new link", "node/add/link", null,'destination=students', null, true, true); 
				 		print '</div>';
						print $top;
				}

# Uncomment line below before Deleting Gateway node, recomment upon successful deletion
#  print $content;


$tid = db_result(db_query("SELECT t.tid FROM {term_data} t WHERE t.name ='%s' AND t.vid = 4",ucfirst($path_root)));
  
/*Enter the name of the view that should show the nodes */
$view_name = "links_resources";
$vocabulary_id = 4;

/* Only edit if you know what you're doing */

$view = views_get_view($view_name);

if (!$view) {
	print ("Missing View");
    drupal_not_found();
    exit;
}

//dprint_r($view);

    foreach(taxonomy_get_tree($vocabulary_id,$tid,-1,1) as $value) {
  	
		print t("<div class='entry clearfix'>");
		print t("<h2>" . $value->name . "</h2>");

	   $view->filter[2]['value'] = array (0 => $value->tid,); // set the node type via the second exposed filter.
	    
		$view->page_type = 'list';
		print views_build_view('embed', $view, array($value->name), false, 999);
		
		print t("</div>");
}

		?>
			
			
				
				
				
			</div><!--END MAIN-->
			
		</div><!--END CONTENT -->
	</div><!--END WRAPPER SHADE-->
</div><!--END WRAPPER-->

