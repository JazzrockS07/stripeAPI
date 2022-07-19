<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	return;
}

class App {
	public function loadParts() {

		$folders = [ 
			'config',
			'components',
			'helpers',
			'shortcodes',
			'single',
			'taxonomy',
			'archive'
		];

		foreach ( $folders as $foldername ) {
			
			$folder = __DIR__ . "/" . $foldername ; 
			$files1 = glob($folder . '/*.php'); // return array files
			$files2 = glob($folder . '/**/*.php'); // return array files
			$files = array_merge($files1, $files2);
	
			foreach($files as $filename){
				require_once $filename;
			}
			
		}

	}
	
	public function init() {
		$this->loadParts();
	}
}

$app = new App();

$app->init();