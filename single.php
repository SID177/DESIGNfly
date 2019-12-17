<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
					<div class="single-post-content">
						<?php
						while ( have_posts() ) :
							the_post();

							get_template_part( 'template-parts/content', 'single-' . get_post_type() );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						endwhile; // End of the loop.
						?>
					</div>
					<?php get_sidebar(); ?>
				</div>
				<?php

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
