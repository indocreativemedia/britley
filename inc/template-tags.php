<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Britley
 */

if ( ! function_exists( 'britley_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function britley_posted_on() {
		$post = get_post();
		if ( ! $post ) {
			return;
		}

		$year  = get_the_date( 'Y' );
		$month = get_the_date( 'm' );
		$day   = get_the_date( 'd' );

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> <time class="updated" datetime="%3$s">(%4$s)</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'britley' ),
			'<a href="' . esc_url( get_day_link( $year, $month, $day ) ) . '">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'britley_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function britley_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'britley' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'britley_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function britley_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'britley' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'britley' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'britley' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'britley' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'britley' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'britley' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'britley_post_thumbnail' ) ) {
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function britley_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail mb-4 text-center">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail d-block text-center mb-4" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
}

if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

if ( ! function_exists( 'britley_site_info' ) ) {
	/**
	 * Add site info hook to WP hook library.
	 */
	function britley_site_info() {
		do_action( 'britley_site_info' );
	}
}

add_action( 'britley_site_info', 'britley_add_site_info' );
if ( ! function_exists( 'britley_add_site_info' ) ) {
	/**
	 * Add site info content.
	 */
	function britley_add_site_info() {

		$blog_description = get_bloginfo( 'description' );

		$site_info = sprintf(
		  '%1$s &copy;%2$s <a href="%3$s">%4$s</a>',
		  esc_html__( 'Copyright', 'britley' ),
		  esc_html( wp_date( 'Y' ) ),
		  esc_url( home_url( '/' ) ),
		  esc_html( get_bloginfo( 'name' ) )
		);

		if ( ! empty( $blog_description ) ) {
		  $site_info .= sprintf(
		    ' &mdash; <a href="%1$s">%2$s</a>',
		    esc_url( home_url( '/' ) ),
		    esc_html( $blog_description )
		  );
		}

		$site_info .= sprintf(
		  '<br>%1$s <a href="https://www.classicpress.net/" target="_blank">ClassicPress</a> &amp; <a href="%2$s" target="_blank">%3$s</a>',
		  esc_html__( 'Powered by', 'britley' ),
		  'https://www.indocreativemedia.com/free-classicpress-themes/',
		  'Britley ClassicPress Theme'
		);

		echo apply_filters( 'britley_site_info_content', $site_info ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
}

if ( ! function_exists( 'britley_navigation_markup' ) ) {
	function britley_navigation_markup( $template ) {
	    $custom_template = '
	    <nav class="navigation pb-1 %1$s" role="navigation">
	        <h2 class="screen-reader-text">%2$s</h2>
	        <div class="nav-links d-flex justify-content-between">%3$s</div>
	    </nav>';
	    
	    return $custom_template;
	}
}
add_filter( 'navigation_markup_template', 'britley_navigation_markup' );

if ( ! function_exists( 'britley_add_form_select_class' ) ) {
	function britley_add_form_select_class($output) {
		// Add the 'form-select' class to <select> elements
		$output = str_replace('<select', '<select class="form-select"', $output);
		return $output;
	}
}
add_filter('wp_dropdown_cats', 'britley_add_form_select_class');

if ( ! function_exists( 'britley_custom_search_form' ) ) {
	function britley_custom_search_form( $form ) {
		$uid = wp_unique_id( 'search-field-' ); // The search form specific unique ID for the input.
		$form = '
			<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
				<label for="' . esc_attr( $uid ) . '" class="visually-hidden">' . esc_html_x( 'Search for:', 'label', 'britley' ) . '</label>
				<div class="input-group">
					<input type="search" id="' . esc_attr( $uid ) . '" class="form-control search-field" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder', 'britley' ) . '" value="' . get_search_query() . '" name="s" aria-label="' . esc_attr_x( 'Search for:', 'aria label', 'britley' ) . '" />
					<button type="submit" class="btn btn-primary search-submit" aria-label="' . esc_attr_x( 'Submit search', 'submit button aria label', 'britley' ) . '">' . esc_html_x( 'Search', 'submit button', 'britley' ) . '</button>
				</div>
			</form>';
		return $form;
	}
}
add_filter( 'get_search_form', 'britley_custom_search_form' );