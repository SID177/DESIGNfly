<?php
/**
 * The front page
 *
 * The main homepage of the theme. It shows portfolios and link to
 * portfolio archive page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DESIGNfly
 */

get_header();
?>
	<div class="front-header">
		<img src="<?= get_template_directory_uri() ?>/img/slider-image.png">
		<div class="text-block">
			<div><?= esc_html__( 'Gearing up the ideas', 'designfly' ) ?></div>
			<p><?= esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', 'designfly' ) ?></p>
		</div>
	</div>
	<div class="portfolio-taxonomy">
		<div class="portfolio-taxonomy-middle">
			<div class="portfolio-taxonomy-content">

				<?php
				$terms = get_terms( array( 'taxonomy' => 'designfly_categories', 'hide_empty' => false ) );
				
				foreach ( $terms as $term ) {
					?>
					<div class="portfolio-taxonomy-block">
						<img src="<?= get_template_directory_uri() . '/img/taxonomy-icons/' . esc_html( $term->slug ) . '.png' ?>">
						<div class="portfolio-taxonomy-details">
							<span class="portfolio-taxonomy-title"><?= esc_html( $term->name ) ?></span>
							<p class="portfolio-taxonomy-description"><?= esc_html( $term->description ) ?></p>
						</div>
					</div>
					<?php
				}
				?>
						
			</div>
		</div>
	</div>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				// get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
