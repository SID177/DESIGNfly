<?php
/**
 * This page contains HTML code for search form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DESIGNfly
 */

?>

<div id="searchform">
	<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="text" class="search-input" name="s" value="<?php echo esc_html( get_search_query() ); ?>">
		<input type="image" class="search-submit" src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/search-icon.png">
	</form>
</div>
