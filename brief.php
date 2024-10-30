<?php

/**
 * @link              https://github.com/andreymatin
 * @since             1.0.1
 * @package           Brief
 *
 * @wordpress-plugin
 * Plugin Name:       Brief
 * Plugin URI:        https://github.com/andreymatin/wp-brief
 * Description:       Development reports and documentation
 * Version:           1.0.1
 * Author:            Andrew Matin
 * Author URI:        https://github.com/andreymatin
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       brief
 **/

if (!defined('ABSPATH')) {
  exit;
}

define('BRIEF_VERSION', '1.0.1');


// Global Options Variable
$brief_options = get_option('brief_settings');

if (is_admin()) {
  require_once(plugin_dir_path(__FILE__) . '/includes/brief-scripts.php');
  require_once(plugin_dir_path(__FILE__) . '/includes/brief-widget.php');
  require_once(plugin_dir_path(__FILE__) . '/includes/brief-settings.php');

  /**
   * Add Settings Link
   *
   * @param [type] $links
   * @return void
   */
  function brief_settings($links)
  {
    $links[] = '<a href="' . admin_url('options-general.php?page=brief-options') . '">' . __('Settings') . '</a>';
    return $links;
  }

  add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'brief_settings');
}
