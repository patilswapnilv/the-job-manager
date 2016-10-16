<?php
/**
 * The Job Manager
 *
 * @package   The Job Manager
 * @license   GPL-2.0+
 */

/**
 * Register post types and taxonomies.
 *
 * @package The Job Manager
 */
class The_Job_Manager_Registrations {

	public $post_type = 'jobs';

	public $taxonomies = array( 'job-category' );

	public function init() {
		// Add the investment post type and taxonomies
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses The_Job_Manager_Registrations::register_post_type()
	 * @uses The_Job_Manager_Registrations::register_taxonomy_category()
	 */
	public function register() {
		$this->register_post_type();
		$this->register_taxonomy_category();
	}

	/**
	 * Register the custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	protected function register_post_type() {
		$labels = array(
			'name'               => __( 'Jobs', 'the-job-manager' ),
			'singular_name'      => __( 'Job', 'the-job-manager' ),
			'add_new'            => __( 'Add Jobs', 'the-job-manager' ),
			'add_new_item'       => __( 'Add Jobs', 'the-job-manager' ),
			'edit_item'          => __( 'Edit Investment', 'the-job-manager' ),
			'new_item'           => __( 'New Investment Member', 'the-job-manager' ),
			'view_item'          => __( 'View Investment', 'the-job-manager' ),
			'search_items'       => __( 'Search Investment', 'the-job-manager' ),
			'not_found'          => __( 'No investments found', 'the-job-manager' ),
			'not_found_in_trash' => __( 'No investments in the trash', 'the-job-manager' ),
		);

		$supports = array(
			'title',
			'editor',
			'thumbnail',
			'custom-fields',
			'revisions',
		);

		$args = array(
			'labels'          => $labels,
			'supports'        => $supports,
			'public'          => true,
			'capability_type' => 'post',
			'rewrite'         => array( 'slug' => 'jobs', ), // Permalinks format
			'menu_position'   => 30,
			'menu_icon'       => 'dashicons-id',
		);

		$args = apply_filters( 'the_job_manager_args', $args );

		register_post_type( $this->post_type, $args );
	}

	/**
	 * Register a taxonomy for The Job Manager Categories.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_taxonomy_category() {
		$labels = array(
			'name'                       => __( 'Job Categories', 'the-job-manager' ),
			'singular_name'              => __( 'Job Category', 'the-job-manager' ),
			'menu_name'                  => __( 'Job Categories', 'the-job-manager' ),
			'edit_item'                  => __( 'Edit Job Category', 'the-job-manager' ),
			'update_item'                => __( 'Update Job Category', 'the-job-manager' ),
			'add_new_item'               => __( 'Add New Job Category', 'the-job-manager' ),
			'new_item_name'              => __( 'New Job Category Name', 'the-job-manager' ),
			'parent_item'                => __( 'Parent Job Category', 'the-job-manager' ),
			'parent_item_colon'          => __( 'Parent Job Category:', 'the-job-manager' ),
			'all_items'                  => __( 'All Job Categories', 'the-job-manager' ),
			'search_items'               => __( 'Search Job Categories', 'the-job-manager' ),
			'popular_items'              => __( 'Popular Job Categories', 'the-job-manager' ),
			'separate_items_with_commas' => __( 'Separate Job categories with commas', 'the-job-manager' ),
			'add_or_remove_items'        => __( 'Add or remove job categories', 'the-job-manager' ),
			'choose_from_most_used'      => __( 'Choose from the most used job categories', 'the-job-manager' ),
			'not_found'                  => __( 'No job categories found.', 'the-job-manager' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'job-category' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'the-job-manager_category_args', $args );

		register_taxonomy( $this->taxonomies[0], $this->post_type, $args );
	}
}
