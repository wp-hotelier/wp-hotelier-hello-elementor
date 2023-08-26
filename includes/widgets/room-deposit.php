<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class HTL_Hello_Elementor_Room_Deposit_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'htl-room-deposit';
	}

	public function get_title() {
		return esc_html__( 'Room Deposit', 'wp-hotelier-hello-elementor' );
	}

	public function get_icon() {
		return 'eicon-download-circle-o';
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
				'label' => esc_html__( 'Deposit', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'deposit_typography',
				'selector' => '{{WRAPPER}} .room__deposit--single',
			]
		);

		$this->add_control(
			'deposit_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .room__deposit--single' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		if ( ! is_room() ) {
			if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) : ?>
			<div class="htl-elementor-editor-notice" style="padding: 15px;margin-bottom: 20px;color: #93003c;background-color: #93003c42;font-weight: bold;">
				<?php echo esc_html_e( 'This module can only be used on the room page.', 'wp-hotelier-hello-elementor' ); ?>
			</div>
			<?php endif;
			return;
		}

		global $room;

		$settings = $this->get_settings_for_display();

		if ( ! $room->is_variable_room() && $room->needs_deposit() ) : ?>
			<div class="room__deposit room__deposit--single">
				<?php echo wp_kses_post( $room->get_long_formatted_deposit() ); ?>
			</div>
		<?php else : ?>
			<?php if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) : ?>
				<?php
				if ( $room->is_variable_room() ) {
					$placeholder = esc_html__( 'This is a placeholder because this is a variable room and deposit info is displayed in the room rates. This element will not be displayed on the live page.', 'wp-hotelier-hello-elementor' );
				} else if ( ! $room->needs_deposit() ) {
					$placeholder = esc_html__( 'This is a placeholder because this room does not require a deposit. This element will not be displayed on the live page.', 'wp-hotelier-hello-elementor' );
				}
				?>
				<div class="room__deposit room__deposit--single">
					<?php echo esc_html( $placeholder ); ?>
				</div>
			<?php endif; ?>
		<?php endif;
	}

}
