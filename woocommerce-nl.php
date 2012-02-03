<?php
/*
Plugin Name: WooCommerce (nl)
Plugin URI: http://pronamic.eu/wp-plugins/woocommerce-nl/
Description: Extends the WooCommerce plugin and add-ons with the Dutch language: <strong>WooCommerce</strong> 1.3.2.1
Version: 0.2.3
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
	private static $isDutch;

	////////////////////////////////////////////////////////////

	/**
	 * Bootstrap
	 */
	public static function bootstrap() {
		add_filter('load_textdomain_mofile', array(__CLASS__, 'loadMoFile'), 10, 2);
	}

	////////////////////////////////////////////////////////////

	/**
	 * Load text domain MO file
	 *
	 * @param string $moFile
	 * @param string $domain
	 */
	public static function loadMoFile($moFile, $domain) {
		if(self::$language == null) {
			self::$language = get_option('WPLANG', WPLANG);
			self::$isDutch = (self::$language == 'nl' || self::$language == 'nl_NL');

			if(defined('ICL_LANGUAGE_CODE')) {
				self::$isDutch = ICL_LANGUAGE_CODE == 'nl';
			}
		}

		$newMofile = null;

		// WooCommerce
		$isWooCommerceDomain = ($domain == 'woocommerce');

		if($isWooCommerceDomain) {
			$isWooCommerce = strpos($moFile, '/woocommerce/') !== false;

			if($isWooCommerce) {
				$version = get_option('woocommerce_db_version', null);

				if(strpos($moFile, '/woocommerce/languages/woocommerce-') !== false) {
					$newMofile = self::getMoFile('woocommerce', $version);
				} elseif(strpos($moFile, '/woocommerce/languages/formal/woocommerce-') !== false) {
					$newMofile = self::getMoFile('woocommerce', $version, 'formal/');
				} elseif(strpos($moFile, '/woocommerce/languages/informal/woocommerce-') !== false) {
					$newMofile = self::getMoFile('woocommerce', $version, 'informal/');
				}
			}
		}

		if(is_readable($newMofile)) {
			$moFile = $newMofile;
		}

		return $moFile;
	}

	////////////////////////////////////////////////////////////

	/**
	 * Get the MO file for the specified domain, version and language
	 */
	public static function getMoFile($domain, $version, $path = '') {
		$dir = dirname(__FILE__);

		$moFile = $dir . '/languages/' . $domain . '/' . $version . '/' . $path . self::$language . '.mo';

		// if specific version MO file is not available point to the current public release (cpr) version
		if(!is_readable($moFile)) {
			$moFile = $dir . '/languages/' . $domain . '/cpr/' . $path . self::$language . '.mo';
		}

		return $moFile;
	}
}

WooCommerceNL::bootstrap();
