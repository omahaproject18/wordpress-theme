<?php

/**
 * Helper function to create custom taxonomies
 * @return null
 */
function init_taxonomies() {
	// You can edit these options here
	$taxonomies = array(
		// 'taxonomy_name' => array(
		// 	'slug'			=> 'taxonomy_name',
		// 	'hierarchical'	=> true, // true is like categories, false is like tags
		// 	'singular'		=> 'Taxonomy',
		// 	'plural'		=> 'Taxonomies',
		// 	'attached_to'	=> array( 'custom_posts' )
		// ),
	);

	// The post types are added here.
	foreach ($taxonomies as $name => $options) {
		$labels = array(
			'name'              => _x( $options['plural'], 'taxonomy general name' ),
			'singular_name'     => _x( $options['singular'], 'taxonomy singular name' ),
			'search_items'      => __( 'Search ' . $options['plural'] ),
			'all_items'         => __( 'All ' . $options['plural'] ),
			'parent_item'       => __( 'Parent ' . $options['singular'] ),
			'parent_item_colon' => __( 'Parent ' . $options['singular'].':' ),
			'edit_item'         => __( 'Edit ' . $options['singular'] ),
			'update_item'       => __( 'Update ' . $options['singular'] ),
			'add_new_item'      => __( 'Add New ' . $options['singular'] ),
			'new_item_name'     => __( 'New ' . $options['singular'] . ' Name' ),
			'menu_name'         => __( $options['plural'] ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => $options['slug'], 'with_front' => false ),
		);

		if (!$options['hierarchical']) {
			$args['hierarchical'] = $options['hierarchical'];
			$args['update_count_callback'] = '_update_post_term_count';
			$labels['popular_items'] = __( 'Popular '. $options['singular'] );
			$labels['parent_item'] = null;
			$labels['parent_item_colon'] = null;
			$labels['separate_items_with_commas'] = __( 'Separate ' . $options['plural'] . ' with commas' );
			$labels['add_or_remove_items'] = __( 'Add or remove ' . $options['plural'] );
			$labels['choose_from_most_used'] = __( 'Choose from the most used ' . $options['plural'] );
			$labels['not_found'] = __( 'No ' . $options['plural'] . ' found.' );
			$args['labels'] = $labels;
		}

		register_taxonomy( $name, $options['attached_to'], $args );
	}
}
add_action( 'init', 'init_taxonomies', 0 );
