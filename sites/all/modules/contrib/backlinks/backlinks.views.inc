<?php

/**
 * Implementation of hook_views_data().
 */
function backlinks_views_data() {
  $data['search_node_links']['table']['group']  = t('Backlinks');
  $data['search_node_links']['table']['join']['node']['arguments'] = array('search_node_links', 'node', 'nid', 'sid', NULL, 'INNER');
  $data['search_node_links']['nid']['filter']['handler'] = 'views_handler_filter_equality';
  $data['search_node_links']['nid']['argument']['handler'] = 'views_handler_argument_node_nid';
  $data['search_node_links']['nid']['title'] = t('Node ID');
  $data['search_node_links']['nid']['help'] = t('Allows users to filter a view by specifying a single node ID to which the returned nodes are linked.');
  return $data;
}
