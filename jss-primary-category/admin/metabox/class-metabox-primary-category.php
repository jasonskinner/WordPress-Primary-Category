<?php
/**
 * Primary Category Metabox
 *
 * @package JSS_Primary_Category
 */

class JSS_Primary_Category_Metabox extends JSS_Primary_Category_Admin {

	/**
	 * JSS_Primary_Category_Metabox constructor.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_primary_category_metabox' ) );
	}


	/**
	 * Add Primary Category Metabox
	 *
	 * @return void
	 */
	public function add_primary_category_metabox() {
		if ( ! JSS_Primary_Category_Admin::is_post() ) {
			return;
		}

		add_meta_box(
			'jss_primary_category',
			'Primary Category',
			array( $this, 'custom_metabox_html' ),
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
	public function custom_metabox_html( $post ) {
		?>
		<label for="wporg_field">Select a Primary Category</label>
		<br>
		<select name="wporg_field" id="wporg_field" class="postbox">
			<option value="">Select something...</option>
			<option value="something">Something</option>
			<option value="else">Else</option>
		</select>
		<?php
	}

	/**
	 * Render metabox with nonce
	 *
	 * @param $post
	 */
	public function render_metabox( $post ) {
		wp_nonce_field( 'custom_nonce_action', 'custom_nonce' );
	}



}

new JSS_Primary_Category_Metabox();