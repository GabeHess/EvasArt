<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package Smooth Scroll by WPOS
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wssbywpos_Admin {
	
	function __construct() {

		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'ssbywpos_register_menu') );

		// Action to register plugin settings
		add_action ( 'admin_init', array($this,'ssbywpos_register_settings') );
	}

	/**
	 * Function to register admin menus
	 * 
	 * @package Smooth Scroll by WPOS
	 * @since 1.0.0
	 */
	function ssbywpos_register_menu() {
		add_menu_page ( __('Smooth Scroll by WPOS', 'ssbywpos'), __('Smooth Scroll by WPOS', 'ssbywpos'), 'manage_options', 'ssbywpos-settings', array($this, 'ssbywpos_settings_page'), 'dashicons-editor-kitchensink' );
	}

	/**
	 * Function to handle the setting page html
	 * 
	 * @package Smooth Scroll by WPOS
	 * @since 1.0.0
	 */
	function ssbywpos_settings_page() {
		include_once( SSBYWPOS_DIR . '/includes/admin/form/ssbywpos-settings.php' );
	}

	/**
	 * Function register setings
	 * 
	 * @package Smooth Scroll by WPOS
	 * @since 1.0.0
	 */
	function ssbywpos_register_settings(){
		register_setting( 'ssbywpos_plugin_options', 'ssbywpos_options', array($this, 'ssbywpos_validate_options') );
	}

	/**
	 * Validate Settings Options
	 * 
	 * @package Smooth Scroll by WPOS
	 * @since 1.0.0
	 */
	function ssbywpos_validate_options( $input ) {
		
		$input['enable_mousewheelsmooth_scroll'] 		= isset($input['enable_mousewheelsmooth_scroll']) 	? 1 : 0;
		$input['ssbywpos_scroll_amount']				= (is_numeric($input['ssbywpos_scroll_amount'])) 	? trim($input['ssbywpos_scroll_amount']) 	: 300;
		$input['ssbywpos_scroll_speed']					= (is_numeric($input['ssbywpos_scroll_speed'])) 	? trim($input['ssbywpos_scroll_speed']) 	: 800;		
		
		$input['enable_gototop_scroll'] 				= isset($input['enable_gototop_scroll']) 	? 1 : 0;
		$input['ssbywpos_gototop_speed']				= (is_numeric($input['ssbywpos_gototop_speed'])) 	? trim($input['ssbywpos_gototop_speed']) 	: 700;	
		
		return $input;
	}
}

$wssbywpos_admin = new Wssbywpos_Admin();