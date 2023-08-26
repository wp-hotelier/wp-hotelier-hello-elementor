<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class HTL_Hello_Elementor_Rooms_Filter extends \Elementor\Widget_Base {
	public function get_name() {
		return 'htl-rooms-filter';
	}

	public function get_title() {
		return esc_html__( 'Rooms Filter', 'wp-hotelier-hello-elementor' );
	}

	public function get_icon() {
		return 'eicon-filter';
	}

	public function get_categories() {
		return [ 'hotelier-elements' ];
	}

	public function get_keywords() {
		return [ 'hotelier', 'hotel', 'rooms', 'filter' ];
	}

	protected function register_controls() {
		$this->register_section_general_controls();
		$this->register_design_content_controls();
		$this->register_design_title_controls();
		$this->register_design_link_controls();
		$this->register_design_buttons_controls();
	}

	public function register_section_general_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Settings', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_control(
			'toggle_sections',
			[
				'label' => esc_html__( 'Toggle Sections', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'prefix_class' => 'room-filters--toggle-',
			]
		);

		$this->add_control(
			'toggle_state',
			[
				'label' => esc_html__( 'Default Toggle State', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'prefix_class' => 'room-filters--toggle-state-',
				'options' => [
					'open' => esc_html__( 'Open', 'wp-hotelier-hello-elementor' ),
					'closed' => esc_html__( 'Closed', 'wp-hotelier-hello-elementor' ),
				],
				'default' => 'open',
				'condition' => [
					'toggle_sections' => 'yes',
				],
			]
		);

		$this->add_control(
			'toggle_mobile_state',
			[
				'label' => esc_html__( 'Default Mobile State', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'prefix_class' => 'room-filters--mobile-toggle-state-',
				'options' => [
					'open' => esc_html__( 'Open', 'wp-hotelier-hello-elementor' ),
					'closed' => esc_html__( 'Closed', 'wp-hotelier-hello-elementor' ),
				],
				'default' => 'closed',
				'condition' => [
					'toggle_state' => 'open',
				],
			]
		);

		$this->add_control(
			'show_room_types',
			[
				'label' => esc_html__( 'Show Room Types', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_room_rates',
			[
				'label' => esc_html__( 'Show Room Rates', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_max_guests',
			[
				'label' => esc_html__( 'Show Max Guests', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'max_guests_limit',
			[
				'label' => esc_html__( 'Max Guests Limit', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => '5',
				'condition' => [
					'show_max_guests' => 'yes',
				],
			]
		);


		$this->add_control(
			'show_max_children',
			[
				'label' => esc_html__( 'Show Max Children', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'max_children_limit',
			[
				'label' => esc_html__( 'Max Children Limit', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => '3',
				'condition' => [
					'show_max_children' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}

	public function register_design_content_controls() {
		$this->start_controls_section(
			'section_design_content',
			[
				'label' => esc_html__( 'Content', 'wp-hotelier-hello-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_align',
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
					'{{WRAPPER}} .widget-rooms-filter__wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_vertical_rhythm',
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
					'{{WRAPPER}} .widget-rooms-filter__group-item' => 'margin-bottom: calc({{SIZE}}{{UNIT}} / 2)',
					'{{WRAPPER}} .widget-rooms-filter__group-list' => 'margin-bottom: calc({{SIZE}}{{UNIT}} * 2)',
					'{{WRAPPER}} .widget-rooms-filter__group-label' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();
	}

	public function register_design_title_controls() {
		$this->start_controls_section(
			'section_design_title',
			[
				'label' => esc_html__( 'Title', 'wp-hotelier-hello-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .widget-rooms-filter__group-label',
			]
		);

		$this->start_controls_tabs( 'title_styles' );

		$this->start_controls_tab( 'title_normal_styles', [
			'label' => esc_html__( 'Normal', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-rooms-filter__group-label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_background',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-rooms-filter__group-label' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'selector' => '{{WRAPPER}} .widget-rooms-filter__group-label',
				'fields_options' => [
					'border' => [
						'default' => 'none',
					],
				],
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'title_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .widget-rooms-filter__group-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'title_hover_styles', [
			'label' => esc_html__( 'Hover', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'title_color_hover',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-rooms-filter__group-label:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_background_hover',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-rooms-filter__group-label:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_border_color_hover',
			[
				'label' => esc_html__( 'Border Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-rooms-filter__group-label:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_hover_transition_duration',
			[
				'label' => esc_html__( 'Transition Duration', 'wp-hotelier-hello-elementor' ) . ' (ms)',
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}}' => '--rooms-filters-title-hover-transition-duration: {{SIZE}}ms',
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

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Padding', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'separator' => 'before',
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .widget-rooms-filter__group-label' => 'padding-left: {{LEFT}}{{UNIT}}; padding-right: {{RIGHT}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}}; padding-top: {{TOP}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'title_toggle_open',
			[
				'label' => __( 'Toggle Icon (Open)', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'condition' => [
					'toggle_sections' => 'yes',
				],
			]
		);

		$this->add_control(
			'title_toggle_closed',
			[
				'label' => __( 'Toggle Icon (Closed)', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'condition' => [
					'toggle_sections' => 'yes',
				],
			]
		);

		$this->add_control(
			'title_toggle_position',
			[
				'label' => esc_html__( 'Toggle Icon Position', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'wp-hotelier-hello-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'wp-hotelier-hello-elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'room-filters--toggle-position-',
				'default' => 'left',
				'render_type' => 'template',
				'condition' => [
					'toggle_sections' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'title_toggle_gap',
			[
				'label' => esc_html__( 'Toggle Icon Gap', 'wp-hotelier-hello-elementor' ),
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
					'{{WRAPPER}}' => '--rooms-filters-toggle-icon-gap: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'toggle_sections' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}

	public function register_design_link_controls() {
		$this->start_controls_section(
			'section_design_link',
			[
				'label' => esc_html__( 'Link', 'wp-hotelier-hello-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'link_typography',
				'selector' => '{{WRAPPER}} .widget-rooms-filter__group-link',
			]
		);

		$this->start_controls_tabs( 'link_styles' );

		$this->start_controls_tab( 'link_normal_styles', [
			'label' => esc_html__( 'Normal', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'link_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-rooms-filter__group-link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'link_background',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-rooms-filter__group-link' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'link_border',
				'selector' => '{{WRAPPER}} .widget-rooms-filter__group-link',
				'fields_options' => [
					'border' => [
						'default' => 'none',
					],
				],
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'link_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .widget-rooms-filter__group-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'link_hover_styles', [
			'label' => esc_html__( 'Active', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'link_color_hover',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-rooms-filter__group-link:hover, {{WRAPPER}} .widget-rooms-filter__group-item--chosen .widget-rooms-filter__group-link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'link_background_hover',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-rooms-filter__group-link:hover, {{WRAPPER}} .widget-rooms-filter__group-item--chosen .widget-rooms-filter__group-link' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'link_border_color_hover',
			[
				'label' => esc_html__( 'Border Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-rooms-filter__group-link:hover, {{WRAPPER}} .widget-rooms-filter__group-item--chosen .widget-rooms-filter__group-link' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'link_hover_transition_duration',
			[
				'label' => esc_html__( 'Transition Duration', 'wp-hotelier-hello-elementor' ) . ' (ms)',
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}}' => '--rooms-filters-link-hover-transition-duration: {{SIZE}}ms',
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

		$this->end_controls_section();
	}

	public function register_design_buttons_controls() {
		$this->start_controls_section(
			'section_design_buttons',
			[
				'label' => esc_html__( 'Reset', 'wp-hotelier-hello-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'reset_button_typography',
				'selector' => '{{WRAPPER}} .widget-rooms-filter__reset',
			]
		);

		$this->start_controls_tabs( 'reset_button_styles' );

		$this->start_controls_tab( 'reset_button_normal_styles', [
			'label' => esc_html__( 'Normal', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'reset_button_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-rooms-filter__reset' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'reset_button_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#CC3366',
				'selectors' => [
					'{{WRAPPER}} .widget-rooms-filter__reset' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'reset_button_hover_styles', [
			'label' => esc_html__( 'Hover', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'reset_button_bg_color_hover',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-rooms-filter__reset:hover, {{WRAPPER}} .widget-rooms-filter__reset:focus' => 'background-color: {{VALUE}};',
				],
				'default' => '#CC3366',
			]
		);

		$this->add_control(
			'reset_button_color_hover',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .widget-rooms-filter__reset:hover, {{WRAPPER}} .widget-rooms-filter__reset:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'reset_button_border_color_hover',
			[
				'label' => esc_html__( 'Border Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#CC3366',
				'selectors' => [
					'{{WRAPPER}} .widget-rooms-filter__reset:hover, {{WRAPPER}} .widget-rooms-filter__reset:focus' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'reset_button_hover_transition_duration',
			[
				'label' => esc_html__( 'Transition Duration', 'wp-hotelier-hello-elementor' ) . ' (ms)',
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}}' => '--rooms-filter-reset-button-hover-transition-duration: {{SIZE}}ms',
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
				'name' => 'reset_button_border',
				'selector' => '{{WRAPPER}} .widget-rooms-filter__reset',
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
			'reset_button_border_radius',
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
					'{{WRAPPER}}' => '--rooms-filter-reset-button-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'reset_button_padding',
			[
				'label' => esc_html__( 'Padding', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}' => '--rooms-filter-reset-button-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	public function print_toggle_icon() {
		echo '<i class="TOGGLE-DEFAULT-ICON-PLACEHOLDER" data-open-icon="TOGGLE-OPEN-ICON-PLACEHOLDER" data-closed-icon="TOGGLE-CLOSED-ICON-PLACEHOLDER"></i>';
	}

	protected function do_hooks_before_render( $settings ) {
		if ( $settings['show_room_types'] !== 'yes' ) {
			add_filter( 'hotelier_widget_rooms_filter_show_room_types', '__return_false' );
		}

		if ( $settings['show_room_rates'] !== 'yes' ) {
			add_filter( 'hotelier_widget_rooms_filter_show_room_rates', '__return_false' );
		}

		if ( ( isset( $settings['title_toggle_open'] ) && isset( $settings['title_toggle_open']['value'] ) && $settings['title_toggle_open']['value'] ) || ( isset( $settings['title_toggle_closed'] ) && isset( $settings['title_toggle_closed']['value'] ) && $settings['title_toggle_closed']['value'] ) ) {
				if ( $settings['title_toggle_position'] === 'right' ) {
					add_action( 'hotelier_widget_rooms_filter_after_title', array( $this, 'print_toggle_icon' ) );
				} else {
					add_action( 'hotelier_widget_rooms_filter_before_title', array( $this, 'print_toggle_icon' ) );
				}
		}
	}

	protected function do_hooks_after_render( $settings ) {
		if ( $settings['show_room_types'] !== 'yes' ) {
			remove_filter( 'hotelier_widget_rooms_filter_show_room_types', '__return_false' );
		}

		if ( $settings['show_room_rates'] !== 'yes' ) {
			remove_filter( 'hotelier_widget_rooms_filter_show_room_rates', '__return_false' );
		}
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

		$this->do_hooks_before_render( $settings );

		if ( $settings['toggle_sections'] === 'yes' ) {
			wp_enqueue_script( 'htl-hello-rooms-filter' );
		}

		$max_guests   = $settings['max_guests_limit'];
		$max_children = $settings['max_children_limit'];
		$link         = \Elementor\Plugin::$instance->editor->is_edit_mode() ? '#' : HTL()->cart->get_room_list_form_url();

		$wrapper_class = '';

		if ( ( isset( $settings['title_toggle_open'] ) && isset( $settings['title_toggle_open']['value'] ) && $settings['title_toggle_open']['value'] ) || ( isset( $settings['title_toggle_closed'] ) && isset( $settings['title_toggle_closed']['value'] ) && $settings['title_toggle_closed']['value'] ) ) {
			$wrapper_class = 'has-toggle-icons';
		}

		ob_start();

		htl_get_template( 'widgets/rooms-filter.php', array(
			'link'          => $link,
			'max_guests'    => $max_guests,
			'max_children'  => $max_children,
			'wrapper_class' => $wrapper_class,
			'reset_button'  => true,
		) );

		$content = ob_get_clean();

		if ( ( isset( $settings['title_toggle_open'] ) && isset( $settings['title_toggle_open']['value'] ) && $settings['title_toggle_open']['value'] ) || ( isset( $settings['title_toggle_closed'] ) && isset( $settings['title_toggle_closed']['value'] ) && $settings['title_toggle_closed']['value'] ) ) {
			if ($settings['toggle_state'] === 'open') {
				$content = str_replace( 'TOGGLE-DEFAULT-ICON-PLACEHOLDER', $settings['title_toggle_open']['value'], $content );
			} else {
				$content = str_replace( 'TOGGLE-DEFAULT-ICON-PLACEHOLDER', $settings['title_toggle_closed']['value'], $content );
			}

			$content   = str_replace( 'TOGGLE-OPEN-ICON-PLACEHOLDER', $settings['title_toggle_open']['value'], $content );
			$content   = str_replace( 'TOGGLE-CLOSED-ICON-PLACEHOLDER', $settings['title_toggle_closed']['value'], $content );
		}

		echo $content;

		$this->do_hooks_after_render( $settings );
	}

}
