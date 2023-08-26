<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class HTL_Hello_Elementor_Room_Meta_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'htl-room-meta';
	}

	public function get_title() {
		return esc_html__( 'Room Meta', 'wp-hotelier-hello-elementor' );
	}

	public function get_icon() {
		return 'eicon-meta-data';
	}

	public function get_categories() {
		return [ 'hotelier-elements' ];
	}

	public function get_keywords() {
		return [ 'hotelier', 'hotel', 'room' ];
	}

	protected function register_controls() {
		$this->register_section_general_controls();
		$this->register_section_design_controls();
	}

	public function register_section_general_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Room Meta', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_control(
			'show_max_guets',
			[
				'label' => esc_html__( 'Show Guests', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_max_children',
			[
				'label' => esc_html__( 'Show Children', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_bed_size',
			[
				'label' => esc_html__( 'Show Beds', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_bathroom',
			[
				'label' => esc_html__( 'Show Bathroom', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_room_size',
			[
				'label' => esc_html__( 'Show Room Size', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();
	}

	public function register_section_design_controls() {
		$this->start_controls_section(
			'section_design',
			[
				'label' => esc_html__( 'Room Meta Style', 'wp-hotelier-hello-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'room_meta_typography',
				'selector' => '{{WRAPPER}} .room__meta--single',
			]
		);

		$this->add_control(
			'room_meta_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .room__meta--single' => 'color: {{VALUE}};',
					'{{WRAPPER}} .room__meta--single span:after' => 'background-color: {{VALUE}};',
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

		$elements_show     = 0;
		$show_max_guets    = false;
		$show_max_children = false;
		$show_bed_size     = false;
		$show_bathroom     = false;
		$show_room_size    = false;

		if ( $settings['show_max_guets'] === 'yes' ) {
			$show_max_guets = true;
			$elements_show++;
		}

		if ( $settings['show_max_children'] === 'yes' ) {
			$show_max_children = true;
			$elements_show++;
		}

		if ( $settings['show_bed_size'] === 'yes' ) {
			$show_bed_size = true;
			$elements_show++;
		}

		if ( $settings['show_bathroom'] === 'yes' ) {
			$show_bathroom = true;
			$elements_show++;
		}

		if ( $settings['show_room_size'] === 'yes' ) {
			$show_room_size = true;
			$elements_show++;
		}
		?>

		<div class="room__meta room__meta--single <?php echo $elements_show === 1 ? 'room__meta--single-element' : '' ?>">
			<?php if ( $show_max_guets && $max_guests = $room->get_max_guests() ) : ?>
				<span class="room__meta-item room__meta-item--guests"><?php echo esc_html( sprintf( _n( '%s adult', '%s adults', $max_guests, 'wp-hotelier' ), absint( $max_guests ) ) ); ?></span>
			<?php endif; ?>

			<?php if ( $show_max_children && $max_children = $room->get_max_children() ) : ?>
				<span class="room__meta-item room__meta-item--children"><?php echo esc_html( sprintf( __( '%s children', 'wp-hotelier' ), $max_guests ) ); ?></span>
			<?php endif; ?>

			<?php if ( $show_bed_size && $bed_size = $room->get_bed_size() ) : ?>
				<span class="room__meta-item room__meta-item--beds"><?php echo esc_html( $bed_size ); ?></span>
			<?php endif; ?>

			<?php if ( $show_bathroom && $bathrooms = $room->get_bathrooms() ) : ?>
				<span class="room__meta-item room__meta-item--bathrooms"><?php echo esc_html( sprintf( _n( '%s bathroom', '%s bathrooms', $bathrooms, 'wp-hotelier' ), absint( $bathrooms ) ) ); ?></span>
			<?php endif; ?>

			<?php if ( $show_room_size && $room->get_room_size() ) : ?>
				<span class="room__meta-item room__meta-item--size"><?php echo esc_html( $room->get_formatted_room_size() ); ?></span>
			<?php endif; ?>
		</div>
		<?php
	}
}
