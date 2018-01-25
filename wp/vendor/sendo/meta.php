<?php
global $sendo;
global $post;

$backup_ico = get_template_directory_uri() . "/assets/img/favicon-default.ico";
$backup_png = get_template_directory_uri() . "/assets/img/favicon-default.png";

$fav_ico = ( get_field( 'brand_fav_icon_ico', 'options' ) ) ? get_field('brand_fav_icon_ico', 'options') : $backup_ico;
$fav_png = get_field('brand_fav_icon_png', 'options');
$fav_wide_png = get_field('brand_fav_icon_wide_png', 'options');

$fav_default = ($fav_png) ? wp_get_attachment_image_src( $fav_png, 'default-png' ) : $backup_png;
$fav_apple_square_76 = ($fav_png) ? wp_get_attachment_image_src( $fav_png, 'apple-square-76' ) : $backup_png;
$fav_apple_square_144 = ($fav_png) ? wp_get_attachment_image_src( $fav_png, 'apple-square-144' ) : $backup_png;

$fav_default = ( is_array( $fav_default ) ) ? array_shift( $fav_default ) : $fav_default;
$fav_apple_square_76 = ( is_array( $fav_apple_square_76 ) ) ? array_shift( $fav_apple_square_76 ) : $fav_apple_square_76;
$fav_apple_square_144 = ( is_array( $fav_apple_square_144 ) ) ? array_shift( $fav_apple_square_144 ) : $fav_apple_square_144;

printf('<title>%s</title>', $sendo->title);

/* Compatibility */
if (isset($_SERVER['HTTP_X_PJAX']) && $_SERVER['HTTP_X_PJAX'] == 'true') {
	if ($post):
		printf('<link rel="canonical" href="%s">', get_permalink($post->ID));
		printf('<link rel="shortlink" href="%s">', get_permalink($post->ID));
	endif;
} else {
	printf('<meta charset="UTF-8">');
	printf('<meta http-equiv="X-UA-Compatible" content="IE=edge">');
	printf('<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />');
	printf('<meta http-equiv="imagetoolbar" content="no" />');
	printf('<link rel="icon" type="image/x-icon" href="%s">', $fav_ico);
	printf('<link rel="icon" type="image/png" href="%s">', $fav_default);
	printf('<link rel="alternate" type="application/rss+xml" title="%s Feed" href="%s">', get_bloginfo('name'), esc_url(get_feed_link()));
	printf('<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">');
}

/* SEO */
printf('<meta itemprop="name" content="%s">', $sendo->title);
printf('<meta itemprop="image" content="%s">', $sendo->default_image);
printf('<meta name="description" content="%s">', $sendo->description);
printf('<meta name="keywords" content="%s">', implode(', ', $sendo->tags));

foreach ($rss as $key => $val):
	if ($val != false):
		printf('<link rel="%s" type="application/rss+xml" title="%s" href="%s">', $val['rel'], $val['title'], $val['href'] );
	endif;
endforeach;

/* SDO */
foreach ($opengraph as $key => $val):
	if ($val != false):
		printf('<meta property="og:%s" content="%s">', $key, $val);
	endif;
endforeach;

foreach ($facebook as $key => $val):
	if ($val != false):
		printf('<meta property="fb:%s" content="%s">', $key, $val);
	endif;
endforeach;

foreach ($twitter as $key => $val):
	if ($val != false):
		printf('<meta property="twitter:%s" content="%s">', $key, $val);
	endif;
endforeach;

/* Web App Capable Site */
printf('<link rel="manifest" href="/manifest.json">');

if (get_field('sdo_display_banner', 'options') === true && is_page('home')):
	printf('<meta name="apple-itunes-app" content="app-id=%s">', get_field('sdo_apple_appstore_id', 'options'));
endif;

/* Design */
/* Add to homescreen for Safari on iOS */
printf('<meta name="mobile-web-app-capable" content="yes">');
printf('<meta name="apple-mobile-web-app-status-bar-style" content="black">');
printf('<meta name="application-name" content="%s" />', get_bloginfo('name'));
printf('<meta name="apple-mobile-web-app-title" content="%s">', get_bloginfo('name'));
printf('<meta id="theme-color" name="theme-color" content="%s">', the_field('brand_primary_color', 'option'));
printf('<meta name="msapplication-navbutton-color" content="%s" />', the_field('brand_primary_color', 'option'));


// /* IE11 and Windows */
// <meta name="msapplication-TileImage" content="echo $fav_apple_square_144">/* Tile icon for Win8 (144x144 + tile color) */
// <meta name="msapplication-TileColor" content="the_field('brand_primary_color', 'option')">
// <meta name="msapplication-tooltip" content="Start the echo get_bloginfo('name'); app">
// <meta name="msapplication-starturl" content="./">/* Start url when pinned (Desktop) */

// /* Icons */
// <link rel="apple-touch-icon" sizes="57x57" href="echo $fav_apple_square_76;" />
// <link rel="apple-touch-icon" sizes="60x60" href="echo $fav_apple_square_76;" />
// <link rel="apple-touch-icon" sizes="72x72" href="echo $fav_apple_square_76;" />
// <link rel="apple-touch-icon" sizes="76x76" href="echo $fav_apple_square_76;" />
// <link rel="apple-touch-icon" sizes="114x114" href="echo $fav_apple_square_144;" />
// <link rel="apple-touch-icon" sizes="120x120" href="echo $fav_apple_square_144;" />
// <link rel="apple-touch-icon" sizes="144x144" href="echo $fav_apple_square_144;" />
// <link rel="apple-touch-icon" sizes="152x152" href="echo array_shift(wp_get_attachment_image_src($fav_png, 'apple-square-180'));" />
// <link rel="apple-touch-icon" sizes="180x180" href="echo array_shift(wp_get_attachment_image_src($fav_png, 'apple-square-180'));" />

// <link rel="icon" sizes="16x16" href="echo array_shift(wp_get_attachment_image_src($fav_png, 'android-square-32'));" />
// <link rel="icon" sizes="32x32" href="echo array_shift(wp_get_attachment_image_src($fav_png, 'android-square-32'));" />
// <link rel="icon" sizes="96x96" href="echo array_shift(wp_get_attachment_image_src($fav_png, 'android-square-192'));" />
// <link rel="icon" sizes="192x192" href="echo array_shift(wp_get_attachment_image_src($fav_png, 'android-square-192'));" />

// <meta name="msapplication-square70x70logo" content="echo array_shift(wp_get_attachment_image_src($fav_png, 'win-square-270'));" />
// <meta name="msapplication-square150x150logo" content="echo array_shift(wp_get_attachment_image_src($fav_png, 'win-square-270'));" />
// <meta name="msapplication-square310x310logo" content="echo array_shift(wp_get_attachment_image_src($fav_png, 'win-square-558'));" />
