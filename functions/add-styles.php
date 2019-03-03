<?php
/**
 * Add Theme Styles
 *
 * @package utpt
 */

/** Add stylesheets */
function bpm_styles() {
	wp_enqueue_style( 'google-font-lato', 'https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i', array(), '1.0.0' );
	wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0' );

	// enqueue main stylesheet.
	$path = '/style.css';
	$ver  = filemtime( get_template_directory() . $path ); // change version based on modified date.
	wp_enqueue_style( 'main', get_stylesheet_directory_uri() . $path, array(), $ver );
}
add_action( 'wp_enqueue_scripts', 'bpm_styles' );

