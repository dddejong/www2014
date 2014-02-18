<?php if (!$page) { ?>
<h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
	<p class="dateline">
		<?php print $node->field_publish_date[0]['view']; ?>
	</p>
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
 	?> 
 	
 	<p class="dateline">
		<?php print $node->field_publish_date[0]['view']; ?>
	</p>
 	
 	<div class="content clear-block">
  		<?php 
  		if (file_exists($field_image[0]['filepath'])) { 
 			print theme('imagecache', 'full', $field_image[0]['filepath'], $node->node_title,$node->node_title,array('class' => 'news_full')); 
  		}
 	}

  	print $node->content['body']['#value'];
 
	?>
</div>
  
<?php if (!$page) { ?>
	<a href="<?php print $node_url ?>" title="<?php print $title ?>">read more</a>
 <?php } ?>