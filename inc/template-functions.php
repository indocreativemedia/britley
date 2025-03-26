<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Britley
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function britley_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'britley_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function britley_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'britley_pingback_header' );

function britley_tag_cloud_font_sizes( array $args ) {
	$args['smallest'] = 16;
	$args['largest'] = 24;
	$args['unit'] = 'px';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'britley_tag_cloud_font_sizes' );