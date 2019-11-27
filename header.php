<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DESIGNfly
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

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'designfly' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-header-content">
			<div class="site-branding">
				<a class="site-logo-link" href="<?= home_url() ?>">
					<img class="site-logo" src="<?= get_template_directory_uri() ?>/img/logo.png">
				</a>
			</div><!-- .site-branding -->

			<div class="site-navigation-search">
				<nav id="site-navigation" class="main-navigation">
					<?php
					wp_nav_menu( array( 
						'theme_location' => 'primary-menu'
					) );
					?>
				</nav><!-- #site-navigation -->
				<?php get_search_form(); ?>
			</div>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
