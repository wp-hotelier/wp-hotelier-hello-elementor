<?php
/**
 * Elementor Widget Functions.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Register widgets.
 */
function hotelier_hello_elementor_register_widgets( $widgets_manager ) {
	require_once( __DIR__ . '/widgets/rooms.php' );
	require_once( __DIR__ . '/widgets/datepicker.php' );
	require_once( __DIR__ . '/widgets/listing.php' );
	require_once( __DIR__ . '/widgets/booking.php' );
	require_once( __DIR__ . '/widgets/room-title.php' );
	require_once( __DIR__ . '/widgets/room-gallery.php' );
	require_once( __DIR__ . '/widgets/room-description.php' );
	require_once( __DIR__ . '/widgets/room-price.php' );
	require_once( __DIR__ . '/widgets/room-deposit.php' );
	require_once( __DIR__ . '/widgets/room-meta.php' );
	require_once( __DIR__ . '/widgets/room-facilities.php' );
	require_once( __DIR__ . '/widgets/room-rates.php' );
	require_once( __DIR__ . '/widgets/checkin.php' );
	require_once( __DIR__ . '/widgets/checkout.php' );
	require_once( __DIR__ . '/widgets/cart.php' );
	require_once( __DIR__ . '/widgets/rooms-filter.php' );
	require_once( __DIR__ . '/widgets/ajax-room-booking.php' );

	$widgets_manager->register( new \HTL_Hello_Elementor_Rooms_Widget() );
	$widgets_manager->register( new \HTL_Hello_Elementor_Datepicker_Widget() );
	$widgets_manager->register( new \HTL_Hello_Elementor_Listing_Widget() );
	$widgets_manager->register( new \HTL_Hello_Elementor_Booking_Widget() );
	$widgets_manager->register( new \HTL_Hello_Elementor_Room_Title_Widget() );
	$widgets_manager->register( new \HTL_Hello_Elementor_Room_Gallery_Widget() );
	$widgets_manager->register( new \HTL_Hello_Elementor_Room_Description_Widget() );
	$widgets_manager->register( new \HTL_Hello_Elementor_Room_Price_Widget() );
	$widgets_manager->register( new \HTL_Hello_Elementor_Room_Deposit_Widget() );
	$widgets_manager->register( new \HTL_Hello_Elementor_Room_Meta_Widget() );
	$widgets_manager->register( new \HTL_Hello_Elementor_Room_Facilities_Widget() );
	$widgets_manager->register( new \HTL_Hello_Elementor_Room_Rates_Widget() );
	$widgets_manager->register( new \HTL_Hello_Elementor_Checkin_Widget() );
	$widgets_manager->register( new \HTL_Hello_Elementor_Checkout_Widget() );
	$widgets_manager->register( new \HTL_Hello_Elementor_Cart_Widget() );
	$widgets_manager->register( new \HTL_Hello_Elementor_Rooms_Filter() );
	$widgets_manager->register( new \HTL_Hello_Elementor_Ajax_Room_Booking_Widget() );
}
add_action( 'elementor/widgets/register', 'hotelier_hello_elementor_register_widgets' );

/**
 * Register new widgets category.
 */
function hotelier_hello_elementor_add_widget_categories( $elements_manager ) {
	$elements_manager->add_category(
		'hotelier-elements',
		[
			'title' => esc_html__( 'WP Hotelier', 'wp-hotelier-hello-elementor' ),
			'active' => false,
		]
	);
}
add_action( 'elementor/elements/categories_registered', 'hotelier_hello_elementor_add_widget_categories' );


function hotelier_hello_elementor_remove_legacy_widgets() {
	unregister_widget( 'HTL_Widget_Booking' );
	unregister_widget( 'HTL_Widget_Rooms_Filter' );
	unregister_widget( 'HTL_Widget_Ajax_Room_Booking' );
}
add_action( 'widgets_init', 'hotelier_hello_elementor_remove_legacy_widgets' );
