<?php
/**
 * Functions File
 *
 * @package Smooth Scroll by WPOS
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;


/*
 * Add shortcode
 *
 */
function ssbywpos_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"link" => '',
		"class" => '',
		"name"   => '',
	), $atts));

	// Define link
	if( $link ) { 
		 $button_link = $link; 
	} else {
		$button_link = '';
	}
	// Define class
	if( $class ) { 
		$button_class = $class; 
	} else {
		$button_class = 'alink';
	}
	
	// Define name
	if( $name ) { 
		$button_name = $name; 
	} else {
		$button_name = 'My Link';
	}	
	
	$button_main_class = "ssbywpos-link {$button_class}";
	
	ob_start(); ?>
	
	  <a href="#<?php echo $button_link; ?>" class="<?php echo $button_main_class;  ?>" > <?php echo $button_name; ?> </a>
	<?php return ob_get_clean();
}
add_shortcode("ss_link", "ssbywpos_shortcode");