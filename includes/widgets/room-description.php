<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class HTL_Hello_Elementor_Room_Description_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'htl-room-description';
	}

	public function get_title() {
		return esc_html__( 'Room Short Description', 'wp-hotelier-hello-elementor' );
	}

	public function get_icon() {
		return 'eicon-text';
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
				'label' => esc_html__( 'Room Short Description', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .room__short-description',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .room__short-description' => 'color: {{VALUE}};',
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

		$short_description = apply_filters( 'hotelier_short_description', $room->post->post_excerpt );

		if ( ! $short_description && \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			$short_description = esc_html__( 'This is a placeholder because this room does not have a short description. This element will not be displayed on the live page.', 'wp-hotelier-hello-elementor' );
		}
		?>

		<?php if ( $short_description ) : ?>
			<div class="room__short-description">
				<?php echo wp_kses_post( $short_description ); ?>
			</div>
		<?php endif;
	}
}
