<?php

add_theme_support( 'post-thumbnails', array('post') );

/*
 * Our theme has a better way of loading images
 */
function disable_srcset( $sources ) {
	return false;
}
add_filter( 'wp_calculate_image_srcset', 'disable_srcset' );

/*
 * Initialize all the images for the theme
 */
function our_images_setup() {
	add_image_size( 'apple-square-76', 76 );
	add_image_size( 'apple-square-144', 144 );
	add_image_size( 'apple-square-180', 180 );

	add_image_size( 'android-square-32', 32 );
	add_image_size( 'android-square-192', 192 );

	add_image_size( 'win-square-270', 270 );
	add_image_size( 'win-square-558', 558 );

	// For Small Hero Images
	add_image_size( 'small-hero-png', 640 );

	// For Medium Hero Images
	add_image_size( 'medium-hero-png', 1024 );

	// For Large Hero Images
	add_image_size( 'large-hero-png', 1200 );

	// For default Hero Images
	add_image_size( 'hero-png', 1600 );
}
add_action( 'after_setup_theme', 'our_images_setup' );

/*
 * Attach pretty names to upload sizes
 */
function tech_omaha_custom_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'hero-png' => 'Large Image (1600 x 800)',
		'large-hero-png' => 'Large Image (1200 x 600)',
		'medium-hero-png' => 'Medium Image (1024 x 512)',
		'small-hero-png' => 'Small Image (640 x 320)',
	) );
}
add_filter( 'image_size_names_choose', 'tech_omaha_custom_sizes' );

/*
 * Allow SVG's to be uploaded as images
 */
function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/*
 * Displays SVG's in the media grid
 */
function custom_admin_head() {
	$css = '';
	$css = 'td.media-icon img[src$=".svg"] { width: 100% !important; height: auto !important; }';
	echo '<style type="text/css">'.$css.'</style>';
}
add_action('admin_head', 'custom_admin_head');
