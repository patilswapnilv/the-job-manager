## The Job Manager

This is meant to be used a custom post type boilerplate plugin- though it does work fine out of the box as a jobs post type.

### Description

This plugin includes a couple common features that are used with custom post types:

* Registers a post type
* Registers a custom taxonomy
* Registers a few metaboxes (Title, Twitter, Facebook, LinkedIn)
* Adds the featured image to the admin column display
* Adds the post count to the admin dashboard

### Customization

There are a couple filters for the post type and taxonomy arguments in this plugin, but the code is actually meant to be modified directly.

If you want to change this post type from "jobs" to something different ("products","resources",etc.) you'll want to update a couple file and class names throughout the plugin- but the main modifications will be in the "class-post-type-registrations.php" file.  This is where the post type and taxonomy are registered.

For information on all the available arguments, [read the codex for register_post_type](http://codex.wordpress.org/Function_Reference/register_post_type).

For example, if you were switching the post type from "Jobs" to "products", you would want to alter this code.

#### Registration for "Jobs"

~~~PHP
$labels = array(
	'name'               => __( 'Jobs', 'the-job-manager' ),
	'singular_name'      => __( 'Job', 'the-job-manager' ),
	'add_new'            => __( 'Add Jobs', 'the-job-manager' ),
	'add_new_item'       => __( 'Add Jobs', 'the-job-manager' ),
	'edit_item'          => __( 'Edit Jobs', 'the-job-manager' ),
	'new_item'           => __( 'New Jobs Member', 'the-job-manager' ),
	'view_item'          => __( 'View Jobs', 'the-job-manager' ),
	'search_items'       => __( 'Search Jobs', 'the-job-manager' ),
	'not_found'          => __( 'No jobs found', 'the-job-manager' ),
	'not_found_in_trash' => __( 'No jobs in the trash', 'the-job-manager' ),
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
~~~

#### Registration for "Jobs"

~~~PHP
$labels = array(
	'name'               => __( 'Jobs', 'jobs-post-type' ),
	'singular_name'      => __( 'Job', 'jobs-post-type' ),
	'add_new'            => __( 'Add Job', 'jobs-post-type' ),
	'add_new_item'       => __( 'Add Job', 'jobs-post-type' ),
	'edit_item'          => __( 'Edit Job', 'jobs-post-type' ),
	'new_item'           => __( 'New Job', 'jobs-post-type' ),
	'view_item'          => __( 'View Job', 'jobs-post-type' ),
	'search_items'       => __( 'Search Job', 'jobs-post-type' ),
	'not_found'          => __( 'No Job found', 'jobs-post-type' ),
	'not_found_in_trash' => __( 'No Job in the trash', 'jobs-post-type' ),
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
	'rewrite'         => array( 'slug' => 'product', ), // Permalinks format
	'menu_position'   => 30,
	'menu_icon'       => 'dashicons-cart',
);
~~~

To find different icons to use ("menu_icon" parameter) see the [dashicons page](http://melchoyce.github.io/dashicons/).

### Requirements

* WordPress 3.8 or higher

