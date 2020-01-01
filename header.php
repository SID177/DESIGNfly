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
	<link rel="shortcut icon" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/favicon.ico" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<header id="masthead" class="site-header">
		<div class="site-header-middle">
			<div class="site-header-content">
				<div class="site-branding">
					<a class="site-logo-link" href="<?php echo esc_url( home_url() ); ?>">
						<img class="site-logo" src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/logo.png">
					</a>
				</div><!-- .site-branding -->

				<div class="site-navigation-search">
					<nav id="site-navigation" class="main-navigation">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'primary-menu',
							)
						);
						?>
					</nav><!-- #site-navigation -->
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
