<?php
/**
 * Main plugin entry point
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.codester.com/teknofraction/
 * @since             1.0.0
 * @package           pslfree
 *
 * @wordpress-plugin
 * Plugin Name:       Products Skeleton Loader Free
 * Plugin URI:        https://www.codester.com/teknofraction/
 * Description:       Add Premium Skeleton Loading Animation to Products Before They Load.
 * Version:           1.0.0
 * Author:            TeknoFraction
 * Author URI:        https://codecanyon.net/user/teknofraction/
 * Text Domain:       pslfree
 * Domain Path:       /languages
 * Tested up to:      5.8
 * Requires at least: 5.6
 * Requires PHP: 7.0
 *
 * Copyright 2021-2021 Teknofraction (http://teknofraction.com/)
 */

/* If this file is called directly, abort. */
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */

define( 'PSLFREE_VERSION', '1.0.0' );
define( 'PSLFREE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'PSLFREE_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pslfree-activator.php
 */
function activate_pslfree() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pslfree-activator.php';
	$activator = new Pslfree_Activator();
	$activator->activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pslfree-deactivator.php
 */
function deactivate_pslfree() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pslfree-deactivator.php';
	Pslfree_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_pslfree' );
register_deactivation_hook( __FILE__, 'deactivate_pslfree' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-pslfree.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/custom-products.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_pslfree() {

	$plugin = new pslfree();
	$plugin->run();
}
run_pslfree();



/**
 * New filter of row meta to show Docs link in the Plugins list table.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
add_filter( 'plugin_row_meta', 'pslfree_wp_row_meta', 10, 2 );
// Add a link to the plugin's settings and/or network admin settings in the plugins list table.
add_filter( 'plugin_action_links', 'pslfree_add_settings_link', 10, 2 );
add_filter( 'network_admin_plugin_action_links', 'pslfree_add_settings_link', 10, 2 );


/**
 * Filters the array of row meta for each plugin in the Plugins list table.
 *
 * @param array  $links         An array of the plugin's metadata, including the version, author, author URI, and plugin URI..
 * @param string $file          Path to the plugin file relative to the plugins directory.
 *
 * @since    1.0.0
 */
function pslfree_wp_row_meta( $links, $file ) {
	if ( plugin_basename( __FILE__ ) === $file ) {
		$row_meta = array(
			'Docs' => '<a href="' . esc_url( 'https://techriver.com.pk/teknofraction/pslfree/docs/' ) . '" target="_blank" aria-label="' . esc_attr__( 'Docs', 'pslfree' ) . '" style="color:green;font-weight:bold">' . esc_html__( 'Documentation', 'pslfree' ) . '</a>',
		);
		return array_merge( $links, $row_meta );
	}
	return (array) $links;
};


/**
 * Add a link to the settings on the Plugins screen.
 *
 * @param array  $links         An array of the plugin's metadata, including the version, author, author URI, and plugin URI..
 * @param string $file          Path to the plugin file relative to the plugins directory.
 *
 * @since    1.0.0
 */
function pslfree_add_settings_link( $links, $file ) {
	if ( plugin_basename( __FILE__ ) === $file ) {
		$url  = admin_url( '/admin.php?page=pslfree-settings' );
		$url2 = 'https://www.codester.com/teknofraction/';

		// Prevent warnings in PHP 7.0+ when a plugin uses this filter incorrectly.
		$links   = (array) $links;
		$links[] = sprintf( '<a href="%s">%s</a>', $url, esc_html__( 'Settings', 'pslfree' ) );
		$links[] = sprintf( '<a style="font-weight:bolder;color:red" href="%s">%s</a>', $url2, esc_html__( 'Premium!', 'pslfree' ) );
	}
	return (array) $links;
}



if ( ! function_exists( 'pslfree_plugin_activation' ) ) {
	/**
	 * Add action on plugin activation
	 */
	function pslfree_plugin_activation() {
		// Add reviews metadata on plugin activation.
		$notices   = get_option( 'pslfree_reviews', array() );
		$notices[] = '';
		update_option( 'pslfree_reviews', $notices );
	}
}
register_activation_hook( __FILE__, 'pslfree_plugin_activation' );



if ( ! function_exists( 'pslfree_reviews_notices' ) ) {
	/**
	 * Display admin notice on Card Elements activation for ratings
	 */
	function pslfree_reviews_notices() {
		$notices = get_option( 'pslfree_reviews' );
		if ( $notices ) {
			foreach ( $notices as $notice ) { ?>
					<div class='notice notice-success is-dismissible pslfree_notice'>
						<p style="font-size: 17px;">
							<?php printf( esc_html__( 'You are now using ', 'pslfree' ) ); ?>
							<strong>
								<?php printf( esc_html__( 'Product Skeleton Loader Free', 'pslfree' ) ); ?>
							</strong>
							<?php printf( esc_html__( ' plugin.', 'pslfree' ) ); ?>
							<a href="<?php esc_html( 'https://www.codester.com/teknofraction/' ); ?>">
								<?php printf( esc_html__( 'Get Premium!', 'pslfree' ) ); ?>
							</a>
						</p>
						<p style="font-size: 17px;">
							<?php printf( esc_html__( 'If you like This Plugin, Don\'t forget to Rate it.', 'pslfree' ) ); ?>
						</p>
						<p style="font-size: 15px;text-align: right;display: grid;">
							<a class="pslfree_btn_secondary" style="color: rgb(0 8 255);" href="<?php printf( esc_url( admin_url( '/admin.php?page=pslfree-settings' ) ) ); ?>">
								<?php printf( esc_html( 'Goto Settings' ) ); ?>
							</a>
							<a class="pslfree_btn_secondary" href="<?php printf( esc_url( 'https://codester.com/teknofraction/' ) ); ?>">
								<?php printf( esc_html( 'Get Premium !' ) ); ?>
							</a>
						</p>
						<p>
							<a href="<?php printf( esc_url( 'https://www.codester.com/items/reviews/35168/woocommerce-skeleton-loader' ) ); ?>" target="_blank" class="rating-link">
							<strong>
								<?php printf( esc_html__( 'Rate This Plugin.', 'pslfree' ) ); ?>
							</strong>
							</a>
						</p>
					</div>
					<?php
			}
			delete_option( 'pslfree_reviews' );
		}
	}
	add_action( 'admin_notices', 'pslfree_reviews_notices' );
}

if ( ! function_exists( 'pslfree_plugin_deactivation' ) ) {
	/**
	 * Remove reviews metadata on plugin deactivation.
	 */
	function pslfree_plugin_deactivation() {
		delete_option( 'pslfree_reviews' );
	}
}
register_deactivation_hook( __FILE__, 'pslfree_plugin_deactivation' );
