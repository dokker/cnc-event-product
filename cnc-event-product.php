<?php
/*
Plugin Name: CNC Event related Products
Plugin URI: http://colorandcode.hu
Description: Wordpress plugin that provide product linking functionality to CNC Events
Version: 1.0
Author: docker
Author URI: https://hu.linkedin.com/in/docker
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Initial settings
 */

/**
 * Autoload
 */
$vendorAutoload = realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
if (is_file($vendorAutoload)) {
	require_once($vendorAutoload);
}

function __cnc_event_product_load_plugin()
{
	// load translations
	load_plugin_textdomain( 'cnc-event-product', false, 'cnc-event-product/languages' );

	$controller = new cncEP\Controller();
}
add_action('plugins_loaded', '__cnc_event_product_load_plugin');
