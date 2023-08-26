<?php
// Get booking object
$booking = HTL()->booking();

do_action( 'hotelier_before_booking_form', $booking, $shortcode_atts );
?>

<form id="booking-form" name="booking" method="post" class="booking form--booking" action="" enctype="multipart/form-data">

	<?php do_action( 'hotelier_begin_booking_form' ); ?>

	<?php if ( sizeof( $booking->booking_fields ) > 0 ) : ?>

		<?php do_action( 'hotelier_booking_guest_details' ); ?>

		<?php
		// show additional information fields
		if ( htl_get_option( 'booking_additional_information' ) ) :	?>

			<?php do_action( 'hotelier_booking_additional_information' ); ?>

		<?php endif; ?>

	<?php endif; ?>

	<?php do_action( 'hotelier_booking_details' ); ?>

	<div id="reservation-table" class="booking__section booking__section--reservation-table">

		<header class="section-header">
			<h3 class="<?php echo esc_attr( apply_filters( 'hotelier_booking_section_title_class', 'section-header__title' ) ); ?>"><?php echo esc_html( apply_filters( 'hotelier_booking_section_reservation_table_title', __( 'Your reservation', 'wp-hotelier' ) ) ); ?></h3>
		</header>

		<?php do_action( 'hotelier_booking_before_booking_table' ); ?>

		<table class="table table--reservation-table reservation-table hotelier-table">
			<thead class="reservation-table__heading">
				<tr class="reservation-table__row reservation-table__row--heading">
					<th class="reservation-table__room-name reservation-table__room-name--heading"><?php esc_html_e( 'Room', 'wp-hotelier' ); ?></th>
					<th class="reservation-table__room-qty reservation-table__room-qty--heading"><?php esc_html_e( 'Qty', 'wp-hotelier' ); ?></th>
					<th class="reservation-table__room-cost reservation-table__room-cost--heading"><?php esc_html_e( 'Cost', 'wp-hotelier' ); ?></th>
				</tr>
			</thead>
			<tbody class="reservation-table__body">
				<tr class="reservation-table__row reservation-table__row--body">
					<td class="reservation-table__room-name reservation-table__room-name--body">

						<a class="reservation-table__room-link" href="#"><?php esc_html_e( 'Room title', 'wp-hotelier-hello-elementor' ); ?></a>

						<span class="reservation-table__room-non-cancellable"><?php esc_html_e( 'Non-refundable', 'wp-hotelier' ); ?></span>

						<?php
							echo apply_filters( 'hotelier_cart_item_remove_link', sprintf(
								'<a href="%s" class="reservation-table__room-remove remove button">%s</a>',
								'#',
								esc_html__( 'Remove', 'wp-hotelier' )
							), '' );
						?>

						<div class="reservation-table__room-guests reservation-table__room-guests--booking">

							<span class="reservation-table__room-guests-label"><?php esc_html_e( 'Number of guests:', 'wp-hotelier-hello-elementor' ); ?></span>

							<p class="form-row" id="adults[131bd3e56e4c2d0ec1d0c0f0679fa1e5][0]_field">
								<label class="form-row__label" for="adults[131bd3e56e4c2d0ec1d0c0f0679fa1e5][0]"><?php esc_html_e( 'Adults', 'wp-hotelier-hello-elementor' ); ?></label>
								<select name="adults[131bd3e56e4c2d0ec1d0c0f0679fa1e5][0]" id="adults[131bd3e56e4c2d0ec1d0c0f0679fa1e5][0]" class="select">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3" selected="selected">3</option>
								</select>
							</p>

							<p class="form-row " id="children[131bd3e56e4c2d0ec1d0c0f0679fa1e5][0]_field">
								<label class="form-row__label" for="children[131bd3e56e4c2d0ec1d0c0f0679fa1e5][0]"><?php esc_html_e( 'Children', 'wp-hotelier-hello-elementor' ); ?></label>
								<select name="children[131bd3e56e4c2d0ec1d0c0f0679fa1e5][0]" id="children[131bd3e56e4c2d0ec1d0c0f0679fa1e5][0]" class="select">
									<option value="0" selected="selected">0</option>
									<option value="1">1</option>
								</select>
							</p>
						</div>
					</td>

					<td class="reservation-table__room-qty reservation-table__room-qty--body">1</td>

					<td class="reservation-table__room-cost reservation-table__room-cost--body">
						<?php echo htl_price( 100 ) ?>

						<span class="view-price-breakdown-modal"><?php esc_html_e( 'View price breakdown', 'wp-hotelier' ); ?><table class="table table--price-breakdown price-breakdown" style="display: none;"><thead><tr class="price-breakdown__row price-breakdown__row--heading"><th colspan="2" class="price-breakdown__day price-breakdown__day--heading">Day</th><th class="price-breakdown__cost price-breakdown__cost--heading">Cost</th></tr></thead><tbody><tr class="price-breakdown__row price-breakdown__row--body"><td colspan="2" class="price-breakdown__day price-breakdown__day--body">December 7, 2022</td><td class="price-breakdown__cost price-breakdown__cost--body"><span class="amount">$75.00</span></td></tr><tr class="price-breakdown__row price-breakdown__row--body"><td colspan="2" class="price-breakdown__day price-breakdown__day--body">December 8, 2022</td><td class="price-breakdown__cost price-breakdown__cost--body"><span class="amount">$75.00</span></td></tr></tbody></table></span>
					</td>
				</tr>

				<tr class="reservation-table__row reservation-table__row--body">
					<td class="reservation-table__room-name reservation-table__room-name--body">

						<a class="reservation-table__room-link" href="#"><?php esc_html_e( 'Room title', 'wp-hotelier-hello-elementor' ); ?></a>

						<small class="reservation-table__room-rate"><?php esc_html_e( 'Rate: rate name', 'wp-hotelier-hello-elementor' ); ?></small>

						<?php
							echo apply_filters( 'hotelier_cart_item_remove_link', sprintf(
								'<a href="%s" class="reservation-table__room-remove remove button">%s</a>',
								'#',
								esc_html__( 'Remove', 'wp-hotelier' )
							), '' );
						?>

						<div class="reservation-table__room-guests reservation-table__room-guests--booking">
							<span class="reservation-table__room-guests-label"><?php esc_html_e( 'Number of guests:', 'wp-hotelier' ); ?></span>
							<span class="reservation-table__room-guests-adults"><?php esc_html_e( '4 Adults', 'wp-hotelier' ); ?></span>
							<span class="reservation-table__room-guests-children"><?php esc_html_e( '2 Children', 'wp-hotelier' ); ?></span>
						</div>
					</td>

					<td class="reservation-table__room-qty reservation-table__room-qty--body">1</td>

					<td class="reservation-table__room-cost reservation-table__room-cost--body">
						<?php echo htl_price( 150 ) ?>

						<span class="view-price-breakdown-modal"><?php esc_html_e( 'View price breakdown', 'wp-hotelier' ); ?><table class="table table--price-breakdown price-breakdown" style="display: none;"><thead><tr class="price-breakdown__row price-breakdown__row--heading"><th colspan="2" class="price-breakdown__day price-breakdown__day--heading">Day</th><th class="price-breakdown__cost price-breakdown__cost--heading">Cost</th></tr></thead><tbody><tr class="price-breakdown__row price-breakdown__row--body"><td colspan="2" class="price-breakdown__day price-breakdown__day--body">December 7, 2022</td><td class="price-breakdown__cost price-breakdown__cost--body"><span class="amount">$75.00</span></td></tr><tr class="price-breakdown__row price-breakdown__row--body"><td colspan="2" class="price-breakdown__day price-breakdown__day--body">December 8, 2022</td><td class="price-breakdown__cost price-breakdown__cost--body"><span class="amount">$75.00</span></td></tr></tbody></table></span>

						<span class="reservation-table__extra-guests-fee reservation-table__extra-guests-fee--adults"><?php echo sprintf( __( 'Including %s per night for %s extra adults' ), htl_price( 20 ), 2 ); ?></span>

						<span class="reservation-table__extra-guests-fee reservation-table__extra-guests-fee--children"><?php echo sprintf( __( 'Including %s per night for %s extra children' ), htl_price( 5 ), 1 ); ?></span>
					</td>
				</tr>

				<tr class="reservation-table__row reservation-table__row--body">
					<td class="reservation-table__room-extra reservation-table__room-extra--body">
						<div class="extra">
							<strong class="extra__name"><?php esc_html_e( 'Extra title', 'wp-hotelier' ); ?></strong>
							<span class="extra__description"><?php esc_html_e( 'Extra description', 'wp-hotelier' ); ?></span>
						</div>
					</td>
					<td class="reservation-table__room-qty reservation-table__room-qty--body">&nbsp;</td>
					<td class="reservation-table__room-extra-cost reservation-table__room-extra-cost--body"><span class="amount"><?php echo htl_price( 5 ) ?></span></td>
				</tr>

				<tr class="reservation-table__row reservation-table__row--body">
					<td class="reservation-table__room-extra reservation-table__room-extra--body">
						<div class="extra">
							<strong class="extra__name"><?php esc_html_e( 'Extra title', 'wp-hotelier' ); ?></strong>
							<span class="extra__description"><?php esc_html_e( 'Extra description', 'wp-hotelier' ); ?></span>
						</div>
					</td>
					<td class="reservation-table__room-qty reservation-table__room-qty--body">&nbsp;</td>
					<td class="reservation-table__room-extra-cost reservation-table__room-extra-cost--body"><span class="amount"><?php echo htl_price( 30 ) ?></span></td>
				</tr>
			</tbody>
			<tfoot class="reservation-table__footer">
				<?php
					do_action( 'hotelier_reservation_table_before_footer' );

					$coupon_printed = false;
					?>

					<tr class="reservation-table__row reservation-table__row--footer">
						<th colspan="2" class="reservation-table__label reservation-table__label--subtotal"><?php esc_html_e( 'Subtotal:', 'wp-hotelier' ); ?></th>
						<td class="reservation-table__data reservation-table__data--subtotal"><strong><span class="amount"><?php echo htl_price( 285 ); ?></span></strong></td>
					</tr>

					<?php if ( htl_coupons_enabled() && ! $coupon_printed ) : ?>

						<?php $coupon_button_classes = apply_filters( 'hotelier_form_coupon_button_classes', array() ); ?>

						<tr class="reservation-table__row reservation-table__row--footer reservation-table__row--coupon-form">
							<td colspan="3" class="reservation-table__coupon-form">
								<div class="coupon-form">

									<div class="coupon-form-input-wrapper">
										<input type="text" class="input-text coupon-form__input" name="coupon" id="coupon" placeholder="<?php esc_attr_e( 'Gift or discount code', 'wp-hotelier' ); ?>" value="">
										<button type="button" class="coupon-form__apply button <?php echo esc_attr( implode( ' ', $coupon_button_classes ) ); ?>"><?php esc_html_e( 'Apply', 'wp-hotelier' ); ?></button>
									</div>
								</div>
							</td>
						</tr>

					<?php endif; ?>

					<tr class="reservation-table__row reservation-table__row--footer">
						<th colspan="2" class="reservation-table__label reservation-table__label--total"><?php esc_html_e( 'Total:', 'wp-hotelier' ); ?></th>
						<td class="reservation-table__data reservation-table__data--total"><strong><?php echo htl_price( 285 ); ?></strong></td>
					</tr>

				<?php do_action( 'hotelier_reservation_table_after_footer' );
				?>
			</tfoot>
		</table>

		<div class="reservation-non-cancellable-disclaimer">
			<p class="reservation-non-cancellable-disclaimer__text">
				<?php esc_html_e( 'This reservation includes a non-cancellable and non-refundable room. You will be charged the total price if you cancel your booking.', 'wp-hotelier' ); ?>
			</p>
		</div>

		<?php do_action( 'hotelier_booking_after_booking_table' ); ?>

	</div>

	<div id="payment" class="booking__section booking__section--payment">
		<header class="section-header">
			<h3 class="<?php echo esc_attr( apply_filters( 'hotelier_booking_section_title_class', 'section-header__title' ) ); ?>"><?php echo esc_html( apply_filters( 'hotelier_booking_section_payment_title', __( 'Payment method', 'wp-hotelier' ) ) ); ?></h3>
		</header>

		<ul class="payment-methods">
			<li class="payment-method payment-method--preview payment-method--single">
				<input id="payment-method-preview" type="radio" class="payment-method__input input-radio" name="payment_method" value="preview" checked="true" />

				<label class="payment-method__label" for="payment-method-preview">
					<?php esc_attr_e( 'Payment method', 'wp-hotelier-hello-elementor' ) ?>
				</label>

				<div class="payment-method__description">
					<?php esc_attr_e( 'Payment method description', 'wp-hotelier-hello-elementor' ) ?>
				</div>
			</li>
		</ul>
	</div>

	<div id="request-booking" class="booking__section booking__section--request-booking">

		<div class="form-row">
			<?php do_action( 'hotelier_booking_before_submit' ); ?>

			<?php echo apply_filters( 'hotelier_book_button_html', '<input type="submit" class="button button--book-button" name="hotelier_booking_book_button" id="book-button" value="' . esc_attr( __( 'Book now', 'wp-hotelier' ) ) . '" />' ); ?>

			<?php do_action( 'hotelier_booking_after_submit' ); ?>
		</div>

	</div>

	<?php do_action( 'hotelier_end_booking_form' ); ?>

</form>

<?php do_action( 'hotelier_after_booking_form', $booking, $shortcode_atts );
