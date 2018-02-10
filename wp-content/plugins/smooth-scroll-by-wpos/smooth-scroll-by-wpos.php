<?php
/*
Plugin Name: Smooth Scroll by WPOS
Plugin URL: https://wponlinesupport.com
Description: A simple plugin contains Smooth Scrolling To Element, Go To Top and MouseWheel Smooth Scroll.
Text Domain: smooth-scroll-by-wpos
Domain Path: /languages/
Version: 1.0
Author: WP Online Support
Author URI: http://sptechnolab.com
Contributors: WP Online Support
*/

if( !defined( 'SSBYWPOS_VERSION' ) ) {
	define( 'SSBYWPOS_VERSION', '1.0' ); // Version of plugin
}

if( !defined( 'SSBYWPOS_DIR' ) ) {
	define( 'SSBYWPOS_DIR', dirname( __FILE__ ) ); // Plugin dir
}

if( !defined( 'SSBYWPOS_URL' ) ) {
    define( 'SSBYWPOS_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package Smooth Scroll by WPOS
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'ssbywpos_install' );

/**
 * Activation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package Smooth Scroll by WPOS
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'ssbywpos_uninstall');

/**
 * Plugin Activation Function
 * Does the initial setup, sets the default values for the plugin options
 * 
 * @package WPSmooth Scroll by WPOS
 * @since 1.0.0
 */
function ssbywpos_install()
{
	//default settings
	ssbywpos_default_settings();
}

/**
 * Plugin Deactivation Function
 * Delete  plugin options
 * 
 * @package WPSmooth Scroll by WPOS
 * @since 1.0.0
 */
function ssbywpos_uninstall()
{
	
}

add_action('plugins_loaded', 'ssbywpos_load_textdomain');
function ssbywpos_load_textdomain() {
	load_plugin_textdomain( 'smooth-scroll-by-wpos', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
} 
global $ssbywpos_options;
// Script and CSS file
require_once( SSBYWPOS_DIR . '/includes/class-ssbywpos-script.php' );

// Function file
require_once( SSBYWPOS_DIR . '/includes/ssbywpos-functions.php' );
 
$ssbywpos_options = ssbywpos_get_settings();

// Admin Class
require_once( SSBYWPOS_DIR . '/includes/admin/class-ssbywpos-admin.php' );

// Shortcode a link
require_once( SSBYWPOS_DIR . '/includes/ssbywpos-shortcode.php' );

// Footer script
require_once( SSBYWPOS_DIR . '/includes/ssbywpos-add-footer-script.php' );

