<?php
/**
 * Footer script File
 *
 * @package Smooth Scroll by WPOS
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
	 * Function to add script in footer
	 * 
	 * @package Smooth Scroll by WPOS
	 * @since 1.0.0
	 */	
	add_action( 'wp_footer', 'ssbywpos_footer_gotoTop' );	
	function ssbywpos_footer_gotoTop() {
		global $ssbywpos_options;
		$enable_gototop_scroll = $ssbywpos_options['enable_gototop_scroll'];		
		if($enable_gototop_scroll == 1) {	
		?>
		<a href="#" id="back-to-top" title="Back to top">&uarr;</a>
		<?php 	} ?>
			
			
		<?php
	}	
		
	