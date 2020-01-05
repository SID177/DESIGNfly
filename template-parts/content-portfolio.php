<?php
/**
 * Template part for displaying portfolios.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DESIGNfly
 */

?>
<div <?php post_class( 'portfolio-item' ); ?> id="post-<?php the_ID(); ?>">
	<img class="portfolio-img" src="<?php echo has_post_thumbnail() ? esc_url( get_the_post_thumbnail_url() ) : esc_url( get_template_directory_uri() . '/img/noimagefound.png' ); ?>" alt="<?php echo esc_html( get_the_title() ); ?>">
	<div class="portfolio-overlay">
		<div class="portfolio-overlay-text">
			<span class="dashicons dashicons-visibility portfolio-overlay-dashicon"></span><br/>
			<?php echo esc_html__( 'View image', 'designfly' ); ?>
		</div>
	</div>
</div><!-- #post-<?php the_ID(); ?> -->
