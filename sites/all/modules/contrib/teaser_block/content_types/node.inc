<?php


/**
 * Callback function to supply a list of content types.
 */
function teaser_block_node_panels_content_types() {
  $items['node'] = array(
    'single' => TRUE,
    'content_types' => 'teaser_block_node_content_types',
    'render callback' => 'teaser_block_node_content',
    'editor render callback' => 'teaser_block_node_admin_content',
    'add callback' => 'teaser_block_node_form',
    'edit callback' => 'teaser_block_node_form',
    'add validate callback' => 'teaser_block_node_form_validate',
    'edit validate callback' => 'teaser_block_node_form_validate',
    'title callback' => 'teaser_block_node_admin_title',
    'no title override' => TRUE,
  );
  return $items;
}

/**
 * Return all content types available.
 */
function teaser_block_node_content_types() {
  return array(
    'teaser_block_node' => array(
      'title' => t('Teaser block'),
      'icon' => 'icon_block_custom.png',
      'path' => panels_get_path('content_types/custom'),
      'description' => t('Create a teaser block linking to another node.'),
      'category' => array(t('Contributed modules')),
    ),
  );
}

/**
 * Output a teaser block.
 */
function teaser_block_node_content($conf) {
  static $delta = 0;

  $data = (object)$conf;

  $block          = new stdClass();
  $block->module  = 'teaser_block';
  $block->delta   = ++$delta;
  $block->subject = check_plain($conf['title']);
  $block->content = theme('teaser_block_read_more_link', $data);

  return $block;
}

/**
 * Render a teaser block in display editor.
 *
 * @param panels_display $display
 * @param stdClass $pane
 *
 * @return stdClass $block
 */
function teaser_block_node_admin_content($display, $pane) {
  $block = new stdClass();
  $block->title = filter_xss_admin($pane->configuration['title']);

  // We don't want to render php output on preview here, because if something is
  // wrong the whole display will be borked. So we check to see if the php
  // evaluator filter is being used, and make a temporary change to the filter
  // so that we get the printed php, not the eval'ed php.
  // If a php filter is active, pass 1 to use core's most restrictive filter.
  $filters = filter_list_format($pane->configuration['format']);
  foreach ($filters as $filter) {
    if ($filter->module == 'php') {
      $pane->configuration['format'] = 1;
    }
  }
  $data = (object)$pane->configuration;
  $block->content = theme('teaser_block_read_more_link', $data);;

  return $block;
}

/**
 * Return the administrative title for a teaser block.
 */
function teaser_block_node_admin_title($conf) {
  $output = t('Teaser Block');
  if (!empty($conf['title'])) {
    $output .= " (" . filter_xss_admin($conf['title']) . ")";
  }
  return $output;
}

/**
 * Return an edit form for a teaser block.
 */
function teaser_block_node_form($id, $parents, $conf = array()) {
  $conf += array(
    'title' => '',
    'body' => '',
    'format' => FILTER_FORMAT_DEFAULT,
    'node' => '',
    'nid' => 0,
  );

  $form['title'] = array(
    '#type' => 'textfield',
    '#title' => t('Title'),
    '#default_value' => $conf['title'],
  );

  $form['node'] = array(
    '#type' => 'textfield',
    '#title' => t('Enter the title or NID of a post'),
    '#maxlength' => 512,
    '#autocomplete_path' => 'panels/node/autocomplete',
    '#prefix' => '<div class="no-float">',
    '#suffix' => '</div>',
  );
  if (!empty($conf['nid'])) {
    $info = db_fetch_object(db_query("SELECT * FROM {node} n WHERE n.nid = %d", $conf['nid']));
    if ($info) {
      $link = l("'$info->title' [node id: $info->nid]", "node/$info->nid", array('target' => '_blank', 'title' => t('Open in new window')));
      $form['node']['#description'] = t('Currently set to !link', array('!link' => $link));
    }
  }
  $form['nid'] = array(
    '#type' => 'value',
    '#value' => $conf['nid'],
  );

  $form['body'] = array(
    '#type' => 'textarea',
    '#title' => t('Body'),
    '#default_value' => $conf['body'],
  );
  $parents[] = 'format';
  $form['format'] = filter_form($conf['format'], NULL, $parents);

  return $form;
}

/**
 * Form validation callback to ensure a proper node selection.
 */
function teaser_block_node_form_validate($form, $form_values) {
  // No existing nid, and no value entered.
  if (empty($form_values['nid']) && empty($form_values['node'])) {
    form_error($form['node'], t('You must select a node.'));
    return;
  }

  // nid already exists, and no new value entered.
  if (!empty($form_values['nid']) && empty($form_values['node'])) {
    return;
  }

  // Validate entered value.
  if ($nid = panels_nid_autocomplete($form_values['node'])) {
    form_set_value($form['nid'], $nid);
  }
  else {
    form_error($form['node'], t('Invalid node selected.'));
  }
}

