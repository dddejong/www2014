<?php 


$feature_1 = $field_feature_1[0]['nid'];
$feature_1 = node_load($feature_1);
/*
$feature_1 = $field_feature_1[0]['nid'];
$feature_1 = node_load($feature_1);
*/

$feature_2 = $field_feature_2[0]['nid'];
$feature_2 = node_load($feature_2);

$feature_3 = $field_feature_3[0]['nid'];
$feature_3 = node_load($feature_3);
$feature_4 = $field_feature_4[0]['nid'];
$feature_4 = node_load($feature_4);
?>

<div class="lead">
<?php print $node->content['body']['#value']; ?>
</div>
<h3 class="title">Items of interest</h3>

<ul class="list-features clearfix">
						<li>
							<img src="images/temp-190x120.gif" alt="" width="190" height="120" />
						  <h5><?php print $feature_1->title; ?></h5>
							<?php print $feature_1->teaser; ?>
							<a href="node/<?php print $feature_1->nid; ?>">Read more</a>
					  </li>
						<li>
						  <img src="images/temp-190x120.gif" alt="" width="190" height="120" />
						  <h5><?php print $feature_2->title; ?></h5>
							<?php print $feature_2->teaser; ?>
							<a href="node/<?php print $feature_2->nid; ?>">Read more</a>
						</li>
						<li class="end">
							<img src="images/temp-190x120.gif" alt="" width="190" height="120" />
						  <h5><?php print $feature_3->title; ?></h5>
							<?php print $feature_3->teaser; ?>
							<a href="node/<?php print $feature_3->nid; ?>">Read more</a>
						</li>
					</ul>
				


<div class="entry">
					<h2><?php print $feature_4->title; ?></h2>
					<?php print $feature_4->teaser; ?>
					<a href="node/<?php print $feature_4->nid; ?>">Read more</a>
					  </div><!--END ENTRY-->


