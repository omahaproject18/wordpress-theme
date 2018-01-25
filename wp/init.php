<?php

/**
 * Sets up Google Analytics
 * @return String - the UA set in the admin dashboard
 */
if (function_exists('get_field')) {
	global $wpdb;

	/**
	 * Configuration values
	 */
	$query = 'SELECT `wp_options`.`option_value` FROM `wp_options` ';
	$seo_google_analytics_ua_code_query = $query . 'WHERE `wp_options`.`option_name` = "options_seo_google_analytics_ua_code" ';
	$seo_google_analytics_ua_code = $wpdb->get_var( $seo_google_analytics_ua_code_query );
	define('GOOGLE_ANALYTICS_ID', $seo_google_analytics_ua_code); // UA-XXXXX-Y (Note: Universal Analytics only, not Classic Analytics)
} else {
	define('GOOGLE_ANALYTICS_ID', ''); // UA-XXXXX-Y (Note: Universal Analytics only, not Classic Analytics)
}


/**
 * Add page slug to body_class() classes if it doesn't exist
 * @param  Array $classes array of already added classes
 * @return Array          Array of classes to be added to the DOM
 */
function tech_omaha_body_class($classes) {
	// Add post/page slug
	if (is_single() || is_page() && !is_front_page()) {
		if (!in_array(basename(get_permalink()), $classes)) {
			$classes[] = basename(get_permalink());
		}
	}
	return $classes;
}
add_filter('body_class', 'tech_omaha_body_class');


/**
 * Initialize all of the theme's stuff
 * @return null
 */
function tech_omaha_setup() {
	// Add post thumbnails
	add_theme_support('post-thumbnails');

	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'feed_links_extra', 3 );

	// Remove WP emoji stuff
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
}
add_action('after_setup_theme', 'tech_omaha_setup');
