<?php

/**
 * Start WP-login custom logo
 *
 */
function tech_omaha_login_logo() {
	$color = get_field('brand_site_theme', 'options');

	$image_source = __DIR__ . "/../../assets/images/";
	$image_source .= "horizontal.svg";

	?>
		<div id="svg"><?php echo file_get_contents($image_source); ?></div>
		<script type="text/javascript">
			setTimeout(() => {
				console.log("<?php echo $image_source; ?>");
				var head = document.querySelector('#login h1');
				var svg = document.querySelector('#svg').innerHTML;

				head.innerHTML = svg;
			})
		</script>
		<style type="text/css">
			#svg { display: none; }

			#login h1 {
				color: white;
				fill: white;
				width: 180px;
				margin: auto;
			}

			#login p#nav a,
			#login p#backtoblog a {
				color: white;
			}
		</style>
	<?php
}
add_action( 'login_enqueue_scripts', 'tech_omaha_login_logo' );


/**
 * Stops the settings page name in the dashboard from wrapping in an ugly way
 *
 */
function tech_omaha_custom_css() {
	echo '<style>
		a[href="admin.php?page=theme-general-settings"] .wp-menu-name {
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			padding-right: 10px !important;
		}
	</style>';
}
add_action('admin_head', 'tech_omaha_custom_css');


/**
 * Hide the bar when browsing the site
 *
 */
add_filter('show_admin_bar', '__return_false');
