<?php

/**
 * Scripts and stylesheets
 *
 * Enqueue stylesheets in the following order:
 * 1. /theme/assets/css/main.css
 *
 * @return null
 */
function prepare_scripts() {
	$assets_basepath = '/assets';
	$styles_subdir = '/styles';
	$scripts_subdir = '/scripts';

	$base_assets = array(
		'app.js' => get_template_directory_uri() . $assets_basepath . '/dist/techomaha.js',
	);

	// Embed resources that we need
	enqueue_load($base_assets);
}
add_action('wp_enqueue_scripts', 'prepare_scripts', 100);
/**
 * Loads the scripts we need on first page load
 * @param  Array $assets Array of script uri's
 * @return null
 */
function enqueue_load($assets) {
	// Embed all resources
	$css_files = sendo()->css;

	foreach ($css_files as $css) {
		wp_enqueue_style('tech_omaha_' . basename($css, '.css'), $css, false, null);
	}

	/**
	 * jQuery is loaded using the same method from HTML5 Boilerplate:
	 * Grab Google CDN's latest jQuery with a protocol relative URL; fallback to local if offline
	 * It's kept in the header instead of footer to avoid conflicts with plugins.
	 */
	if (!is_admin()) {
		wp_deregister_script('jquery');
	}

	wp_enqueue_script('app.js', $assets['app.js'], array(), null, true);

}
