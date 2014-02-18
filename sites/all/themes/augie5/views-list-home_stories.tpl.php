<?php $file = _imagefield_file_load($node->node_data_field_image_field_image_fid); ?>
<?php $img = theme('imagecache', 'thumbnail', $file['filepath'], $node->node_title,$node->node_title,array('class' => 'news_thumb'));?>

<h3 class="entry-title"><?php print $title?> <?php if ($edit) { print '<span class="edit-small">('.$edit.')</span>'; } ?></h3>
	<div class="post-meta">
		<div class="published">
		<?php print $field_publish_date_value?>
		</div>
	</div>
	<div class="entry-content">
		<?php 
		if (file_exists($file['filepath'])) { 
			print l($img, 'node/'.$node->nid, null, null, null, true, true); 
		}	
		?>
		<?php 
		if ($field_teaser_value) {
			print $field_teaser_value; 
		} else {
			print $body;		
		}
		?>
	</div>
	
 