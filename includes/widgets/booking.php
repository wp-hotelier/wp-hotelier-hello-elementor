<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class HTL_Hello_Elementor_Booking_Widget extends \Elementor\Widget_Base {
	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return 'htl-booking';
	}

	public function get_title() {
		return esc_html__( 'Booking', 'wp-hotelier-hello-elementor' );
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	public function get_categories() {
		return [ 'hotelier-elements' ];
	}

	public function get_keywords() {
		return [ 'hotelier', 'hotel', 'rooms', 'booking', 'form' ];
	}

	protected function register_controls() {
		$this->register_section_general_controls();
		$this->register_section_guest_details_controls();
		$this->register_section_additional_information_controls();
		$this->register_section_booking_details_controls();
		$this->register_section_reservation_table_controls();
		$this->register_section_received_reservation_details_controls();
		$this->register_section_received_guest_details_controls();
		$this->register_section_received_guest_address_controls();
		$this->register_section_payment_method_controls();
		$this->register_section_design_sections();
		$this->register_section_design_content_controls();
		$this->register_section_design_typography_controls();
		$this->register_section_design_forms_controls();
		$this->register_section_design_tables_controls();
		$this->register_section_design_coupon_controls();
		$this->register_section_design_buttons_controls();
		$this->register_section_design_notices_controls();
	}

	protected function register_section_general_controls() {
		$this->start_controls_section(
			'section_general',
			[
				'label' => esc_html__( 'General', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_control(
			'booking_layout',
			[
				'label' => esc_html__( 'Layout', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'one-column' => esc_html__( 'One column', 'wp-hotelier-hello-elementor' ),
					'two-columns' => esc_html__( 'Two columns', 'wp-hotelier-hello-elementor' ),
				],
				'default' => 'one-column',
				'prefix_class' => 'booking-layout-',
			]
		);

		$this->add_control(
			'booking_main_column_width',
			[
				'label' => esc_html__( 'Main Column Width', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 55,
				],
				'condition' => [
					'booking_layout' => 'two-columns',
				],
				'selectors' => [
					'{{WRAPPER}} .booking__column--1' => 'width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .booking__column--2' => 'width: calc(100% - {{SIZE}}{{UNIT}})',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_section_guest_details_controls() {
		$this->start_controls_section(
			'section_guest_details',
			[
				'label' => esc_html__( 'Guest Details', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_control(
			'section_guest_details_section_title',
			[
				'label' => esc_html__( 'Section Title', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Guest details', 'wp-hotelier-hello-elementor' ),
				'default' => esc_html__( 'Guest details', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_responsive_control(
			'section_guest_details_section_title_alignment',
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
				'selectors' => [
					'{{WRAPPER}}' => '--guest-details-section-title-alignment: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_section_additional_information_controls() {
		$this->start_controls_section(
			'section_additional_information',
			[
				'label' => esc_html__( 'Additional information', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_control(
			'section_additional_information_section_title',
			[
				'label' => esc_html__( 'Section Title', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Additional information', 'wp-hotelier-hello-elementor' ),
				'default' => esc_html__( 'Additional information', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_responsive_control(
			'section_additional_information_section_title_alignment',
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
				'selectors' => [
					'{{WRAPPER}}' => '--additional-information-section-title-alignment: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_section_booking_details_controls() {
		$this->start_controls_section(
			'section_booking_details',
			[
				'label' => esc_html__( 'Booking details', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_control(
			'section_booking_details_section_title',
			[
				'label' => esc_html__( 'Section Title', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Booking details', 'wp-hotelier-hello-elementor' ),
				'default' => esc_html__( 'Booking details', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_responsive_control(
			'section_booking_details_section_title_alignment',
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
				'selectors' => [
					'{{WRAPPER}}' => '--booking-details-section-title-alignment: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_section_reservation_table_controls() {
		$this->start_controls_section(
			'section_reservation_table',
			[
				'label' => esc_html__( 'Reservation table', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_control(
			'section_reservation_table_section_title',
			[
				'label' => esc_html__( 'Section Title', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Your reservation', 'wp-hotelier-hello-elementor' ),
				'default' => esc_html__( 'Your reservation', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_responsive_control(
			'section_reservation_table_section_title_alignment',
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
				'selectors' => [
					'{{WRAPPER}}' => '--reservation-table-section-title-alignment: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_section_received_reservation_details_controls() {
		$this->start_controls_section(
			'section_received_reservation_details',
			[
				'label' => esc_html__( 'Reservation details (Received page)', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_control(
			'section_received_reservation_details_section_title',
			[
				'label' => esc_html__( 'Section Title', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Reservation details', 'wp-hotelier-hello-elementor' ),
				'default' => esc_html__( 'Reservation details', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_responsive_control(
			'section_received_reservation_details_section_title_alignment',
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
				'selectors' => [
					'{{WRAPPER}}' => '--received-reservation-details-section-title-alignment: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_section_received_guest_details_controls() {
		$this->start_controls_section(
			'section_received_guest_details',
			[
				'label' => esc_html__( 'Guest details (Received page)', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_control(
			'section_received_guest_details_section_title',
			[
				'label' => esc_html__( 'Section Title', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Guest details', 'wp-hotelier-hello-elementor' ),
				'default' => esc_html__( 'Guest details', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_responsive_control(
			'section_received_guest_details_section_title_alignment',
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
				'selectors' => [
					'{{WRAPPER}}' => '--received-guest-details-section-title-alignment: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_section_received_guest_address_controls() {
		$this->start_controls_section(
			'section_received_guest_address',
			[
				'label' => esc_html__( 'Guest address (Received page)', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_control(
			'section_received_guest_address_section_title',
			[
				'label' => esc_html__( 'Section Title', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Guest address', 'wp-hotelier-hello-elementor' ),
				'default' => esc_html__( 'Guest address', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_responsive_control(
			'section_received_guest_address_section_title_alignment',
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
				'selectors' => [
					'{{WRAPPER}}' => '--received-guest-address-section-title-alignment: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_section_payment_method_controls() {
		$this->start_controls_section(
			'section_payment_method',
			[
				'label' => esc_html__( 'Payment method', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_control(
			'section_payment_method_section_title',
			[
				'label' => esc_html__( 'Section Title', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Payment method', 'wp-hotelier-hello-elementor' ),
				'default' => esc_html__( 'Payment method', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_responsive_control(
			'section_payment_method_section_title_alignment',
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
				'selectors' => [
					'{{WRAPPER}}' => '--payment-method-section-title-alignment: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_section_design_sections() {
		$this->start_controls_section(
			'section_design_sections',
			[
				'label' => esc_html__( 'Sections', 'wp-hotelier-hello-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'sections_background_color',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}' => '--booking-section-background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'sections_normal_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'wp-hotelier-hello-elementor' ),
				'selector' => '{{WRAPPER}} .booking__section, {{WRAPPER}} .reservation-received__section',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'sections_border_type',
				'selector' => '{{WRAPPER}} .booking__section, {{WRAPPER}} .reservation-received__section',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'sections_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}' => '--booking-section-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'sections_padding',
			[
				'label' => esc_html__( 'Padding', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}' => '--booking-section-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'sections_margin',
			[
				'label' => esc_html__( 'Margin', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}' => '--booking-section-margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'booking_vertical_rhythm',
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
					'{{WRAPPER}} .form-row__label' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .form-row__label,
					{{WRAPPER}} .form-row__description,
					{{WRAPPER}} .form-row--booking-terms,
					{{WRAPPER}} .form-row--mailchimp-signup-form,
					{{WRAPPER}} .reservation-non-cancellable-disclaimer,
					{{WRAPPER}} .reservation-table__room-non-cancellable,
					{{WRAPPER}} .reservation-table__room-guests,
					{{WRAPPER}} .reservation-table__room-guests .form-row__label, {{WRAPPER}} .reservation-table__room-remove' => 'margin-top: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .section-header__title, {{WRAPPER}} .form-row, {{WRAPPER}} .reservation-response, {{WRAPPER}} .bank-transfer-instructions p' => 'margin-bottom: calc({{SIZE}}{{UNIT}} * 2)',
					'{{WRAPPER}} .reservation-details__item--special-requests' => 'margin-top: calc({{SIZE}}{{UNIT}} * 2)',
				]
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
			'sections_typography',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => esc_html__( 'Titles', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_control(
			'sections_title_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-header__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'sections_title_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .section-header__title',
			]
		);

		$this->add_control(
			'heading_descriptions_style',
			[
				'label' => esc_html__( 'Descriptions', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'descriptions_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .form-row__description,
					{{WRAPPER}} .privacy-policy-text,
					{{WRAPPER}} .form-row--booking-terms,
					{{WRAPPER}} .form-row--mailchimp-signup-form,
					{{WRAPPER}} .reservation-non-cancellable-disclaimer,
					{{WRAPPER}} .payment-method__description,
					{{WRAPPER}} .reservation-response,
					{{WRAPPER}} .reservation-received__section li,
					{{WRAPPER}} .reservation-received__section--bank-transfer-details,
					{{WRAPPER}} .address--guest-address' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'descriptions_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} .form-row__description,
					{{WRAPPER}} .privacy-policy-text,
					{{WRAPPER}} .form-row--booking-terms,
					{{WRAPPER}} .form-row--mailchimp-signup-form,
					{{WRAPPER}} .reservation-non-cancellable-disclaimer,
					{{WRAPPER}} .payment-method__description,
					{{WRAPPER}} .reservation-response,
					{{WRAPPER}} .reservation-received__section li,
					{{WRAPPER}} .reservation-received__section--bank-transfer-details,
					{{WRAPPER}} .address--guest-address',
			]
		);

		$this->add_control(
			'heading_links_style',
			[
				'label' => esc_html__( 'Links', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs( 'links_styles' );

		$this->start_controls_tab( 'links_normal_styles', [
			'label' => esc_html__( 'Normal', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'links_normal_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .privacy-policy-text a,
					{{WRAPPER}} .form-row--booking-terms a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'links_hover_styles', [
			'label' => esc_html__( 'Hover', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'links_hover_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .privacy-policy-text a:hover, {{WRAPPER}} .privacy-policy-text a:focus,
					{{WRAPPER}} .form-row--booking-terms a:hover, {{WRAPPER}} .form-row--booking-terms a:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'links_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} .privacy-policy-text a,
					{{WRAPPER}} .form-row--booking-terms a',
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
				'selector' => '{{WRAPPER}} .form--booking input[type="text"], {{WRAPPER}} .form--booking input[type="number"], {{WRAPPER}} .form--booking input[type="tel"], {{WRAPPER}} .form--booking input[type="email"], {{WRAPPER}} .form--booking input[type="url"], {{WRAPPER}} .form--booking input[type="password"], {{WRAPPER}} .form--booking input[type="search"], {{WRAPPER}} .form--booking select, {{WRAPPER}} .form--booking textarea',
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
					'{{WRAPPER}} .form--booking input[type="text"], {{WRAPPER}} .form--booking input[type="number"], {{WRAPPER}} .form--booking input[type="tel"], {{WRAPPER}} .form--booking input[type="email"], {{WRAPPER}} .form--booking input[type="url"], {{WRAPPER}} .form--booking input[type="password"], {{WRAPPER}} .form--booking input[type="search"], {{WRAPPER}} .form--booking select, {{WRAPPER}} .form--booking textarea' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'forms_fields_placeholder_color',
			[
				'label' => esc_html__( 'Placeholder', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .form--booking input::placeholder' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .form--booking input[type="text"], {{WRAPPER}} .form--booking input[type="number"], {{WRAPPER}} .form--booking input[type="tel"], {{WRAPPER}} .form--booking input[type="email"], {{WRAPPER}} .form--booking input[type="url"], {{WRAPPER}} .form--booking input[type="password"], {{WRAPPER}} .form--booking input[type="search"], {{WRAPPER}} .form--booking select, {{WRAPPER}} .form--booking textarea' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'forms_fields_normal_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'wp-hotelier-hello-elementor' ),
				'selector' => '{{WRAPPER}} .form--booking input[type="text"], {{WRAPPER}} .form--booking input[type="number"], {{WRAPPER}} .form--booking input[type="tel"], {{WRAPPER}} .form--booking input[type="email"], {{WRAPPER}} .form--booking input[type="url"], {{WRAPPER}} .form--booking input[type="password"], {{WRAPPER}} .form--booking input[type="search"], {{WRAPPER}} .form--booking select, {{WRAPPER}} .form--booking textarea',
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
					'{{WRAPPER}} .form--booking input[type="text"]:focus, {{WRAPPER}} .form--booking input[type="number"]:focus, {{WRAPPER}} .form--booking input[type="tel"]:focus, {{WRAPPER}} .form--booking input[type="email"]:focus, {{WRAPPER}} .form--booking input[type="url"]:focus, {{WRAPPER}} .form--booking input[type="password"]:focus, {{WRAPPER}} .form--booking input[type="search"]:focus, {{WRAPPER}} .form--booking textarea:focus' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .form--booking input[type="text"]:focus, {{WRAPPER}} .form--booking input[type="number"]:focus, {{WRAPPER}} .form--booking input[type="tel"]:focus, {{WRAPPER}} .form--booking input[type="email"]:focus, {{WRAPPER}} .form--booking input[type="url"]:focus, {{WRAPPER}} .form--booking input[type="password"]:focus, {{WRAPPER}} .form--booking input[type="search"]:focus, {{WRAPPER}} .form--booking textarea:focus' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'forms_fields_focus_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'wp-hotelier-hello-elementor' ),
				'selector' => '{{WRAPPER}} .form--booking input[type="text"]:focus, {{WRAPPER}} .form--booking input[type="number"]:focus, {{WRAPPER}} .form--booking input[type="tel"]:focus, {{WRAPPER}} .form--booking input[type="email"]:focus, {{WRAPPER}} .form--booking input[type="url"]:focus, {{WRAPPER}} .form--booking input[type="password"]:focus, {{WRAPPER}} .form--booking input[type="search"]:focus, {{WRAPPER}} .form--booking textarea:focus',
			]
		);

		$this->add_control(
			'forms_fields_focus_border_color',
			[
				'label' => esc_html__( 'Border Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .form--booking input[type="text"]:focus, {{WRAPPER}} .form--booking input[type="number"]:focus, {{WRAPPER}} .form--booking input[type="tel"]:focus, {{WRAPPER}} .form--booking input[type="email"]:focus, {{WRAPPER}} .form--booking input[type="url"]:focus, {{WRAPPER}} .form--booking input[type="password"]:focus, {{WRAPPER}} .form--booking input[type="search"]:focus, {{WRAPPER}} .form--booking textarea:focus' => 'border-color: {{VALUE}}',
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
					'{{WRAPPER}}' => '--booking-fields-focus-transition-duration: {{SIZE}}ms',
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
				'selector' => '{{WRAPPER}} .form--booking input[type="text"], {{WRAPPER}} .form--booking input[type="number"], {{WRAPPER}} .form--booking input[type="tel"], {{WRAPPER}} .form--booking input[type="email"], {{WRAPPER}} .form--booking input[type="url"], {{WRAPPER}} .form--booking input[type="password"], {{WRAPPER}} .form--booking input[type="search"], {{WRAPPER}} .form--booking select, {{WRAPPER}} .form--booking textarea',
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
					'{{WRAPPER}}' => '--booking-fields-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}}' => '--booking-fields-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'label' => esc_html__( 'Book Button', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				// 'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'book_button_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .button--book-button',
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
					'{{WRAPPER}} .button--book-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'book_button_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .button--book-button' => 'color: {{VALUE}};',
				],
				'default' => '#CC3366',
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
					'{{WRAPPER}} .button--book-button:hover, {{WRAPPER}} .button--book-button:focus' => 'background-color: {{VALUE}};',
				],
				'default' => '#CC3366',
			]
		);

		$this->add_control(
			'book_button_color_hover',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .button--book-button:hover, {{WRAPPER}} .button--book-button:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'book_button_border_color_hover',
			[
				'label' => esc_html__( 'Border Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#CC3366',
				'selectors' => [
					'{{WRAPPER}} .button--book-button:hover, {{WRAPPER}} .button--book-button:focus' => 'border-color: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .button--book-button',
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
			'book_button_border_radius',
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
			'heading_cancel_reservation_button_style',
			[
				'label' => esc_html__( 'Cancel Reservation', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'cancel_reservation_button_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .button.button--cancel-reservation-button',
			]
		);

		$this->start_controls_tabs( 'cancel_reservation_button_styles' );

		$this->start_controls_tab( 'cancel_reservation_button_normal_styles', [
			'label' => esc_html__( 'Normal', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'cancel_reservation_button_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button.button--cancel-reservation-button' => 'background-color: {{VALUE}};',
				],
				'default' => '#818a91',
			]
		);

		$this->add_control(
			'cancel_reservation_button_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .button.button--cancel-reservation-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'cancel_reservation_button_hover_styles', [
			'label' => esc_html__( 'Hover', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'cancel_reservation_button_bg_color_hover',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button.button--cancel-reservation-button:hover, {{WRAPPER}} .button.button--cancel-reservation-button:focus' => 'background-color: {{VALUE}};',
				],
				'default' => '#818a91',
			]
		);

		$this->add_control(
			'cancel_reservation_button_color_hover',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .button.button--cancel-reservation-button:hover, {{WRAPPER}} .button.button--cancel-reservation-button:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cancel_reservation_button_border_color_hover',
			[
				'label' => esc_html__( 'Border Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#818a91',
				'selectors' => [
					'{{WRAPPER}} .button.button--cancel-reservation-button:hover, {{WRAPPER}} .button.button--cancel-reservation-button:focus' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'cancel_reservation_button_hover_transition_duration',
			[
				'label' => esc_html__( 'Transition Duration', 'wp-hotelier-hello-elementor' ) . ' (ms)',
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}}' => '--cancel-reservation-button-hover-transition-duration: {{SIZE}}ms',
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
				'name' => 'cancel_reservation_button_border',
				'selector' => '{{WRAPPER}} .button.button--cancel-reservation-button',
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
			'cancel_reservation_button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}' => '--cancel-reservation-button-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'cancel_reservation_button_padding',
			[
				'label' => esc_html__( 'Padding', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}' => '--cancel-reservation-button-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_remove_room_button_style',
			[
				'label' => esc_html__( 'Remove Button', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'remove_room_button_typography',
				'selector' => '{{WRAPPER}} .reservation-table__room-remove',
			]
		);

		$this->start_controls_tabs( 'remove_room_button_styles' );

		$this->start_controls_tab( 'remove_room_button_normal_styles', [
			'label' => esc_html__( 'Normal', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'remove_room_button_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .reservation-table__room-remove' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'remove_room_button_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#818a91',
				'selectors' => [
					'{{WRAPPER}} .reservation-table__room-remove' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'remove_room_button_hover_styles', [
			'label' => esc_html__( 'Hover', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'remove_room_button_bg_color_hover',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .reservation-table__room-remove:hover, {{WRAPPER}} .reservation-table__room-remove:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'remove_room_button_color_hover',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .reservation-table__room-remove:hover, {{WRAPPER}} .reservation-table__room-remove:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'remove_room_button_border_color_hover',
			[
				'label' => esc_html__( 'Border Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .reservation-table__room-remove:hover, {{WRAPPER}} .reservation-table__room-remove:focus' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'remove_room_button_hover_transition_duration',
			[
				'label' => esc_html__( 'Transition Duration', 'wp-hotelier-hello-elementor' ) . ' (ms)',
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}}' => '--remove-room-button-hover-transition-duration: {{SIZE}}ms',
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
				'name' => 'remove_room_button_border',
				'selector' => '{{WRAPPER}} .reservation-table__room-remove',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'remove_room_button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}' => '--remove-room-button-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'remove_room_button_padding',
			[
				'label' => esc_html__( 'Padding', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}' => '--remove-room-button-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'separator' => 'before',
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

	protected function register_section_design_tables_controls() {
		$this->start_controls_section(
			'section_tables_style',
			[
				'label' => esc_html__( 'Tables', 'wp-hotelier-hello-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_tables_cells_style',
			[
				'label' => esc_html__( 'Cells', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'tables_cells_padding',
			[
				'label' => esc_html__( 'Padding', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} table.hotelier-table th, {{WRAPPER}} table.hotelier-table td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .reservation-table__room-extra' => 'padding-left: calc({{LEFT}}{{UNIT}} + 40px) !important;',
				],
			]
		);

		$this->add_control(
			'heading_tables_border_style',
			[
				'label' => esc_html__( 'Borders', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'tables_border_style',
			[
				'label' => esc_html__( 'Style', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'wp-hotelier-hello-elementor' ),
					'no-borders' => esc_html__( 'No borders', 'wp-hotelier-hello-elementor' ),
					'hor-borders' => esc_html__( 'Horizontal borders', 'wp-hotelier-hello-elementor' ),
				],
				'default' => 'default',
				'prefix_class' => 'tables-style-',
			]
		);

		$this->add_control(
			'tables_border_color',
			[
				'label' => esc_html__( 'Border Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}' => '--tables-border-color: {{VALUE}};',
				],
				'default' => '#80808080',
			]
		);

		$this->add_control(
			'heading_tables_headings_style',
			[
				'label' => esc_html__( 'Headings', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'tables_headings_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} table.hotelier-table th' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'tables_headings_typography',
				'selector' => '{{WRAPPER}} table.hotelier-table th',
			]
		);

		$this->add_control(
			'heading_titles_style',
			[
				'label' => esc_html__( 'Titles', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'tables_titles_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .reservation-table__room-link,
					{{WRAPPER}} .extra__name,
					{{WRAPPER}} .payment-method__label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'tables_titles_typography',
				'selector' => '{{WRAPPER}} .reservation-table__room-link,
					{{WRAPPER}} .extra__name,
					{{WRAPPER}} .payment-method__label',
			]
		);

		$this->add_control(
			'heading_text_style',
			[
				'label' => esc_html__( 'Text', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'tables_text_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hotelier-table,
					{{WRAPPER}} .reservation-table__room-rate' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'tables_text_typography',
				'selector' => '{{WRAPPER}} .hotelier-table, {{WRAPPER}} .reservation-table__room-rate',
			]
		);

		$this->add_control(
			'heading_prices_style',
			[
				'label' => esc_html__( 'Prices', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'tables_prices_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} table.hotelier-table .amount,
					{{WRAPPER}} .discount-separator' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'tables_prices_typography',
				'selector' => '{{WRAPPER}} table.hotelier-table .amount,
				{{WRAPPER}} .discount-separator',
			]
		);

		$this->add_control(
			'heading_tables_descriptions_style',
			[
				'label' => esc_html__( 'Descriptions', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'tables_descriptions_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .table--reservation-table .extra__description,
					{{WRAPPER}} .reservation-table__room-non-cancellable,
					{{WRAPPER}} .reservation-table__room-guests' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'tables_descriptions_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} .table--reservation-table .extra__description,
					{{WRAPPER}} .reservation-table__room-non-cancellable,
					{{WRAPPER}} .reservation-table__room-guests,
					{{WRAPPER}} .reservation-table__room-guests .form-row__label',
			]
		);

		$this->end_controls_section();
	}

	protected function register_section_design_coupon_controls() {
		$this->start_controls_section(
			'section_coupons_style',
			[
				'label' => esc_html__( 'Coupon Form', 'wp-hotelier-hello-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_coupon_code_style',
			[
				'label' => esc_html__( 'Coupon Code', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'coupon_code_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .coupon-card__title, {{WRAPPER}} .reservation-table__coupon-code' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'coupon_code_typography',
				'selector' => '{{WRAPPER}} .coupon-card__title',
			]
		);

		$this->add_control(
			'heading_coupon_description_style',
			[
				'label' => esc_html__( 'Coupon Description', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'coupon_description_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .coupon-card__description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'coupon_description_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} .coupon-card__description',
			]
		);

		$this->add_control(
			'heading_apply_coupon_button_style',
			[
				'label' => esc_html__( 'Apply Button', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'apply_coupon_button_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} button.coupon-form__apply',
			]
		);

		$this->start_controls_tabs( 'apply_coupon_button_styles' );

		$this->start_controls_tab( 'apply_coupon_button_normal_styles', [
			'label' => esc_html__( 'Normal', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'apply_coupon_button_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} button.coupon-form__apply' => 'background-color: {{VALUE}};',
				],
				'default' => '#818a91',
			]
		);

		$this->add_control(
			'apply_coupon_button_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} button.coupon-form__apply' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'apply_coupon_button_hover_styles', [
			'label' => esc_html__( 'Hover', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'apply_coupon_button_bg_color_hover',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} button.coupon-form__apply:hover, {{WRAPPER}} button.coupon-form__apply:focus' => 'background-color: {{VALUE}};',
				],
				'default' => '#818a91',
			]
		);

		$this->add_control(
			'apply_coupon_button_color_hover',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} button.coupon-form__apply:hover, {{WRAPPER}} button.coupon-form__apply:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'apply_coupon_button_border_color_hover',
			[
				'label' => esc_html__( 'Border Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#818a91',
				'selectors' => [
					'{{WRAPPER}} button.coupon-form__apply:hover, {{WRAPPER}} button.coupon-form__apply:focus' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'apply_coupon_button_hover_transition_duration',
			[
				'label' => esc_html__( 'Transition Duration', 'wp-hotelier-hello-elementor' ) . ' (ms)',
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}}' => '--apply-coupon-button-hover-transition-duration: {{SIZE}}ms',
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
				'name' => 'apply_coupon_button_border',
				'selector' => '{{WRAPPER}} button.coupon-form__apply',
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
			'apply_coupon_button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}' => '--apply-coupon-button-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'apply_coupon_button_padding',
			[
				'label' => esc_html__( 'Padding', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}' => '--apply-coupon-button-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_remove_coupon_button_style',
			[
				'label' => esc_html__( 'Remove Button', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'remove_coupon_button_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} button.coupon-form__remove',
			]
		);

		$this->start_controls_tabs( 'remove_coupon_button_styles' );

		$this->start_controls_tab( 'remove_coupon_button_normal_styles', [
			'label' => esc_html__( 'Normal', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'remove_coupon_button_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} button.coupon-form__remove' => 'background-color: {{VALUE}};',
				],
				'default' => '#818a91',
			]
		);

		$this->add_control(
			'remove_coupon_button_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} button.coupon-form__remove' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'remove_coupon_button_hover_styles', [
			'label' => esc_html__( 'Hover', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'remove_coupon_button_bg_color_hover',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} button.coupon-form__remove:hover, {{WRAPPER}} button.coupon-form__remove:focus' => 'background-color: {{VALUE}};',
				],
				'default' => '#818a91',
			]
		);

		$this->add_control(
			'remove_coupon_button_color_hover',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} button.coupon-form__remove:hover, {{WRAPPER}} button.coupon-form__remove:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'remove_coupon_button_border_color_hover',
			[
				'label' => esc_html__( 'Border Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#818a91',
				'selectors' => [
					'{{WRAPPER}} button.coupon-form__remove:hover, {{WRAPPER}} button.coupon-form__remove:focus' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'remove_coupon_button_hover_transition_duration',
			[
				'label' => esc_html__( 'Transition Duration', 'wp-hotelier-hello-elementor' ) . ' (ms)',
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}}' => '--remove-coupon-button-hover-transition-duration: {{SIZE}}ms',
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
				'name' => 'remove_coupon_button_border',
				'selector' => '{{WRAPPER}} button.coupon-form__remove',
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
			'remove_coupon_button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}' => '--remove-coupon-button-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'remove_coupon_button_padding',
			[
				'label' => esc_html__( 'Padding', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}' => '--remove-coupon-button-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	public function change_section_guest_details_title( $text ) {
		$settings = $this->get_settings_for_display();

		if ( $settings['section_guest_details_section_title'] ) {
			return $settings['section_guest_details_section_title'];
		}

		return $text;
	}

	public function change_section_additional_information_title( $text ) {
		$settings = $this->get_settings_for_display();

		if ( $settings['section_additional_information_section_title'] ) {
			return $settings['section_additional_information_section_title'];
		}

		return $text;
	}

	public function change_section_booking_details_title( $text ) {
		$settings = $this->get_settings_for_display();

		if ( $settings['section_booking_details_section_title'] ) {
			return $settings['section_booking_details_section_title'];
		}

		return $text;
	}

	public function change_section_reservation_table_title( $text ) {
		$settings = $this->get_settings_for_display();

		if ( $settings['section_reservation_table_section_title'] ) {
			return $settings['section_reservation_table_section_title'];
		}

		return $text;
	}

	public function change_section_received_reservation_details_title( $text ) {
		$settings = $this->get_settings_for_display();

		if ( $settings['section_received_reservation_details_section_title'] ) {
			return $settings['section_received_reservation_details_section_title'];
		}

		return $text;
	}

	public function change_section_received_guest_details_title( $text ) {
		$settings = $this->get_settings_for_display();

		if ( $settings['section_received_guest_details_section_title'] ) {
			return $settings['section_received_guest_details_section_title'];
		}

		return $text;
	}

	public function change_section_received_guest_address_title( $text ) {
		$settings = $this->get_settings_for_display();

		if ( $settings['section_received_guest_address_section_title'] ) {
			return $settings['section_received_guest_address_section_title'];
		}

		return $text;
	}

	public function change_section_payment_method_title( $text ) {
		$settings = $this->get_settings_for_display();

		if ( $settings['section_payment_method_section_title'] ) {
			return $settings['section_payment_method_section_title'];
		}

		return $text;
	}

	public function open_first_column() {
		echo '<div class="booking__column booking__column--1">';
	}

	public function close_first_column() {
		echo '</div>';
	}

	public function open_second_column() {
		echo '<div class="booking__column booking__column--2">';
	}

	public function close_second_column() {
		echo '</div>';
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

	protected function do_hooks_before_render() {
		add_filter( 'hotelier_is_booking', '__return_true' );

		add_filter( 'hotelier_booking_section_guest_details_title', array( $this, 'change_section_guest_details_title' ) );
		add_filter( 'hotelier_booking_section_additional_information_title', array( $this, 'change_section_additional_information_title' ), 1 );
		add_filter( 'hotelier_booking_section_booking_details_title', array( $this, 'change_section_booking_details_title' ) );
		add_filter( 'hotelier_booking_section_reservation_table_title', array( $this, 'change_section_reservation_table_title' ) );
		add_filter( 'hotelier_received_section_reservation_details_title', array( $this, 'change_section_received_reservation_details_title' ) );
		add_filter( 'hotelier_received_section_guest_details_title', array( $this, 'change_section_received_guest_details_title' ) );
		add_filter( 'hotelier_received_section_guest_address_title', array( $this, 'change_section_received_guest_address_title' ) );
		add_filter( 'hotelier_booking_section_payment_title', array( $this, 'change_section_payment_method_title' ) );

		add_action( 'hotelier_begin_booking_form', array( $this, 'open_first_column' ), 1 );
		add_action( 'hotelier_booking_details', array( $this, 'close_first_column' ), 9998 );
		add_action( 'hotelier_booking_details', array( $this, 'open_second_column' ), 9999 );
		add_action( 'hotelier_end_booking_form', array( $this, 'close_second_column' ), 9999 );

		add_action( 'hotelier_before_reservation_received_page', array( $this, 'open_first_column' ), 1 );
		add_action( 'hotelier_after_reservation_table', array( $this, 'close_first_column' ), 1 );
		add_action( 'hotelier_after_reservation_table', array( $this, 'open_second_column' ), 2 );
		add_action( 'hotelier_after_reservation_received_page', array( $this, 'close_second_column' ), 9999 );

		add_action( 'before_hotelier_pay', array( $this, 'open_first_column' ), 1 );
		add_action( 'hotelier_before_pay_form', array( $this, 'close_first_column' ), 1 );
		add_action( 'hotelier_before_pay_form', array( $this, 'open_second_column' ), 2 );
		add_action( 'after_hotelier_pay', array( $this, 'close_second_column' ), 9999 );

		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			add_action( 'hotelier_before_booking_form', array( $this, 'print_notices' ) );
		}
	}

	protected function get_shortcode_atts( $settings ) {
		$atts = array();

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

		$shortcode_string = '[hotelier_booking ' . $atts_string . ']';

		$content = do_shortcode( $shortcode_string );

		return $content;
	}

	public function show_preview( $shortcode_atts ) {
		htl_get_template( 'preview/booking-preview.php', array( 'shortcode_atts' => $shortcode_atts ), false,  HTL_HELLO_ELEMENTOR_PLUGIN_DIR . 'templates/' );
	}

	protected function render() {
		if ( ! is_booking() || is_reservation_received_page() || is_pay_reservation_page() ) {
			?>
			<?php if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) : ?>
			<div class="htl-elementor-editor-notice" style="padding: 15px;margin-bottom: 20px;color: #93003c;background-color: #93003c42;font-weight: bold;">
				<?php echo esc_html_e( 'This module can only be used on the booking page.', 'wp-hotelier-hello-elementor' ); ?>
			</div>
			<?php endif;
			return;
		}

		$settings = $this->get_settings_for_display();
		$shortcode_atts = $this->get_shortcode_atts( $settings );

		$this->do_hooks_before_render( $settings );

		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			$this->show_preview( $shortcode_atts );
		} else {
			$content = $this->render_shortcode( $shortcode_atts );

			echo $content;
		}

		$this->do_hooks_after_render();
	}
}
