<?php
/**
 * Register Custom Post Type Project
 *
 * @package utpt
 */

/**
 * Post Type Key: project
 */
function create_project_cpt() {
	$labels = array(
		'name'                  => __( 'Projects', 'Post Type General Name' ),
		'singular_name'         => __( 'Project', 'Post Type Singular Name' ),
		'menu_name'             => __( 'Projects', 'utpt' ),
		'name_admin_bar'        => __( 'Project', 'utpt' ),
		'archives'              => __( 'Project Archives', 'utpt' ),
		'attributes'            => __( 'Project Attributes', 'utpt' ),
		'parent_item_colon'     => __( 'Parent Project:', 'utpt' ),
		'all_items'             => __( 'All Projects', 'utpt' ),
		'add_new_item'          => __( 'Add New Project', 'utpt' ),
		'add_new'               => __( 'Add New', 'utpt' ),
		'new_item'              => __( 'New Project', 'utpt' ),
		'edit_item'             => __( 'Edit Project', 'utpt' ),
		'update_item'           => __( 'Update Project', 'utpt' ),
		'view_item'             => __( 'View Project', 'utpt' ),
		'view_items'            => __( 'View Projects', 'utpt' ),
		'search_items'          => __( 'Search Project', 'utpt' ),
		'not_found'             => __( 'Not found', 'utpt' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'utpt' ),
		'featured_image'        => __( 'Featured Image', 'utpt' ),
		'set_featured_image'    => __( 'Set featured image', 'utpt' ),
		'remove_featured_image' => __( 'Remove featured image', 'utpt' ),
		'use_featured_image'    => __( 'Use as featured image', 'utpt' ),
		'insert_into_item'      => __( 'Insert into Project', 'utpt' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Project', 'utpt' ),
		'items_list'            => __( 'Projects list', 'utpt' ),
		'items_list_navigation' => __( 'Projects list navigation', 'utpt' ),
		'filter_items_list'     => __( 'Filter Projects list', 'utpt' ),
	);
	$args   = array(
		'label'               => __( 'Project', 'utpt' ),
		'description'         => __( 'Photography Portfolio Projects', 'utpt' ),
		'labels'              => $labels,
		'menu_icon'           => 'dashicons-portfolio',
		'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'author', 'post-formats', 'custom-fields' ),
		'taxonomies'          => array( 'category' ),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => false,
		'hierarchical'        => true,
		'exclude_from_search' => false,
		'show_in_rest'        => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'projects', $args );
}
add_action( 'init', 'create_project_cpt', 0 );

