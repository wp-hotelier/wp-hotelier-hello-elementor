<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class HTL_Hello_Elementor_Rooms_Widget extends \Elementor\Widget_Base {

	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );

		add_action( 'elementor/frontend/before_register_scripts', [ $this, 'register_frontend_styles' ] );
	}

	public function register_frontend_styles() {
		wp_register_style( 'widget-htl-rooms', HTL_HELLO_ELEMENTOR_PLUGIN_URL . 'assets/css/widgets/rooms.css', array(), HTL_HELLO_ELEMENTOR_VERSION );
	}

	public function get_style_depends() {
		$this->register_frontend_styles();

		return [
			'widget-htl-rooms',
		];
	}

	public function get_name() {
		return 'htl-rooms';
	}

	public function get_title() {
		return esc_html__( 'Rooms', 'wp-hotelier-hello-elementor' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'hotelier-elements' ];
	}

	public function get_keywords() {
		return [ 'hotelier', 'hotel', 'room', 'archive', 'related' ];
	}

	protected function register_controls() {
		$this->register_section_layout_controls();
		$this->register_section_query_controls();
		$this->register_section_pagination_controls();
		$this->register_design_layout_controls();
		$this->register_design_card_controls();
		$this->register_design_image_controls();
		$this->register_design_overlay_controls();
		$this->register_design_content_controls();
	}

	public function register_section_layout_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Layout', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_control(
			'skin',
			[
				'label' => esc_html__( 'Skin', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__( 'Default', 'wp-hotelier-hello-elementor' ),
					'overlay' => esc_html__( 'Overlay', 'wp-hotelier-hello-elementor' ),
				],
				'prefix_class' => 'rooms-grid--thumbnail-skin-',
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label' => esc_html__( 'Columns', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'prefix_class' => 'rooms-grid%s-',
				'min' => 1,
				'max' => 6,
				'default' => '4',
				'tablet_default' => '3',
				'mobile_default' => '2',
				'required' => true,
				'device_args' => $this->get_devices_default_args(),
				'min_affected_device' => [
					\Elementor\Core\Breakpoints\Manager::BREAKPOINT_KEY_DESKTOP => \Elementor\Core\Breakpoints\Manager::BREAKPOINT_KEY_DESKTOP,
					\Elementor\Core\Breakpoints\Manager::BREAKPOINT_KEY_TABLET => \Elementor\Core\Breakpoints\Manager::BREAKPOINT_KEY_TABLET
				],
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => esc_html__( 'Posts Per Page', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => '8',
				'condition' => [
					'query_source' => 'rooms',
				],
			]
		);

		$this->add_control(
			'show_image',
			[
				'label' => esc_html__( 'Show Image', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'room_catalog',
				'exclude' => [ 'custom' ],
				'condition' => [
					'show_image!' => '',
				],
				'prefix_class' => 'rooms-grid--thumbnail-size-',
			]
		);

		$this->add_control(
			'show_title',
			[
				'label' => esc_html__( 'Title', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'wp-hotelier-hello-elementor' ),
				'label_off' => esc_html__( 'Hide', 'wp-hotelier-hello-elementor' ),
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_title_priority',
			[
				'label' => esc_html__( 'Title Priority', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
				'condition' => [
					'show_title' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_meta',
			[
				'label' => esc_html__( 'Metas', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'wp-hotelier-hello-elementor' ),
				'label_off' => esc_html__( 'Hide', 'wp-hotelier-hello-elementor' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_meta_priority',
			[
				'label' => esc_html__( 'Metas Priority', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 15,
				'condition' => [
					'show_meta' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_description',
			[
				'label' => esc_html__( 'Description', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'wp-hotelier-hello-elementor' ),
				'label_off' => esc_html__( 'Hide', 'wp-hotelier-hello-elementor' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_description_priority',
			[
				'label' => esc_html__( 'Description Priority', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 20,
				'condition' => [
					'show_description' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_price',
			[
				'label' => esc_html__( 'Price', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'wp-hotelier-hello-elementor' ),
				'label_off' => esc_html__( 'Hide', 'wp-hotelier-hello-elementor' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_price_priority',
			[
				'label' => esc_html__( 'Price Priority', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 30,
				'condition' => [
					'show_description' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_more',
			[
				'label' => esc_html__( 'Read More', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'wp-hotelier-hello-elementor' ),
				'label_off' => esc_html__( 'Hide', 'wp-hotelier-hello-elementor' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_more_priority',
			[
				'label' => esc_html__( 'Read More Priority', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 40,
				'condition' => [
					'show_description' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_category',
			[
				'label' => esc_html__( 'Category Badge', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'wp-hotelier-hello-elementor' ),
				'label_off' => esc_html__( 'Hide', 'wp-hotelier-hello-elementor' ),
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->end_controls_section();
	}

	public function register_section_query_controls() {
		$this->start_controls_section(
			'section_query',
			[
				'label' => esc_html__( 'Query', 'wp-hotelier-hello-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'query_source',
			[
				'label' => esc_html__( 'Source', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'rooms',
				'options' => [
					'rooms' => esc_html__( 'Rooms', 'wp-hotelier-hello-elementor' ),
					'related' => esc_html__( 'Related Rooms', 'wp-hotelier-hello-elementor' ),
					'archive' => esc_html__( 'Dynamic Query (Archives)', 'wp-hotelier-hello-elementor' ),
				],
			]
		);

		$all_rooms     = $this->get_rooms();
		$all_room_cats = $this->get_room_cats();

		$this->start_controls_tabs(
			'style_tabs',
			[
				'condition' => [
					'query_source' => 'rooms',
				],
			]
		);

		$this->start_controls_tab(
			'query_include_tab',
			[
				'label' => esc_html__( 'Include', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_control(
			'include_rooms_ids',
			[
				'label' => esc_html__( 'Room IDs', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'label_block' => true,
				'options' => $all_rooms,
			]
		);

		$this->add_control(
			'include_room_cats',
			[
				'label' => esc_html__( 'Categories', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'label_block' => true,
				'options' => $all_room_cats,
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'query_exclude_tab',
			[
				'label' => esc_html__( 'Exclude', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_control(
			'exclude_rooms_ids',
			[
				'label' => esc_html__( 'Room IDs', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'label_block' => true,
				'options' => $all_rooms,
			]
		);

		$this->add_control(
			'exclude_room_cats',
			[
				'label' => esc_html__( 'Categories', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'label_block' => true,
				'options' => $all_room_cats,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'offset',
			[
				'label' => esc_html__( 'Offset', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => '0',
				'condition' => [
					'query_source' => 'rooms',
					'pagination_type' => '',
				],
			]
		);

		$this->add_control(
			'order_by',
			[
				'label' => esc_html__( 'Order By', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date' => esc_html__( 'Date', 'wp-hotelier-hello-elementor' ),
					'title' => esc_html__( 'Title', 'wp-hotelier-hello-elementor' ),
					'menu_order' => esc_html__( 'Menu Order', 'wp-hotelier-hello-elementor' ),
					'rand' => esc_html__( 'Random', 'wp-hotelier-hello-elementor' ),
				],
				'condition' => [
					'query_source' => 'rooms',
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => esc_html__( 'Order', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'ASC' => esc_html__( 'ASC', 'wp-hotelier-hello-elementor' ),
					'DESC' => esc_html__( 'DESC', 'wp-hotelier-hello-elementor' ),
				],
				'condition' => [
					'query_source' => 'rooms',
					'order_by!' => 'rand',
				],
			]
		);

		$this->end_controls_section();
	}

	public function register_section_pagination_controls() {
		$this->start_controls_section(
			'section_pagination',
			[
				'label' => esc_html__( 'Pagination', 'wp-hotelier-hello-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'query_source!' => 'related',
				],
			]
		);

		$this->add_control(
			'pagination_type',
			[
				'label' => esc_html__( 'Pagination', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'None', 'wp-hotelier-hello-elementor' ),
					'default' => esc_html__( 'Numbers + Arrows', 'wp-hotelier-hello-elementor' ),
					'numbers' => esc_html__( 'Numbers', 'wp-hotelier-hello-elementor' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'pagination_align',
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
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .hotelier-pagination' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	public function register_design_layout_controls() {
		$this->start_controls_section(
			'section_design_layout',
			[
				'label' => esc_html__( 'Layout', 'wp-hotelier-hello-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'column_gap',
			[
				'label' => esc_html__( 'Columns Gap', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--rooms-grid-column-gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'row_gap',
			[
				'label' => esc_html__( 'Rows Gap', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 35,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'frontend_available' => true,
				'selectors' => [
					'{{WRAPPER}}' => '--rooms-grid-row-gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'alignment',
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
				'prefix_class' => 'rooms-grid--align-',
			]
		);

		$this->end_controls_section();
	}

	public function register_design_card_controls() {
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
					'{{WRAPPER}} .room-loop__item' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'skin!' => 'overlay',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'card_border',
				'selector' => '{{WRAPPER}} .room-loop__item',
				'condition' => [
					'skin!' => 'overlay',
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
					'{{WRAPPER}} .room-loop__item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'skin!' => 'overlay',
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
					'right' => '0',
					'bottom' => '20',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .room__text-wrapper' => 'padding-left: {{LEFT}}{{UNIT}}; padding-right: {{RIGHT}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}}; padding-top: {{TOP}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'card_box_shadow',
			[
				'label' => esc_html__( 'Box Shadow', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'prefix_class' => 'rooms-grid--shadow-',
				// 'default' => 'yes',
			]
		);

		$this->add_responsive_control(
			'card_vertical_rhythm',
			[
				'label' => esc_html__( 'Vertical Rhythm', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .room__name, {{WRAPPER}} .room__icon, {{WRAPPER}} .room__description, {{WRAPPER}} .room__price--loop, {{WRAPPER}} .button--view-room-details' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	public function register_design_image_controls() {
		$this->start_controls_section(
			'section_design_image',
			[
				'label' => esc_html__( 'Image', 'wp-hotelier-hello-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'skin!' => 'overlay',
				],
			]
		);

		$this->add_control(
			'image_hover_effect',
			[
				'label' => esc_html__( 'Hover Effect', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => false,
				'options' => [
					'none' => esc_html__( 'None', 'wp-hotelier-hello-elementor' ),
					'overlay' => esc_html__( 'Overlay', 'wp-hotelier-hello-elementor' ),
					'zoom-in' => esc_html__( 'Zoom In', 'wp-hotelier-hello-elementor' ),
				],
				'prefix_class' => 'rooms-grid--hover-',
			]
		);

		$this->add_control(
			'image_hover_effect_invert',
			[
				'label' => esc_html__( 'Invert Effect', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => '',
				'prefix_class' => 'rooms-grid--invert-hover-',
			]
		);

		$this->add_control(
			'image_overlay_bg_color',
			[
				'label' => esc_html__( 'Overlay Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'image_hover_effect' => 'overlay',
				],
				'selectors' => [
					'{{WRAPPER}} .room__thumbnail:after' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'image_overlay_opacity',
			[
				'label' => esc_html__( 'Overlay Opacity', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'condition' => [
					'image_hover_effect' => 'overlay',
				],
				'selectors' => [
					'{{WRAPPER}} .room-loop__item .room__thumbnail:hover:after' => 'opacity: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}}.rooms-grid--invert-hover-yes .room-loop__item .room__thumbnail:after' => 'opacity: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();
	}

	public function register_design_overlay_controls() {
		$this->start_controls_section(
			'section_design_overlay',
			[
				'label' => esc_html__( 'Overlay', 'wp-hotelier-hello-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'skin' => 'overlay',
				],
			]
		);

		$this->add_control(
			'overlay_bg_color',
			[
				'label' => esc_html__( 'Overlay Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#818a91',
				'selectors' => [
					'{{WRAPPER}}.rooms-grid--thumbnail-skin-overlay .room-loop__item:hover .room__thumbnail:after' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'overlay_opacity',
			[
				'label' => esc_html__( 'Overlay Opacity', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}}.rooms-grid--thumbnail-skin-overlay .room-loop__item:hover .room__thumbnail:after' => 'opacity: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_design_content_controls() {
		$this->start_controls_section(
			'section_design_content',
			[
				'label' => esc_html__( 'Content', 'wp-hotelier-hello-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_title_style',
			[
				'label' => esc_html__( 'Title', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
					'show_title' => 'yes',
				],
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
					'{{WRAPPER}} .room__name, {{WRAPPER}} .room__link' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_title' => 'yes',
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
				'selector' => '{{WRAPPER}} .room__name, {{WRAPPER}} .room__link',
				'condition' => [
					'show_title' => 'yes',
				],
			]
		);

		$this->add_control(
			'heading_metas_style',
			[
				'label' => esc_html__( 'Metas', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'show_meta' => 'yes',
				],
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
					'{{WRAPPER}} .room__meta' => 'color: {{VALUE}};',
					'{{WRAPPER}} .room__meta span:after' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'show_meta' => 'yes',
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
				'selector' => '{{WRAPPER}} .room__meta',
				'condition' => [
					'show_meta' => 'yes',
				],
			]
		);

		$this->add_control(
			'heading_description_style',
			[
				'label' => esc_html__( 'Description', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'show_description' => 'yes',
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_TEXT,
				],
				'selectors' => [
					'{{WRAPPER}} .room__description' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_description' => 'yes',
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
				'selector' => '{{WRAPPER}} .room__description p',
				'condition' => [
					'show_description' => 'yes',
				],
			]
		);

		$this->add_control(
			'heading_price_style',
			[
				'label' => esc_html__( 'Price', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'show_price' => 'yes',
				],
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
					'{{WRAPPER}} .room__price--loop' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_price' => 'yes',
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
				'selector' => '{{WRAPPER}} .room__price--loop',
				'exclude' => [ 'font_weight' ],
				'condition' => [
					'show_price' => 'yes',
				],
			]
		);

		$this->add_control(
			'heading_more_style',
			[
				'label' => esc_html__( 'Read More', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'show_more' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'more_typography',
				'selector' => '{{WRAPPER}} .button--view-room-details',
				'condition' => [
					'show_more' => 'yes',
				],
			]
		);

		$this->start_controls_tabs( 'more_styles', [
			'condition' => [
				'show_more' => 'yes',
			],
		] );

		$this->start_controls_tab( 'more_normal_styles', [
			'label' => esc_html__( 'Normal', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'more_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button--view-room-details' => 'background-color: {{VALUE}};',
				],
				'default' => '#818a91',
				'condition' => [
					'show_more' => 'yes',
				],
			]
		);

		$this->add_control(
			'more_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .button--view-room-details' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_more' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'more_hover_styles', [
			'label' => esc_html__( 'Hover', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'more_bg_color_hover',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button--view-room-details:hover, {{WRAPPER}} .button--view-room-details:focus' => 'background-color: {{VALUE}};',
				],
				'default' => '#818a91',
				'condition' => [
					'show_more' => 'yes',
				],
			]
		);

		$this->add_control(
			'more_color_hover',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .button--view-room-details:hover, {{WRAPPER}} .button--view-room-details:focus' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_more' => 'yes',
				],
			]
		);

		$this->add_control(
			'more_border_color_hover',
			[
				'label' => esc_html__( 'Border Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .button--view-room-details:hover, {{WRAPPER}} .button--view-room-details:focus' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'show_more' => 'yes',
				],
			]
		);

		$this->add_control(
			'more_hover_transition_duration',
			[
				'label' => esc_html__( 'Transition Duration', 'wp-hotelier-hello-elementor' ) . ' (ms)',
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}}' => '--more-button-hover-transition-duration: {{SIZE}}ms',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 3000,
					],
				],
				'condition' => [
					'show_more' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'more_border',
				'selector' => '{{WRAPPER}} .button--view-room-details',
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
				],
				'condition' => [
					'show_more' => 'yes',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'more_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}' => '--more-button-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_more' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'more_padding',
			[
				'label' => esc_html__( 'Padding', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}}' => '--more-button-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_more' => 'yes',
				],
			]
		);

		$this->add_control(
			'heading_badge_category_style',
			[
				'label' => esc_html__( 'Badge Category', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'show_category' => 'yes',
				],
			]
		);

		$this->add_control(
			'badge_category_position',
			[
				'label' => 'Position',
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
				'default' => 'right',
				'selectors' => [
					'{{WRAPPER}} .room__badge--category' => '{{VALUE}}: 0',
				],
				'condition' => [
					'show_category' => 'yes',
				],
			]
		);

		$this->add_control(
			'badge_category_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .room__badge--category' => 'background-color: {{VALUE}};',
				],
				'default' => '#818a91',
				'condition' => [
					'show_category' => 'yes',
				],
			]
		);

		$this->add_control(
			'badge_category_color',
			[
				'label' => esc_html__( 'Text Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .room__badge--category' => 'color: {{VALUE}};',
				],
				'default' => '#FFFFFF',
				'condition' => [
					'show_category' => 'yes',
				],
			]
		);

		$this->add_control(
			'badge_category_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .room__badge--category' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_category' => 'yes',
				],
			]
		);

		$this->add_control(
			'badge_category_size',
			[
				'label' => esc_html__( 'Size', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .room__badge--category' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'show_category' => 'yes',
				],
			]
		);

		$this->add_control(
			'badge_category_margin',
			[
				'label' => esc_html__( 'Margin', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'default' => [
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .room__badge--category' => 'margin: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'show_category' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'badge_category_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .room__badge--category',
				'exclude' => [ 'font_size', 'line_height', 'text_decoration' ],
				'condition' => [
					'show_category' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function get_devices_default_args() {
		$devices_required = [];

		// Make sure device settings can inherit from larger screen sizes' breakpoint settings.
		foreach ( \Elementor\Core\Breakpoints\Manager::get_default_config() as $breakpoint_name => $breakpoint_config ) {
			$devices_required[ $breakpoint_name ] = [
				'required' => false,
			];
		}

		return $devices_required;
	}

	protected function get_rooms() {
		$all_rooms = htl_get_room_ids();
		$rooms     = array();

		if ( is_array( $all_rooms ) ) {
			foreach ( $all_rooms as $room_id ) {
				$rooms[$room_id] = get_the_title( $room_id );
			}
		}

		return $rooms;
	}

	protected function get_room_cats() {
		$terms     = get_terms( 'room_cat' );
		$room_cats = array();

		if ( is_array( $terms ) ) {
			foreach ( $terms as $term ) {
				$room_cats[$term->term_id] = $term->name;
			}
		}

		return $room_cats;
	}

	public function change_pp() {
		return 4;
	}

	protected function do_hooks_before_render() {
		$settings = $this->get_settings_for_display();

		add_filter( 'test_pp', array( $this, 'change_pp' ) );

		// Remove shortcode's wrapper
		add_filter( 'hotelier_shortcode_room_loop_has_wrapper', '__return_false' );

		// Show image
		if ( isset( $settings['show_image'] ) && $settings['show_image'] === 'yes' ) {
			// Filter thumb size
			add_filter( 'hotelier_loop_room_image_size', array( $this, 'change_image_size' ) );
		} else {
			remove_action( 'hotelier_archive_item_room', 'hotelier_template_archive_room_image', 5 );
		}

		// Remove default actions
		remove_action( 'hotelier_archive_item_room', 'hotelier_template_archive_room_title', 10 );
		remove_action( 'hotelier_archive_item_room', 'hotelier_template_archive_room_description', 20 );
		remove_action( 'hotelier_archive_item_room', 'hotelier_template_archive_room_price', 30 );
		remove_action( 'hotelier_archive_item_room', 'hotelier_template_archive_room_more', 40 );

		// Show title
		if ( isset( $settings['show_title'] ) && $settings['show_title'] === 'yes' ) {
			$show_title_priority = isset( $settings['show_title_priority'] ) && $settings['show_title_priority'] ? absint( $settings['show_title_priority'] ) : 10;
			add_action( 'hotelier_archive_item_room', 'hotelier_template_archive_room_title', $show_title_priority );
		}

		// Show description
		if ( isset( $settings['show_description'] ) && $settings['show_description'] === 'yes' ) {
			$show_description_priority = isset( $settings['show_description_priority'] ) && $settings['show_description_priority'] ? absint( $settings['show_description_priority'] ) : 20;
			add_action( 'hotelier_archive_item_room', 'hotelier_template_archive_room_description', $show_description_priority );
		}

		// Show price
		if ( isset( $settings['show_price'] ) && $settings['show_price'] === 'yes' ) {
			$show_price_priority = isset( $settings['show_price_priority'] ) && $settings['show_price_priority'] ? absint( $settings['show_price_priority'] ) : 30;
			add_action( 'hotelier_archive_item_room', 'hotelier_template_archive_room_price', $show_price_priority );
		}

		// Show more button
		if ( isset( $settings['show_more'] ) && $settings['show_more'] === 'yes' ) {
			$show_more_priority = isset( $settings['show_more_priority'] ) && $settings['show_more_priority'] ? absint( $settings['show_more_priority'] ) : 40;
			add_action( 'hotelier_archive_item_room', 'hotelier_template_archive_room_more', $show_more_priority );
		}

		// Show meta
		$show_meta_priority = isset( $settings['show_meta_priority'] ) && $settings['show_meta_priority'] ? absint( $settings['show_meta_priority'] ) : 15;

		if ( isset( $settings['show_meta'] ) && $settings['show_meta'] === 'yes' ) {
			add_action( 'hotelier_archive_item_room', 'hotelier_hello_elementor_archive_item_show_room_meta', $show_meta_priority );
		}

		// Show category
		if ( isset( $settings['show_category'] ) && $settings['show_category'] === 'yes' ) {
			add_action( 'hotelier_archive_item_room', 'hotelier_hello_elementor_archive_item_room_category_badge', 5 );
		}

		// Filter pagination args
		if ( isset( $settings['pagination_type'] ) && $settings['pagination_type'] === 'numbers' ) {
			add_filter( 'hotelier_pagination_args', array( $this, 'pagination_args' ) );
		}
	}

	protected function do_hooks_after_render() {
		$settings = $this->get_settings_for_display();

		// Add again shortcode's wrapper
		add_filter( 'hotelier_shortcode_room_loop_has_wrapper', '__return_true' );

		// Show image
		if ( isset( $settings['show_image'] ) && $settings['show_image'] === 'yes' ) {
			// Remove thumb's size filter
			remove_filter( 'hotelier_loop_room_image_size', array( $this, 'change_image_size' ) );
		}

		// Show image
		if ( isset( $settings['show_image'] ) && $settings['show_image'] === 'yes' ) {
			// Remove thumb's size filter
			remove_filter( 'hotelier_loop_room_image_size', array( $this, 'change_image_size' ) );
		} else {
			add_action( 'hotelier_archive_item_room', 'hotelier_template_archive_room_image', 5 );
		}

		// Re-add default hooks
		add_action( 'hotelier_archive_item_room', 'hotelier_template_archive_room_title', 10 );
		add_action( 'hotelier_archive_item_room', 'hotelier_template_archive_room_description', 20 );
		add_action( 'hotelier_archive_item_room', 'hotelier_template_archive_room_price', 30 );
		add_action( 'hotelier_archive_item_room', 'hotelier_template_archive_room_more', 40 );

		// Remove the new ones
		$show_title_priority = isset( $settings['show_title_priority'] ) && $settings['show_title_priority'] ? absint( $settings['show_title_priority'] ) : 10;
		$show_description_priority = isset( $settings['show_description_priority'] ) && $settings['show_description_priority'] ? absint( $settings['show_description_priority'] ) : 20;
		$show_price_priority = isset( $settings['show_price_priority'] ) && $settings['show_price_priority'] ? absint( $settings['show_price_priority'] ) : 30;
		$show_more_priority = isset( $settings['show_more_priority'] ) && $settings['show_more_priority'] ? absint( $settings['show_more_priority'] ) : 40;
		$show_meta_priority = isset( $settings['show_meta_priority'] ) && $settings['show_meta_priority'] ? absint( $settings['show_meta_priority'] ) : 15;

		remove_action( 'hotelier_archive_item_room', 'hotelier_template_archive_room_title', $show_title_priority );
		remove_action( 'hotelier_archive_item_room', 'hotelier_template_archive_room_description', $show_description_priority );
		remove_action( 'hotelier_archive_item_room', 'hotelier_template_archive_room_price', $show_price_priority );
		remove_action( 'hotelier_archive_item_room', 'hotelier_hello_elementor_archive_item_show_room_meta', $show_more_priority );

		// Remove pagination args filter
		if ( isset( $settings['pagination_type'] ) && $settings['pagination_type'] === 'numbers' ) {
			remove_filter( 'hotelier_pagination_args', array( $this, 'pagination_args' ) );
		}
	}

	public function change_image_size( $size ) {
		$settings = $this->get_settings_for_display();

		if ( isset( $settings['thumbnail_size'] ) && $settings['thumbnail_size'] ) {
			$size = $settings['thumbnail_size'];
		}

		return $size;
	}

	public function pagination_args( $args ) {
		$args['prev_next'] = false;

		return $args;
	}

	protected function get_shortcode_atts( $settings ) {
		$atts = array();

		// Query source
		$query_source = isset( $settings['query_source'] ) && ( $settings['query_source'] === 'related' || $settings['query_source'] === 'archive' ) ? $settings['query_source'] : 'default';

		if ( $query_source === 'archive' ) {
			// Posts per page
			$per_page = absint( htl_get_option( 'rooms_archive_per_page' ) );

			if ( $per_page ) {
				$atts['per_page'] = $per_page;
			}

			// Pagination
			$pagination       = isset( $settings['pagination_type'] ) && $settings['pagination_type'] ? 'true' : 'false';
			$atts['paginate'] = $pagination;
		} else {
			// Posts per page
			$per_page         = isset( $settings['posts_per_page'] ) ? absint( $settings['posts_per_page'] ) : 8;
			$atts['per_page'] = $per_page;

			// Pagination
			$pagination       = isset( $settings['pagination_type'] ) && $settings['pagination_type'] ? 'true' : 'false';
			$atts['paginate'] = $pagination;

			// Order by
			$orderby         = isset( $settings['order_by'] ) && $settings['order_by'] ? $settings['order_by'] : 'date';
			$atts['orderby'] = $orderby;

			// Order
			$order         = isset( $settings['order'] ) && $settings['order'] ? $settings['order'] : 'DESC';
			$atts['order'] = $order;

			// Offset
			$offset         = isset( $settings['offset'] ) && $settings['offset'] ? absint( $settings['offset'] ) : 0;
			$atts['offset'] = $offset;

			// Include IDs
			$include_ids = isset( $settings['include_rooms_ids'] ) && $settings['include_rooms_ids'] ? $settings['include_rooms_ids'] : array();
			if ( is_array( $include_ids ) ) {
				$atts['ids'] = implode( ',', $include_ids );
			}

			// Exclude IDs
			$exclude_ids = isset( $settings['exclude_rooms_ids'] ) && $settings['exclude_rooms_ids'] ? $settings['exclude_rooms_ids'] : array();
			if ( is_array( $exclude_ids ) ) {
				$atts['exclude_ids'] = implode( ',', $exclude_ids );
			}

			// Include categories
			$include_cats = isset( $settings['include_room_cats'] ) && $settings['include_room_cats'] ? $settings['include_room_cats'] : array();
			if ( is_array( $include_cats ) ) {
				$atts['category'] = implode( ',', $include_cats );
			}

			// Exclude categories
			$exclude_cats = isset( $settings['exclude_room_cats'] ) && $settings['exclude_room_cats'] ? $settings['exclude_room_cats'] : array();
			if ( is_array( $exclude_cats ) ) {
				$atts['exclude_category'] = implode( ',', $exclude_cats );
			}

			if ( $query_source === 'related' ) {
				$related_rooms_ids = $this->get_related_rooms_ids( $atts['per_page'] );

				if ( is_array( $related_rooms_ids ) ) {
					$atts['ids'] = implode( ',', $related_rooms_ids );
				}
			}
		}

		return $atts;
	}

	protected function get_related_rooms_ids( $limit ) {
		global $room;

		$ids = array();

		$related_rooms = htl_get_related_rooms_query( $room->id, $limit, 'rand' );

		if ( $related_rooms && $related_rooms->have_posts() ) {
			while ( $related_rooms->have_posts() ) { $related_rooms->the_post();

				global $post;

				$ids[] = $post->ID;
			}

			wp_reset_postdata();
		}

		return $ids;
	}

	protected function render_shortcode( $atts, $settings ) {
		$atts_string = '';

		foreach ( $atts as $att_key => $att_value ) {
			if ( $att_value ) {
				$atts_string .= $att_key . '="' . $att_value . '" ';
			}
		}

		if ( $settings['query_source'] === 'archive' ) {
			$shortcode_string = '[hotelier_archive_rooms ' . $atts_string . ']';
		} else {
			$shortcode_string = '[hotelier_rooms ' . $atts_string . ']';
		}

		$content = do_shortcode( $shortcode_string );

		return $content;
	}

	protected function render() {
		if ( HTL()->session ) {
			htl_print_notices();
		}

		$settings       = $this->get_settings_for_display();
		$shortcode_atts = $this->get_shortcode_atts( $settings );

		$this->do_hooks_before_render();

		$content = $this->render_shortcode( $shortcode_atts, $settings );

		$this->do_hooks_after_render();
		?>

		<?php
		if ( $content ) {
			echo $content;
		} else {
			echo '<div class="nothing-found-message">' . esc_html( 'Nothing found', 'wp-hotelier-hello-elementor' ) . '</div>';
		}
	}

}
