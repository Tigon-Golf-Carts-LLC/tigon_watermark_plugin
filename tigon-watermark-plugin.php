<?php
/**
 * Plugin Name: Tigon Watermark Plugin
 * Plugin URI:  https://devaxe.co/
 * Description: Add watermark functionality for products
 * Version:     2.0.2
 * Author:      Devaxe
 * Author URI:  https://devaxe.co/
 * Text Domain: tigonwm-plugin-woocommerce 
 */
if (!defined('WPINC')) {
	die();
}

if (!defined('tigonwm_path')) {
	define('tigonwm_path', plugin_dir_url( __FILE__ ));
}




function tigonwm_dbtables()
{
	Global $wpdb;
	$charset_collate       = $wpdb->get_charset_collate();
	$tigonwm_watermarks    = 'tigonwm_watermarks';
	$tigonwm_table         = "CREATE TABLE $tigonwm_watermarks (
							`id` int(11) NOT NULL AUTO_INCREMENT,
							`watermark` varchar(255) DEFAULT NULL,
							PRIMARY KEY (`id`)
						) $charset_collate;";
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($tigonwm_table);
}
register_activation_hook( __FILE__, 'tigonwm_dbtables' );

require_once('essential-asset.php');