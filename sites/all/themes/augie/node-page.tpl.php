
<?php if (!$page) { ?>
<h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
 <div class="content clear-block">
<?php 
 // if (file_exists($field_image[0]['filepath'])) { 
  	
 // print theme('imagecache', 'thumbnail', $field_image[0]['filepath'], '1','2',array('class' => 'thumbnail')); 

 // }
 
} ?>



    <?php
 if (file_exists($field_title_image[0]['filepath'])) { 
  	
  print theme('imagecache', 'title_image', $field_title_image[0]['filepath'], $node->node_title,$node->node_title,array('class' => 'title_image')); 

 }
    	if ($title != '') {
			print '<h2>'.$title.'</h2>';
		}      	
		print $help; // Drupal already wraps this one in a class      
   
 if ($page) { ?>
 	 <div class="content clear-block">
  <?php 
 }

  print $node->content['body']['#value'];
 // print $links;
  ?>
    
    
  
  </div>
  
  <?php if (!$page) { ?>
 <a href="<?php print $node_url ?>" title="<?php print $title ?>">read more</a>
  <?php } ?>
  


 