<?php
/**
 * Split Infinities theme includes. Serves as the entry point.
 *
 * Please note that missing files *will* produce a fatal error.
 */

$mandatory_includes = [
	'wp/init.php',                    // Initial theme setup and constants
	'wp/init/plugins.php',            // Plugin mandatory plugins
	'wp/init/routes.php',             // Reroute pages or archives
	'wp/init/activation.php',         // Theme activation
	'wp/init/assets.php',             // Scripts and stylesheets
	'wp/conf/navigation.php',         // Initiates navigation
	'wp/conf/post_types.php',         // Initiates custom post types
	'wp/conf/post_taxonomies.php',    // Initiates taxonomies
	'wp/conf/post_acf.php',           // Initiates default ACF fields
	'wp/conf/shortcodes.php',         // Contains shortcodes
	'wp/conf/images.php',             // Functions for images and custom sizes
	'wp/conf/admin.php',              // Admin config
	'wp/conf/editor.php',             // Configuration settings for the Editor/TinyMCE
	'wp/helpers.php',                 // Helper functions
];

$features_append = [
	'wp/init/carbon.php',             // Provides simple ways of dealing with time.
	'wp/init/htmlcompression.php',    // includes the HTML compression class
	'wp/init/sendo.php',              // SENDO
	'wp/init/wrapper.php',            // Theme wrapper class
];

$includes = array_merge($mandatory_includes, $features_append);

foreach ($includes as $file) {
	if (!$filepath = locate_template($file)) {
		trigger_error(sprintf(__('Error locating %s for inclusion', 'SPLITINFINITIES'), $file), E_USER_ERROR);
	}

	require_once $filepath;
}

unset($file, $filepath);

// Initialize SENDO
if (class_exists('SENDO')) {
	$sendo = new SENDO();
}
