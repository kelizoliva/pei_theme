<?php

/**
 * Override output of some views to be used in math expressions.
 */
function pei_theme_views_post_render(&$view, &$output, &$cache) {
  $raw_views = array('count_activities');
  if(in_array($view->name, $raw_views)) {
    $base_field = $view->base_field;
    $output = $view->result[0]->$base_field;
  }
}
