<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class HTL_Hello_Elementor_Cart_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'htl-room-deposit';
	}

	public function get_title() {
		return esc_html__( 'Cart', 'wp-hotelier-hello-elementor' );
	}

	public function get_icon() {
		return 'eicon-cart-light';
	}

	public function get_categories() {
		return [ 'hotelier-elements' ];
	}

	public function get_keywords() {
		return [ 'hotelier', 'hotel', 'rooms', 'booking' ];
	}

	protected function register_controls() {
		$this->register_section_general_controls();
		$this->register_section_design_typography_controls();
	}

	public function register_section_general_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Cart', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_control(
			'show_rooms',
			[
				'label' => esc_html__( 'Show Rooms', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_room_prices',
			[
				'label' => esc_html__( 'Show Room Prices', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
				'condition' => [
					'show_rooms' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_total',
			[
				'label' => esc_html__( 'Show Total', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->end_controls_section();
	}

	protected function register_section_design_typography_controls() {
		$this->start_controls_section(
			'section_design_typography',
			[
				'label' => esc_html__( 'Typography', 'wp-hotelier-hello-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_title_room_style',
			[
				'label' => esc_html__( 'Room Titles', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .rooms-cart__room-link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .rooms-cart__room-link',
			]
		);

		$this->add_control(
			'heading_title_room_rates',
			[
				'label' => esc_html__( 'Room Rates', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'rate_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .rooms-cart__room-rate' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'rate_typography',
				'selector' => '{{WRAPPER}} .rooms-cart__room-rate',
			]
		);

		$this->add_control(
			'heading_total_label',
			[
				'label' => esc_html__( 'Total Label', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'total_label_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .rooms-cart__total-label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'total_label_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .rooms-cart__total-label',
			]
		);

		$this->add_control(
			'heading_prices',
			[
				'label' => esc_html__( 'Prices', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'prices_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .rooms-cart__room-price' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'prices_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .rooms-cart__room-price',
			]
		);

		$this->add_control(
			'heading_total_price',
			[
				'label' => esc_html__( 'Total Price', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'total_price_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .rooms-cart__price-total' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'total_price_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .rooms-cart__price-total',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		if ( htl_get_page_id( 'booking' ) !== get_the_ID() || is_reservation_received_page() || is_pay_reservation_page() ) {
			?>
			<?php if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) : ?>
			<div class="htl-elementor-editor-notice" style="padding: 15px;margin-bottom: 20px;color: #93003c;background-color: #93003c42;font-weight: bold;">
				<?php echo esc_html_e( 'This module can only be used on the booking page.', 'wp-hotelier-hello-elementor' ); ?>
			</div>
			<?php endif;
			return;
		}

		$settings = $this->get_settings_for_display();

		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			?>
			<div class="rooms-cart">
				<?php if ( $settings['show_rooms'] === 'yes' ) : ?>
					<ul class="rooms-cart__list">
						<li class="rooms-cart__room">
							<div class="rooms-cart__room-item">
								<div class="rooms-cart__room-name">
									<a class="rooms-cart__room-link" href="#"><?php esc_html_e( 'Room title', 'wp-hotelier-hello-elementor' ); ?></a>

									<small class="rooms-cart__room-rate"><?php esc_html_e( 'Rate: rate name', 'wp-hotelier-hello-elementor' ); ?></small>
								</div>

								<?php if ( $settings['show_room_prices'] === 'yes' ) : ?>
									<span class="rooms-cart__room-price"><?php echo htl_price( 150 ) ?></span>
								<?php endif; ?>
							</div>
						</li>
						<li class="rooms-cart__room">
							<div class="rooms-cart__room-item">
								<div class="rooms-cart__room-name">
									<a class="rooms-cart__room-link" href="#"><?php esc_html_e( 'Room title', 'wp-hotelier-hello-elementor' ); ?></a>
								</div>

								<?php if ( $settings['show_room_prices'] === 'yes' ) : ?>
									<span class="rooms-cart__room-price"><span class="rooms-cart__room-price-times">2 &times;</span> <?php echo htl_price( 150 ) ?></span>
								<?php endif; ?>
							</div>
						</li>
						<li class="rooms-cart__room">
							<div class="rooms-cart__room-item">
								<div class="rooms-cart__room-name">
									<a class="rooms-cart__room-link" href="#"><?php esc_html_e( 'Room title', 'wp-hotelier-hello-elementor' ); ?></a>

									<small class="rooms-cart__room-rate"><?php esc_html_e( 'Rate: rate name', 'wp-hotelier-hello-elementor' ); ?></small>
								</div>

								<?php if ( $settings['show_room_prices'] === 'yes' ) : ?>
									<span class="rooms-cart__room-price"><?php echo htl_price( 150 ) ?></span>
								<?php endif; ?>
							</div>
						</li>
					</ul>
				<?php endif; ?>

				<?php if ( $settings['show_total'] === 'yes' ) : ?>
					<span class="rooms-cart__total"><span class="rooms-cart__total-label"><?php esc_html_e( 'Total', 'wp-hotelier' ); ?></span><span class="rooms-cart__price-total"><?php echo htl_price( 600 ) ?></span></span>
				<?php endif; ?>
			</div>
			<?php
		} else {
			if ( HTL()->session->get( 'cart' ) ) : ?>
				<div class="rooms-cart">
					<?php if ( $settings['show_rooms'] === 'yes' ) : ?>
						<ul class="rooms-cart__list">
						<?php foreach ( HTL()->cart->get_cart() as $cart_item_key => $cart_item ) :
							$_room    = $cart_item[ 'data' ];
							$_room_id = $cart_item[ 'room_id' ];

							if ( $_room && $_room->exists() && $cart_item[ 'quantity' ] > 0 ) : ?>
								<li class="rooms-cart__room">
									<div class="rooms-cart__room-item">
										<div class="rooms-cart__room-name">
											<a class="rooms-cart__room-link" href="<?php echo esc_url( get_permalink( $_room_id ) ); ?>"><?php echo esc_html( $_room->get_title() ); ?></a>

											<?php if ( $cart_item[ 'rate_name' ] ) : ?>
												<small class="rooms-cart__room-rate"><?php printf( esc_html__( 'Rate: %s', 'wp-hotelier' ), htl_get_formatted_room_rate( $cart_item[ 'rate_name' ] ) ); ?></small>
											<?php endif; ?>
										</div>

										<?php if ( $settings['show_room_prices'] === 'yes' ) : ?>
											<span class="rooms-cart__room-price"><?php echo $cart_item[ 'quantity' ] > 1 ? absint( $cart_item[ 'quantity' ] ) . ' <span class="rooms-cart__room-price-times">&times;</span>': ''; ?> <?php echo HTL()->cart->get_room_price( $cart_item[ 'total' ] ); ?></span>
										<?php endif; ?>
									</div>
								</li>
							<?php endif;
						endforeach; ?>
						</ul>
					<?php endif; ?>

					<?php if ( $settings['show_total'] === 'yes' ) : ?>
						<span class="rooms-cart__total"><span class="rooms-cart__total-label"><?php esc_html_e( 'Total', 'wp-hotelier' ); ?></span><span class="rooms-cart__price-total"><?php echo htl_cart_formatted_total(); ?></span></span>
					<?php endif; ?>
				</div>
			<?php endif;
		}
	}

}
