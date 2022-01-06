<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://themeforest.net/user/teknofraction/
 * @since      1.0.0
 *
 * @package    pslfree
 * @subpackage pslfree/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    pslfree
 * @subpackage pslfree/admin
 * @author     TeknoFraction   <Support@TeknoFraction.com>
 */
class Pslfree_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in pslfree_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The pslfree_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pslfree-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in pslfree_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The pslfree_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pslfree-admin.js', array( 'jquery' ), $this->version, false );

	}




	/**
	 * Add menu page for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function pslfree_menu() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in pslfree_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The pslfree_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		add_menu_page(
			'Products Skeleton Loader Free Version',   // Page Title.
			'Products Skeleton',                        // Menu Title.
			'manage_options',                           // capability.
			'pslfree-settings',                            // Menu slug.
			array( $this, 'pslfree_settings_display' ),    // callback function.
			'dashicons-align-full-width'                // icon.
		);
	}


	/**
	 * Display Admin Settings Page Data
	 *
	 * @since    1.0.0
	 */
	public function pslfree_settings_display() {
		// return views.
		require 'partials/pslfree-admin-display.php';
	}


	/**
	 * Resgiter Settings Fields
	 *
	 * @since    1.0.0
	 */
	public function pslfree_register_settings() {

		// General Section.
		register_setting(
			'pslfree_general_options',     // Group Name.
			'pslfree_switch'               // Setting name = html form <input> name on settings form.
		);
		register_setting(
			'pslfree_general_options',     // Group Name.
			'pslfree_image_switch'              // Setting name = html form <input> name on settings form.
		);
		register_setting(
			'pslfree_general_options',     // Group Name.
			'pslfree_image'                // Setting name = html form <input> name on settings form.
		);

		if ( isset( $_POST['pslfree_general'] ) && current_user_can( 'manage_options' ) ) {
			if ( wp_verify_nonce( isset( $_POST['pslfree_general_nonce'] ), 'pslfree_general_options' ) ) {
				print 'Nonce Failed!';
				exit;
			} else {
				update_option(
					'pslfree',
					array(
						'pslfree_switch'       => isset( $_POST['pslfree_switch'] ) ? sanitize_text_field( wp_unslash( $_POST['pslfree_switch'] ) ) : '',
						'pslfree_image_switch' => isset( $_POST['pslfree_image_switch'] ) ? sanitize_text_field( wp_unslash( $_POST['pslfree_image_switch'] ) ) : '',
						'pslfree_image'        => isset( $_POST['pslfree_image'] ) ? sanitize_text_field( wp_unslash( $_POST['pslfree_image'] ) ) : '',
					)
				);
			}
		}
	}
}
