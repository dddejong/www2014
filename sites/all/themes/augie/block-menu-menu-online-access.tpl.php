<?php ?>

<div id="block-<?php print $block->module .'-'. $block->delta; ?>" class="block block-<?php print $block->module ?>">
	
<?php if ($block->subject): ?>
	<h2><?php print $block->subject ?></h2>
	<h3 class="title">LOG IN TO:</h3>
<?php endif;?>

	<div class="content">
		<?php print $block->content ?>
	</div>
	
</div>