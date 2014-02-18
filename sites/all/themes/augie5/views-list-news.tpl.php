<?php if (module_exists('devel')) {dprint_r($view);} ?>

 <div class="entry">
	<h3 class="entry-title"><?php print $title?></h3>
	<p class="dateline">
		<?php print $field_publish_date_value?>
	</p>
	
<?php $file = _imagefield_file_load($node->node_data_field_image_field_image_fid); ?>
<?php $img = theme('imagecache', 'thumbnail', $file['filepath'], $node->node_title,$node->node_title,array('class' => 'news_thumb'));?>
<?php 
if (file_exists($file['filepath'])) { 
			print l($img, 'node/'.$node->nid, null, null, null, true, true); 
		}	
	?>
	<?php if ($field_teaser_value) {
		
		
		print $field_teaser_value; 
	} else {
		print $body;		
	}

?>
	<div class="read-more"><?php print $link; ?> <?php if ($edit) { print '('.$edit.')'; } ?></div>
</div>

  


 
 



