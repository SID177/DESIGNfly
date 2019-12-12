<?php
/**
 * Template part for displaying modal.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DESIGNfly
 */
?>

<div id="portfolio-modal">
	<div id="portfolio-modal-box">
		<div id="portfolio-modal-box-middle">
			<div id="portfolio-modal-box-flex">
				<div id="portfolio-modal-box-border">
					<img class="modal-content" id="portfolio-modal-img">
					<div id="portfolio-modal-caption">
						<!-- <img src="<?= get_template_directory_uri() ?>/img/small-left-arrow.png"> -->
						<span class="navigation-arrow-left"><?= esc_html( '<' ) ?></span>
						<span id="portfolio-title-span"></span>
						<span class="navigation-arrow-right"><?= esc_html( '>' ) ?></span>
						<!-- <img src="<?= get_template_directory_uri() ?>/img/small-right-arrow.png"> -->
					</div>
				</div>
				<div class="portfolio-close">
					<span class="portfolio-close-span">&times;</span>
				</div>
			</div>
		</div>
	</div>
</div>