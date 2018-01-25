<?php
class SENDO {
	/**
	 * Variables and arrays for SEO and SDO
	 *
	 * @var string
	 */
	public $title = "";
	public $description = "";
	public $canonical = "";
	public $default_image = "";
	public $theme_color = "";
	public $tags = Array();
	public $rssfeeds = Array();

	/**
	 * Asset management variables
	 *
	 * @var string
	 */
	public $routeClassOverride = null;
	public $override_output = true;
	public $js = Array();
	public $prepend_captured_js = Array();
	public $append_captured_js = Array();
	public $css = Array();
	public $chrome_shown = true;

	/**
	 * Capture type and/or attributes (used for hinting during capture)
	 *
	 * @var string
	 */
	protected $_capture_lock;
	protected $_capture_script_attrs = null;
	protected $_capture_type;

	/**
	 * Open graph default model for SDO tags
	 *
	 * @var Array
	 */
	public $opengraph = array(
		'site_name' => false,
		'type' => false,
		'locale' => false,
		'title' => false,
		'description' => false,
		'url' => false
	);

	/**
	 * Facebook default model for SDO tags
	 *
	 * @var Array
	 */
	public $facebook = array(
		'app_id' => false
	);

	/**
	 * Twitter default model for SDO cards
	 *
	 * @var Array
	 */
	public $twitter = array(
		'card' => false,
		'creator' => false,
		'site' => false,
		'title' => false,
		'domain' => false,
		'image' => false
	);

	/**
	 * Foursquare default model for SDO tags
	 *
	 * @var Array
	 */
	public $foursquare = array(
		'app_id' => false,
	);

	/**
	 * hide_navigation
	 *
	 * Hides or shows the navigation bar
	 *
	 * @param (type) (name) about this param
	 * @return (type) (name)
	 */
	public function hide_chrome() {
		$this->chrome_shown = false;
		return $this;
	}

	/**
	 * show_navigation
	 *
	 * Hides or shows the navigation bar
	 *
	 * @param (type) (name) about this param
	 * @return (type) (name)
	 */
	public function show_chrome() {
		$this->chrome_shown = true;
		return $this;
	}

	/**
	 * set_twitter_cards
	 *
	 * Appends a twitter card to an array to print out in the layout
	 *
	 * @param (type) (name) about this param
	 * @return (type) (name)
	 */
	public function set_twitter_card($id, $value) {
		$this->twitter[$id] = $value;
		return $this;
	}

	/**
	 * set_facebook_tag
	 *
	 * Appends a facebook card to an array to print out in the layout
	 *
	 * @param (type) (name) about this param
	 * @return (type) (name)
	 */
	public function set_facebook_tag($id, $value) {
		$this->facebook[$id] = $value;
		return $this;
	}

	/**
	 * set_opengraph_tag
	 *
	 * Appends a open graph tag to an array to print out in the layout
	 *
	 * @param (type) (name) about this param
	 * @return (type) (name)
	 */
	public function set_opengraph_tag($id, $value) {
		$this->opengraph[$id] = $value;
		return $this;
	}

	/**
	 * set_description
	 *
	 * set the description to print out in the layout
	 *
	 * @param (type) (name) about this param
	 * @return (type) (name)
	 */
	public function set_description($value) {
		$this->description = $value;
		return $this->set_twitter_card('description', $value)->set_opengraph_tag('description', $value);
	}

	/**
	 * set_title
	 *
	 * set the title to print out in the layout
	 *
	 * @param (type) (name) about this param
	 * @return (type) (name)
	 */
	public function set_title($value) {
		$this->title = $value;
		$this->set_twitter_card('title', $value)->set_opengraph_tag('title', $value);
		return $this;
	}

	/**
	 * set_tags
	 *
	 * set tags to print out in the layout
	 *
	 * @param (type) (name) about this param
	 * @return (type) (name)
	 */
	public function set_tags(Array $value) {
		$this->tags = $value;
		// @TODO: if any OG tags are allowed on any platform, place here.
		return $this;
	}

	/**
	 * set_images
	 *
	 * set images to print out in the layout
	 *
	 * @param (type) (name) about this param
	 * @return (type) (name)
	 */
	public function set_images($value) {
		$this->default_image = $value;
		// @TODO: if any OG tags are allowed on any platform, place here.
		return $this;
	}

	/**
	 * set_theme_color
	 *
	 * set images to print out in the layout
	 *
	 * @param (type) (name) about this param
	 * @return (type) (name)
	 */
	public function set_theme_color($value) {
		$this->theme_color = $value;
		// @TODO: if any OG tags are allowed on any platform, place here.
		return $this;
	}

	/**
	 * set_canonical
	 *
	 * set the canonical links to print out in the layout
	 *
	 * @param (type) (name) about this param
	 * @return (type) (name)
	 */
	public function set_canonical($value) {
		$this->canonical = $value;
		$this->set_twitter_card('url', $value)->set_opengraph_tag('site_url', $value);
		return $this;
	}

	/**
	 * set_rss_feed
	 *
	 * set the rss feed meta to print out in the layout
	 *
	 * @param (type) (name) about this param
	 * @return (type) (name)
	 */
	public function add_rss_feed($title, $href, $rel = "alternate") {
		array_push($this->$rssfeeds, array('title' => $title, 'href' => $href, 'rel' => $rel));
		return $this;
	}

	/**
	 * append_javascript
	 *
	 * set the rss feed meta to print out in the layout
	 *
	 * @param (type) (name) about this param
	 * @return (type) (name)
	 */
	public function append_javascript($src) {
		array_push($this->js, $src);
		return $this;
	}

	/**
	 * prepend_javascript
	 *
	 * set the rss feed meta to print out in the layout
	 *
	 * @param (type) (name) about this param
	 * @return (type) (name)
	 */
	public function prepend_javascript($src) {
		array_unshift($this->js, $src);
		return $this;
	}

	/**
	 * append_css
	 *
	 * append a link to a css file to add to the layout
	 *
	 * @param (type) (name) about this param
	 * @return (type) (name)
	 */
	public function append_css($src) {
		array_push($this->css, $src);
		return $this;
	}

	/**
	 * prepend_css
	 *
	 * prepend a link to a css file to add to the layout
	 *
	 * @param (type) (name) about this param
	 * @return (type) (name)
	 */
	public function prepend_css($src) {
		array_unshift($this->css, $src);
		return $this;
	}

	/**
	 * Start capture action.
	 *
	 * @param  mixed $captureType
	 * @param  string $typeOrAttrs
	 * @return void
	 */
	public function capture_javascript_start($attrs = array()) {
		if ($this->_capture_lock) {
			echo 'Whoops! There&rsquo;s a capture lock on - you can&rsquo;t nest capture_javascript_start functions!'; exit;
		}
		$this->_capture_lock        = true;
		$this->_capture_script_attrs = $attrs;
		ob_start();
	}

	/**
	 * End capture action and store.
	 *
	 * @return void
	 */
	public function capture_javascript_end() {
		$content                        = ob_get_clean();
		$attrs                          = $this->_capture_script_attrs;
		$this->_capture_script_type     = null;
		$this->_capture_script_attrs    = null;
		$this->_capture_lock            = false;
		if ((!array_key_exists('position', $attrs )) || (array_key_exists('position', $attrs ) && $attrs['position'] === 'append')) {
			array_push($this->append_captured_js, $content);
		} elseif (array_key_exists('position', $attrs ) && $attrs['position'] === 'prepend') {
			array_push($this->prepend_captured_js, $content);
		}
		return $this;
	}

	/**
	 * Page Title Treatment
	 *
	 * @return void
	 */
	public function page_title_treatment($iv) {

		$iv = str_replace('{title}', get_the_title(), $iv);
		$iv = str_replace('{site_name}', get_bloginfo('name'), $iv);
		$iv = str_replace('{site_title}', get_bloginfo('name'), $iv);

		return $iv;
	}

	/**
	 * Initialize the application with a few updates.
	 *
	 * @return void
	 */
	public function init(Array $iv) {
		foreach ($iv as $key => $value) {
			if ($key == 'description') {
				$this->set_description($value);
			}
			elseif ($key == 'title') {
				$this->set_title($value);
			}
			elseif ($key == 'url') {
				$this->set_canonical($value);
			}
			elseif ($key == 'tags') {
				$this->set_tags($value);
			}
			elseif ($key == 'image') {
				$this->set_images($value);
			}
			elseif ($key == 'color') {
				$this->set_theme_color($value);
			}
		}
		return $this;
	}

	/**
	 * Output all stored data
	 *
	 * @return void
	 */
	public function prepare_output() {
		$shareable_image =  (get_field('sdo_fallback_image')) ? get_field('sdo_fallback_image') : get_field('sdo_fallback_image', 'option');
		$twitter_card = (get_field('sdo_twitter_card') && get_field('sdo_twitter_card') !== 'none') ? get_field('sdo_twitter_card') : get_field('sdo_twitter_card', 'option');
		$creator = (get_field('sdo_twitter_card_creator')) ? get_field('sdo_twitter_card_creator') : get_field('sdo_twitter_card_creator', 'option');


		/* TWITTER LOGIC */
		if ($twitter_card !== 'none') {
			$this->set_twitter_card('card', $twitter_card)
				 ->set_twitter_card('title', sendo()->title)
				 ->set_twitter_card('site', get_field('sdo_twitter_card_site', 'option'))
				 ->set_twitter_card('description', sendo()->description )
				 ->set_twitter_card('url', get_the_permalink() )
				 ->set_twitter_card('creator', $creator)
				 ->set_twitter_card('image', $shareable_image);


			if ( $twitter_card === 'summary_large_image' || $twitter_card === 'summary' || $twitter_card === 'photo') {
				$this->set_twitter_card('image', $shareable_image);
			}

			if ( $twitter_card === 'gallery' ) {
				$gallery = (get_field('sdo_twitter_card_gallery')) ? get_field('sdo_twitter_card_gallery') : get_field('sdo_twitter_card_gallery', 'option');

				$i = 0;
				foreach($gallery as $image) {
					$this->set_twitter_card('image'.$i++, $image['image']);
				}
			}

			if ( $twitter_card === 'app' ) {
				$app_country = (get_field('sdo_twitter_card_app_country')) ? get_field('sdo_twitter_card_app_country') : get_field('sdo_twitter_card_app_country', 'option');

				$this->set_twitter_card('image', $shareable_image);

				$this->set_twitter_card( 'app:country', $app_country );

				$all_app_details = (get_field('sdo_twitter_card_app_details')) ? get_field('sdo_twitter_card_app_details') : get_field('sdo_twitter_card_app_details', 'option');

				foreach($all_app_details as $app_details) {
					$this->set_twitter_card('app:name:' . $app_details['platform'], $app_details['app_name'] );
					$this->set_twitter_card('app:id:' . $app_details['platform'], $app_details['app_id'] );
					$this->set_twitter_card('app:url:' . $app_details['platform'], $app_details['app_url'] );
				}
			}

			if ( $twitter_card === 'player' ) {
				$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

				$all_video_details = (get_field('sdo_twitter_card_app_video')) ? get_field('sdo_twitter_card_app_video') : get_field('sdo_twitter_card_app_video', 'option');

				$this->set_twitter_card('image', $shareable_image);

				foreach($all_video_details as $video_details) {
					$this->set_twitter_card('player', $protocol.$_SERVER['SERVER_NAME'].'/twitter_video_player?video='.$video_details['player_stream']['id']);
					$this->set_twitter_card('player:width', $video_details['player_stream']['width']);
					$this->set_twitter_card('player:height', $video_details['player_stream']['height']);
					$this->set_twitter_card('player:stream', $video_details['player_stream']['url']);
					$this->set_twitter_card('player:stream:content_type', $video_details['player_stream']['mime_type']);
				}
			}

			if ( $twitter_card === 'product' ) {
				$all_product_details = (get_field('sdo_twitter_card_labels_and_data')) ? get_field('sdo_twitter_card_labels_and_data') : get_field('sdo_twitter_card_labels_and_data', 'option');

				$this->set_twitter_card('image', $shareable_image);

				$i = 0;
				foreach($all_product_details as $product_details) {
					$this->set_twitter_card('label'.$i, $product_details['label']);
					$this->set_twitter_card('data'.$i++, $product_details['data']);
				}
			}
		}
	}

	/**
	 * Output all stored data
	 *
	 * @return void
	 */
	public function override_the_output() {
		$this->override_output = false;
	}

	/**
	 * Output all stored data
	 *
	 * @return void
	 */
	public function output($type) {
		if ($this->override_output) {
			$this->prepare_output();
		}

		if ($type === 'meta') {
			$opengraph = $this->opengraph;
			$facebook = $this->facebook;
			$twitter = $this->twitter;
			$foursquare = $this->foursquare;
			$title = $this->title;
			$description = $this->description;
			$canonical = $this->canonical;
			$tags = $this->tags;
			$rss = $this->rssfeeds;
			include __DIR__ . '/../vendor/sendo/meta.php';
		}

		elseif ($type === 'scripts') {
			$js = $this->js;
			include __DIR__ . '/../vendor/sendo/scripts.php';
		}

		elseif ($type === 'style') {
			$css = $this->css;
			include __DIR__ . '/../vendor/sendo/style.php';
		}

		elseif ($type === 'bodyclass') {
			return ($this->routeClassOverride) ? $this->routeClassOverride : $this->route_class();
		}

		elseif ($type === 'prepend_captured_scripts') {
			$prepend_captured_js = $this->prepend_captured_js;

			foreach ($prepend_captured_js as $val) {

				if ($val != false) {
					echo $val;
				}
			}
		}

		elseif ($type === 'append_captured_scripts') {
			$append_captured_js = $this->append_captured_js;

			foreach ($append_captured_js as $val) {

				if ($val != false) {
					echo $val;
				}
			}
		}
	}
}


/**
 * Helper function to call this instance.
 * @return [type] [description]
 */
function sendo() {
	global $sendo;
	return $sendo;
}
