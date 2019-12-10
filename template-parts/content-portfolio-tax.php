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