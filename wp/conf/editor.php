<?php

/**
 * Remove P tag from WordPress img tag in the_content
 *
 */
function filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');
add_filter('acf_the_content', 'filter_ptags_on_images');

/**
 * Add default content to MCE
 *
 */
function tech_omaha_editor_content( $content ) {
	$content = '<h1>Get Started</h1>
	<p>Here&rsquo;s some lead in copy.</p>';
	return $content;
}
add_filter( 'default_content', 'tech_omaha_editor_content' );

/**
 * Remove links on embedded images
 *
 */
function wpb_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );

	if ($image_set !== 'none') {
		update_option('image_default_link_type', 'none');
	}
}
add_action('admin_init', 'wpb_imagelink_setup', 10);

/**
 * Swaps images out with preloading smart images when rendering the HTML
 */
function tech_omaha_swap_all_image_tags($content) {

	// Get all the images and put them into an array, $image_tags
	preg_match_all("/<img[^>]+\>/i", $content, $image_tags, PREG_SET_ORDER);

	$image_ids_in_order = array();

	// Loops though the image tags and prepare the smart image shortcode
	foreach ($image_tags as $image_tag) {
		preg_match_all('/(class)=("[^"]*")/i', $image_tag[0], $this_tags_classes);

		preg_match_all('/(width)=("[^"]*")/i', $image_tag[0], $this_tags_width);
		preg_match_all('/(height)=("[^"]*")/i', $image_tag[0], $this_tags_height);

		$image_id = false;

		$our_classes = [];

		if ($this_tags_classes[0]) {
			$this_tags_classes = substr($this_tags_classes[0][0], 7, -1);

			$our_classes = $this_tags_classes;

			$this_tags_classes = explode(' ', $this_tags_classes);

			foreach($this_tags_classes as $a_class) {

				if (strpos($a_class, 'wp-image-') === 0) {
					preg_match_all('!\d+!', $a_class, 	$id);
					$image_id = (int) $id[0][0];
				}
			}
		}

		if ($image_id !== false) {
			$image_ids_in_order[$image_id] = array(
				'string_to_replace' => $image_tag[0],
				'width' => (int) substr($this_tags_width[2][0], 1, -1),
				'height' => (int) substr($this_tags_height[2][0], 1, -1),
				'classes' => $our_classes
			);
		}
	}

	/* BEGIN caption logic */
	$pattern = get_shortcode_regex();
	preg_match_all('/'. $pattern .'/s', $content, $shortcodes, PREG_SET_ORDER);

	$caption_ids = array();
	foreach ($shortcodes as $shortcode) {
		if (strpos($shortcode[0], 'caption') >= 0) {

			preg_match('/(id)=("[^"]*")/i', $shortcode[0], $this_captions_id);
			if ($this_captions_id && $this_captions_id[0]) {
				preg_match_all('!\d+!', $this_captions_id[0], $id);

				if ( preg_match( '#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $shortcode[0], $matches ) ) {
					$caption_ids[(int) $id[0][0]] = array(
						'caption' => substr(trim( $matches[2] ), 0, -10),
						'string_to_replace' => $shortcode[0]
					);
				}
			}
		}
	}

	foreach ($image_ids_in_order as $key => $image_details) {
		if (!array_key_exists($key, $caption_ids)) {
			$new_image = do_shortcode('[smart_image image_id="' . $key . '" class="' . $image_details['classes'] . '" width="'.$image_details["width"].'" height="'.$image_details["height"].'"][/smart_image]');
			$content = str_replace($image_details["string_to_replace"], $new_image, $content);
		} else {
			$new_image = do_shortcode('[smart_image image_id="' . $key . '" class="' . $image_details['classes'] . '" width="'.$image_details["width"].'" height="'.$image_details["height"].'"]' . $caption_ids[$key]["caption"] . '[/smart_image]');
			$content = str_replace($caption_ids[$key]["string_to_replace"], $new_image, $content);
		}
	}

	return $content;
}
add_filter('the_content','tech_omaha_swap_all_image_tags');
add_filter('acf_the_content','tech_omaha_swap_all_image_tags');
