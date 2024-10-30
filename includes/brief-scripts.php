<?php

if (is_admin()) {

  // Add Admin Scripts
  function brief_add_admin_scripts()
  {
    // Styles for Widget and Config Panel
    wp_enqueue_style('brief-admin-style', plugins_url('/assets/css/styles-admin.css', __FILE__));

    // Markdown Convertor
    wp_enqueue_script('brief-showdown', plugins_url('/assets/js/showdown.js', __FILE__));

    // Scripts for Plugin
    wp_enqueue_script('brief-main-script', plugins_url('/assets/js/scripts-admin.js', __FILE__), 'jquery');
  }

  add_action('admin_init', 'brief_add_admin_scripts');
}
