<?php
/**
 * WP Hotelier Functions.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Register Hotelier frontend hooks before Elementor editor inits
 */
function hotelier_hello_elementor_register_htl_hooks() {
	if ( ! empty( $_REQUEST['action'] ) && 'elementor' === $_REQUEST['action'] && is_admin() ) {
		HTL()->frontend_includes();
		add_action( 'init', array( 'HTL_Shortcodes', 'init' ) );
	}
}
add_action( 'init', 'hotelier_hello_elementor_register_htl_hooks', 5 );

/**
 * Register support for advanced features
 */
function hotelier_hello_elementor_use_card_listing() {
	add_theme_support( 'htl-room-list-content-card' );
	add_theme_support( 'htl-modal-price-breakdown' );
}
add_action( 'after_setup_theme', 'hotelier_hello_elementor_use_card_listing' );

/**
 * Use long deposits in single room
 */
add_filter( 'hotelier_single_room_long_formatted_deposit', '__return_true' );

/**
 * Use inline meta in single room
 */
add_filter( 'hotelier_single_room_meta_inline', '__return_true' );

/**
 * Show description's title in single room
 */
add_filter( 'hotelier_single_room_description_show_title', '__return_true' );

/**
 * Remove templates in single room when using Elementor
 */
function hotelier_hello_elementor_remove_single_room_templates() {
	if ( is_room() ) {
		$post_id = get_the_ID();

		if ( \Elementor\Plugin::$instance->documents->get( $post_id )->is_built_with_elementor() ) {
			add_filter( 'hotelier_single_room_print_hooks', '__return_false' );
		}
	}
}
add_action( 'template_redirect', 'hotelier_hello_elementor_remove_single_room_templates' );

/**
 * Remove templates in single room when using Elementor
 */
function hotelier_hello_elementor_get_reservation_object_from_received_page() {
	global $wp;

	$reservation = false;

	if ( isset( $wp->query_vars[ 'reservation-received' ] ) ) {
		$reservation_id  = apply_filters( 'hotelier_received_reservation_id', absint( $wp->query_vars[ 'reservation-received' ] ) );
		$reservation_key = apply_filters( 'hotelier_received_reservation_key', empty( $_GET[ 'key' ] ) ? '' : sanitize_text_field( $_GET[ 'key' ] ) );

		if ( $reservation_id > 0 ) {
			$reservation = htl_get_reservation( $reservation_id );
			if ( $reservation->reservation_key != $reservation_key )
				$reservation = false;
		}
	}

	return $reservation;
}

/**
 * Option to select the number of rooms per page in the archive
 */
function hotelier_hello_elementor_add_rooms_archive_per_page( $settings ) {
	$settings['rooms_archive_settings'] = array(
		'id'    => 'rooms_archive_settings',
		'name'  => '<strong>' . esc_html__( 'Room archive settings', 'wp-hotelier-hello-elementor' ) . '</strong>',
		'type'  => 'header',
		'class' => 'htl-ui-row--section-description'
	);

	$settings['rooms_archive_per_page'] = array(
		'id'    => 'rooms_archive_per_page',
		'name'  => '<strong>' . esc_html__( 'Rooms per page', 'wp-hotelier-hello-elementor' ) . '</strong>',
		'type' => 'number',
		'size' => 'small',
	);

	return $settings;
}
add_filter( 'hotelier_settings_rooms_and_reservations', 'hotelier_hello_elementor_add_rooms_archive_per_page', 100 );

/**
 * Fix pagination on archives
 */
function hotelier_hello_elementor_fix_archive_rooms_main_query( $query ) {
	if ( ! is_admin() && $query->is_main_query() && ( is_post_type_archive( 'room' ) || is_room_category() ) ) {
		$per_page = absint( htl_get_option( 'rooms_archive_per_page' ) );

		if ( $per_page ) {
			$query->set( 'posts_per_page', $per_page );
		}
	}
}
add_action( 'pre_get_posts', 'hotelier_hello_elementor_fix_archive_rooms_main_query' );

/**
 * Populate post object with a random room
 */
function hotelier_hello_elementor_populate_room_objet() {
	$post = false;

	$args = array(
		'post_type'      => 'room',
		'post_status'    => 'publish',
		'posts_per_page' => '1',
		'orderby'        => 'id',
		'order'          => 'asc',
	);

	$posts = get_posts( $args );

	if ( empty( $posts ) ) {
		return;
	}

	foreach( $posts as $_post ) {
		$post_id = apply_filters( 'hotelier_hello_elementor_default_frontend_editor_room_id', $_post->ID );
		$post    = htl_get_room( $post_id );
	}

	return $post;
}
