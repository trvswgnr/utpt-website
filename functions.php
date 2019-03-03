<?php
/**
 * Theme Functions
 *
 * @package utpt
 */

/**
 * Helper function to include files from the template-parts folder (allows variables to be passed)
 * usage: require template_part( 'hero' ) ); or require template_part( 'hero', 'large' ) );
 *
 * @param string $part1 First part of module to include (filename before hyphen).
 * @param string $part2 Second part of module to include (filename after hypen with no extension).
 */
function template_part( $part1, $part2 = '' ) {
	$hyphen = '';

	if ( '' !== $part2 ) {
		$hyphen = '-'; }

	return locate_template( 'template-parts/' . $part1 . $hyphen . $part2 . '.php' );
}

/**
 * Include function partials
 *
 * @param string $filename Name of function file (without extension) to be included.
 */
function include_function( $filename ) {
	return require_once dirname( __FILE__ ) . '/functions/' . $filename . '.php';
}

/**
 * Get image from the assets folder
 *
 * @param string $filename Name of the file with extension.
 */
function image( $filename ) {
	echo esc_url( get_template_directory_uri() . '/assets/img/' . $filename );
}


include_function( 'add-theme-support' );
include_function( 'add-styles' );
include_function( 'add-scripts' );
include_function( 'custom-post-types' );
include_function( 'require-plugins' );
include_function( 'class-bpm-nav-walker' );
