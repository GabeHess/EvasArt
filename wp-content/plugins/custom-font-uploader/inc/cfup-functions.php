<?php
/**
 * Exit if accessed directly.
 *
 * @package custom-font-uploader
 * @version 1.0.0
 * @author  wbcomdesigns
 */

add_action( 'wp_ajax_delete_customfont', 'delete_customfont' );
add_action( 'wp_ajax_nopriv_delete_customfont', 'delete_customfont' );

/**
 * Function for deleting fonts using upload method.
 *
 * @version 1.0.0
 * @author  wbcomdesigns
 */
function delete_customfont() {

	$fonts_db_data    = get_option( 'font_file_name', true );
	$delckey          = sanitize_text_field( wp_unslash( $_POST['del_key'] ) );
	$custom_font_file = CUSTOM_FONT_UPLOADER_UPLOADS_DIR_PATH . $fonts_db_data[ $delckey ];
	unlink( realpath( $custom_font_file ) );
	unset( $fonts_db_data[ $delckey ] );
	update_option( 'font_file_name', $fonts_db_data );
	echo 'custom-font-deleted';
	die;
}

add_action( 'wp_ajax_delete_googlefont', 'delete_googlefont' );
add_action( 'wp_ajax_nopriv_delete_googlefont', 'delete_googlefont' );

/**
 * Function for deleting fonts using google fonts.
 *
 * @version 1.0.0
 * @author  wbcomdesigns
 */
function delete_googlefont() {
	$gfonts_db_data = get_option( 'googlefont_file_name', true );
	if ( isset( $_POST['del_gkey'] ) ) {
		$del_gkey = sanitize_text_field( wp_unslash( $_POST['del_gkey'] ) );
	}

	unset( $gfonts_db_data[ $del_gkey ] );
	update_option( 'googlefont_file_name', $gfonts_db_data );
	echo 'google-font-deleted';
	die;
}

/**
 * Get google fonts through google api and pass it in curl.
 *
 * @version 1.0.0
 * @author  wbcomdesigns
 * @param   string $api_key contain api key for font.
 */
function cfup_get_google_fonts( $api_key ) {
	$api_url  = 'https://www.googleapis.com/webfonts/v1/webfonts';
	$params   = array( 'key' => $api_key );
	$url      = add_query_arg( $params, esc_url_raw( $api_url ) );
	$response = wp_remote_get( esc_url_raw( $url ) );

	// Check the response code.
	$response_code    = wp_remote_retrieve_response_code( $response );
	$response_message = wp_remote_retrieve_response_message( $response );

	if ( 200 != $response_code && ! empty( $response_message ) ) {
		return new WP_Error( $response_code, $response_message );
	} elseif ( 200 != $response_code ) {
		return new WP_Error( $response_code, 'Unknown error occurred' );
	} else {
		// Everything seems OK, retreive the fonts.
		return json_decode( wp_remote_retrieve_body( $response ) );
	}
}
