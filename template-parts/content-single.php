<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Britley
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'pt-1 mb-4 pb-4 border-bottom' ); ?>>
	<header class="entry-header mb-3">
		<?php
			the_title( '<h1 class="entry-title">', '</h1>' );

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				britley_posted_on();
				britley_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php britley_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="clearfix"></div><div class="page-links">' . esc_html__( 'Pages:', 'britley' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<div class="clearfix"></div>
	<footer class="entry-footer mb-2">
		<?php britley_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
