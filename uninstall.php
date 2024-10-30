<?php

if (!defined('WP_UNINSTALL_PLUGIN')) {
  exit;
}

function brief_delete_plugin()
{
  delete_option('brief_settings');
}

brief_delete_plugin();
