<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Britley
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'text-break' ); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link visually-hidden-focusable" href="#primary"><?php esc_html_e( 'Skip to content', 'britley' ); ?></a>

	<header id="masthead" class="site-header">
		<?php
		if ( ! has_custom_logo() ) {
			echo '<div class="site-branding container-xl text-center my-4">';
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title h2">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
					</a>
				</h1>
			<?php else : ?>
				<p class="site-title h2">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
					</a>
				</p>
			<?php endif;

			$britley_description = get_bloginfo( 'description', 'display' );
			if ( $britley_description || is_customize_preview() ) : ?>
				<p class="site-description mb-0">
					<?php echo esc_html( $britley_description ); ?>
				</p>
			<?php endif;
		} else {
			echo '<div class="site-branding text-center">';
			the_custom_logo();
		}
		?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="navbar navbar-expand-md border-top border-bottom py-lg-3">
			<div class="container-xl">
				<button class="navbar-toggler p-1" type="button" data-bs-toggle="collapse" data-bs-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div id="navbar-search" class="d-md-none">
					<?php get_search_form(); ?>
				</div>

				<div class="collapse navbar-collapse" id="main-menu">
					<?php
					wp_nav_menu(array(
						'theme_location'  => 'menu-1',
						'container'       => false,
						'menu_class'      => '',
						'fallback_cb'     => '__return_false',
						'items_wrap'      => '<ul id="%1$s" class="navbar-nav mx-auto py-3 py-md-0 flex-wrap %2$s">%3$s</ul>',
						'depth'           => 3,
						'walker'          => new bootstrap_5_wp_nav_menu_walker()
					));
					?>
				</div>
			</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div class="container-xl py-4">

		<div class="row">