<?php
/**
 * This page contains HTML code for search form.
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DESIGNfly
 */
?>

<div id="searchform">
    <form method="get" action="<?= home_url( '/' ) ?>">
        <input type="text" class="search-input" name="s" value="<?= get_search_query() ?>">
        <input type="image" class="search-submit" src="<?= get_template_directory_uri() ?>/img/search-icon.png">
    </form>
</div>