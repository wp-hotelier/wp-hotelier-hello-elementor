<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class HTL_Hello_Elementor_Room_Price_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'htl-room-price';
	}

	public function get_title() {
		return esc_html__( 'Room Price', 'wp-hotelier-hello-elementor' );
	}

	public function get_icon() {
		return 'eicon-number-field';
	}

	public function get_categories() {
		return [ 'hotelier-elements' ];
	}

	public function get_keywords() {
		return [ 'hotelier', 'hotel', 'room' ];
	}

	protected function register_controls() {
		$this->register_section_title_controls();
	}

	public function register_section_title_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Price', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .room__price--single',
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
					'{{WRAPPER}} .room__price--single' => 'color: {{VALUE}};',
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
		?>

		<div class="room__price-wrapper room__price-wrapper--single">
			<span class="room__price room__price--single"><?php echo $room->get_min_price_html(); ?></span>
		</div>
		<?php
	}

}
