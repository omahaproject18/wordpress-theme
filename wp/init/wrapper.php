<?php

namespace SPLITINFINITIES\Wrapper;

/**
 * Theme wrapper
 *
 * @link https://roots.io/sage/docs/theme-wrapper/
 * @link http://scribu.net/wordpress/theme-wrappers.html
 */

function template_path() {
	return SPLITINFINITIES_Wrapping::$main_partial;
}

class SPLITINFINITIES_Wrapping {
	// Stores the full path to the main partial file
	public static $main_partial;

	// Basename of partial file
	public $slug;

	// Array of partials
	public $partials;

	// Stores the base name of the partial file; e.g. 'page' for 'page.php' etc.
	public static $base;

	public function __construct($partial = 'base.php') {
		$this->slug = basename($partial, '.php');
		$this->partials = [$partial];

		if (self::$base) {
			$str = substr($partial, 0, -4);
			array_unshift($this->partials, sprintf($str . '-%s.php', self::$base));
		}
	}

	public function __toString() {
		$this->partials = apply_filters('SPLITINFINITIES/wrap_' . $this->slug, $this->partials);
		return locate_template($this->partials);
	}

	public static function wrap($main) {
		// Check for other filters returning null
		if (!is_string($main)) {
			return $main;
		}

		self::$main_partial = $main;
		self::$base = basename(self::$main_partial, '.php');

		if (self::$base === 'index') {
			self::$base = false;
		}

		return new SPLITINFINITIES_Wrapping();
	}
}

add_filter('template_include', [__NAMESPACE__ . '\\SPLITINFINITIES_Wrapping', 'wrap'], 109);
