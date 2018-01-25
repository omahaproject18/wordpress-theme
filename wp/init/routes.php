<?php
/**
 * Makes WordPress routing aware of custom variables
 * @return void
 */
function custom_rewrite_tag() {
	// add_rewrite_tag('%my_custom_category%', '([^&]+)');
	// add_rewrite_tag('%my_custom_paged%', '([^&]+)');
}
add_action('init', 'custom_rewrite_tag', 10, 0);


/**
 * Rewrites the routes based on regex, used for pretty url rewrites.
 * @return void
 */
function tech_omaha_route_rewrites() {
	// add_rewrite_rule("^about/([^/]*)/posts/feed/(feed|rdf|rss|rss2|atom)/?$",'index.php?author_name=$matches[1]&feed=$matches[2]','top');
	// add_rewrite_rule("^about/([^/]*)/posts/(feed|rdf|rss|rss2|atom)/?$",'index.php?author_name=$matches[1]&feed=$matches[2]','top');
	// add_rewrite_rule("^about/([^/]*)/posts/?$",'index.php?author_name=$matches[1]&paged=$matches[2]','top');
	// add_rewrite_rule("^about/([^/]*)/posts",'index.php?author_name=$matches[1]','top');
}
add_action('init', 'tech_omaha_route_rewrites', 10, 0);


// Also where we will add more API's to the routes
