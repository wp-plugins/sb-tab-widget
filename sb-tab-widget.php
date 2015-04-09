<?php
/*
Plugin Name: SB Tab Widget
Plugin URI: http://hocwp.net/
Description: SB Tab Widget is a plugin that allows to display widget on tabber.
Author: SB Team
Version: 1.0.6
Author URI: http://hocwp.net/
Text Domain: sb-tab-widget
Domain Path: /languages/
*/

if(defined('SB_THEME_VERSION') && version_compare(SB_THEME_VERSION, '1.7.0', '>=')) {
    return;
}

define('SB_TAB_WIDGET_FILE', __FILE__);

//add_filter('sb_tab_widget_testing', '__return_true');

define('SB_TAB_WIDGET_PATH', untrailingslashit(plugin_dir_path(SB_TAB_WIDGET_FILE)));

define('SB_TAB_WIDGET_URL', plugins_url('', SB_TAB_WIDGET_FILE));

define('SB_TAB_WIDGET_INC_PATH', SB_TAB_WIDGET_PATH . '/inc');

define('SB_TAB_WIDGET_BASENAME', plugin_basename(SB_TAB_WIDGET_FILE));

define('SB_TAB_WIDGET_DIRNAME', dirname(SB_TAB_WIDGET_BASENAME));

require SB_TAB_WIDGET_INC_PATH . '/sb-plugin-load.php';