<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Oner
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

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'oner' ),
					number_format_i18n( get_comments_number() ), '<code>' . get_the_title() . '</code>' );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'oner' ); ?></h1>
			<div class="nav-previous rippler rippler-default"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Previous Comments', 'oner' ) ); ?></div>
			<div class="nav-next rippler rippler-default"><?php next_comments_link( __( 'Next Comments <span class="meta-nav">&rarr;</span>', 'oner' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>       	

		<ol class="comment-list clearfix">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'oner' ); ?></h1>
			<div class="nav-previous rippler rippler-default"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Previous Comments', 'oner' ) ); ?></div>
			<div class="nav-next rippler rippler-default"><?php next_comments_link( __( 'Next Comments <span class="meta-nav">&rarr;</span>', 'oner' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'oner' ); ?></p>
	<?php endif; ?>

	<?php 
	    $req = get_option( 'require_name_email' );
	    $aria_req = ( $req ? " aria-required='true'" : '' );

		$comments_args = array(
        // change the title of send button 
        'label_submit'=>'Submit',
        // change the title of the reply section
        'title_reply'=>'Leave a Comment',
        // remove "Text or HTML to be displayed after the set of comment fields"
        'comment_notes_after' => '',
        // redefine your own textarea (the comment body)
        'comment_field' => ' 
        <div class="form-group"><div class="input-field"><textarea class="materialize-textarea" type="text" rows="10" id="textarea1" name="comment" aria-required="true"></textarea><label for="textarea1">Comments</label></div></div>',

        'fields' => apply_filters( 'comment_form_default_fields', array(


	    'author' =>'' .
	      '<div><div class="input-field">' .
	      '<input class="validate" id="name" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
	      '" size="30"' . $aria_req . ' /> <label for="name">Name</label></div></div>',

	    'email' =>'' .
	      '<div><div class="input-field">' .
	      '<input class="validate" id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
	      '" size="30"' . $aria_req . ' /><label for="email">Email</label></div></div>',

	    'url' =>'' .
	      '<div class="form-group">'.
	      '<div><div class="input-field"><input class="validate" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
	      '" size="30" /><label for="url">Website</label></div></div>'
	    )
	  ),
	);

	comment_form($comments_args); 	?> 

</div><!-- #comments -->
