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

class WooCommerceNLPlugin {
	/**
	 * The current langauge
	 *
	 * @var string
	 */
	private $language;

	/**
	 * Flag for the dutch langauge, true if current langauge is dutch, false otherwise
	 *
	 * @var boolean
	 */
	private $is_dutch;

	////////////////////////////////////////////////////////////

	/**
	 * Bootstrap
	 */
	public function __construct( $file ) {
		$this->file = $file;

		// Filters and actions
		add_filter( 'load_textdomain_mofile', array( $this, 'load_mo_file' ), 10, 2 );

		/*
		 * WooThemes/WooCommerce don't execute the load_plugin_textdomain() in the 'init'
		 * action, therefor we have to make sure this plugin will load first
		 * 
		 * @see http://stv.whtly.com/2011/09/03/forcing-a-wordpress-plugin-to-be-loaded-before-all-other-plugins/
		 */ 
		add_action( 'activated_plugin',       array( $this, 'activated_plugin' ) );
	}

	////////////////////////////////////////////////////////////

	/**
	 * Activated plugin
	 */
	public function activated_plugin() {
		$path = str_replace( WP_PLUGIN_DIR . '/', '', $this->file );

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
	public function load_mo_file( $mo_file, $domain ) {
		if ( $this->language == null ) {
			$this->language = get_option( 'WPLANG', WPLANG );
			$this->is_dutch = ( $this->language == 'nl' || $this->language == 'nl_NL' );
		}

		// The ICL_LANGUAGE_CODE constant is defined from an plugin, so this constant
		// is not always defined in the first 'load_textdomain_mofile' filter call
		if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
			$this->is_dutch = ( ICL_LANGUAGE_CODE == 'nl' );
		}

		if ( $this->is_dutch ) {
			$domains = array(
				// @see https://github.com/woothemes/woocommerce/tree/v2.0.5
				'woocommerce'                => array(
					'i18n/languages/woocommerce-nl_NL.mo'           => 'woocommerce/nl_NL.mo',
					'i18n/languages/woocommerce-admin-nl_NL.mo'     => 'woocommerce/admin-nl_NL.mo'
				),
				'wc_eu_vat_number'           => array(
					'languages/wc_eu_vat_number-nl_NL.mo'           => 'woocommerce-eu-vat-number/nl_NL.mo'
				),
				'wc_gf_addons'               => array(
					'languages/wc_gf_addons-nl_NL.mo'               => 'woocommerce-gravityforms-product-addons/nl_NL.mo'
				),
				'wc_subscribe_to_newsletter' => array(
					'languages/wc_subscribe_to_newsletter-nl_NL.mo' => 'woocommerce-subscribe-to-newsletter/nl_NL.mo'
				),
				'x3m_gf'                     => array(
					'languages/x3m_gf-nl_NL.mo'                     => 'woocommerce-gateway-fees/nl_NL.mo'
				)
			);

			if ( isset( $domains[$domain] ) ) {
				$paths = $domains[$domain];

				foreach ( $paths as $path => $file ) {
					if ( substr( $mo_file, -strlen( $path ) ) == $path ) {
						$new_file = dirname( $this->file ) . '/languages/' . $file;

						if ( is_readable( $new_file ) ) {
							$mo_file = $new_file;
						}
					}
				}
			}
		}

		return $mo_file;
	}
}

global $woocommerce_nl_plugin;

$woocommerce_nl_plugin = new WooCommerceNLPlugin( __FILE__ );
