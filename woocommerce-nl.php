<?php
/*
Plugin Name: WooCommerce (nl)
Plugin URI: http://pronamic.eu/wp-plugins/woocommerce-nl/
Description: Extends the WooCommerce plugin and add-ons with the Dutch language: <strong>WooCommerce</strong> 1.6.5.1

Version: 0.3.16
Requires at least: 3.0

Author: Pronamic
Author URI: http://pronamic.eu/
License: GPL
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

			if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
				self::$is_dutch = ( ICL_LANGUAGE_CODE == 'nl' );
			}
		}

		$new_mo_file = null;

		// WooCommerce
		$is_woocommerce_domain = ($domain == 'woocommerce');

		if ( $is_woocommerce_domain ) {
			$is_woocommerce = strpos( $mo_file, '/woocommerce/' ) !== false;

			if ( $is_woocommerce ) {
				$version = get_option( 'woocommerce_db_version', null );

				if ( strpos( $mo_file, '/woocommerce/languages/woocommerce-' ) !== false ) {
					$new_mo_file = self::get_mo_file( 'woocommerce', $version );
				} elseif ( strpos( $mo_file, '/woocommerce/languages/formal/woocommerce-' ) !== false ) {
					$new_mo_file = self::get_mo_file( 'woocommerce', $version, 'formal/' );
				} elseif ( strpos( $mo_file, '/woocommerce/languages/informal/woocommerce-' ) !== false ) {
					$new_mo_file = self::get_mo_file( 'woocommerce', $version, 'informal/' );
				}
			}
		}

		if ( is_readable( $new_mo_file ) ) {
			$mo_file = $new_mo_file;
		}

		return $mo_file;
	}

	////////////////////////////////////////////////////////////

	/**
	 * Get the MO file for the specified domain, version and language
	 */
	public static function get_mo_file( $domain, $version, $path = '' ) {
		$dir = dirname( __FILE__ );

		$mo_file = $dir . '/languages/' . $domain . '/' . $version . '/' . $path . self::$language . '.mo';

		// if specific version MO file is not available point to the current public release (cpr) version
		if( ! is_readable( $mo_file ) ) {
			$mo_file = $dir . '/languages/' . $domain . '/cpr/' . $path . self::$language . '.mo';
		}

		return $mo_file;
	}
}

WooCommerceNL::bootstrap();
