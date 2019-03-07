<?php
/**
 * Class to handle admin interations in plugin
 *
 * @package JSS_Primary_Category
 */

// If called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'JSS_Primary_Category_Admin' ) ) {

	/**
	 * Admin Class
	 */
	class JSS_Primary_Category_Admin {
		/**
		 * Create instance of JSS_Primary_Category_Admin
		 *
		 * @var JSS_Primary_Category_Admin
		 */
		protected static $instance = null;

		/**
		 * Return instance of class JSS_Primary_Category_Admin
		 *
		 * @return instance of class JSS_Primary_Category_Admin
		 */
		public static function get_instance() {
			// set instance.
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			// return.
			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * @access public
		 * @return void
		 */
		public function __construct() {
			$this->register_hooks();
		}

		/**
		 * Determine if page is post edit or new with action
		 *
		 * @return bool
		 */
		public function is_post() {
			/**
			 * Checks if current screen is post
			 *
			 * @return bool true or false
			 */
			return $this->this_screen();

			add_action( 'current_screen', 'this_screen' );
		}

		/**
		 * Get current screen in the admin.
		 *
		 * @return bool
		 */
		public function this_screen() {
			$screen = get_current_screen();

			if ( 'post' === $screen->id ) {
				return true;
			}
			return false;
		}

		/**
		 * Get current ID
		 *
		 * @return integer
		 */
		public function get_current_id() {
			$postid = get_post_id();
			return $postid;
		}

		/**
		 * Register actions for Admin
		 *
		 * @access private
		 * @return void
		 */
		public function register_hooks() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}

		/**
		 * Enqueue all assets required for plugin in admin
		 */
		public function enqueue_scripts() {
			// return is not edit post.
			if ( ! $this->is_post() ) {
				return;
			}

			// register styles and scripts.
			wp_register_style( 'jss-category-metabox-css', JSS_URL . 'admin/css/output/jss-category-metabox.min.css', array(), '0.1' );
			wp_register_script( 'jss-category-metabox-js', JSS_URL . 'admin/js/output/jss-category-metabox.min.js', array( 'jquery' ), '0.1' );

			// Enqueue admin scripts.
			wp_enqueue_style( 'jss-category-metabox-css' );
			wp_enqueue_style( 'jss-category-metabox-js' );
		}
	}

	JSS_Primary_Category_Admin::get_instance();
}