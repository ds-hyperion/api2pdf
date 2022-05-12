<?php
/**
 * Plugin Name: Hyperion - Module API2PDF
 * Plugin URI:
 * Description: Gestion des pdf via api2pdf
 * Version: 0.1
 * Requires PHP: 8.1
 * Author: Benoit DELBOE & Grégory COLLIN
 * Author URI:
 * Licence: GPLv2
 */

add_action('init', '\Hyperion\Api2pdf\Plugin::init');
add_action('admin_menu', '\Hyperion\Api2pdf\Admin\Settings::createMenu');
register_activation_hook(__FILE__, '\Hyperion\Api2pdf\Plugin::install');
register_uninstall_hook(__FILE__, '\Hyperion\Api2pdf\Plugin::uninstall');