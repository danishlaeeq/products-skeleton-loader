<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://codecanyon.net/user/teknofraction/portfolio
 * @since      1.0.0
 *
 * @package    pslfree
 * @subpackage pslfree/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    pslfree
 * @subpackage pslfree/includes
 * @author     TeknoFraction   <Support@TeknoFraction.com>
 */
class Pslfree_I18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'pslfree',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
