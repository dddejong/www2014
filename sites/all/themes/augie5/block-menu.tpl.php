<div id="block-<?php print $block->module .'-'. $block->delta; ?>" class="clear-block block block-<?php print $block->module ?>">

<?php
//print_r($path_root_array);

if ($block->subject) { ?>
 <h3 class="title"><?php print $block->subject ?></h3>
<?php }

print $block->content ?>
</div>
