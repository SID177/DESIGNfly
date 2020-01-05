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
						<span class="navigation-arrow-left"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/caret-left-solid.svg"></span>
						<span id="portfolio-title-span"></span>
						<span class="navigation-arrow-right"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/caret-right-solid.svg"></span>
					</div>
				</div>
				<div class="portfolio-close">
					<span class="portfolio-close-span">&times;</span>
				</div>
			</div>
		</div>
	</div>
</div>
