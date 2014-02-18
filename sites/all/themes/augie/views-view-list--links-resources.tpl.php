<?php
/**
 * @file views-view-list.tpl.php
 * Default simple view template to display a list of rows.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $options['type'] will either be ul or ol.
 * @ingroup views_templates
 */
  $total = count($rows);
  $halfway_point = floor($total / 2);
  
?>
<?php if (!empty($title)) : ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>

  <?php if ($total > 5) { ?>
	<div class="item-list">
    <<?php print $options['type']; ?>>

      <?php 
          foreach ($rows as $id => $row): 
          $count++;
          if($count > $halfway_point)  {
          $count = 0;
      ?>

        </<?php print $options['type']; ?>>
		</div><!-- /item-list -->
		
		<div class="item-list">
        <<?php print $options['type']; ?>>
      <?php } ?>
        <li><?php print $row; ?></li>
      <?php endforeach; ?>
    </<?php print $options['type']; ?>>
	</div><!-- /item-list -->

  <?php } 
	else { ?>

	<div class="item-list">
    <<?php print $options['type']; ?>>
      <?php foreach ($rows as $id => $row): ?>
        <li><?php print $row; ?></li>
      <?php endforeach; ?>
    </<?php print $options['type']; ?>>
	</div><!-- /item-list -->
  <?php } ?>


<?php
/*

function augie_views_view_list_links_resources($view, $nodes, $type) {
  $fields = _views_get_fields();
  $count = 0;
  
  $total = count($nodes);
  $halfway_point = floor($total) / 2;
  
  $left_items = array();
  $right_items = array(); 
 
  //dprint_r($nodes);
  
  foreach ($nodes as $node) {

    $count++;
    $item = '';   
    
      foreach ($view->field as $field) {
      //$vars[$count-1][$field['field']] = views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $node, $view);
        if ($field['field'] == 'edit' && user_access('create link content')) {
        $item .= ' (' . views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $node, $view) . ')';
        } else {
        $item .=  views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $node, $view);
       }
        //echo $item . '<hr>';
      }
      // $item  = substr($item , 0, -3);  
    
      if ($total > 5) {
      if($count > $halfway_point)  {
        $right_items[] = $item; // l($node->title, "node/$node->nid");
      } else {
        $left_items[] = $item; // l($node->title, "node/$node->nid");   
      }
      } else {
         $left_items[] = $item; // l($node->title, "node/$node->nid");
  
      }
  }
 
  
  
  if ($left_items || $right_items) {
    return theme('item_list_test', $left_items) . theme('item_list_test', $right_items);
  }
}
*/

?>
