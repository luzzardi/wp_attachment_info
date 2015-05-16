<?php
/*
Plugin Name: Attachment Info
Plugin URI:
Description: Dev Plugin - Check all attachment information
Version: 1.0.0
Author: André Luzzardi
Author URI:
*/

// In case someone integrates this plugin in a theme or calling this directly
if (class_exists('AttachmentInfo') || !defined('ABSPATH')) {
	return;
}

define('_ATTACHMENT_INFO__VERSION', '1.0.0');
define('_ATTACHMENT_INFO__PLUGIN_URL', plugin_dir_url( __FILE__ ));
define('_ATTACHMENT_INFO__PLUGIN_DIR', plugin_dir_path( __FILE__ ));
define('_ATTACHMENT_INFO__ROOT_FILE',  __FILE__);
define('_ATTACHMENT_INFO__PLUGIN_DOMAIN', 'att_info_module');
define('_ATTACHMENT_INFO__PLUGIN_TITLE', 'Attachment Info');

// Require and instance a Almette class to handle some functions for the plugin.
require_once(_ATTACHMENT_INFO__PLUGIN_DIR . 'class.attachment_info.php');
add_action('init', array('AttachmentInfo', 'init'));

if (is_admin()) {
	require_once(_ATTACHMENT_INFO__PLUGIN_DIR . 'admin/class.admin.php');
	add_action('init', array('AttachmentInfo_Admin', 'init'));
}
