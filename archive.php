<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DESIGNfly
 */

get_header();
get_template_part( 'template-parts/content', 'portfolio-tax' );
?>

	<div id="primary" class="content-area show-sidebar">
		<main id="main" class="site-main">

			<?php
			if ( have_posts() ) :

				?>
				<div class="blog-content">
					<div class="post-content">
						<div class="main-title">
							<span class="title"><?= esc_html__( "LET'S BLOG", 'designfly' ) ?></span>
						</div>
						<div class="post-grid">
							<?php

							/* Start the Loop */
							while ( have_posts() ) :
								the_post();

								/*
								* Include the Post-Type-specific template for the content.
								* If you want to override this in a child theme, then include a file
								* called content-___.php (where ___ is the Post Type name) and that will be used instead.
								*/
								get_template_part( 'template-parts/content', get_post_type() );

							endwhile;
							?>
						</div>
					</div>
					<?php get_sidebar(); ?>
				</div>
				<?php

				the_posts_pagination( array(
					'screen_reader_text' => ' ',
					'next_text'          => '<img src="' . get_template_directory_uri() . '/img/pagination-arrow.png' . '">',
					'prev_text'          => '',
				) );

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
