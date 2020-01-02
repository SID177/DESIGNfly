<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DESIGNfly
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a class="post-link" href="<?= esc_url( get_the_permalink() ) ?>">
		<header class="entry-header">
			<span class="entry-meta">
				<span class="post-day"><?= get_the_date( 'd' ) . '</span><span class="post-month">' . get_the_date( 'M' ) ?></span>
			</span><!-- .entry-meta -->
			<?php the_title( '<span class="entry-title">', '</span>' ); ?>
		</header><!-- .entry-header -->
	</a>

	<div class="entry-content">
		<?php
		if ( has_post_thumbnail() ) {
			?><img src="<?= esc_url( get_the_post_thumbnail_url() ) ?>" class="post-thumbnail"><?php
		}
		?>
		<div class="post-content-block">
			<div class="post-content-header">
				<span><?php designfly_posted_by() ?>&nbsp;<?php designfly_posted_on() ?></span>
				<span class="number-of-comments"><?= get_comments_number() . ' ' . esc_html__( 'comments', 'designfly' ) ?></span>
			</div>
			<div class="post-text">
				<?php the_excerpt(); ?>
			</div>
		</div>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
