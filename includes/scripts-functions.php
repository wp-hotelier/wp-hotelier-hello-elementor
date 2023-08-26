<?php
/**
 * Scripts functions.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Disable default styles
 */
add_filter( 'hotelier_enqueue_styles', '__return_false' );

/**
 * Enqueue styles
 */
function hotelier_hello_elementor_frontend_styles() {
	wp_enqueue_style( 'htl-hello-hotelier', HTL_HELLO_ELEMENTOR_PLUGIN_URL . 'assets/css/frontend/hotelier.css', array(), HTL_HELLO_ELEMENTOR_VERSION );
}
add_action( 'wp_enqueue_scripts', 'hotelier_hello_elementor_frontend_styles' );

/**
 * Enqueue scripts
 */
function hotelier_hello_elementor_frontend_scripts() {
	// Use minified libraries if SCRIPT_DEBUG is turned off
	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_register_script( 'htl-hello-rooms-filter', HTL_HELLO_ELEMENTOR_PLUGIN_URL . 'assets/js/frontend/rooms-filter' . $suffix . '.js', array( 'jquery' ), HTL_HELLO_ELEMENTOR_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'hotelier_hello_elementor_frontend_scripts' );
