<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class HTL_Hello_Elementor_Room_Title_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'htl-room-title';
	}

	public function get_title() {
		return esc_html__( 'Room Title', 'wp-hotelier-hello-elementor' );
	}

	public function get_icon() {
		return 'eicon-post-title';
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
				'label' => esc_html__( 'Title', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .room__title--single',
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
					'{{WRAPPER}} .room__title--single' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label' => esc_html__( 'HTML Tag', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h1',
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

		$tag = \Elementor\Utils::validate_html_tag( $settings['title_tag'] );
		?>

		<<?php \Elementor\Utils::print_validated_html_tag( $tag ); ?> class="room__title room__title--single">
			<span>
			<?php echo get_the_title( $room->id ); ?>
			</span>
		</<?php \Elementor\Utils::print_validated_html_tag( $tag ); ?>>

		<?php
	}

}
