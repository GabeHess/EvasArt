<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package Smooth Scroll by WPOS 
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wssbywpos_Script {
	
	function __construct() {
		
		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'ssbywpos_front_style') );
		
		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'ssbywpos_front_script') );		
		
	}

	/**
	 * Function to add style at front side
	 * 
	 * @package Smooth Scroll by WPOS
	 * @since 1.0.0
	 */
	function ssbywpos_front_style() {

		// Registring and enqueing public css
		wp_register_style( 'ssbywpos-public-css', SSBYWPOS_URL.'assets/css/ssbywpos-style.css', null, SSBYWPOS_VERSION );
		wp_enqueue_style( 'ssbywpos-public-css' );

	}
	
	/**
	 * Function to add script at front side
	 * 
	 * @package Smooth Scroll by WPOS
	 * @since 1.0.0
	 */
	function ssbywpos_front_script() {
		global $ssbywpos_options;
		// Registring public script
		
		if ($ssbywpos_options['enable_mousewheelsmooth_scroll'] == 1) {
			wp_register_script( 'ssbywpos-mousewheelscroll-js', SSBYWPOS_URL.'assets/js/jQuery.mousewheel-smooth-scroll.js', array('jquery'), SSBYWPOS_VERSION, true );
			wp_enqueue_script( 'ssbywpos-mousewheelscroll-js');
		}
		// Registring public script
		wp_register_script( 'ssbywpos-public-js', SSBYWPOS_URL.'assets/js/wp-ssbywpos-public.js', array('jquery'), SSBYWPOS_VERSION, true );
		wp_localize_script( 'ssbywpos-public-js', 'ssbywpos', array(
															'is_mobile' 						=>	(wp_is_mobile()) ? 1 : 0,
															'is_rtl' 							=>	(is_rtl()) ? 1 : 0,
															'enable_mousewheelsmooth_scroll' 	=> ssbywpos_get_option('enable_mousewheelsmooth_scroll'),
															'ssbywpos_scroll_amount' 			=> ssbywpos_get_option('ssbywpos_scroll_amount'),
															'ssbywpos_scroll_speed' 			=> ssbywpos_get_option('ssbywpos_scroll_speed'),
															'enable_gototop_scroll' 			=> ssbywpos_get_option('enable_gototop_scroll'),
															'ssbywpos_gototop_speed' 			=> ssbywpos_get_option('ssbywpos_gototop_speed'),
														));
		wp_enqueue_script( 'ssbywpos-public-js');
	
	}	
	
		
}

$wssbywpos_script = new Wssbywpos_Script();