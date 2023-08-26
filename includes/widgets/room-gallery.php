<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class HTL_Hello_Elementor_Room_Gallery_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'htl-room-gallery';
	}

	public function get_title() {
		return esc_html__( 'Room Gallery', 'wp-hotelier-hello-elementor' );
	}

	public function get_icon() {
		return 'eicon-image';
	}

	public function get_categories() {
		return [ 'hotelier-elements' ];
	}

	public function get_keywords() {
		return [ 'hotelier', 'hotel', 'room', 'gallery' ];
	}

	protected function register_controls() {
		$this->register_section_general_controls();
		$this->register_section_design_controls();
	}

	public function register_section_general_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Room Gallery', 'wp-hotelier-hello-elementor' ),
			]
		);

		$this->add_control(
			'enable_ligthbox',
			[
				'label' => esc_html__( 'Enable Lightbox', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();
	}

	protected function register_section_design_controls() {
		$this->start_controls_section(
			'section_design',
			[
				'label' => esc_html__( 'Link Style', 'wp-hotelier-hello-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,

			]
		);

		$this->add_control(
			'link_only',
			[
				'label' => esc_html__( 'Link only', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
				'condition' => [
					'enable_ligthbox' => 'yes',
				],
			]
		);

		$this->add_control(
			'link_type',
			[
				'label' => esc_html__( 'Link Type', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'icon' => esc_html__( 'Icon', 'wp-hotelier-hello-elementor' ),
					'text' => esc_html__( 'Text', 'wp-hotelier-hello-elementor' ),
				],
				'prefix_class' => 'room-gallery-link--',
				'condition' => [
					'enable_ligthbox' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'link_typography',
				'selector' => '{{WRAPPER}}.room-gallery-link--text .room__gallery-link',
				'exclude' => [ 'line_height' ],
				'condition' => [
					'enable_ligthbox' => 'yes',
					'link_type' => 'text',
				],
			]
		);

		$this->start_controls_tabs( 'link_styles', [
			'condition' => [
				'enable_ligthbox' => 'yes',
			],
		] );

		$this->start_controls_tab( 'link_normal_styles', [
			'label' => esc_html__( 'Normal', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'link_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .room__gallery-link-only .room__gallery-link' => 'background-color: {{VALUE}};',
				],
				'default' => '#000000',
				'condition' => [
					'enable_ligthbox' => 'yes',
					'link_type' => 'icon',
				],
			]
		);

		$this->add_control(
			'link_color',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .room__gallery-link' => 'color: {{VALUE}} !important;',
				],
				'condition' => [
					'enable_ligthbox' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'datepicker_main_button_hover_styles', [
			'label' => esc_html__( 'Hover', 'wp-hotelier-hello-elementor' ),
		] );

		$this->add_control(
			'link_bg_color_hover',
			[
				'label' => esc_html__( 'Background Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .room__gallery-link-only .room__gallery-link:hover' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'enable_ligthbox' => 'yes',
					'link_type' => 'icon',
				],
			]
		);

		$this->add_control(
			'link_color_hover',
			[
				'label' => esc_html__( 'Color', 'wp-hotelier-hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .room__gallery-link:hover' => 'color: {{VALUE}} !important;',
				],
				'condition' => [
					'enable_ligthbox' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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

		if ( $settings['link_only'] === 'yes' ) {
			global $post, $room;

			$thumb_id        = has_post_thumbnail() ? get_post_thumbnail_id() : false;
			$room_thumbnails = array();

			if ( $thumb_id > 0 ) {
				$thumbnail         = wp_get_attachment_image_src( $thumb_id, 'full' );
				$thumbnail_src     = $thumbnail[0];
				$room_thumbnails[] = $thumb_id;
			}

			$room_gallery_ids = $room->get_gallery_attachment_ids();

			if ( $room_gallery_ids ) {
				$room_thumbnails = array_merge( $room_thumbnails, $room_gallery_ids );
			}
			?>

			<div class="room__gallery room__gallery-link-only">
				<a href="#" class="room__gallery-link" data-index="0"><?php esc_html_e( 'View gallery', 'wp-hotelier-hello-elementor' ); ?></a>

				<?php if ( is_array( $room_thumbnails ) && count( $room_thumbnails ) > 0 ) :
					$loop = 0;
					?>

					<ul style="display:none">

						<?php foreach ( $room_thumbnails as $attachment_id ) {
							$classes = array( 'room__gallery-thumbnail', 'room__gallery-thumbnail--listing' );

							$image_large = wp_get_attachment_image_src( $attachment_id, 'full' );

							if ( ! $image_large ) {
								continue;
							}

							$image_link    = esc_url( $image_large[ 0 ] );
							$image_width   = absint( $image_large[ 1 ] );
							$image_height  = absint( $image_large[ 2 ] );
							$image_title   = esc_attr( get_the_title( $attachment_id ) );
							$image_caption = esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );
							$image_class   = esc_attr( implode( ' ', $classes ) );
							$image_index   = has_post_thumbnail() ? absint( $loop + 1 ) : absint( $loop );

							echo apply_filters( 'hotelier_room_list_card_gallery_thumbnail_html', sprintf( '<li><a href="%s" data-size="%sx%s" data-index="%s" class="%s" title="%s">%s</a></li>', $image_link, $image_width, $image_height, $image_index, $image_class, $image_caption, $image_title ), $attachment_id, $room->id, $image_class );

							$loop++;
						} ?>

					</ul>
				<?php endif; ?>
			</div>
			<?php
		} else {
			htl_get_template( 'single-room/image.php' );

			if ( $settings['enable_ligthbox'] === 'yes' ) {
				htl_get_template( 'single-room/gallery.php' );
			} else {
				// Close the .room__thumbnail div
				echo '</div><!-- .room__thumbnail -->';
			}
		}
	}

}
