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
	<img class="portfolio-img" src="<?= get_the_post_thumbnail_url() ?>">
	<div class="portfolio-overlay">
		<div class="portfolio-overlay-text">
			<span class="dashicons dashicons-visibility portfolio-overlay-dashicon"></span><br/>
			<?= esc_html__( 'View image', 'designfly' ) ?>
		</div>
	</div>
</div><!-- #post-<?php the_ID(); ?> -->
