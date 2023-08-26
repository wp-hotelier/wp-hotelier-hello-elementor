<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class HTL_Hello_Elementor_Room_Rates_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'htl-room-rates';
	}

	public function get_title() {
		return esc_html__( 'Room Rates', 'wp-hotelier-hello-elementor' );
	}

	public function get_icon() {
		return 'eicon-toggle';
	}

	public function get_categories() {
		return [ 'hotelier-elements' ];
	}

	public function get_keywords() {
		return [ 'hotelier', 'hotel', 'room' ];
	}

	protected function register_controls() {
		$this->register_section_design_card_controls();
		$this->register_section_design_content_controls();
		$this->register_section_design_typography_controls();
		$this->register_section_design_buttons_controls();
	}

	protected function register_section_design_card_controls() {
		$this->start_controls_section(
			'section_design_card',
			[
				'label' => esc_html__( 'Card', 'wp-hotelier-hello-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'card_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .room__rates-list' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'card_border',
				'selector' => '{{WRAPPER}} .room__rates-list, {{WRAPPER}} .room__rate',
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'width' => [
						'default' => [
							'top' => '1',
							'right' => '1',
							'bottom' => '1',
							'left' => '1',
							'isLinked' => true,
						],
					],
					'color' => [
						'default' => '#c5c5c5',
					],
				],
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'card_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .room__rates-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_padding',
			[
				'label' => esc_html__( 'Padding', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '20',
					'right' => '20',
					'bottom' => '20',
					'left' => '20',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .room__rates-list' => 'padding-left: {{LEFT}}{{UNIT}}; padding-right: {{RIGHT}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}}; padding-top: {{BOTTOM}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_section_design_content_controls() {
		$this->start_controls_section(
			'section_design_content',
			[
				'label' => esc_html__( 'Content', 'wp-hotelier-hello-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'card_vertical_rhythm',
			[
				'label' => esc_html__( 'Vertical Rhythm', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .room__rate' => 'padding-top: calc({{SIZE}}{{UNIT}} * 2); padding-bottom: calc({{SIZE}}{{UNIT}} * 2)',
					'{{WRAPPER}} .rate__description' => 'margin-top: calc({{SIZE}}{{UNIT}} * 2)',
					'{{WRAPPER}} .rate__conditions-list, {{WRAPPER}} .room__rates-list .room__min-max-stay, {{WRAPPER}} .room__rates-list .rate__non-cancellable-info, {{WRAPPER}} .room__rates-list .rate__deposit, {{WRAPPER}} .rate__price, {{WRAPPER}} .button--check-availability' => 'margin-top: {{SIZE}}{{UNIT}}',


				],
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
			'heading_title_rate_style',
			[
				'label' => esc_html__( 'Rate Titles', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'title_rate_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .rate__name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_rate_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .rate__name',
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label' => esc_html__( 'Description', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .rate__description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} .rate__description',
			]
		);

		$this->add_control(
			'heading_price_style',
			[
				'label' => esc_html__( 'Prices', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'price_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .rate__price' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .rate__price',
			]
		);

		$this->add_control(
			'heading_infos_style',
			[
				'label' => esc_html__( 'Infos', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'infos_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .room__rates-list .room__min-max-stay, {{WRAPPER}} .room__rates-list .rate__non-cancellable-info' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'infos_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} .room__rates-list .room__min-max-stay, {{WRAPPER}} .room__rates-list .rate__non-cancellable-info',
			]
		);

		$this->add_control(
			'heading_deposits_style',
			[
				'label' => esc_html__( 'Deposits', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'deposit_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .room__rates-list .rate__deposit' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'deposit_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} .room__rates-list .rate__deposit',
			]
		);

		$this->add_control(
			'heading_conditions_style',
			[
				'label' => esc_html__( 'Conditions', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'conditions_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .rate__conditions-item' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'conditions_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} .rate__conditions-item',
			]
		);

		$this->end_controls_section();
	}

	protected function register_section_design_buttons_controls() {
		$this->start_controls_section(
			'section_buttons_style',
			[
				'label' => esc_html__( 'Buttons', 'wp-hotelier-hello-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_check_availability_button_style',
			[
				'label' => esc_html__( 'Check Availability', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'check_availability_button_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .button--check-availability',
			]
		);

		$this->start_controls_tabs( 'check_availability_button_styles' );

		$this->start_controls_tab( 'check_availability_button_normal_styles', [
			'label' => esc_html__( 'Normal', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'check_availability_button_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button--check-availability' => 'background-color: {{VALUE}};',
				],
				'default' => '#818a91',
			]
		);

		$this->add_control(
			'check_availability_button_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .button--check-availability' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'check_availability_button_hover_styles', [
			'label' => esc_html__( 'Hover', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'check_availability_button_bg_color_hover',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button--check-availability:hover, {{WRAPPER}} .button--check-availability:focus' => 'background-color: {{VALUE}};',
				],
				'default' => '#818a91',
			]
		);

		$this->add_control(
			'check_availability_button_color_hover',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .button--check-availability:hover, {{WRAPPER}} .button--check-availability:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'check_availability_button_border_color_hover',
			[
				'label' => esc_html__( 'Border Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#818a91',
				'selectors' => [
					'{{WRAPPER}} .button--check-availability:hover, {{WRAPPER}} .button--check-availability:focus' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'check_availability_button_hover_transition_duration',
			[
				'label' => esc_html__( 'Transition Duration', 'wp-hotelier-hello-elementor' ) . ' (ms)',
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}}' => '--check-availability-button-hover-transition-duration: {{SIZE}}ms',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 3000,
					],
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'check_availability_button_border',
				'selector' => '{{WRAPPER}} .button--check-availability',
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'width' => [
						'default' => [
							'top' => '0',
							'right' => '0',
							'bottom' => '0',
							'left' => '0',
							'isLinked' => true,
						],
					],
					'color' => [
						'default' => '#818a91',
					],
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'check_availability_button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}' => '--check-availability-button-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'check_availability_button_padding',
			[
				'label' => esc_html__( 'Padding', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}' => '--check-availability-button-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		global $room;

		if ( ! is_room() ) {
			$room = hotelier_hello_elementor_populate_room_objet();

			if ( ! $room ) { ?>
				<div class="htl-elementor-editor-notice" style="padding: 15px;margin-bottom: 20px;color: #93003c;background-color: #93003c42;font-weight: bold;">
					<?php echo esc_html_e( 'This module can only be used on the room page.', 'wp-hotelier-hello-elementor' ); ?>
				</div>
			<?php
				return;
			}
		}

		$settings = $this->get_settings_for_display();

		add_filter( 'hotelier_single_room_rates_show_title', '__return_false' );

		if ( $room->is_variable_room() ) :
			htl_get_template( 'single-room/room-rates.php' );
		else : ?>
			<?php if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) : ?>
				<?php
				$placeholder = esc_html__( 'This is a placeholder because this room does not have room rates. This element will not be displayed on the live page.', 'wp-hotelier-hello-elementor' );
				?>
				<div class="room__rates room__rates--single">
					<?php echo esc_html( $placeholder ); ?>
				</div>
			<?php endif; ?>
		<?php endif;

		add_filter( 'hotelier_single_room_rates_show_title', '__return_true' );
	}
}
