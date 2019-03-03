<?php
/**
 * Add Theme Support
 *
 * @package utpt
 */

if ( ! function_exists( 'bpm_setup' ) ) :
	/** Setup BPM Theme Support */
	function bpm_setup() {
		// translation support.
		load_theme_textdomain( 'bpm', get_template_directory() . '/languages' );

		// default posts and comments RSS feed links in head.
		add_theme_support( 'automatic-feed-links' );

		// dynamic title tags.
		add_theme_support( 'title-tag' );

		// featured images.
		add_theme_support( 'post-thumbnails' );

		// usage: wp_nav_menu().
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'utpt' ),
				'mobile'  => esc_html__( 'Mobile', 'utpt' ),
			)
		);
	}
	// ACF - Add Options page-header.
	// Usage within template file: the_field('header_title', 'option');.
	if ( function_exists( 'acf_add_options_page' ) ) {
		acf_add_options_page();
	}

endif;
add_action( 'after_setup_theme', 'bpm_setup' );

