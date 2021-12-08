<?php
/*
 * 
Plugin Name: Synchronization for WooCommerce and WP Staging Pro
Plugin URI: https://edville.be
Description: Allows staging sites to import the latest orders and bookings from the WooCommerce live site
Author: Thimo Thoeye
Author URI: https://github.com/tthoeye/
Version: 0.1
Text Domain: commerce-staging-sync
WC tested up to: 4.7.1
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

/**
 * Check if WooCommerce is active
 */
if ( ! in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) && !array_key_exists( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_site_option( 'active_sitewide_plugins', array() ) ) ) ) { // deactive if woocommerce in not active
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    deactivate_plugins( plugin_basename(__FILE__) );
}
register_activation_hook(__FILE__, 'tt_sync_register_activation_hook_callback');

function tt_sync_register_activation_hook_callback() {
    if(!class_exists( 'WooCommerce' )){
        deactivate_plugins(basename(__FILE__));
        wp_die(__("WooCommerce is not installed/actived. it is required for this plugin to work properly. Please activate WooCommerce.", "order-import-export-for-woocommerce"), "", array('back_link' => 1));
    }

    update_option('tt_sync_plugin_installed_date', date('Y-m-d H:i:s'));
}

?>