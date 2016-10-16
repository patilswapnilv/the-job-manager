<?php
/**
 * The Job Manager
 *
 * @package   The Job Manager
 * @license   GPL-2.0+
 */

/**
 * Register metaboxes.
 *
 * @package The Job Manager
 */
class The_Job_Manager_Metaboxes {

	public function init() {
		add_action( 'add_meta_boxes', array( $this, 'the_job_manager_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ),  10, 2 );
	}

	/**
	 * Register the metaboxes to be used for the investment post type
	 *
	 * @since 0.1.0
	 */
	public function the_job_manager_meta_boxes() {
		add_meta_box(
			'the_job_manager_fields',
			'The Job Manager Fields',
			array( $this, 'render_meta_boxes' ),
			'jobs',
			'normal',
			'high'
		);
	}

   /**
	* The HTML for the fields
	*
	* @since 0.1.0
	*/
	function render_meta_boxes( $post ) {

		$meta = get_post_custom( $post->ID );
		$title = ! isset( $meta['the_job_manager_title'][0] ) ? '' : $meta['the_job_manager_title'][0];
		$twitter = ! isset( $meta['the_job_manager_twitter'][0] ) ? '' : $meta['the_job_manager_twitter'][0];
		$linkedin = ! isset( $meta['the_job_manager_linkedin'][0] ) ? '' : $meta['the_job_manager_linkedin'][0];
		$facebook = ! isset( $meta['the_job_manager_facebook'][0] ) ? '' : $meta['the_job_manager_facebook'][0];
		$url=! isset($meta['the_job_manager_company_url'][0] )? '' : $meta['the_job_manager_url'][0];

		wp_nonce_field( basename( __FILE__ ), 'the_job_manager_fields' ); ?>

		<table class="form-table">

			<tr>
				<td class="the_job_manager_meta_box_td" colspan="2">
					<label for="the_job_manager_title"><?php _e( 'Title', 'the_job_manager' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="the_job_manager_title" class="regular-text" value="<?php echo $title; ?>">
					<p class="description"><?php _e( 'E.g. CEO, Sales Lead, Designer', 'the_job_manager' ); ?></p>
				</td>
			</tr>

			<tr>
				<td class="the_job_manager_meta_box_td" colspan="2">
					<label for="the_job_manager_url"><?php _e( 'The Job Manager URL', 'the_job_manager' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="the_job_manager_url" class="regular-text" value="<?php echo $facebook; ?>">
				</td>
			</tr>

			<tr>
				<td class="the_job_manager_meta_box_td" colspan="2">
					<label for="the_job_manager_linkedin"><?php _e( 'LinkedIn URL', 'the_job_manager' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="the_job_manager_linkedin" class="regular-text" value="<?php echo $linkedin; ?>">
				</td>
			</tr>

			<tr>
				<td class="the_job_manager_meta_box_td" colspan="2">
					<label for="the_job_manager_twitter"><?php _e( 'Twitter URL', 'the_job_manager' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="the_job_manager_twitter" class="regular-text" value="<?php echo $twitter; ?>">
				</td>
			</tr>

			<tr>
				<td class="the_job_manager_meta_box_td" colspan="2">
					<label for="the_job_manager_facebook"><?php _e( 'Facebook URL', 'the_job_manager' ); ?>
					</label>
				</td>
				<td colspan="4">
					<input type="text" name="the_job_manager_facebook" class="regular-text" value="<?php echo $facebook; ?>">
				</td>
			</tr>

		</table>

	<?php }

   /**
	* Save metaboxes
	*
	* @since 0.1.0
	*/
	function save_meta_boxes( $post_id ) {

		global $post;

		// Verify nonce
		if ( !isset( $_POST['the_job_manager_fields'] ) || !wp_verify_nonce( $_POST['the_job_manager_fields'], basename(__FILE__) ) ) {
			return $post_id;
		}

		// Check Autosave
		if ( (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || ( defined('DOING_AJAX') && DOING_AJAX) || isset($_REQUEST['bulk_edit']) ) {
			return $post_id;
		}

		// Don't save if only a revision
		if ( isset( $post->post_type ) && $post->post_type == 'revision' ) {
			return $post_id;
		}

		// Check permissions
		if ( !current_user_can( 'edit_post', $post->ID ) ) {
			return $post_id;
		}

		$meta['the_job_manager_title'] = ( isset( $_POST['the_job_manager_title'] ) ? esc_textarea( $_POST['the_job_manager_title'] ) : '' );

		$meta['the_job_manager_linkedin'] = ( isset( $_POST['the_job_manager_linkedin'] ) ? esc_url( $_POST['the_job_manager_linkedin'] ) : '' );

		$meta['the_job_manager_twitter'] = ( isset( $_POST['the_job_manager_twitter'] ) ? esc_url( $_POST['the_job_manager_twitter'] ) : '' );

		$meta['the_job_manager_facebook'] = ( isset( $_POST['the_job_manager_facebook'] ) ? esc_url( $_POST['the_job_manager_facebook'] ) : '' );

		foreach ( $meta as $key => $value ) {
			update_post_meta( $post->ID, $key, $value );
		}
	}

}
