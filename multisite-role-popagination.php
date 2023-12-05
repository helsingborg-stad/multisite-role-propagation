<?php

/**
 * Plugin Name:       Multisite Role Propagination
 * Plugin URI:        https://github.com/helsingborg-stad/multisite-role-propagation
 * Description:       Plugin to quickly set a role for a multisite user on multiple blogs in a network
 * Version: 3.0.5
 * Author:            Sebastian Thulin
 * Author URI:        https://github.com/sebastianthulin
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       multisite-role-popagination
 * Domain Path:       /languages
 */

 // Protect agains direct file access
if (! defined('WPINC')) {
    die;
}

define('MSROLEPROPAGINATION_PATH', plugin_dir_path(__FILE__));
define('MSROLEPROPAGINATION_URL', plugins_url('', __FILE__));
define('MSROLEPROPAGINATION_TEMPLATE_PATH', MSROLEPROPAGINATION_PATH . 'templates/');

load_plugin_textdomain('multisite-role-popagination', false, plugin_basename(dirname(__FILE__)) . '/languages');

// Autoload from plugin
if (file_exists(MSROLEPROPAGINATION_PATH . 'vendor/autoload.php')) {
    require_once MSROLEPROPAGINATION_PATH . 'vendor/autoload.php';
}

// Start application
new msRolePropagination\App();
