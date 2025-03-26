<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Britley
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area col-md-4 col-xxl-3">
	<div class="pt-4 mt-4 border-top d-md-none"></div>
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
