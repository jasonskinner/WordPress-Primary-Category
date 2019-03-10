<?php
/**
 * Primary Category Metabox
 *
 * @package JSS_Primary_Category
 */

class JSS_Primary_Category_Metabox {

	/**
	 * JSS_Primary_Category_Metabox constructor.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_primary_category_metabox' ) );
		add_action( 'save_post', array( $this, 'do_save_primary_category' ) );
	}


	/**
	 * Add Primary Category Metabox
	 *
	 * @return void
	 */
	public function add_primary_category_metabox() {
		$category_admin = new JSS_Primary_Category_Admin();
		if ( ! $category_admin->is_post() ) {
			return;
		}

		add_meta_box(
			'jss_primary_category',
			'Primary Category',
			array( $this, 'add_primary_category_metabox_html' ),
			null,
			'side',
			'high',
			null

		);
	}

	/**
	 * Primary Category Metabox HTML
	 *
	 * @param $post
	 */
	public function add_primary_category_metabox_html( $post ) {
		$admin      = new JSS_Primary_Category_Admin();
		$categories = $admin->get_term_object( $post->ID );

		wp_nonce_field( 'save_primary_category', 'primary-category-dropdown-nonce' );
		?>
		<label for="jss-primary-category-field">Select a Primary Category</label>
		<br>
		<select name="jss-primary-category-field" id="wporg_field" class="postbox">

			<option value="">Select</option>
			<?php
			foreach ( $categories as $category ) {
				echo '<option value=option-' . $category->slug . '>' . $category->cat_name . '</option>';
			}
			?>
		</select>
		<?php
	}

	public function do_save_primary_category( $post_id ) {
		return $this->save_primary_category( $post_id );
	}

	
}

new JSS_Primary_Category_Metabox();