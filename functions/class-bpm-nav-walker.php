<?php
/**
 * Nav and Nav Menu Functions
 *
 * @package utpt
 */

/**
 * Custom Nav Walker with BEM Markup
 *
 * @category Class
 * @author Travis A. Wagner
 */
class BPM_Nav_Walker extends Walker_Nav_Menu {

	/**
	 * Makes a new instance of this nav walker
	 *
	 * @param string $class_name Name of custom base class to use for <ul> and <li>.
	 */
	public function __construct( $class_name = 'nav' ) {
		$this->class_name = $class_name;
	}

	/**
	 * Calls at the start of a new level
	 *
	 * @param string $output The output string.
	 * @param int    $depth  The current menu level.
	 * @param array  $args   Optional arguments to pass.
	 *
	 * @see Walker::start_lvl().
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$depth++; // start the depth at 1.
		$class_name = $this->class_name;
		$output    .= '<ul class=' . $class_name . '__sub-menu ' . $class_name . '__sub-menu--level-' . $depth . '">';
	}

	/**
	 * Displays start of an element. E.g '<li> Item Name'
	 *
	 * @param string $output The output string.
	 * @param object $item   Menu item object.
	 * @param int    $depth  The current menu level.
	 * @param array  $args   Optional arguments to pass.
	 * @param int    $id     Menu ID Number.
	 *
	 * @see Walker::start_el().
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$depth++; // start the depth at 1.
		$title      = $item->title;
		$permalink  = $item->url;
		$class_name = $this->class_name;
		$classes    = array(
			$class_name . '__item',
			$class_name . '__item--level-' . $depth,
			( $item->current ? '__item--current' : '' ),
		);

		$output .= "<li class='" . implode( ' ', $classes ) . "'>";

		$output .= '<a href="' . $permalink . '">' . $title . '</a>';
	}
}

/**
 * Call custom menu in theme
 *
 * @param string $location   The theme menu location.
 * @param string $class_name Name of custom class to pass as base of other classes.
 */
function bpm_nav_menu( $location = 'primary', $class_name = 'nav' ) {
	wp_nav_menu(
		array(
			'theme_location'  => $location,
			'menu_class'      => $class_name . '__menu',
			'container'       => 'nav',
			'container_class' => $class_name . ' ' . $class_name . '--' . $location,
			'walker'          => new BPM_Nav_Walker( $class_name ),
		)
	);
}
