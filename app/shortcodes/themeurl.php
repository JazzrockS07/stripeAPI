<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	return;
}

class themeUrl extends App {

	public function __construct() {
		add_shortcode('theme_url', array($this, 'getThemeUrl'), 100);
	}

	function getThemeUrl( $attrs = array (), $content = '' ) {
		$theme = ( is_child_theme() ? get_stylesheet_directory_uri() : get_template_directory_uri() );
		return $theme;
	}

}

$themeUrl = new themeUrl();