<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

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
//      ($path_url == 'about/college-offices-and-affiliates/human-resources') ||

  if (
      ($path_root_array[3] == 'college-events'
        && $path_root_array[0] == 'about') ||
      ($path_root_array[2] == 'tracy-riddle'
        && $path_root_array[0] == 'campuslife') ||
      ($path_root_array[2] == 'new-student-orientation'
        && $path_root_array[0] == 'campuslife') ||
      ($path_root_array[1]
        && $path_root_array[0] == 'information-technology') ||
      ($path_root_array[4] == 'sesquicentennial-celebration'
        && $path_root_array[0] == 'about') ||
      ($path_root_array[4] == 'viking-days'
        && $path_root_array[0] == 'about') ||
      ($path_root_array[4] == 'spark'
        && $path_root_array[0] == 'about') ||
      ($path_root_array[4] == 'commencement'
        && $path_root_array[0] == 'about') ||
      ($path_root_array[1] == 'financing-your-education'
        && $path_root_array[0] == 'admission') ||
      ($path_root_array[1] == 'value'
        && $path_root_array[0] == 'admission') ||
      ($path_root_array[1] == 'rec'
        && $path_root_array[0] == 'campuslife') ||
      ($path_root_array[1] == 'campus-safety'
        && $path_root_array[0] == 'campuslife') ||
      ($path_root_array[1] == 'career-center'
        && $path_root_array[0] == 'campuslife') ||
      ($path_root_array[1] == 'theatre-performance'
        && $path_root_array[0] == 'arts') ||
      (($path_root_array[1] == 'disability-services' || 
        $path_root_array[1] == 'anthropology' ||
        $path_root_array[1] == 'archeology-lab' ||
        $path_root_array[1] == 'art' ||
        $path_root_array[1] == 'biochemistry' ||
        $path_root_array[1] == 'biology' ||
        $path_root_array[1] == 'business-accounting' ||
        $path_root_array[1] == 'chemistry' ||
        $path_root_array[1] == 'communication-studies' ||
        $path_root_array[1] == 'computer-science-cis' ||
        $path_root_array[1] == 'continuing-education-and-workshops' ||
        $path_root_array[1] == 'economics' ||
        $path_root_array[1] == 'education' ||
        $path_root_array[1] == 'english' ||
        $path_root_array[1] == 'graduate-education' ||
        $path_root_array[1] == 'government-and-international-affairs' ||
        $path_root_array[1] == 'health-physical-ed-rec' ||
        $path_root_array[1] == 'history' ||
        $path_root_array[1] == 'international-and-off-campus-programs' ||
        $path_root_array[1] == 'international-studies' ||
        $path_root_array[1] == 'mathematics' ||
        $path_root_array[1] == 'modern-foreign-languages' ||
        $path_root_array[1] == 'music' ||
        $path_root_array[1] == 'nursing' ||
        $path_root_array[1] == 'physics' ||
        $path_root_array[1] == 'psychology' ||
        $path_root_array[1] == 'registrar' ||
        $path_root_array[1] == 'religion-philosophy-classics' ||
        $path_root_array[1] == 'sign-language-interpreting' ||
        $path_root_array[1] == 'sociology' ||
        $path_root_array[1] == 'theatre'
        )
        && $path_root_array[0] == 'academics') ||
      ($path_root_array[2] == 'sciences' 
	&& $path_root_array[0] == 'giving') ||
     
     // ($path_url == 'academics/graduate-education') || 
      ($path_url == 'about/college-offices-and-affiliates/business-office') ||
      ($path_url == 'about/college-offices-and-affiliates/president') ||
      ($path_url == 'admission/value') ||
      ($path_url == 'giving/augustana-fund-year-end-thank-you') ) {
    // hide the menu
  } else {
?>
<div class="<?php print $classes; ?>">
  <?php print $content; ?>
</div>
<?php } ?>
