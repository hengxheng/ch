<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
*/
if ( post_password_required() ) {
	return;
}

$discussion = twentynineteen_get_discussion_data();
?>

<div id="comments" class="<?php echo comments_open() ? 'comments-area' : 'comments-area comments-closed'; ?>">
	<?php if ( comments_open() ) : ?>
		<div class="<?php echo $discussion->responses > 0 ? 'comments-title-wrap' : 'comments-title-wrap no-responses'; ?>">
			<h2 class="comments-title">Leave a comment</h2>
		</div>
	
		<div class="comment-form-flex">
			<?php 
				comment_form( array(
							'logged_in_as' => null,
							'title_reply'  => null,
						)); 
			?>	
		</div>
		<?php
			else:
				?>
					<p class="no-comments">Comments are closed.</p>
				<?php
			endif;
		?>
	<?php
		if ( have_comments() ) :
			// Show comment form at bottom if showing newest comments at the bottom.
			
		?>
		<ul class="comment-list">
				<?php
					wp_list_comments(
						array(
							'walker'      => new TwentyNineteen_Walker_Comment(),
							'avatar_size' => twentynineteen_get_avatar_size(),
							'short_ping'  => true,
							'style'       => 'ul',
						)
					);
				?>
			</ul><!-- .comment-list -->
	<?php endif; ?>
</div><!-- #comments -->
