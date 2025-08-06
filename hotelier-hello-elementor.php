<?php
/**
 * Plugin Name:       WP Hotelier - Hello Elementor
 * Plugin URI:        https://wphotelier.com/hello-elementor/
 * Description:       WP Hotelier Integration For Hello Theme.
 * Version:           1.1.1
 * Author:            WP Hotelier
 * Author URI:        https://wphotelier.com/
 * Requires at least: 4.4
 * Tested up to:      6.0
 * License:           GPLv3
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       wp-hotelier-hello-elementor
 * Domain Path:       languages
 * Elementor tested up to: 3.14
 * Elementor Pro tested up to: 3.14
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Hotelier_Hello_Elementor' ) ) :

/**
 * Main Hotelier_Hello_Elementor Class
 */
final class Hotelier_Hello_Elementor {

	/**
	 * @var string
	 */
	public $version = '1.1.1';

	/**
	 * @var Hotelier_Hello_Elementor The single instance of the class
	 */
	private static $_instance = null;

	/**
	 * Main Hotelier_Hello_Elementor Instance
	 *
	 * Insures that only one instance of Hotelier_Hello_Elementor exists in memory at any one time.
	 *
	 * @static
	 * @see HTL_HELLO_ELEMENTOR()
	 * @return Hotelier_Hello_Elementor - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Cloning is forbidden.
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'wp-hotelier-hello-elementor' ), '1.0.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'wp-hotelier-hello-elementor' ), '1.0.0' );
	}

	/**
	 * Hotelier_Hello_Elementor Constructor.
	 */
	public function __construct() {
		$this->setup_constants();
		if ( ! empty( $_REQUEST['action'] ) && 'elementor' === $_REQUEST['action'] && is_admin() ) {
			if ( ! defined( 'HOTELIER_SHORTCODE_PREVIEW' ) ) {
				define( 'HOTELIER_SHORTCODE_PREVIEW', true );
			}
		}
		add_action( 'plugins_loaded', array( $this, 'init' ), 90 );
	}

	/**
	 * Setup plugin constants
	 *
	 * @return void
	 */
	private function setup_constants() {
		$upload_dir = wp_upload_dir();

		// Plugin version
		if ( ! defined( 'HTL_HELLO_ELEMENTOR_VERSION' ) ) {
			define( 'HTL_HELLO_ELEMENTOR_VERSION', $this->version );
		}

		// Plugin Folder Path
		if ( ! defined( 'HTL_HELLO_ELEMENTOR_PLUGIN_DIR' ) ) {
			define( 'HTL_HELLO_ELEMENTOR_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}

		// Plugin Folder URL
		if ( ! defined( 'HTL_HELLO_ELEMENTOR_PLUGIN_URL' ) ) {
			define( 'HTL_HELLO_ELEMENTOR_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		}

		// Plugin Root File
		if ( ! defined( 'HTL_HELLO_ELEMENTOR_PLUGIN_FILE' ) ) {
			define( 'HTL_HELLO_ELEMENTOR_PLUGIN_FILE', __FILE__ );
		}

		// Plugin Basename
		if ( ! defined( 'HTL_HELLO_ELEMENTOR_PLUGIN_BASENAME' ) ) {
			define( 'HTL_HELLO_ELEMENTOR_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
		}
	}

	/**
	 * Hook into actions and filters
	 */
	public function init() {
		if ( ! class_exists( 'Hotelier' ) ) {
			// Ask to install WP Hotelier first
			add_action( 'admin_notices', array( $this, 'install_hotelier_notice' ) );
			return;
		}

		if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
			// Ask to install Elementor
			add_action( 'admin_notices', array( $this, 'install_elementor_notice' ) );
			return;
		}

		// Include required files
		$this->includes();

		// Set up localisation
		$this->load_textdomain();
	}

	/**
	 * Include required files.
	 *
	 * @return void
	 */
	private function includes() {
		include_once HTL_HELLO_ELEMENTOR_PLUGIN_DIR . 'includes/widgets-functions.php';
		include_once HTL_HELLO_ELEMENTOR_PLUGIN_DIR . 'includes/hotelier-functions.php';
		include_once HTL_HELLO_ELEMENTOR_PLUGIN_DIR . 'includes/templates/templates-shortcodes.php';
		include_once HTL_HELLO_ELEMENTOR_PLUGIN_DIR . 'includes/scripts-functions.php';
		include_once HTL_HELLO_ELEMENTOR_PLUGIN_DIR . 'includes/theme-support.php';
	}

	/**
	 * Loads the plugin language files
	 *
	 * @return void
	 */
	public function load_textdomain() {
		// Set filter for plugin's languages directory
		$hotelier_hello_elementor_lang_dir = dirname( HTL_HELLO_ELEMENTOR_PLUGIN_BASENAME ) . '/languages/';
		$hotelier_hello_elementor_lang_dir = apply_filters( 'hotelier_hello_elementor_languages_directory', $hotelier_hello_elementor_lang_dir );

		// Traditional WordPress plugin locale filter
		$locale = apply_filters( 'plugin_locale', get_locale(), 'wp-hotelier-hello-elementor' );
		$mofile = sprintf( '%1$s-%2$s.mo', 'wp-hotelier-hello-elementor', $locale );

		// Setup paths to current locale file
		$mofile_local  = $hotelier_hello_elementor_lang_dir . $mofile;
		$mofile_global = WP_LANG_DIR . '/wp-hotelier-hello-elementor/' . $mofile;

		if ( file_exists( $mofile_global ) ) {
			// Look in global /wp-content/languages/wp-hotelier-hello-elementor folder
			load_textdomain( 'wp-hotelier-hello-elementor', $mofile_global );
		} elseif ( file_exists( $mofile_local ) ) {
			// Look in local /wp-content/plugins/wp-hotelier-hello-elementor/languages/ folder
			load_textdomain( 'wp-hotelier-hello-elementor', $mofile_local );
		} else {
			// Load the default language files
			load_plugin_textdomain( 'wp-hotelier-hello-elementor', false, $hotelier_hello_elementor_lang_dir );
		}
	}

	/**
	 * Show notice asking to install WP Hotelier.
	 */
	public function install_hotelier_notice() {
		$this->install_required_plugin_notice( 'wp-hotelier' );
	}

	/**
	 * Show notice asking to install Elementor.
	 */
	public function install_elementor_notice() {
		$this->install_required_plugin_notice( 'elementor' );
	}

	/**
	 * Show notice asking to install a required plugin.
	 */
	public function install_required_plugin_notice( $plugin ) {
		switch ( $plugin ) {
			case 'wp-hotelier':
				$path = 'wp-hotelier/hotelier.php';
				$slug = 'wp-hotelier';
				$name = 'WP Hotelier';
				break;

			case 'elementor':
				$path = 'elementor/elementor.php';
				$slug = 'elementor';
				$name = 'Elementor';
				break;
		}

		$installed_plugins     = get_plugins();
		$is_hotelier_installed = isset( $installed_plugins[ $path ] );
		$button_text           = false;

		if ( $is_hotelier_installed ) {
			$message = sprintf( __( 'WP Hotelier - Hello Elementor requires %s.', 'wp-hotelier-hello-elementor' ), $name );
			if ( current_user_can( 'activate_plugins' ) ) {
				$button_text = sprintf( __( 'Activate %s', 'wp-hotelier-hello-elementor' ), $name  );
				$button_link = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $path . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $path );
			}
		} else {
			$message = sprintf( __( 'WP Hotelier - Hello Elementor requires %s.', 'wp-hotelier-hello-elementor' ), $name );
			if ( current_user_can( 'install_plugins' ) ) {
				$button_text = sprintf( __( 'Install %s', 'wp-hotelier-hello-elementor' ), $name );
				$button_link = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=' . $slug ), 'install-plugin_' . $slug );
			}
		}
		?>

		<style>
			.wp-hotelier-hello-elementor-notice {
				border: 1px solid #ccd0d4;
				border-left: 4px solid #9b0a46 !important;
				box-shadow: 0 1px 4px rgba(0,0,0,0.15);
			}

			.wp-hotelier-hello-elementor-notice p {
				padding: 0;
				margin: 0;
			}
			.wp-hotelier-hello-elementor-notice h3 {
				margin: 0 0 5px;
			}
			.wp-hotelier-hello-elementor-notice-content {
				padding: 20px 0;
			}
			.wp-hotelier-hello-elementor-install-now {
				display: block;
				margin-top: 15px;
			}
			.wp-hotelier-hello-elementor-install-button {
				background: #127DB8;
				border-radius: 3px;
				color: #fff !important;
				text-decoration: none;
				height: auto;
				line-height: 20px;
				padding: 0.4375rem 0.75rem;
				text-transform: capitalize;
			}
		</style>

		<div class="notice wp-hotelier-hello-elementor-notice wp-hotelier-hello-elementor-install-hotelier">
			<div class="wp-hotelier-hello-elementor-notice-content">
				<h3><?php esc_html_e( 'Thanks for installing WP Hotelier - Hello Elementor!', 'wp-hotelier-hello-elementor' ); ?></h3>
				<p><?php echo esc_html( $message ); ?></p>
				<?php if ( $button_text ) : ?>
					<div class="wp-hotelier-hello-elementor-install-now">
						<a class="wp-hotelier-hello-elementor-install-button" href="<?php echo esc_attr( $button_link ); ?>"><?php echo esc_html( $button_text ); ?></a>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<?php
	}
}

endif;

/**
 * Returns the main instance of HTL_HELLO_ELEMENTOR to prevent the need to use globals.
 *
 * @return Hotelier_Hello_Elementor
 */
function HTL_HELLO_ELEMENTOR() {
	return Hotelier_Hello_Elementor::instance();
}

// Get HTL_HELLO_ELEMENTOR Running
HTL_HELLO_ELEMENTOR();
