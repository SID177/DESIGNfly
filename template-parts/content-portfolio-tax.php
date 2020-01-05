<?php
/**
 * Template part for displaying portfolios.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DESIGNfly
 */

?>
<div class="portfolio-taxonomy">
	<div class="portfolio-taxonomy-middle">
		<div class="portfolio-taxonomy-content">

			<?php
			$terms = get_terms(
				array(
					'taxonomy'   => 'designfly_categories',
					'hide_empty' => false,
					'number'     => 3,
				)
			);

			foreach ( $terms as $t ) {
				?>
				<div class="portfolio-taxonomy-block">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/img/taxonomy-icons/' ) . esc_html( $t->slug ) . '.png'; ?>">
						<div class="portfolio-taxonomy-details">
							<a href="<?php echo esc_url( get_term_link( $t, 'designfly_portfolio' ) ); ?>">
								<span class="portfolio-taxonomy-title"><?php echo esc_html( $t->name ); ?></span>
							</a>
							<p class="portfolio-taxonomy-description"><?php echo esc_html( $t->description ); ?></p>
						</div>
				</div>
				<?php
			}
			?>

		</div>
	</div>
</div>
