<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DESIGNfly
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<div class="site-detail">
				<span class="title"><?= esc_html__( "Welcome to D'SIGNfly", 'designfly' ) ?></span>
				<p class="description"><?= esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'designfly' ) ?></p>
				<a href="<?= home_url( '/' ) ?>" class="read-more"><?= esc_html__( 'Read more', 'designfly' ) ?></a>
			</div>
			<div class="contact-detail">
				<span class="title"><?= esc_html__( 'Contact Us', 'designfly' ) ?></span>
				<p class="description">
					<?= esc_html__( 'Street 21 Planet, A-11, dapibus tristique. 123551', 'designfly' ) ?><br/>
					<?= esc_html__( 'Tel: 123 4567890; Fax: 123 456789', 'designfly' ) ?><br/>
					<?= esc_html__( 'Email: ', 'designfly' ) ?><span class="email"><?= esc_html__( 'contactus@designfly.com', 'designfly' ) ?></span>
				</p>
				<img src="<?= get_template_directory_uri() . '/img/social.png' ?>">
			</div>
		</div><!-- .site-info -->
		<div class="copyright-div">
			<span>&copy; <?= esc_html__( "2012 - D'SIGNfly | Designed by ", 'designfly' ) ?><a href="<?= esc_url( 'https://rtcamp.com/' ) ?>" class="copyright-rtcamp"><?= esc_html__( 'rtCamp', 'designfly' ) ?></a></span>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
