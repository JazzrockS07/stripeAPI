<?php 
define('PATH', get_stylesheet_directory( ));
define('URL', get_stylesheet_directory_uri(  ));

define('INCLUDES_PATH', PATH . '/inc/fields');
define('INCLUDES_URI', URL . '/inc/fields');

// Define path and URL to the ACF plugin.
define( 'ACF_PATH', INCLUDES_PATH . '/acf/' );
define( 'ACF_URL', INCLUDES_URI . '/acf/' );
define( 'ACFE_PATH', INCLUDES_PATH . '/acf-extended/');
define( 'ACFE_URL', INCLUDES_URI . '/acf-extended/');

include_once( INCLUDES_PATH . '/acf/acf.php' );
include_once( INCLUDES_PATH . '/acf-extended/acf-extended.php' );
include_once( INCLUDES_PATH . '/acf-theme-code-pro/acf_theme_code_pro.php');

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' => 'Detalii Business',
		'menu_title' => 'Detalii Business',
		'menu_slug' => 'theme-settings',
		'capability' => 'edit_posts',
		'position' => '63',
		'parent_slug' => '',
		'icon_url' => '',
		'redirect' => false,
		'post_id' => 'theme_options',
		'autoload' => true,
		'update_button' => 'Update',
		'updated_message' => 'Options Updated',
	));
}
?>