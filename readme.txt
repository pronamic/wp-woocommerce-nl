=== WooCommerce (nl) ===
Contributors: pronamic, remcotolsma
Tags: woocommerce, translation, dutch, nl, nl_NL, webshop, ecommerce, e-commerce, commerce, woothemes
Donate link: http://www.pronamic.eu/donate/?for=wp-plugin-woocommerce-nl&source=wp-plugin-readme-txt
Requires at least: 3.0
Tested up to: 3.9.1
Stable tag: 1.1.5

This WordPress plugin extends the WooCommerce plugin with the Dutch translation.

== Description ==

<strong>WooCommerce</strong> 2.2.4
<strong>WooCommerce EU VAT Number</strong> 1.4
<strong>WooCommerce Subscribe to Newsletter</strong> 1.0.4
<strong>WooCommerce Gateway Fees</strong> 1.2.1
<strong>WooCommerce - Gravity Forms Product Add-Ons</strong> 2.4.2
<strong>WooCommerce Print Invoices & Delivery Notes</strong> 2.0.2

> This plugin requires the <a href="http://wordpress.org/extend/plugins/woocommerce/">WooCommerce plugin</a>


== Installation ==

Extract the zip file and just drop the contents in the wp-content/plugins/ directory of your 
WordPress installation and then activate the Plugin from Plugins page.


== Developers ==

*	php ~/wp/svn/i18n-tools/makepot.php wp-plugin ~/Downloads/woocommerce-eu-vat-number ./languages/woocommerce-eu-vat-number/wc_eu_vat_number.pot
*	grunt downloadPo --project=woocommerce/2.2.4 --destination=languages/woocommerce/nl_NL.po
*	grunt downloadPo --project=woocommerce/2.2.4/admin --destination=languages/woocommerce/admin-nl_NL.po
*	grunt downloadPo --project=woocommerce-eu-vat-number/1.5.8 --destination=languages/woocommerce-eu-vat-number/nl_NL.po


== Changelog ==

= 1.1.5 =
*	Updated translatiosn to WooCommerce v2.2.4

= 1.1.4 =
*	Updated translations to WooCommerce v2.1.12.

= 1.1.3 =
*	Updated translations to WooCommerce v2.1.8.

= 1.1.2 =
*	Updated translations to WooCommerce v2.1.3, please note that WooCommerce v2.1.3 contains a [bug](https://github.com/woothemes/woocommerce/commit/4ab4811c571d566d103aa7902e9eb25e5732483e).

= 1.1.1 =
*	Fix - Warning: printf() [function.printf]: Argument number must be greater than zero in /woocommerce/templates/myaccount/my-account.php on line 22.

= 1.1.0 =
*	Updated frontend translation to WooCommerce v2.1.2.

= 1.0.1 =
*	Updated translations to WooCommerce v2.0.20.

= 1.0.0 =
*	Updated translations to WooCommerce v2.0.19.
*	Updated WordPress.org plugin header.

= 0.4.9 =
*	Updated translations to WooCommerce v2.0.14

= 0.4.8 =
*	Updated translations to WooCommerce v2.0.13

= 0.4.7 =
*	Updated translations to WooCommerce v2.0.12
*	Added translations for WooCommerce - Gravity Forms Product Add-Ons v2.4.2

= 0.4.6 =
*	Updated translations for WooCommerce - Gravity Forms Product Add-Ons v2.4.2

= 0.4.5 =
*	Updated translations to WooCommerce v2.0.10

= 0.4.4 =
*	Updated translation to WooCommerce v2.0.5

= 0.4.3 =
*	Updated translation to WooCommerce v2.0.5

= 0.4.2 =
*	Updated translation to WooCommerce v2.0.4

= 0.4.1 =
*	Updated translation to WooCommerce v2.0.3

= 0.4 =
*	Updated translation to WooCommerce v2.0.2
*	Updated translation to WooCommerce v2.0.1
*	Updated translation to WooCommerce v2.0.0
*	Removed translations of older plugin versions

= 0.3.21 =
*	Added translation for WooCommerce Gateway Fees v1.2.1

= 0.3.20 =
*	Added translation for WooCommerce v1.6.6

= 0.3.19 =
*	Added translation for WooCommerce Subscribe to Newsletter v1.0.4
*	Added translation for WooCommerce EU VAT Number v1.4

= 0.3.18 =
*	Added translation for WooCommerce EU VAT Number v1.4
*	Added function that will make sure this plugins will load as first

= 0.3.17 =
*	Added translation for WooCommerce v1.6.5.2

= 0.3.16 =
*	Added translation for WooCommerce v1.6.5
*	Added translation for WooCommerce v1.6.5.1

= 0.3.15 =
*	Added translation for WooCommerce v1.6.4

= 0.3.14 =
*	Added translation for WooCommerce v1.6.2
*	Added translation for WooCommerce v1.6.3

= 0.3.13 =
*	Added translation for WooCommerce v1.6.0
*	Added translation for WooCommerce v1.6.1

= 0.3.12 =
*	Added translation for WooCommerce v1.5.8

= 0.3.11 =
*	Added translation for WooCommerce v1.5.7.1

= 0.3.10 =
*	Added translation for WooCommerce v1.5.6
*	Added translation for WooCommerce v1.5.5

= 0.3.9 =
*	Added translation for WooCommerce v1.5.4

= 0.3.8 =
*	Added translation for WooCommerce v1.5.3

= 0.3.7 =
*	Added translation for WooCommerce v1.5.2.1

= 0.3.6 =
*	Added translation for WooCommerce v1.5.2

= 0.3.5 =
*	Added translation for WooCommerce v1.5.1

= 0.3.4 =
*	Added translation for WooCommerce v1.5

= 0.3.3 =
*	Added translation for WooCommerce v1.4.4

= 0.3.2 =
*	Changed the translation of 'pending' from 'in afwachting van' naar 'in behandeling'
*	Added translation for WooCommerce v1.4.3

= 0.3.1 =
*	Added translation for WooCommerce v1.4.2

= 0.3 =
*	Changed text domain from 'woothemes' to 'woocommerce'
*	Improved translations of strings with ' / '
*	Improved translations of strings with 'VAT' or 'Tax'
*	Improved many other translations
*	Added translation for WooCommerce v1.4
*	Added translation for WooCommerce v1.4.1

= 0.2.3 =
*	Added translation for WooCommerce v1.3.2.1

= 0.2.2 =
*	Added translation for WooCommerce v1.3.2

= 0.2.1 =
*	Added translation for WooCommerce v1.3.1

= 0.2 =
*	Added translation for WooCommerce v1.3

= 0.1 =
*	Initial release


== Links ==

*	[Pronamic](http://pronamic.eu/)
*	[Remco Tolsma](http://remcotolsma.nl/)
*	[Markdown's Syntax Documentation][markdown syntax]

[markdown syntax]: http://daringfireball.net/projects/markdown/syntax
            "Markdown is what the parser uses to process much of the readme file"


== Pronamic plugins ==

*	[Pronamic Google Maps](http://wordpress.org/extend/plugins/pronamic-google-maps/)
*	[Gravity Forms (nl)](http://wordpress.org/extend/plugins/gravityforms-nl/)
*	[Pronamic Page Widget](http://wordpress.org/extend/plugins/pronamic-page-widget/)
*	[Pronamic Page Teasers](http://wordpress.org/extend/plugins/pronamic-page-teasers/)
*	[Maildit](http://wordpress.org/extend/plugins/maildit/)
*	[Pronamic Framework](http://wordpress.org/extend/plugins/pronamic-framework/)
*	[Pronamic iDEAL](http://wordpress.org/extend/plugins/pronamic-ideal/)

