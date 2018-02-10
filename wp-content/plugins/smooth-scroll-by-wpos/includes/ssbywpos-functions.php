<?php
/**
 * Functions File
 *
 * @package Smooth Scroll by WPOS
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Update default settings
 * 
 * @package Smooth Scroll by WPOS
 * @since 1.0.0
 */
function ssbywpos_default_settings(){
	
	global $ssbywpos_options;
	
	$ssbywpos_options = array(
								'enable_mousewheelsmooth_scroll'	 		=> '0',
								'ssbywpos_scroll_amount' 					=> '300',
								'ssbywpos_scroll_speed'						=> '800',		
								'enable_gototop_scroll'	 					=> '0',			
								'ssbywpos_gototop_speed'					=> '700',		
							);
	
	$default_options = apply_filters('ssbywpos_options_default_values', $ssbywpos_options );
	
	// Update default options
	update_option( 'ssbywpos_options', $default_options );
	
	// Overwrite global variable when option is update
	$ssbywpos_options = ssbywpos_get_settings();
}

/**
 * Get Settings From Option Page
 * 
 * Handles to return all settings value
 * 
 * @package Smooth Scroll by WPOS
 * @since 1.0.0
 */
function ssbywpos_get_settings() {
	
	$options = get_option('ssbywpos_options');

	$settings = is_array($options) 	? $options : array();
	
	return $settings;
}

/**
 * Get an option
 * Looks to see if the specified setting exists, returns default if not
 * 
 * @package Smooth Scroll by WPOS
 * @since 1.0
 */
function ssbywpos_get_option( $key = '', $default = false ) {
	global $ssbywpos_options;
	
	$value = ! empty( $ssbywpos_options[ $key ] ) ? $ssbywpos_options[ $key ] : $default;
	$value = apply_filters( 'ssbywpos_get_option', $value, $key, $default );
	return apply_filters( 'ssbywpos_get_option_' . $key, $value, $key, $default );
}

/**
 * Escape Tags & Slashes
 *
 * Handles escapping the slashes and tags
 *
 * @package  Smooth Scroll by WPOS
 * @since 1.0.0
 */
function ssbywpos_escape_attr($data) {
	return esc_attr( stripslashes($data) );
}

/**
 * Strip Slashes From Array
 *
 * @package Smooth Scroll by WPOS
 * @since 1.0.0
 */
function ssbywpos_slashes_deep($data = array(), $flag = false) {
	
	if($flag != true) {
		$data = ssbywpos_nohtml_kses($data);
	}
	$data = stripslashes_deep($data);
	return $data;
}

/**
 * Strip Html Tags 
 * 
 * It will sanitize text input (strip html tags, and escape characters)
 * 
 * @package Smooth Scroll by WPOS
 * @since 1.0.0
 */
function ssbywpos_nohtml_kses($data = array()) {
	
	if ( is_array($data) ) {
		
		$data = array_map('ssbywpos_nohtml_kses', $data);
		
	} elseif ( is_string( $data ) ) {
		
		$data = wp_filter_nohtml_kses($data);
	}
	
	return $data;
}


