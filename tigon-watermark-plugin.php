<?php
/**
 * Plugin Name: Tigon Watermark Plugin
 * Plugin URI:  https://tigongolfcarts.com
 * Description: Add watermark functionality for woo commerce products
 * Version:     2.1.0
 * Author:      Jaslow Digital | Noah Jaslow
 * Author URI:  https://jaslowdigital.com
 * Text Domain: tigonwm-plugin-woocommerce
 */
if (!defined('WPINC')) {
	die();
}

if (!defined('tigonwm_path')) {
	define('tigonwm_path', plugin_dir_url( __FILE__ ));
}

define('TIGONWM_DB_VERSION', '2.1.0');

/**
 * Create or update the database table.
 * Uses dbDelta which safely creates/alters tables without dropping existing data.
 */
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

/**
 * Check DB version on every load and run migration if needed.
 * This ensures the table exists even after plugin updates
 * (register_activation_hook does NOT fire on updates).
 * dbDelta never drops data — it only creates or alters tables.
 */
function tigonwm_check_db_version()
{
	$installed_version = get_option('tigonwm_db_version', '0');
	if ($installed_version !== TIGONWM_DB_VERSION) {
		tigonwm_dbtables();
		update_option('tigonwm_db_version', TIGONWM_DB_VERSION);
	}
}
add_action('plugins_loaded', 'tigonwm_check_db_version');

require_once('essential-asset.php');
