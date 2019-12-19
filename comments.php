<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DESIGNfly
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<span class="comments-title">
			<?= esc_html_x( 'Comments', 'post comments', 'designfly' ) ?>
		</span><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ul class="comment-list">
			<?php wp_list_comments( 'callback=designfly_custom_comment_block' ); ?>
		</ul><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'designfly' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	comment_form( array(
		'fields'               => array(
			'author'  => '<div class="comment-meta-fields"><p class="comment-form-author"><label for="author">' . esc_html_x( 'Name', 'comment form name', 'designfly' ) . '</label> <input id="author" name="author" type="text" value="" maxlength="245" required="required" /></p>',
			'email'   => '<p class="comment-form-email"><label for="email">' . esc_html_x( 'Email', 'comment form email', 'designfly' ) . '</label> <input id="email" name="email" type="email" value="" maxlength="100" aria-describedby="email-notes" required=required /></p>',
			'url'     => '<p class="comment-form-url"><label for="url">' . esc_html_x( 'Website', 'comment form website', 'designfly' ) . '</label> <input id="url" name="url" type="url" value="" maxlength="200" /></p></div>',
			'cookies' => '',
		),
		'title_reply'          => esc_html__( 'Post your comment', 'designfly' ),
		'label_submit'         => esc_html__( 'Submit', 'designfly' ),
		'logged_in_as'         => '',
		'comment_notes_before' => '',
	) );
	?>

</div><!-- #comments -->
