<?php //dprint_r($node); ?>
<?php if (!$page) { ?>
<h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>

<?php 
  if (file_exists($field_image[0]['filepath'])) { 
  	
  print theme('imagecache', 'thumbnail', $field_image[0]['filepath'], '1','2',array('class' => 'thumbnail')); 

  }
 
} ?>
<?php if ($page) { ?>
<?php if ( user_access('create album_image content') ) {
				  	print '<div class="admin-right clearfix">';
				  	$query = (array('query' => 'destination=node/'. $node->nid ));
						print '('.l("Add new photo", "node/add/album-image",$query).')'; 
				 			print '<br /><span class="tip">tags:  <em>' . $node->field_gallery_view[0]['vargs'] .'</em></span';
					
						print '</div>';
						
				}
	
					
	?>
<h2><?php print $node->title;?><?php print $edit;?></h2>

	
  		<?php print $node->content['body']['#value'];?>

  
<?php  } ?>
  
  
  <?php print $node->field_gallery_view[0]['view'];
  
 // print $links;
  ?>
    
    

  
  <?php if (!$page) { ?>
 <a href="<?php print $node_url ?>" title="<?php print $title ?>">read more</a>
  <?php } ?>
  


 