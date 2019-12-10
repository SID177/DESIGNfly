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
			<div class="main-title">
				<span><?= esc_html__( "D'SIGN IS THE SOUL", 'designfly' ) ?></span>
				<a href="<?= get_post_type_archive_link( 'designfly_portfolio' ) ?>"><?= esc_html__( 'view all', 'designfly' ) ?></a>
			</div>

			<div class="portfolio-block">
				<?php
				$query = new WP_Query( array(
					'post_type'      => 'designfly_portfolio',
					'post_status'    => 'publish',
					'posts_per_page' => 6,
				) );

				if ( $query->have_posts() ) :

					while ( $query->have_posts() ) :

						$query->the_post();
						
						get_template_part( 'template-parts/content', 'portfolio' );

					endwhile;

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
