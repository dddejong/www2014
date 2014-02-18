<?php
function augie_preprocess_page(&$variables) {
  if ($variables['node']->type != "") {
    $variables['template_files'][] = "page-node-" . $variables['node']->type;
  }
}
?>
