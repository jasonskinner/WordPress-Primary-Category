<?php

/**
 * 10up Primary Category
 *
 * Plugin Name: JSS Primary Category
 * Plugin URI: http://examplepluginuri.com
 * Description: Select and display primary category in posts
 * Version: 0.1
 * Author: Jason Skinner
 * Author URI: https://jasonskinner.me
 * Text Domain: jss-primary-category
 * Domain Path:
 *
 * @package JSS_Primary_Category
 */

// If called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! defined( 'JSS_PATH' ) ) {
	/**
	 * Plugin path
	 */
	define( 'JSS_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
}

if ( ! defined( 'JSS_URL' ) ) {
	/**
	 * Plugin folder URL
	 */
	define( 'JSS_URL', trailingslashit( plugins_url( '', __FILE__ ) ) );
}

/**
 * Core plugin class
 */
require_once JSS_PATH . 'src/class-jss-primary-category.php';

/*
 * Core admin class
 */
if ( is_admin() ) {
	require_once JSS_PATH . 'admin/class-jss-primary-category-admin.php';
	require_once JSS_PATH . 'admin/metabox/class-metabox-primary-category.php';
}
