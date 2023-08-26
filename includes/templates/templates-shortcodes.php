<?php
/**
 * Shortcode Templates.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Add class to shortcode wrappers. This filter
 * is removed when using the Rooms module.
 */
function hotelier_hello_elementor_shortcode_wrapper_class( $class ) {
	$class .= ' rooms-grid-4 rooms-grid-tablet-2 rooms-grid-mobile-1 rooms-grid--align-left rooms-grid-shortcode';

	return $class;
}
add_filter( 'hotelier_shortcode_room_loop_wrapper_class', 'hotelier_hello_elementor_shortcode_wrapper_class' );
add_filter( 'hotelier_related_rooms_loop_wrapper_class', 'hotelier_hello_elementor_shortcode_wrapper_class' );
add_filter( 'hotelier_archive_rooms_wrapper_class', 'hotelier_hello_elementor_shortcode_wrapper_class' );

/**
 * Open wrapper in room loop content.
 */
function hotelier_hello_elementor_before_archive_item_room_title() {
	echo '<div class="room__text-wrapper">';
}
add_action( 'hotelier_archive_item_room', 'hotelier_hello_elementor_before_archive_item_room_title', 9 );

/**
 * Close wrapper in room loop content.
 */
function hotelier_hello_elementor_after_archive_item_room_more() {
	echo '</div>';
}
add_action( 'hotelier_archive_item_room', 'hotelier_hello_elementor_after_archive_item_room_more', 999 );

/**
 * Show room meta content.
 */
function hotelier_hello_elementor_archive_item_show_room_meta() {
	global $room;

	$_room = htl_get_room( $room );

	echo '<div class="room__meta">';

	$beds  = $_room->get_beds();

	if ( $beds ) {
		echo '<span class="room__beds">' . sprintf( _n( '%s bed', '%s beds', $beds, 'wp-hotelier-hello-elementor' ), $beds ) . '</span>';
	}

	$bathrooms = $_room->get_bathrooms();

	if ( $bathrooms ) {
		echo '<span class="room__bathrooms">' . sprintf( _n( '%s bathroom', '%s bathrooms', $bathrooms, 'wp-hotelier-hello-elementor' ), $bathrooms ) . '</span>';
	}

	$size = $_room->get_formatted_room_size();

	if ( $size ) {
		echo '<span class="room__size">' . $size . '</span>';
	}

	echo '</div>';
}

/**
 * Show room's categories.
 */
function hotelier_hello_elementor_archive_item_room_category_badge() {
	global $room;
	$_room = htl_get_room( $room );

	$terms = get_the_terms( get_the_ID(), 'room_cat' );
	if ( empty( $terms[0] ) ) {
		return;
	}

	echo '<span class="room__badge room__badge--category">' . esc_html( $terms[0]->name ) . '</span>';
}
