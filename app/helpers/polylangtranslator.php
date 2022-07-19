<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	return;
}

class polylangTranslator extends App {

	public function __construct() {
		add_action('init', array($this, 'true_polylang_strings'));

		if( ! function_exists( 'pll__' ) ) {
			function pll__( $string ) {
				return $string;
			}
		}

		if( ! function_exists( 'pll_e' ) ) {
			function pll_e( $string ) {
				echo $string;
			}
		}
	}

	public function true_polylang_strings() {

		if( ! function_exists( 'pll_register_string' ) ) {
			return;
		}

		pll_register_string(
			'true_home_section_quick_updates_text',
			'Short Daily Updates',
			'Home page',
			false
		);
	}
}

$polylangTranslator = new polylangTranslator;