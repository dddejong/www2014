<?php
/**
 * @file
 * Default theme implementation to wrap menu blocks.
 *
 * Available variables:
 * - $content: The unordered list containing the menu.
 * - $classes: A string containing the CSS classes for the DIV tag. Includes:
 *   menu-block-DELTA, menu-name-NAME, parent-mlid-MLID, and menu-level-LEVEL.
 * - $classes_array: An array containing each of the CSS classes.
 *
 * The following variables are provided for contextual information.
 * - $settings: An array of the block's configuration settings. Includes
 *   menu_name, parent_mlid, level, follow, depth, expanded, and sort.
 *
 * @see template_preprocess_menu_block_wrapper()
 */
?>
<?php
  $path_url = $_REQUEST['q'];
  $path_root_array =  explode('/', $path_url);
  $path_count = count($path_root_array);
  $path_root = $path_root_array[0];


if (
    ($path_root_array[4] == 'sesquicentennial-celebration'
        && $path_root_array[0] == 'about') ||
    ($path_root_array[4] == 'college-events'
        && $path_root_array[0] == 'about') ||
    ($path_root_array[4] == 'viking-days'
        && $path_root_array[0] == 'about') ||
    ($path_root_array[1] == 'financing-your-education'
        && $path_root_array[0] == 'admission') ||
    ($path_root_array[1] == 'value'
        && $path_root_array[0] == 'admission') ||
    ($path_root_array[4] == 'spark'
        && $path_root_array[0] == 'about') ||
      ($path_root_array[1] == 'rec'
        && $path_root_array[0] == 'campuslife') ||
      ($path_root_array[1] == 'campus-safety'
        && $path_root_array[0] == 'campuslife') ||
      ($path_root_array[1] == 'career-center'
        && $path_root_array[0] == 'campuslife') ||
      ($path_root_array[1] == 'theatre-performance'
        && $path_root_array[0] == 'arts') ||
    ($path_root_array[4] == 'commencement'
        && $path_root_array[0] == 'about')) {
    // hide the menu
  } else {

?>
<div class="<?php print $classes; ?>">
  <?php print $content; ?>
</div>
<?php } ?>
