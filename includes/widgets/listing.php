<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class HTL_Hello_Elementor_Listing_Widget extends \Elementor\Widget_Base {
	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_listing_scripts' ], 11 );
	}

	public function enqueue_listing_scripts() {
		wp_enqueue_script( 'hotelier-init-datepicker' );
	}

	public function get_name() {
		return 'htl-listing';
	}

	public function get_title() {
		return esc_html__( 'Listing', 'wp-hotelier-hello-elementor' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return [ 'hotelier-elements' ];
	}

	public function get_keywords() {
		return [ 'hotelier', 'hotel', 'rooms', 'listing' ];
	}

	protected function register_controls() {
		$this->register_section_datepicker_controls();
		$this->register_section_design_layout_controls();
		$this->register_section_design_card_controls();
		$this->register_section_design_content_controls();
		$this->register_section_design_typography_controls();
		$this->register_section_design_buttons_controls();
		$this->register_section_design_extras_controls();
		$this->register_section_design_forms_controls();
		$this->register_section_design_datepicker_controls();
		$this->register_section_design_datepicker_forms_controls();
		$this->register_section_design_notices_controls();
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

	protected function register_section_design_layout_controls() {
		$this->start_controls_section(
			'section_design_layout',
			[
				'label' => esc_html__( 'Layout', 'wp-hotelier-hello-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'items_gap',
			[
				'label' => esc_html__( 'Cards Gap', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .form--listing' => 'margin-top: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .selected-nights' => 'margin-top: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();
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
					'{{WRAPPER}} .listing__room' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'card_border',
				'selector' => '{{WRAPPER}} .listing__room, {{WRAPPER}} .room-card__action',
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

		$this->add_control(
			'card_selected_border_color',
			[
				'label' => esc_html__( 'Color (Selected)', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#CC3366',
				'selectors' => [
					'{{WRAPPER}} .listing__room.room--selected, {{WRAPPER}} .listing__room.room--queried' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'card_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .listing__room' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .room-card__content, {{WRAPPER}} .room-card__gallery' => 'padding-left: {{LEFT}}{{UNIT}}; padding-right: {{RIGHT}}{{UNIT}}',
					'{{WRAPPER}} .room-card__content' => 'padding-bottom: {{BOTTOM}}{{UNIT}}',
					'{{WRAPPER}} .room-card__gallery' => 'padding-top: {{TOP}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'card_box_shadow',
			[
				'label' => esc_html__( 'Box Shadow', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'prefix_class' => 'listing__room--shadow-',
				// 'default' => 'yes',
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
					'{{WRAPPER}} .room-card__action, {{WRAPPER}} .room-card__description, {{WRAPPER}} .room-card__rate-description, {{WRAPPER}} .room-fee, {{WRAPPER}} .room-card__price, {{WRAPPER}} .button--extras-toggle, {{WRAPPER}} .room-extras__title, {{WRAPPER}} .room-extra' => 'margin-top: calc({{SIZE}}{{UNIT}} * 2)',
					'{{WRAPPER}} .room-card__action-content' => 'padding-top: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .room-card__name, {{WRAPPER}} .room-card__rate-name, {{WRAPPER}} .room-card__info, {{WRAPPER}} .room-card__deposit, {{WRAPPER}} .room-card__meta, {{WRAPPER}} .room-card__facilities, {{WRAPPER}} .button--add-to-cart, {{WRAPPER}} .room-card__conditions-list, {{WRAPPER}} .room-extra__description, {{WRAPPER}} .room-extra__price, {{WRAPPER}} .room-extra__input' => 'margin-top: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .room-fee__title, {{WRAPPER}} .room-fee__label' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .room-extra' => 'padding: calc({{SIZE}}{{UNIT}} * 2)',
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
					'{{WRAPPER}} .room-card__name .room-card__link' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .room-card__name, {{WRAPPER}} .room-card__link',
			]
		);

		$this->add_control(
			'heading_title_rate_style',
			[
				'label' => esc_html__( 'Rate Titles', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
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
					'{{WRAPPER}} .room-card__rate-name' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .room-card__rate-name',
			]
		);

		$this->add_control(
			'heading_descriptions',
			[
				'label' => esc_html__( 'Descriptions', 'wp-hotelier-hello-elementor' ),
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
					'{{WRAPPER}} .room-card__description, {{WRAPPER}} .room-card__rate-description' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .room-card__description, {{WRAPPER}} .room-card__rate-description',
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
					'{{WRAPPER}} .room-card__price' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .room-card__price',
			]
		);

		$this->add_control(
			'heading_price_description_style',
			[
				'label' => esc_html__( 'Price Description', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'price_description_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .room-card__price-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'price_description_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} .room-card__price-description',
			]
		);

		$this->add_control(
			'heading_facilities_style',
			[
				'label' => esc_html__( 'Facilities', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'facilities_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .room-card__facilities' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'facilities_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} .room-card__facilities',
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
					'{{WRAPPER}} .room-card__info' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .room-card__info',
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
					'{{WRAPPER}} .room-card__deposit' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .room-card__deposit',
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
					'{{WRAPPER}} .room-card__conditions-item' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .room-card__conditions-item',
			]
		);

		$this->add_control(
			'heading_metas_style',
			[
				'label' => esc_html__( 'Metas', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .room-card__meta' => 'color: {{VALUE}};',
					'{{WRAPPER}} .room-card__meta span:after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} .room-card__meta',
			]
		);

		$this->add_control(
			'heading_selected_nights_style',
			[
				'label' => esc_html__( 'Selected Nights', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'selected_nights_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .selected-nights' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'selected_nights_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} .selected-nights',
			]
		);

		$this->end_controls_section();
	}

	protected function register_section_design_forms_controls() {
		$this->start_controls_section(
			'section_fields_style',
			[
				'label' => esc_html__( 'Fields', 'wp-hotelier-hello-elementor' ),
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
					'{{WRAPPER}} .room-quantity__label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'forms_label_typography',
				'selector' => '{{WRAPPER}} .room-quantity__label',
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
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .form--listing input[type="text"], {{WRAPPER}} .form--listing input[type="number"], {{WRAPPER}} .form--listing select',
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
					'{{WRAPPER}} .form--listing input[type="text"], {{WRAPPER}} input[type="number"], {{WRAPPER}} .form--listing select' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .form--listing input[type="text"], {{WRAPPER}} .form--listing input[type="number"], {{WRAPPER}} .form--listing select' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'forms_fields_normal_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'wp-hotelier-hello-elementor' ),
				'selector' => '{{WRAPPER}} .form--listing input[type="text"], {{WRAPPER}} .form--listing input[type="number"], {{WRAPPER}} .form--listing select',
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
					'{{WRAPPER}} .form--listing input[type="text"]:focus, {{WRAPPER}} .form--listing input[type="number"]:focus' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .form--listing input[type="text"]:focus, {{WRAPPER}} .form--listing input[type="number"]:focus' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'forms_fields_focus_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'wp-hotelier-hello-elementor' ),
				'selector' => '{{WRAPPER}} .form--listing input[type="text"]:focus, {{WRAPPER}} .form--listing input[type="number"]:focus',
			]
		);

		$this->add_control(
			'forms_fields_focus_border_color',
			[
				'label' => esc_html__( 'Border Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .form--listing input[type="text"]:focus, {{WRAPPER}} .form--listing input[type="number"]:focus' => 'border-color: {{VALUE}}',
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
					'{{WRAPPER}}' => '--listing-fields-focus-transition-duration: {{SIZE}}ms',
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
				'selector' => '{{WRAPPER}} .form--listing input[type="text"], {{WRAPPER}} .form--listing input[type="number"], {{WRAPPER}} .form--listing select',
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
					'{{WRAPPER}}' => '--listing-fields-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}}' => '--listing-fields-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
			'heading_book_button_style',
			[
				'label' => esc_html__( 'Book Now', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'book_button_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .button--add-to-cart',
			]
		);

		$this->start_controls_tabs( 'book_button_styles' );

		$this->start_controls_tab( 'book_button_normal_styles', [
			'label' => esc_html__( 'Normal', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'book_button_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button--add-to-cart' => 'background-color: {{VALUE}};',
				],
				'default' => '#818a91',
			]
		);

		$this->add_control(
			'book_button_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .button--add-to-cart' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'book_button_hover_styles', [
			'label' => esc_html__( 'Hover', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'book_button_bg_color_hover',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button--add-to-cart:hover, {{WRAPPER}} .button--add-to-cart:focus' => 'background-color: {{VALUE}};',
				],
				'default' => '#818a91',
			]
		);

		$this->add_control(
			'book_button_color_hover',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .button--add-to-cart:hover, {{WRAPPER}} .button--add-to-cart:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'book_button_border_color_hover',
			[
				'label' => esc_html__( 'Border Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#818a91',
				'selectors' => [
					'{{WRAPPER}} .button--add-to-cart:hover, {{WRAPPER}} .button--add-to-cart:focus' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'book_button_hover_transition_duration',
			[
				'label' => esc_html__( 'Transition Duration', 'wp-hotelier-hello-elementor' ) . ' (ms)',
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}}' => '--book-button-hover-transition-duration: {{SIZE}}ms',
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
				'name' => 'book_button_border',
				'selector' => '{{WRAPPER}} .button--add-to-cart',
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
			'book_button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}' => '--book-button-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'book_button_padding',
			[
				'label' => esc_html__( 'Padding', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}' => '--book-button-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_reserve_button_style',
			[
				'label' => esc_html__( 'Reserve', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'reserve_button_align',
			[
				'label' => esc_html__( 'Alignment', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'wp-hotelier-hello-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'wp-hotelier-hello-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'wp-hotelier-hello-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} #reserve-rooms-button' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'reserve_button_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .button--reserve',
			]
		);

		$this->start_controls_tabs( 'reserve_button_styles' );

		$this->start_controls_tab( 'reserve_button_normal_styles', [
			'label' => esc_html__( 'Normal', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'reserve_button_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button--reserve' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'reserve_button_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .button--reserve' => 'color: {{VALUE}};',
				],
				'default' => '#CC3366',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'reserve_button_hover_styles', [
			'label' => esc_html__( 'Hover', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'reserve_button_bg_color_hover',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button--reserve:hover, {{WRAPPER}} .button--reserve:focus' => 'background-color: {{VALUE}};',
				],
				'default' => '#CC3366',
			]
		);

		$this->add_control(
			'reserve_button_color_hover',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .button--reserve:hover, {{WRAPPER}} .button--reserve:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'reserve_button_border_color_hover',
			[
				'label' => esc_html__( 'Border Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#CC3366',
				'selectors' => [
					'{{WRAPPER}} .button--reserve:hover, {{WRAPPER}} .button--reserve:focus' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'reserve_button_hover_transition_duration',
			[
				'label' => esc_html__( 'Transition Duration', 'wp-hotelier-hello-elementor' ) . ' (ms)',
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}}' => '--reserve-button-hover-transition-duration: {{SIZE}}ms',
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
				'name' => 'reserve_button_border',
				'selector' => '{{WRAPPER}} .button--reserve',
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
			'reserve_button_border_radius',
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
					'{{WRAPPER}}' => '--reserve-button-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'reserve_button_padding',
			[
				'label' => esc_html__( 'Padding', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}' => '--reserve-button-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
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
			'heading_extras_toggle_style',
			[
				'label' => esc_html__( 'Toggle', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'extras_toggle_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .button--extras-toggle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'extras_toggle_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .button--extras-toggle',
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

	protected function register_section_field_controls() {
		$this->start_controls_section(
			'section_datepicker_field',
			[
				'label' => esc_html__( 'Datepicker Field', 'wp-hotelier-hello-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,

			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'datepicker_field_typography',
				'selector' => '{{WRAPPER}} .datepicker-input-select',
				'condition' => [
					'datepicker_layout' => 'default',
				],
			]
		);

		$this->add_control(
			'datepicker_field_text_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .datepicker-input-select' => 'color: {{VALUE}};',
				],
				'condition' => [
					'datepicker_layout' => 'default',
				],
			]
		);

		$this->add_control(
			'datepicker_field_bg_color',
			[
				'label' => esc_html__( 'Background', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .datepicker-input-select' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'datepicker_field_border',
				'selector' => '{{WRAPPER}} .datepicker-input-select',
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
				'condition' => [
					'datepicker_layout' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'datepicker_field_border_radius',
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
					'{{WRAPPER}} .datepicker-input-select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'datepicker_layout' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'datepicker_field_padding',
			[
				'label' => esc_html__( 'Padding', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0.5',
					'right' => '1',
					'bottom' => '0.5',
					'left' => '1',
					'unit' => 'em',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .datepicker-input-select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'datepicker_layout' => 'default',
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

	protected function register_section_design_datepicker_forms_controls() {
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

	protected function register_section_design_notices_controls() {
		$this->start_controls_section(
			'section_notices_style',
			[
				'label' => esc_html__( 'Notices', 'wp-hotelier-hello-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_notice_general_style',
			[
				'label' => esc_html__( 'General', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'notice_margin',
			[
				'label' => esc_html__( 'Margin', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .hotelier-notice' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_notice_info_style',
			[
				'label' => esc_html__( 'Info Notice', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'notice_info_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hotelier-notice--info' => 'background-color: {{VALUE}};',
				],
				'default' => '#F4F4F4'
			]
		);

		$this->add_control(
			'notice_info_text_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#313131',
				'selectors' => [
					'{{WRAPPER}} .hotelier-notice--info' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'notice_info_text_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} .hotelier-notice--info',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'notice_info_border',
				'selector' => '{{WRAPPER}} .hotelier-notice--info',
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'notice_info_padding',
			[
				'label' => esc_html__( 'Padding', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .hotelier-notice--info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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

	protected function do_hooks_before_render() {
		add_filter( 'hotelier_is_listing', '__return_true' );

		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			add_action( 'hotelier_before_room_list_form', array( $this, 'print_notices' ) );
		}
	}

	public function print_notices() {
		?>
		<div class="hotelier-notice hotelier-notice--info">
			<span class="hotelier-notice__text">
				<?php echo esc_html__( 'This is an example of "Info" notice. (You won\'t see this while previewing your site.)', 'wp-hotelier-hello-elementor' ); ?>
			</span>
		</div>

		<div class="hotelier-notice hotelier-notice--error">
			<span class="hotelier-notice__text">
				<?php echo esc_html__( 'This is an example of "Error" notice. (You won\'t see this while previewing your site.)', 'wp-hotelier-hello-elementor' ); ?>
			</span>
		</div>
		<?php
	}

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

		$shortcode_string = '[hotelier_listing ' . $atts_string . ']';

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
		if ( htl_get_page_id( 'listing' ) !== get_the_ID() ) {
			?>
			<?php if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) : ?>
			<div class="htl-elementor-editor-notice" style="padding: 15px;margin-bottom: 20px;color: #93003c;background-color: #93003c42;font-weight: bold;">
				<?php echo esc_html_e( 'This module can only be used on the listing page.', 'wp-hotelier-hello-elementor' ); ?>
			</div>
			<?php endif;
			return;
		}

		$settings = $this->get_settings_for_display();
		$shortcode_atts = $this->get_shortcode_atts( $settings );

		$this->do_hooks_before_render();

		$content = $this->render_shortcode( $shortcode_atts );

		echo $content;

		$this->do_hooks_after_render();
	}
}
