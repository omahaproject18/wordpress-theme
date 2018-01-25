<?php

/**
 * Helper class to add Custom Post Types
 * @return null
 */
function init_custom_post_types() {
	$post_types = array(
		'videos' => array(
			'slug'			=> 'videos',
			'title'			=> 'Videos',
			'singular'		=> 'Video',
			'plural'		=> 'Videos',
			'menu_icon'		=> 'dashicons-analytics',
			'supports'		=> array( 'title', 'editor', 'excerpt', 'content', 'thumbnail', 'comments', 'revisions', 'permalinks' ),
			'taxonomies'	=> array( 'category', 'post_tag' ),
			'position'		=> 11,
			'has_archive'	=> true
		),
		'meetups' => array(
			'slug'			=> 'meetups',
			'title'			=> 'Meetups',
			'singular'		=> 'Meetup',
			'plural'		=> 'Meetups',
			'menu_icon'		=> 'dashicons-analytics',
			'supports'		=> array( 'title', 'content', 'revisions', 'permalinks' ),
			'taxonomies'	=> array( 'category', 'post_tag' ),
			'position'		=> 12,
			'has_archive'	=> true
		),
		'stories' => array(
			'slug'			=> 'stories',
			'title'			=> 'P18 Stories',
			'singular'		=> 'P18 Story',
			'plural'		=> 'P18 Stories',
			'menu_icon'		=> 'dashicons-analytics',
			'supports'		=> array( 'title', 'content', 'revisions', 'permalinks' ),
			'taxonomies'	=> array( 'category', 'post_tag' ),
			'position'		=> 15,
			'has_archive'	=> true
		),
	);

	foreach ($post_types as $name => $options) {
		$labels = array(
			'name'               => _x( $options['title'], 'post type general name', 'tech_omaha' ),
			'singular_name'      => _x( $options['singular'], 'post type singular name', 'tech_omaha' ),
			'menu_name'          => _x( $options['title'], 'admin menu', 'tech_omaha' ),
			'name_admin_bar'     => _x( $options['singular'], 'add new on admin bar', 'tech_omaha' ),
			'add_new'            => _x( 'Add ' . $options['singular'], $name, 'tech_omaha' ),
			'add_new_item'       => __( 'Add New ' . $options['singular'], 'tech_omaha' ),
			'new_item'           => __( 'New ' . $options['singular'], 'tech_omaha' ),
			'edit_item'          => __( 'Edit ' . $options['singular'], 'tech_omaha' ),
			'view_item'          => __( 'View ' . $options['singular'], 'tech_omaha' ),
			'all_items'          => __( 'All ' . $options['plural'], 'tech_omaha' ),
			'search_items'       => __( 'Search ' . $options['plural'], 'tech_omaha' ),
			'parent_item_colon'  => __( 'Parent ' . $options['plural'], 'tech_omaha' ),
			'not_found'          => __( 'No ' . strtolower($options['plural']) . ' found.', 'tech_omaha' ),
			'not_found_in_trash' => __( 'No ' . strtolower($options['plural']) . ' found in Trash.', 'tech_omaha' )
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => $options['slug'], 'with_front' => true ),
			'capability_type'    => 'post',
			'has_archive'        => $options['has_archive'],
			'hierarchical'       => true,
			'menu_position'      => $options['position'],
			'menu_icon'          => $options['menu_icon'],
			'supports'           => $options['supports'],
			'taxonomies'         => $options['taxonomies'],
		);

		register_post_type( $name, $args );
	}
}
add_action( 'init', 'init_custom_post_types' );
