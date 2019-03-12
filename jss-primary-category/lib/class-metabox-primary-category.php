<?php
/**
 * Primary Category Metabox
 *
 * @package JSS_Primary_Category
 */

class JSS_Primary_Category_Metabox {

	/**
	 * Post ID of term
	 *
	 * @var
	 */
	protected $post_id;

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
		$value      = $this->get_primary_category( $admin->get_current_id() );

		wp_nonce_field( 'save_primary_category', 'primary-category-dropdown-nonce' );

		?>
		<label for="jss-primary-category-field">Select a Primary Category</label>
		<br>
		<?php $this->set_primary_category( $admin->get_current_id() ); ?>
		<select name="jss-primary-category-field" id="wporg_field" class="postbox">
			<option value="">Select</option>
			<?php
			foreach ( $categories as $category ) {
				$slug = 'option-' . esc_html( $category->slug );
				echo '<option value="' . esc_html( $slug ) . '" ' . selected( $slug, $value ) . '>' . esc_html( $category->cat_name ) . '</option>';
			}
			?>
		</select>
		<?php
	}

	/**
	 *  Run save_primary_category function
	 *
	 * @return function save_primary_category
	 */
	public function do_save_primary_category() {
		$admin   = new JSS_Primary_Category_Admin();
		$post_id = $admin->get_current_id();

		return $this->save_primary_category( $post_id );
	}

	/**
	 * Save custom post meta
	 *
	 * @param $post_id
	 */
	private function save_primary_category( $post_id ) {
		// check submission.
		if ( ! isset( $_POST['jss-primary-category-field'] ) ) {
			return;
		}

		// verify nonce.
		if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['primary-category-dropdown-nonce'] ) ), 'save_primary_category' ) ) {
			return;
		}

		// verify user can edit.
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

		$old_meta = get_post_meta( $post_id, 'jss-primary-category', true );
		$new_meta = sanitize_text_field( wp_unslash( $_POST['jss-primary-category-field'] ) );

		if ( $new_meta && $new_meta !== $old_meta ) {
			update_post_meta( $post_id, 'jss-primary-category', $new_meta );
		} elseif ( '' === $new_meta && $old_meta ) {
			delete_post_meta( $post_id, 'jss-primary-category', $old_meta );
		}
	}

	/**
	 * Get custom post meta of primary-category
	 *
	 * @param $post_id
	 *
	 * @return mixed
	 */
	public function get_primary_category( $post_id ) {
		$value = get_post_meta( $post_id, 'jss-primary-category', true );

		return $value;
	}
}

new JSS_Primary_Category_Metabox();