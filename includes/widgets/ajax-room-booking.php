<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class HTL_Hello_Elementor_Ajax_Room_Booking_Widget extends \Elementor\Widget_Base {
	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return 'htl-ajax-room-booking';
	}

	public function get_title() {
		return esc_html__( 'AJAX Room Booking', 'wp-hotelier-hello-elementor' );
	}

	public function get_icon() {
		return 'eicon-product-add-to-cart';
	}

	public function get_categories() {
		return [ 'hotelier-elements' ];
	}

	public function get_keywords() {
		return [ 'hotelier', 'hotel', 'room', 'ajax', 'booking' ];
	}

	protected function register_controls() {
		$this->register_section_general_controls();
		$this->register_section_datepicker_controls();
		$this->register_section_design_datepicker_controls();
		$this->register_section_design_typography_controls();
		$this->register_section_design_forms_controls();
		$this->register_section_design_extras_controls();
		$this->register_section_design_notices_controls();
	}

	public function register_section_general_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Settings', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_control(
			'show_quantity_selection',
			[
				'label' => esc_html__( 'Show Quantity Selection', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'show_guests_selection',
			[
				'label' => esc_html__( 'Show Guests Selection', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'show_rate_descriptions',
			[
				'label' => esc_html__( 'Show Rate Description', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'show_room_conditions',
			[
				'label' => esc_html__( 'Show Room Conditions', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'show_room_deposit',
			[
				'label' => esc_html__( 'Show Room Deposit', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default'   => 'yes',
			]
		);

		$this->end_controls_section();
	}

	protected function register_section_datepicker_controls() {
		$this->start_controls_section(
			'section_datepicker',
			[
				'label' => esc_html__( 'Datepicker', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_control(
			'datepicker_layout',
			[
				'label' => esc_html__( 'Layout', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__( 'Default', 'wp-hotelier-hello-elementor' ),
					'inline' => esc_html__( 'Inline', 'wp-hotelier-hello-elementor' ),
				],
			]
		);

		$this->add_control(
			'datepicker_bar_position',
			[
				'label' => esc_html__( 'Bar Position', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'top',
				'options' => [
					'top' => esc_html__( 'Top', 'wp-hotelier-hello-elementor' ),
					'bottom' => esc_html__( 'Bottom', 'wp-hotelier-hello-elementor' ),
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_section_design_datepicker_controls() {
		$this->start_controls_section(
			'section_design_datepicker',
			[
				'label' => esc_html__( 'Datepicker', 'wp-hotelier-hello-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,

			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'datepicker_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .datepicker',
			]
		);

		$this->add_control(
			'datepicker_skin',
			[
				'label' => esc_html__( 'Skin', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__( 'Default', 'wp-hotelier-hello-elementor' ),
					'rounded' => esc_html__( 'Rounded', 'wp-hotelier-hello-elementor' ),
				],
			]
		);

		$this->add_control(
			'datepicker_disabled_style',
			[
				'label' => esc_html__( 'Disabled Style', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'cross',
				'options' => [
					'cross'         => esc_html__( 'Cross', 'wp-hotelier-hello-elementor' ),
					'strikethrough' => esc_html__( 'Strikethrough', 'wp-hotelier-hello-elementor' ),
				],
			]
		);

		$this->add_control(
			'datepicker_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .datepicker, {{WRAPPER}} .datepicker table, {{WRAPPER}} .datepicker caption, {{WRAPPER}} .datepicker th, {{WRAPPER}} .datepicker td' => 'background-color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'datepicker_border_color',
			[
				'label' => esc_html__( 'Border Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#e6e6e6',
				'selectors' => [
					'{{WRAPPER}} .datepicker__months:before, {{WRAPPER}} .datepicker--topbar-bottom .datepicker__inner:before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .datepicker__topbar, {{WRAPPER}} .datepicker--topbar-bottom .datepicker__topbar' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'datepicker_today_bg_color',
			[
				'label' => esc_html__( 'Today Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} td.datepicker__month-day--today, {{WRAPPER}} td.datepicker__month-day--today:hover' => 'background-color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'datepicker_today_text_color',
			[
				'label' => esc_html__( 'Today Text Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} td.datepicker__month-day--today, {{WRAPPER}} td.datepicker__month-day--today:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'datepicker_selected_bg_color',
			[
				'label' => esc_html__( 'Selected Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#f3f3f3',
				'selectors' => [
					'{{WRAPPER}} td.datepicker__month-day--selected, {{WRAPPER}} td.datepicker__month-day--selected:hover, {{WRAPPER}} td.datepicker__month-day--hovering, {{WRAPPER}} td.datepicker__month-day--hovering:hover' => 'background-color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'datepicker_accent_text_color',
			[
				'label' => esc_html__( 'Accent Text Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .datepicker__month-day:hover, {{WRAPPER}} td.datepicker__month-day--first-day-selected, {{WRAPPER}} td.datepicker__month-day--last-day-selected, {{WRAPPER}} td.datepicker__month-day--first-day-selected:hover, {{WRAPPER}} td.datepicker__month-day--last-day-selected:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'datepicker_accent_color',
			[
				'label' => esc_html__( 'Accent Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#CC3366',
				'selectors' => [
					'{{WRAPPER}} .datepicker__month-day:hover, {{WRAPPER}} td.datepicker__month-day--first-day-selected, {{WRAPPER}} td.datepicker__month-day--last-day-selected, {{WRAPPER}} td.datepicker__month-day--first-day-selected:hover, {{WRAPPER}} td.datepicker__month-day--last-day-selected:hover' => 'background-color: {{VALUE}} !important',
					'{{WRAPPER}} td.datepicker__month-day--selected, {{WRAPPER}} td.datepicker__month-day--selected:hover, {{WRAPPER}} td.datepicker__month-day--hovering, {{WRAPPER}} td.datepicker__month-day--hovering:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'heading_datepicker_close_button_style',
			[
				'label' => esc_html__( 'Close Button', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'datepicker_layout' => 'default',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'datepicker_close_button_typography',
				'selector' => '{{WRAPPER}} .datepicker__close-button',
				'condition' => [
					'datepicker_layout' => 'default',
				],
			]
		);

		$this->start_controls_tabs( 'datepicker_close_button_styles', [
			'condition' => [
				'datepicker_layout' => 'default',
			],
		] );

		$this->start_controls_tab( 'datepicker_close_button_normal_styles', [
			'label' => esc_html__( 'Normal', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'datepicker_close_button_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .datepicker__close-button' => 'background-color: {{VALUE}};',
				],
				'default' => '#818a91',
				'condition' => [
					'datepicker_layout' => 'default',
				],
			]
		);

		$this->add_control(
			'datepicker_close_button_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .datepicker__close-button' => 'color: {{VALUE}};',
				],
				'condition' => [
					'datepicker_layout' => 'default',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'datepicker_close_button_hover_styles', [
			'label' => esc_html__( 'Hover', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'datepicker_close_button_bg_color_hover',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .datepicker__close-button:hover, {{WRAPPER}} .datepicker__close-button:focus' => 'background-color: {{VALUE}};',
				],
				'default' => '#818a91',
				'condition' => [
					'datepicker_layout' => 'default',
				],
			]
		);

		$this->add_control(
			'datepicker_close_button_color_hover',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .datepicker__close-button:hover, {{WRAPPER}} .datepicker__close-button:focus' => 'color: {{VALUE}};',
				],
				'condition' => [
					'datepicker_layout' => 'default',
				],
			]
		);

		$this->add_control(
			'datepicker_close_button_border_color_hover',
			[
				'label' => esc_html__( 'Border Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#818a91',
				'selectors' => [
					'{{WRAPPER}} .datepicker__close-button:hover, {{WRAPPER}} .datepicker__close-button:focus' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'datepicker_layout' => 'default',
				],
			]
		);

		$this->add_control(
			'datepicker_close_button_hover_transition_duration',
			[
				'label' => esc_html__( 'Transition Duration', 'wp-hotelier-hello-elementor' ) . ' (ms)',
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}}' => '--datepicker-close-button-hover-transition-duration: {{SIZE}}ms',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 3000,
					],
				],
				'condition' => [
					'datepicker_layout' => 'default',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'datepicker_close_button_border',
				'selector' => '{{WRAPPER}} .datepicker__close-button',
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
				'condition' => [
					'datepicker_layout' => 'default',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'datepicker_close_button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '3',
					'right' => '3',
					'bottom' => '3',
					'left' => '3',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}}' => '--datepicker-close-button-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'datepicker_layout' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'datepicker_close_button_padding',
			[
				'label' => esc_html__( 'Padding', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}' => '--datepicker-close-button-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'datepicker_layout' => 'default',
				],
			]
		);

		$this->add_control(
			'heading_datepicker_clear_button_style',
			[
				'label' => esc_html__( 'Clear Button', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'datepicker_layout' => 'inline',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'datepicker_clear_button_typography',
				'selector' => '{{WRAPPER}} .datepicker__clear-button',
				'condition' => [
					'datepicker_layout' => 'inline',
				],
			]
		);

		$this->start_controls_tabs( 'datepicker_clear_button_styles', [
			'condition' => [
				'datepicker_layout' => 'inline',
			],
		] );

		$this->start_controls_tab( 'datepicker_clear_button_normal_styles', [
			'label' => esc_html__( 'Normal', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'datepicker_clear_button_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .datepicker__clear-button' => 'background-color: {{VALUE}};',
				],
				'default' => '#818a91',
				'condition' => [
					'datepicker_layout' => 'inline',
				],
			]
		);

		$this->add_control(
			'datepicker_clear_button_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .datepicker__clear-button' => 'color: {{VALUE}};',
				],
				'condition' => [
					'datepicker_layout' => 'inline',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'datepicker_clear_button_hover_styles', [
			'label' => esc_html__( 'Hover', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'datepicker_clear_button_bg_color_hover',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .datepicker__clear-button:hover, {{WRAPPER}} .datepicker__clear-button:focus' => 'background-color: {{VALUE}};',
				],
				'default' => '#818a91',
				'condition' => [
					'datepicker_layout' => 'inline',
				],
			]
		);

		$this->add_control(
			'datepicker_clear_button_color_hover',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .datepicker__clear-button:hover, {{WRAPPER}} .datepicker__clear-button:focus' => 'color: {{VALUE}};',
				],
				'condition' => [
					'datepicker_layout' => 'inline',
				],
			]
		);

		$this->add_control(
			'datepicker_clear_button_border_color_hover',
			[
				'label' => esc_html__( 'Border Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#818a91',
				'selectors' => [
					'{{WRAPPER}} .datepicker__clear-button:hover, {{WRAPPER}} .datepicker__clear-button:focus' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'datepicker_layout' => 'inline',
				],
			]
		);

		$this->add_control(
			'datepicker_clear_button_hover_transition_duration',
			[
				'label' => esc_html__( 'Transition Duration', 'wp-hotelier-hello-elementor' ) . ' (ms)',
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}}' => '--datepicker-clear-button-hover-transition-duration: {{SIZE}}ms',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 3000,
					],
				],
				'condition' => [
					'datepicker_layout' => 'inline',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'datepicker_clear_button_border',
				'selector' => '{{WRAPPER}} .datepicker__clear-button',
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
				'condition' => [
					'datepicker_layout' => 'inline',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'datepicker_clear_button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '3',
					'right' => '3',
					'bottom' => '3',
					'left' => '3',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}}' => '--datepicker-clear-button-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'datepicker_layout' => 'inline',
				],
			]
		);

		$this->add_responsive_control(
			'datepicker_clear_button_padding',
			[
				'label' => esc_html__( 'Padding', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}' => '--datepicker-clear-button-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'datepicker_layout' => 'inline',
				],
			]
		);

		$this->add_control(
			'heading_datepicker_submit_button_style',
			[
				'label' => esc_html__( 'Submit Button', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'datepicker_layout' => 'inline',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'datepicker_submit_button_typography',
				'selector' => '{{WRAPPER}} .datepicker__submit-button',
				'condition' => [
					'datepicker_layout' => 'inline',
				],
			]
		);

		$this->start_controls_tabs( 'datepicker_submit_button_styles', [
			'condition' => [
				'datepicker_layout' => 'inline',
			],
		] );

		$this->start_controls_tab( 'datepicker_submit_button_normal_styles', [
			'label' => esc_html__( 'Normal', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'datepicker_submit_button_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .datepicker__submit-button' => 'background-color: {{VALUE}};',
				],
				'default' => '#818a91',
				'condition' => [
					'datepicker_layout' => 'inline',
				],
			]
		);

		$this->add_control(
			'datepicker_submit_button_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .datepicker__submit-button' => 'color: {{VALUE}};',
				],
				'condition' => [
					'datepicker_layout' => 'inline',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'datepicker_submit_button_hover_styles', [
			'label' => esc_html__( 'Hover', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'datepicker_submit_button_bg_color_hover',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .datepicker__submit-button:hover, {{WRAPPER}} .datepicker__submit-button:focus' => 'background-color: {{VALUE}};',
				],
				'default' => '#818a91',
				'condition' => [
					'datepicker_layout' => 'inline',
				],
			]
		);

		$this->add_control(
			'datepicker_submit_button_color_hover',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .datepicker__submit-button:hover, {{WRAPPER}} .datepicker__submit-button:focus' => 'color: {{VALUE}};',
				],
				'condition' => [
					'datepicker_layout' => 'inline',
				],
			]
		);

		$this->add_control(
			'datepicker_submit_button_border_color_hover',
			[
				'label' => esc_html__( 'Border Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#818a91',
				'selectors' => [
					'{{WRAPPER}} .datepicker__submit-button:hover, {{WRAPPER}} .datepicker__submit-button:focus' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'datepicker_layout' => 'inline',
				],
			]
		);

		$this->add_control(
			'datepicker_submit_button_hover_transition_duration',
			[
				'label' => esc_html__( 'Transition Duration', 'wp-hotelier-hello-elementor' ) . ' (ms)',
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}}' => '--datepicker-submit-button-hover-transition-duration: {{SIZE}}ms',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 3000,
					],
				],
				'condition' => [
					'datepicker_layout' => 'inline',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'datepicker_submit_button_border',
				'selector' => '{{WRAPPER}} .datepicker__submit-button',
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
				'condition' => [
					'datepicker_layout' => 'inline',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'datepicker_submit_button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '3',
					'right' => '3',
					'bottom' => '3',
					'left' => '3',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}}' => '--datepicker-submit-button-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'datepicker_layout' => 'inline',
				],
			]
		);

		$this->add_responsive_control(
			'datepicker_submit_button_padding',
			[
				'label' => esc_html__( 'Padding', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}' => '--datepicker-submit-button-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'datepicker_layout' => 'inline',
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
					'{{WRAPPER}} .widget-ajax-room-booking__data--price' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .widget-ajax-room-booking__data--price',
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
					'{{WRAPPER}} .widget-ajax-room-booking__data--info, {{WRAPPER}} .room-extra__info' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .widget-ajax-room-booking__data--info, {{WRAPPER}} .room-extra__info',
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
					'{{WRAPPER}} .room__deposit-amount, {{WRAPPER}} .rate__deposit-amount' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .room__deposit-amount, {{WRAPPER}} .rate__deposit-amount',
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
					'{{WRAPPER}} .room__conditions-item, {{WRAPPER}} .rate__conditions-item' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .room__conditions-item, {{WRAPPER}} .rate__conditions-item',
			]
		);

		$this->add_control(
			'heading_reset_style',
			[
				'label' => esc_html__( 'Reset', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'reset_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .reset--widget-ajax-room-booking' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'reset_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} .reset--widget-ajax-room-booking',
			]
		);

		$this->end_controls_section();
	}

	protected function register_section_design_forms_controls() {
		$this->start_controls_section(
			'section_forms_style',
			[
				'label' => esc_html__( 'Forms', 'wp-hotelier-hello-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'forms_label_title',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => esc_html__( 'Labels', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_control(
			'forms_label_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .form-row__label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'forms_label_typography',
				'selector' => '{{WRAPPER}} .form-row__label',
			]
		);

		$this->add_control(
			'heading_forms_fields_style',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => esc_html__( 'Fields', 'wp-hotelier-hello-elementor' ),
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'forms_fields_typography',
				'selector' => '{{WRAPPER}} .form--widget-ajax-room-booking input[type="text"], {{WRAPPER}} .form--widget-ajax-room-booking input[type="number"], {{WRAPPER}} .form--widget-ajax-room-booking select, {{WRAPPER}} .form--widget-ajax-room-booking textarea',
			]
		);

		$this->start_controls_tabs( 'forms_fields_styles' );

		$this->start_controls_tab( 'forms_fields_normal_styles', [
			'label' => esc_html__( 'Normal', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'forms_fields_normal_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .form--widget-ajax-room-booking input[type="text"], {{WRAPPER}} .form--widget-ajax-room-booking input[type="number"], {{WRAPPER}} .form--widget-ajax-room-booking select, {{WRAPPER}} .form--widget-ajax-room-booking textarea' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'forms_fields_placeholder_color',
			[
				'label' => esc_html__( 'Placeholder', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .form--widget-ajax-room-booking input::placeholder' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'forms_fields_normal_background',
			[
				'name' => 'forms_fields_normal_background',
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'selectors' => [
					'{{WRAPPER}} .form--widget-ajax-room-booking input[type="text"], {{WRAPPER}} .form--widget-ajax-room-booking input[type="number"], {{WRAPPER}} .form--widget-ajax-room-booking select, {{WRAPPER}} .form--widget-ajax-room-booking textarea' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'forms_fields_normal_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'wp-hotelier-hello-elementor' ),
				'selector' => '{{WRAPPER}} .form--widget-ajax-room-booking input[type="text"], {{WRAPPER}} .form--widget-ajax-room-booking input[type="number"], {{WRAPPER}} .form--widget-ajax-room-booking select, {{WRAPPER}} .form--widget-ajax-room-booking textarea',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'forms_fields_focus_styles', [
			'label' => esc_html__( 'Focus', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'forms_fields_focus_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .form--widget-ajax-room-booking input[type="text"]:focus, {{WRAPPER}} .form--widget-ajax-room-booking input[type="number"]:focus, {{WRAPPER}} .form--widget-ajax-room-booking textarea:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'forms_fields_focus_background',
			[
				'name' => 'forms_fields_normal_background',
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'selectors' => [
					'{{WRAPPER}} .form--widget-ajax-room-booking input[type="text"]:focus, {{WRAPPER}} .form--widget-ajax-room-booking input[type="number"]:focus, {{WRAPPER}} .form--widget-ajax-room-booking textarea:focus' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'forms_fields_focus_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'wp-hotelier-hello-elementor' ),
				'selector' => '{{WRAPPER}} .form--widget-ajax-room-booking input[type="text"]:focus, {{WRAPPER}} .form--widget-ajax-room-booking input[type="number"]:focus, {{WRAPPER}} .form--widget-ajax-room-booking textarea:focus',
			]
		);

		$this->add_control(
			'forms_fields_focus_border_color',
			[
				'label' => esc_html__( 'Border Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .form--widget-ajax-room-booking input[type="text"]:focus, {{WRAPPER}} .form--widget-ajax-room-booking input[type="number"]:focus, {{WRAPPER}} .form--widget-ajax-room-booking textarea:focus' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'forms_fields_border_border!' => '',
				],
			]
		);

		$this->add_control(
			'forms_fields_focus_transition_duration',
			[
				'label' => esc_html__( 'Transition Duration', 'wp-hotelier-hello-elementor' ) . ' (ms)',
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}}' => '--widget-ajax-room-booking-fields-focus-transition-duration: {{SIZE}}ms',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 3000,
					],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'forms_fields_border',
				'selector' => '{{WRAPPER}} .form--widget-ajax-room-booking input[type="text"], {{WRAPPER}} .form--widget-ajax-room-booking input[type="number"], {{WRAPPER}} .form--widget-ajax-room-booking select, {{WRAPPER}} .form--widget-ajax-room-booking textarea',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'forms_fields_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}' => '--widget-ajax-room-booking-fields-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'forms_fields_padding',
			[
				'label' => esc_html__( 'Padding', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}' => '--widget-ajax-room-booking-fields-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'submit_button_style',
			[
				'label' => esc_html__( 'Submit Button', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'submit_button_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .button--widget-ajax-room-booking',
			]
		);

		$this->start_controls_tabs( 'submit_button_styles' );

		$this->start_controls_tab( 'submit_button_normal_styles', [
			'label' => esc_html__( 'Normal', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'submit_button_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button--widget-ajax-room-booking' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'submit_button_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .button--widget-ajax-room-booking' => 'color: {{VALUE}};',
				],
				'default' => '#CC3366',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'submit_button_hover_styles', [
			'label' => esc_html__( 'Hover', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'submit_button_bg_color_hover',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button--widget-ajax-room-booking:hover, {{WRAPPER}} .button--widget-ajax-room-booking:focus' => 'background-color: {{VALUE}};',
				],
				'default' => '#CC3366',
			]
		);

		$this->add_control(
			'submit_button_color_hover',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .button--widget-ajax-room-booking:hover, {{WRAPPER}} .button--widget-ajax-room-booking:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'submit_button_border_color_hover',
			[
				'label' => esc_html__( 'Border Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#CC3366',
				'selectors' => [
					'{{WRAPPER}} .button--widget-ajax-room-booking:hover, {{WRAPPER}} .button--widget-ajax-room-booking:focus' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'submit_button_hover_transition_duration',
			[
				'label' => esc_html__( 'Transition Duration', 'wp-hotelier-hello-elementor' ) . ' (ms)',
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}}' => '--widget-ajax-room-booking-button-hover-transition-duration: {{SIZE}}ms',
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
				'name' => 'submit_button_border',
				'selector' => '{{WRAPPER}} .button--widget-ajax-room-booking',
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
						'default' => '#CC3366',
					],
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'submit_button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '3',
					'right' => '3',
					'bottom' => '3',
					'left' => '3',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}}' => '--widget-ajax-room-booking-button-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'submit_button_padding',
			[
				'label' => esc_html__( 'Padding', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}' => '--widget-ajax-room-booking-button-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_section_design_notices_controls() {
		$this->start_controls_section(
			'section_notices_style',
			[
				'label' => esc_html__( 'Notices', 'wp-hotelier-hello-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_notice_error_style',
			[
				'label' => esc_html__( 'Error Notice', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'notice_error_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hotelier-notice--error' => 'background-color: {{VALUE}};',
				],
				'default' => '#FFEDED'
			]
		);

		$this->add_control(
			'notice_error_text_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FF3100',
				'selectors' => [
					'{{WRAPPER}} .hotelier-notice--error' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'notice_error_text_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} .hotelier-notice--error',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'notice_error_border',
				'selector' => '{{WRAPPER}} .hotelier-notice--error',
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'notice_error_padding',
			[
				'label' => esc_html__( 'Padding', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .hotelier-notice--error' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	}

	protected function register_section_design_extras_controls() {
		$this->start_controls_section(
			'section_extras_content',
			[
				'label' => esc_html__( 'Extras', 'wp-hotelier-hello-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_extras_content_style',
			[
				'label' => esc_html__( 'Content', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'extras_background_color',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#f0f0f0',
				'selectors' => [
					'{{WRAPPER}} .room-extra' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'extras_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .room-extra' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_extras_title_style',
			[
				'label' => esc_html__( 'Title', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'extras_title_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .room-extra__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'extras_title_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .room-extra__title',
			]
		);

		$this->add_control(
			'heading_extras_description_style',
			[
				'label' => esc_html__( 'Description', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'extras_description_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .room-extra__description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'extras_description_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} .room-extra__description',
			]
		);

		$this->add_control(
			'heading_extras_price_style',
			[
				'label' => esc_html__( 'Price', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'extras_price_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .room-extra__price' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'extras_price_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} .room-extra__price',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		wp_enqueue_script( 'hotelier-ajax-room-booking' );

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

		$show_guests_selection = isset( $settings[ 'show_guests_selection' ] ) && $settings[ 'show_guests_selection' ] === 'yes' ? true : false;
		$show_quantity         = isset( $settings[ 'show_quantity_selection' ] ) && $settings[ 'show_quantity_selection' ] === 'yes' ? true : false;
		$show_rate_desc        = isset( $settings[ 'show_rate_descriptions' ] ) && $settings[ 'show_rate_descriptions' ] === 'yes' ? true : false;
		$show_room_conditions  = isset( $settings[ 'show_room_conditions' ] ) && $settings[ 'show_room_conditions' ] === 'yes' ? true : false;
		$show_room_deposit     = isset( $settings[ 'show_room_deposit' ] ) && $settings[ 'show_room_deposit' ] === 'yes' ? true : false;

		$checkin  = HTL()->session->get( 'checkin' );
		$checkout = HTL()->session->get( 'checkout' );

		$default_dates = '';

		$datepicker_atts = array();

		// Layout
		$datepicker_layout = isset( $settings['datepicker_layout'] ) ? $settings['datepicker_layout'] : 'default';
		if ( $datepicker_layout === 'inline' ) {
			$datepicker_atts['inline'] = true;
		}

		// Bar position
		$datepicker_bar_position = isset( $settings['datepicker_bar_position'] ) ? $settings['datepicker_bar_position'] : 'top';
		if ( $datepicker_bar_position === 'bottom' ) {
			$datepicker_atts['bar'] = 'bottom';
		}

		// Skin
		$datepicker_skin = isset( $settings['datepicker_skin'] ) ? $settings['datepicker_skin'] : 'default';
		if ( $datepicker_skin === 'rounded' ) {
			$datepicker_atts['rounded'] = true;
		}

		// Disabled style
		$datepicker_disabled_style = isset( $settings['datepicker_disabled_style'] ) ? $settings['datepicker_disabled_style'] : 'cross';
		if ( $datepicker_disabled_style === 'strikethrough' ) {
			$datepicker_atts['disabled_style'] = 'strikethrough';
		}

		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			$_checkin  = new DateTime( $checkin );
			$_checkout = new DateTime( $checkout );

			$default_dates = $_checkin->format( 'j M Y' ) . ' - ' . $_checkout->format( 'j M Y' );
		}

		ob_start();

		htl_get_template( 'widgets/ajax-room-booking/ajax-room-booking-form.php', array(
			'default_dates'         => $default_dates,
			'checkin'               => $checkin,
			'checkout'              => $checkout,
			'show_guests_selection' => $show_guests_selection,
			'show_quantity'         => $show_quantity,
			'show_rate_desc'        => $show_rate_desc,
			'show_room_conditions'  => $show_room_conditions,
			'show_room_deposit'     => $show_room_deposit,
			'datepicker_atts'       => $datepicker_atts,
		) );

		echo ob_get_clean();

		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			if ( function_exists( 'htl_get_default_dates' ) ) {
				$dates = htl_get_default_dates();

				echo '<script>jQuery(window).trigger("hotelier_init_datepicker", ["' . $dates['checkin'] . '", "' . $dates['checkout'] . '"]);</script>';
			}
		}
	}

}
