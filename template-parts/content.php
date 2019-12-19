<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DESIGNfly
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<span class="entry-title">', '</span>' ); ?>
		<div class="entry-header-meta">
			<span><?php designfly_posted_by() ?>&nbsp;<?php designfly_posted_on() ?></span>
			<span class="number-of-comments"><?= get_comments_number() . ' ' . esc_html__( 'comments', 'designfly' ) ?></span>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
	
	<div class="entry-footer">
		<?php designfly_entry_footer(); ?>
	</div><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
