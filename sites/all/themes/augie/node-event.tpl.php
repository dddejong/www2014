<?php //dprint_r ($node); ?>
<?php if (!$page) { ?>
	<h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
 	<div class="content clear-block">
	
	<?php 
  	if (file_exists($field_image[0]['filepath'])) { 
  		print theme('imagecache', 'thumbnail', $field_image[0]['filepath'], '1','2',array('class' => 'thumbnail')); 
	}
 
	} 
?>

<?php
   
if ($page) { 
	
	if ($node->status== 0) {
 		print '<div class="message">UNPUBLISHED CONTENT</div>';
 	}
         if ($title != '') {
        print '<h2>'.$title.'</h2>';
        }
 ?>

<div class="content clear-block">
	<?php 
	if (file_exists($field_image[0]['filepath'])) { 
  		print theme('imagecache', 'full', $field_image[0]['filepath'], $node->node_title,$node->node_title,array('class' => 'news_full')); 
	}
	
	if ($node->field_date[0]['value'] == $node->field_date[0]['value2']) {
		$date_hd = 'DATE: ';
	
	} else {
		$date_hd = 'DATES: ';
	}

	?>
	<div id="event-details">
	<?php 
	if ($node->field_date[0]['view']) {
		print '<div class="dateline-event"><span class="item">'.$date_hd.'</span>' . $node->field_date[0]['view'] . '</div>'; 
	}
	?>
	
	<?php 
	if ($node->field_times[0]['view']) {
		print '<div class="dateline-event"><span class="item">TIME(S): </span>' . $node->field_times[0]['view'] . '</div>';
	}
	?>
	
	<?php 
	if ($node->field_location[0]['view'] ) {
		print '<div class="dateline-event"><span class="item">LOCATION: </span>' . $node->field_location[0]['view'] . '</div>'; 
	}
	?>
	
	<?php 
	if ($node->field_ticket_info[0]['view'] ) {
		print '<div class="dateline-event"><span class="item">TICKET INFO: </span>' . $node->field_ticket_info[0]['view'] . '</div>'; 
	}
	?>
	
	</div>
  <?php 
	if ($node->content['body']['#value']) {
		print '<div class="dateline-event"><span class="item">EVENT DETAILS: </span>' . $node->content['body']['#value'] . '</div>'; 
	}
	?>
      
	<?php 
	if ($node->field_contact_0[0]['view']) {
		print '<div class="dateline-event"><span class="item">CONTACT INFO: </span>' . $node->field_contact_0[0]['view'] . '</div>'; 
	}
	?>
	
      
 
  
	
 <?php
}

  
  ?>
    
    
  
  </div>
  
  <?php if (!$page) { ?>
 <a href="<?php print $node_url ?>" title="<?php print $title ?>">read more</a>
  <?php } ?>
 
