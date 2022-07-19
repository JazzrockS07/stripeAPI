<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	return;
}

class themeFonts extends App {

	public function __construct() {
		add_action('wp_head', array($this, 'googleFonts'), 100);
	}

	public function googleFonts() {
		 ?> 
		
		<!-- Font CSS -->
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link
			href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700;900&display=swap"
			rel="stylesheet"
		/>
		 <?php
		 
	}
	
}

$themeFonts = new themeFonts();