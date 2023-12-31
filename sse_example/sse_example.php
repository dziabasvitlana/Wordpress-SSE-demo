<?php

/**
 * Plugin Name: SSE example
 * Author: Upsite
 * Author URI: https://upsite.top
 * Version: 1.0.0
 * License: GPL-3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 *
 */
 
add_action( 'wp_enqueue_scripts', 'sse_enqueue_scripts' );
function sse_enqueue_scripts() {
	
	wp_register_script( 'sse-test', plugin_dir_url( __FILE__ ) . 'sse-test.js', array( 'jquery' ), '1.0.1', true );
}

require_once plugin_dir_path( __FILE__ ) . 'functions.php';
