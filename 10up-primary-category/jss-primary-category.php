<?php

/**
 * 10up Primary Category
 *
 * Plugin Name: 10up Primary Category
 * Plugin URI: http://examplepluginuri.com
 * Description: Select and display primary category in posts
 * Version: 0.1
 * Author: Jason Skinner
 * Author URI: https://jasonskinner.me
 * Text Domain: 10up-primary-category
 * Domain Path:
 */

// If called directly, abort
if ( !defined( 'WPINC') ) {
	die;
}

/**
 * Core plugin class
 */
require_once JSS_PATH . 'src/jss-primary-category.php';

/*
 * Core admin class
 */
if ( is_admin() ) {
	require_once JSS_PATH . 'admin/class-jss-primary-category-admin.php';
}

