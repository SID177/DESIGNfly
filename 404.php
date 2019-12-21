<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package DESIGNfly
 */

get_header();
get_template_part( 'template-parts/content', 'portfolio-tax' );
?>

	<div id="primary" class="content-area show-sidebar">
		<main id="main" class="site-main">

			
				<div class="blog-content">
					<div class="post-content">
						<div class="main-title">
							<span class="title">
								<?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'designfly' ); ?>
							</span>
						</div>
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'designfly' ); ?></p>
						<div class="post-grid">
							<!-- <div class="page-content"> -->
								<?php
								get_search_form();
								?>

								<div class="widget widget_categories">
									<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'designfly' ); ?></h2>
									<ul>
										<?php
										wp_list_categories( array(
											'orderby'    => 'count',
											'order'      => 'DESC',
											'show_count' => 1,
											'title_li'   => '',
											'number'     => 10,
										) );
										?>
									</ul>
								</div><!-- .widget -->

								<?php
								/* translators: %1$s: smiley */
								$designfly_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'designfly' ), convert_smilies( ':)' ) ) . '</p>';
								the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$designfly_archive_content" );

								the_widget( 'WP_Widget_Tag_Cloud' );
								?>

							<!-- </div> -->
							<!-- .page-content -->
						</div>
					</div>
					<?php get_sidebar(); ?>
				</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
