<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Bizgrowth
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function bizgrowth_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'bizgrowth_jetpack_setup' );
