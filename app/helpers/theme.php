<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	return;
}

class themeHelpers extends App {

	public function __construct() {
		add_action('init', array($this, 'register_menu'));
		add_action('init', array($this, 'register_sidebar'));
	}

	public static function getTemplateName() {
		global $template;
		$template = str_replace('.php', '', $template);
		return basename($template);
	}
	
	/**
	 * Method hex2rgba
	 *
	 * @param string $color - Hex value
	 * @param int $opacity - Opacity
	 *
	 * @return string
	 */
	public static function hex2rgba($color, $opacity = false) {
 
		$default = 'rgb(0,0,0)';
	 
		//Return default if no color provided
		if(empty($color))
			  return $default; 
	 
			//Sanitize $color if "#" is provided 
			if ($color[0] == '#' ) {
				$color = substr( $color, 1 );
			}
	 
			//Check if color has 6 or 3 characters and get values
			if (strlen($color) == 6) {
				$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
			} elseif ( strlen( $color ) == 3 ) {
				$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
			} else {
				return $default;
			}
	 
			//Convert hexadec to rgb
			$rgb =  array_map('hexdec', $hex);
	 
			//Check if opacity is set(rgba or rgb)
			if($opacity){
				// if(abs($opacity) > 1)
				// 	$opacity = 1.0;
				$output = 'rgba('.implode(",",$rgb).','. ($opacity / 100) .')';
			} else {
				$output = 'rgb('.implode(",",$rgb).')';
			}
	 
			//Return rgb(a) color string
			return $output;
	}




	public function register_menu() {
		// Meniuri
		$menus = [
			'primary-menu'  => 'Primary Menu',
			'footer-main'	=> 'Footer Main',
			'footer-secondary'	=> 'Footer Secondary',
		];

		foreach ($menus as $menu_slug => $menu_title) { 
			$menu = [$menu_slug => __( $menu_title, 'TEXT_DOMAIN' )];
			register_nav_menus($menu);
		}
	}
	
	public function register_sidebar() {

		$sidebars = [
			'primary-sidebar'  => 'Primary Sidebar',
		];

		foreach ($sidebars as $sidebar_slug => $sidebar_title) {

			$sidebar_options = array(
				'name'          => __( $sidebar_title, 'TEXT_DOMAIN' ),
				'id'            => $sidebar_slug,
				'description'   => '',
				'class'         => '',
				'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
				'after_widget'  => '</div><!--end-widget-->',
				'before_title'  => '<h4 class="footer-widget-title mb-5 mb-xl-10 pb-1">',
				'after_title'   => '</h4>'
			);
			register_sidebar( $sidebar_options );
		}
	}
}

$themeHelpers = new themeHelpers();