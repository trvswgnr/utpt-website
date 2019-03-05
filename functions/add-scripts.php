<?php
/**
 * Add Theme Scripts
 *
 * @package utpt
 */

/** Add scripts */
function bpm_scripts() {
	wp_enqueue_script( 'bpm-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '1.0', true );

	// enqueue main script file.
	$path = '/assets/js/main.js';
	$ver  = filemtime( get_template_directory() . $path );
	wp_enqueue_script( 'bpm-scripts', get_theme_file_uri( $path ), array( 'jquery' ), $ver, true );

}
add_action( 'wp_enqueue_scripts', 'bpm_scripts' );


