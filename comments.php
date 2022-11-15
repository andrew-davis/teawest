<?php
/**
 * The template for displaying Comments on Recipes and Posts
 *
 *
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
 global $post;
if ( post_password_required() ) {
	return;
} ?>


<div id="collapseComments" class="collapse comment-form cm-hide">

	<div class="row pbottom-10">
			
		<div class="col-sm-8 col-lg-7">
			<?php if ( have_comments() ) : ?>
				<ul class="comment-list">
					<?php
/*
					wp_list_comments( array(
						'style'				=> 'ul',
						'format' 			=> 'html5',
						'type'				=> 'all',
						'short_ping' 		=> true,
						'reverse_top_level'	=> true,
						'avatar_size'		=> 0,
					) );
*/
					?>
					<?php wp_list_comments('type=comment&callback=format_comment'); ?>
				</ul><!-- .comment-list -->
		
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
				<nav id="comment-nav" class="navbar navbar-default" role="navigation">
					<div class="load-more load-comments" data-type="recipes">Load More +</div>
				</nav><!-- #comment-nav -->
			<?php endif; ?>
		
			<?php if ( ! comments_open() ) : ?>
				<!-- comments deactivated -->
			<?php endif; ?>
		
			<?php endif; // have_comments() ?>
		</div><!-- .col-sm-7 -->
	
		<?php 
			/**
			 *	Comment Form
			 *
			**/
			global $user_identity;
			$commenter = wp_get_current_commenter();
			$req = get_option( 'require_name_email' );
			$aria_req = ( $req ? " aria-required='true'" : '' );
			$com_args = array(
				'fields' => array(
					'author' => '<p><label for="author"> Name <span class="glyphicon glyphicon-asterisk"></span> </label> ' .
						'<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
						'" size="30"' . $aria_req . ' /></p>',
					
					'email' => '<p><label for="email"> Email <span class="glyphicon glyphicon-asterisk"></span> </label> ' . 
						'<input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
						'" size="30"' . $aria_req . ' /></p>',
					'url' => ''
				),
				'comment_field' => '<p> <label for="comment"> Comment </label><textarea id="comment" class="form-control" name="comment" cols="45" rows="4" aria-required="true" placeholder="Type here..."></textarea></p>',
				'must_log_in'	=> '<p class="must-log-in">' .  sprintf( __( 'You must <a href="%s">log in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
				'logged_in_as'	=> '<p class="logged-in-as">Logged in as ' . sprintf( __( '<a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out">Log out</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
				'comment_notes_before'	=> '',
				'comment_notes_after'	=> '',
				'id_form'	=> 'recipe-comments',
				'id_submit'	=> '',
				'class_submit' => 'btn btn-default btn-sm btn-reverse',
				'title_reply'	=> 'Add your comments',
				'title_reply_to' => __( 'Reply to %s' ),
				'cancel_reply_link' => 'Cancel',
				'label_submit' => 'Submit'
		
			); 
		?>
		
		<div class="col-sm-4 col-lg-4 col-lg-offset-1">
			
			<?php comment_form($com_args); ?>
		</div><!-- .col-sm-4 -->
	</div><!-- .row -->
</div><!-- #collapseComments -->
	
	<hr class="mtop-10 cm-hide" />

