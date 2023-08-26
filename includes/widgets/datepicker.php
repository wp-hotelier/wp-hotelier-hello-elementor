<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class HTL_Hello_Elementor_Datepicker_Widget extends \Elementor\Widget_Base {
	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_datepicker_scripts' ], 11 );
	}

	public function enqueue_datepicker_scripts() {
		wp_enqueue_script( 'hotelier-init-datepicker' );
	}

	public function get_name() {
		return 'htl-datepicker';
	}

	public function get_title() {
		return esc_html__( 'Datepicker', 'wp-hotelier-hello-elementor' );
	}

	public function get_icon() {
		return 'eicon-calendar';
	}

	public function get_categories() {
		return [ 'hotelier-elements' ];
	}

	public function get_keywords() {
		return [ 'hotelier', 'hotel', 'dates', 'datepicker' ];
	}

	protected function register_controls() {
		$this->register_section_datepicker_controls();
		$this->register_section_design_controls();
		$this->register_section_field_controls();
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

	protected function register_section_design_controls() {
		$this->start_controls_section(
			'section_design',
			[
				'label' => esc_html__( 'Datepicker Style', 'wp-hotelier-hello-elementor' ),
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
			'heading_datepicker_main_button_style',
			[
				'label' => esc_html__( 'Main Button', 'wp-hotelier-hello-elementor' ),
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
				'name' => 'datepicker_main_button_typography',
				'selector' => '{{WRAPPER}} .button--datepicker',
				'condition' => [
					'datepicker_layout' => 'default',
				],
			]
		);

		$this->start_controls_tabs( 'datepicker_main_button_styles', [
			'condition' => [
				'datepicker_layout' => 'default',
			],
		] );

		$this->start_controls_tab( 'datepicker_main_button_normal_styles', [
			'label' => esc_html__( 'Normal', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'datepicker_main_button_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button--datepicker' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'datepicker_layout' => 'default',
				],
			]
		);

		$this->add_control(
			'datepicker_main_button_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#CC3366',
				'selectors' => [
					'{{WRAPPER}} .button--datepicker' => 'color: {{VALUE}};',
				],
				'condition' => [
					'datepicker_layout' => 'default',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'datepicker_main_button_hover_styles', [
			'label' => esc_html__( 'Hover', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'datepicker_main_button_bg_color_hover',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button--datepicker:hover, {{WRAPPER}} .button--datepicker:focus' => 'background-color: {{VALUE}};',
				],
				'default' => '#CC3366',
				'condition' => [
					'datepicker_layout' => 'default',
				],
			]
		);

		$this->add_control(
			'datepicker_main_button_color_hover',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .button--datepicker:hover, {{WRAPPER}} .button--datepicker:focus' => 'color: {{VALUE}};',
				],
				'condition' => [
					'datepicker_layout' => 'default',
				],
			]
		);

		$this->add_control(
			'datepicker_main_button_border_color_hover',
			[
				'label' => esc_html__( 'Border Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#CC3366',
				'selectors' => [
					'{{WRAPPER}} .button--datepicker:hover, {{WRAPPER}} .button--datepicker:focus' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'datepicker_layout' => 'default',
				],
			]
		);

		$this->add_control(
			'datepicker_main_button_hover_transition_duration',
			[
				'label' => esc_html__( 'Transition Duration', 'wp-hotelier-hello-elementor' ) . ' (ms)',
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}}' => '--datepicker-main-button-hover-transition-duration: {{SIZE}}ms',
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
				'name' => 'datepicker_main_button_border',
				'selector' => '{{WRAPPER}} .button--datepicker',
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
				'condition' => [
					'datepicker_layout' => 'default',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'datepicker_main_button_border_radius',
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
					'{{WRAPPER}}' => '--datepicker-main-button-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'datepicker_layout' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'datepicker_main_button_padding',
			[
				'label' => esc_html__( 'Padding', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}' => '--datepicker-main-button-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'datepicker_layout' => 'default',
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

	protected function register_section_field_controls() {
		$this->start_controls_section(
			'section_datepicker_fields_style',
			[
				'label' => esc_html__( 'Datepicker Fields', 'wp-hotelier-hello-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'datepicker_forms_fields_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} .datepicker-input-select',
			]
		);

		$this->start_controls_tabs( 'datepicker_forms_fields_styles' );

		$this->start_controls_tab( 'datepicker_forms_fields_normal_styles', [
			'label' => esc_html__( 'Normal', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'datepicker_forms_fields_normal_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .datepicker-input-select' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'datepicker_forms_fields_normal_background',
			[
				'name' => 'datepicker_forms_fields_normal_background',
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'selectors' => [
					'{{WRAPPER}} .datepicker-input-select' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'datepicker_forms_fields_normal_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'wp-hotelier-hello-elementor' ),
				'selector' => '{{WRAPPER}} .datepicker-input-select',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'datepicker_forms_fields_focus_styles', [
			'label' => esc_html__( 'Focus', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'datepicker_forms_fields_focus_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .datepicker-input-select:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'datepicker_forms_fields_focus_background',
			[
				'name' => 'datepicker_forms_fields_normal_background',
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'selectors' => [
					'{{WRAPPER}} .datepicker-input-select:focus' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'datepicker_forms_fields_focus_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'wp-hotelier-hello-elementor' ),
				'selector' => '{{WRAPPER}} .datepicker-input-select:focus',
			]
		);

		$this->add_control(
			'datepicker_forms_fields_focus_border_color',
			[
				'label' => esc_html__( 'Border Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .datepicker-input-select:focus' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'datepicker_forms_fields_border_border!' => '',
				],
			]
		);

		$this->add_control(
			'datepicker_forms_fields_focus_transition_duration',
			[
				'label' => esc_html__( 'Transition Duration', 'wp-hotelier-hello-elementor' ) . ' (ms)',
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}}' => '--datepicker-forms-fields-focus-transition-duration: {{SIZE}}ms',
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
				'name' => 'datepicker_forms_fields_border',
				'selector' => '{{WRAPPER}} .datepicker-input-select',
				'separator' => 'before',
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
						'default' => '#666666',
					],
				],
			]
		);

		$this->add_responsive_control(
			'datepicker_forms_fields_border_radius',
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
					'{{WRAPPER}}' => '--datepicker-forms-fields-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'datepicker_forms_fields_padding',
			[
				'label' => esc_html__( 'Padding', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}' => '--datepicker-forms-fields-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function do_hooks_before_render() {}

	protected function get_shortcode_atts( $settings ) {
		$atts = array();

		// Layout
		$layout = isset( $settings['datepicker_layout'] ) ? $settings['datepicker_layout'] : 'default';
		if ( $layout === 'inline' ) {
			$atts['inline'] = true;
		}

		// Bar position
		$bar_position = isset( $settings['datepicker_bar_position'] ) ? $settings['datepicker_bar_position'] : 'top';
		if ( $bar_position === 'bottom' ) {
			$atts['bar'] = 'bottom';
		}

		// Skin
		$skin = isset( $settings['datepicker_skin'] ) ? $settings['datepicker_skin'] : 'default';
		if ( $skin === 'rounded' ) {
			$atts['rounded'] = true;
		}

		// Disabled style
		$disabled_style = isset( $settings['datepicker_disabled_style'] ) ? $settings['datepicker_disabled_style'] : 'cross';
		if ( $disabled_style === 'strikethrough' ) {
			$atts['disabled_style'] = 'strikethrough';
		}

		return $atts;
	}

	protected function do_hooks_after_render() {}

	protected function render_shortcode( $atts ) {
		$atts_string = '';

		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			$atts['preview'] = true;
		}

		foreach ( $atts as $att_key => $att_value ) {
			if ( $att_value ) {
				$atts_string .= $att_key . '="' . $att_value . '" ';
			}
		}

		$shortcode_string = '[hotelier_datepicker ' . $atts_string . ']';

		$content = do_shortcode( $shortcode_string );

		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			if ( function_exists( 'htl_get_default_dates' ) ) {
				$dates = htl_get_default_dates();

				$content .= '<script>jQuery(window).trigger("hotelier_init_datepicker", ["' . $dates['checkin'] . '", "' . $dates['checkout'] . '"]);</script>';
			}
		}

		return $content;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$shortcode_atts = $this->get_shortcode_atts( $settings );

		$this->do_hooks_before_render();

		$content = $this->render_shortcode( $shortcode_atts );

		echo $content;

		$this->do_hooks_after_render();
	}
}
