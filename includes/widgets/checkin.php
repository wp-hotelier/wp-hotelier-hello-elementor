<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class HTL_Hello_Elementor_Checkin_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'htl-checkin';
	}

	public function get_title() {
		return esc_html__( 'Check-in', 'wp-hotelier-hello-elementor' );
	}

	public function get_icon() {
		return 'eicon-date';
	}

	public function get_categories() {
		return [ 'hotelier-elements' ];
	}

	public function get_keywords() {
		return [ 'hotelier', 'hotel', 'checkin' ];
	}

	protected function register_controls() {
		$this->register_section_title_controls();
	}

	public function register_section_title_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Check-in', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'checkin_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .checkin-element',
			]
		);

		$this->add_control(
			'checkin_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .checkin-element' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'checkin_format',
			[
				'label' => esc_html__( 'Format', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__( 'Default', 'wp-hotelier-hello-elementor' ),
					'custom' => esc_html__( 'Custom', 'wp-hotelier-hello-elementor' ),
				],
			]
		);

		$this->add_control(
			'checkin_custom_format',
			[
				'label' => esc_html__( 'Custom Format', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => 'F j, Y',
				'default' => 'F j, Y',
				'condition' => [
					'checkin_format' => 'custom',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$format = $settings['checkin_format'] === 'custom' && $settings['checkin_custom_format'] ? $settings['checkin_custom_format'] : get_option( 'date_format' );

		$reservation = hotelier_hello_elementor_get_reservation_object_from_received_page();

		if ( $reservation ) {
			$checkin = $reservation->get_checkin();
		} else {
			$checkin = HTL()->session->get( 'checkin' );
		}

		$checkin_formatted = date_i18n( $format, strtotime( $checkin ) );
		?>

		<span class="checkin-element">
			<?php echo esc_html( $checkin_formatted ); ?>
		</span>
		<?php
	}

}
