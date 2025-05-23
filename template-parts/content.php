<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Britley
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'pt-2 mb-4 pb-4 border-bottom' ); ?>>
	<header class="entry-header mb-3">
		<?php
			the_title(
				sprintf( '<h2 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ),
				(is_sticky() ? '</a>&#128204;</h2>' : '</a></h2>')
			);

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
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'britley' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

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
