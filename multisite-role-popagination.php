<?php

/**
 * Plugin Name:       Multisite Role Propagination
 * Plugin URI:        (#plugin_url#)
 * Description:       Plugin to quickly set a role for a multisite user on multiple blogs in a network
 * Version:           1.0.0
 * Author:            Sebastian Thulin
 * Author URI:        (#plugin_author_url#)
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

require_once MSROLEPROPAGINATION_PATH . 'source/php/Vendor/Psr4ClassLoader.php';
require_once MSROLEPROPAGINATION_PATH . 'Public.php';

// Instantiate and register the autoloader
$loader = new msRolePropagination\Vendor\Psr4ClassLoader();
$loader->addPrefix('msRolePropagination', MSROLEPROPAGINATION_PATH);
$loader->addPrefix('msRolePropagination', MSROLEPROPAGINATION_PATH . 'source/php/');
$loader->register();

// Start application
new msRolePropagination\App();
