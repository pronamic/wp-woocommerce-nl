<?php
/*
Plugin Name: WooCommerce (nl)
Plugin URI: http://pronamic.eu/wp-plugins/woocommerce-nl/
Description: Extends the WooCommerce plugin and add-ons with the Dutch language: <strong>WooCommerce</strong> 2.0.5 | <strong>WooCommerce EU VAT Number</strong> 1.4 | <strong>WooCommerce Subscribe to Newsletter</strong> 1.0.4 | <strong>WooCommerce Gateway Fees</strong> 1.2.1 | <strong>WooCommerce - Gravity Forms Product Add-Ons</strong> 1.3.6

Version: 0.4.3
Requires at least: 3.0

Author: Pronamic
Author URI: http://pronamic.eu/

Text Domain: woocommerce_nl
Domain Path: /languages/

License: GPL

GitHub URI: https://github.com/pronamic/wp-woocommerce-nl
*/

class WooCommerceNL {
	/**
	 * The current langauge
	 *
	 * @var string
	 */
	private static $language;

	/**
	 * Flag for the dutch langauge, true if current langauge is dutch, false otherwise
	 *
	 * @var boolean
	 */
	private static $is_dutch;

	////////////////////////////////////////////////////////////

	/**
	 * Bootstrap
	 */
	public static function bootstrap() {
		add_filter( 'load_textdomain_mofile', array( __CLASS__, 'load_mo_file' ), 10, 2 );

		/*
		 * WooThemes/WooCommerce don't execute the load_plugin_textdomain() in the 'init'
		 * action, therefor we have to make sure this plugin will load first
		 * 
		 * @see http://stv.whtly.com/2011/09/03/forcing-a-wordpress-plugin-to-be-loaded-before-all-other-plugins/
		 */ 
		add_action( 'activated_plugin',       array( __CLASS__, 'activated_plugin' ) );
	}

	////////////////////////////////////////////////////////////

	/**
	 * Activated plugin
	 */
	function activated_plugin() {
		$path = str_replace( WP_PLUGIN_DIR . '/', '', __FILE__ );

		if ( $plugins = get_option( 'active_plugins' ) ) {
			if ( $key = array_search( $path, $plugins ) ) {
				array_splice( $plugins, $key, 1 );
				array_unshift( $plugins, $path );

				update_option( 'active_plugins', $plugins );
			}
		}
	}

	////////////////////////////////////////////////////////////

	/**
	 * Load text domain MO file
	 *
	 * @param string $moFile
	 * @param string $domain
	 */
	public static function load_mo_file( $mo_file, $domain ) {
		if ( self::$language == null ) {
			self::$language = get_option( 'WPLANG', WPLANG );
			self::$is_dutch = ( self::$language == 'nl' || self::$language == 'nl_NL' );
		}

		// The ICL_LANGUAGE_CODE constant is defined from an plugin, so this constant
		// is not always defined in the first 'load_textdomain_mofile' filter call
		if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
			self::$is_dutch = ( ICL_LANGUAGE_CODE == 'nl' );
		}

		if ( self::$is_dutch ) {
			$domains = array(
				'woocommerce',
				'wc_eu_vat_number',
				'wc_gf_addons',
				'wc_subscribe_to_newsletter',
				'x3m_gf'
			);
			
			if ( in_array( $domain, $domains ) ) {
				$mo_file = self::get_mo_file( $domain );
			}
		}

		return $mo_file;
	}

	////////////////////////////////////////////////////////////

	/**
	 * Get the MO file for the specified domain, version and language
	 */
	public static function get_mo_file( $domain ) {
		$dir = dirname( __FILE__ );

		$mo_file = $dir . '/languages/' . $domain . '/nl_NL.mo';

		return $mo_file;
	}
}

WooCommerceNL::bootstrap();
