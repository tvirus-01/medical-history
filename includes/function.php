<?php

	//Add scripts functions//

	function bkly_add_scripts(){

		//Add main css//

		wp_enqueue_style('bkly_main_style', plugins_url().'/bookly_history/css/style.css');

		//Add main js//

		wp_enqueue_script('bkly_main_scripts', plugins_url().'/bookly_history/js/main.js');
	}

	//Add hook for the scripts//
	add_action('wp_enqueue_scripts', 'bkly_add_scripts');