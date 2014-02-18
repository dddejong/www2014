<?php 


/*
$feature_1 = $field_feature_1[0]['nid'];
$feature_1 = node_load($feature_1);
*/

$feature_1 = $field_feature_1[0]['nid'];
$feature_1 = node_load($feature_1);

$feature_2 = $field_feature_2[0]['nid'];
$feature_2 = node_load($feature_2);

$feature_3 = $field_feature_3[0]['nid'];
$feature_3 = node_load($feature_3);




?>

<div class="lead">
<?php print $node->content['body']['#value']; ?>
</div>

<h3 class="title">Items of interest</h3>

<ul class="list-features clearfix">
	<li><?php 
  						if ($feature_1->field_image[0]['filepath'] && file_exists($feature_1->field_image[0]['filepath'])) { 
  							print theme('imagecache', 'channel_thumbnail', $feature_1->field_image[0]['filepath'], $feature_1->title,$feature_1->title,array('class' => 'thumbnail')); 
						} ?>	

						  <h5><?php print l($feature_1->title, "node/$feature_1->nid");  ?></h5>
							<?php print $feature_1->field_teaser[0]['value']; ?>
							
					  </li>
						<li>
						<?php 
  						if ($feature_2->field_image[0]['filepath'] && file_exists($feature_2->field_image[0]['filepath'])) { 
  							print theme('imagecache', 'channel_thumbnail', $feature_2->field_image[0]['filepath'], $feature_2->title,$feature_2->title,array('class' => 'thumbnail')); 
						} ?>	  
						  
						  <h5><?php print l($feature_2->title, "node/$feature_2->nid");  ?></h5>
							<?php print $feature_2->field_teaser[0]['value']; ?>
							
							
						</li>
						<li class="end">
						<?php 
  						if ($feature_3->field_image[0]['filepath'] && file_exists($feature_3->field_image[0]['filepath'])) { 
  							print theme('imagecache', 'channel_thumbnail', $feature_3->field_image[0]['filepath'], $feature_3->title,$feature_3->title,array('class' => 'thumbnail')); 
						} ?>	  
						<h5><?php print l($feature_3->title, "node/$feature_3->nid");  ?></h5>
						  	<?php print $feature_3->field_teaser[0]['value']; ?>
							
						</li>
					</ul>
				

<?php if ($node->field_channel_footer[0]['value']) { ?>
<div class="entry">
<?php print $node->field_channel_footer[0]['value']; ?>
<?php } ?>
</div><!--END ENTRY-->


