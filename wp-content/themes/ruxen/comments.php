<?php
/*
 * The template for displaying comments part
*/

$post_comment_hide = get_theme_mod( 'post_comment_hide' );
if( !$post_comment_hide == '1' ):
if ( post_password_required() )
	return;
?>

<!-- COMMENT AREA START -->
<section id="comments" class="comments-area">

		<?php if ( have_comments() ) : ?>
		
			<h2 class="comments-title"><i class="fa fa-comments"></i>
				<?php
					printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'ruxen' ),
						number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
				?>
			</h2>
			
			<ol class="comment-list">
				<?php
					wp_list_comments( array(
						'style'       => 'ol',
						'short_ping'  => true,
						'avatar_size' => 74,
					) );
				?>
			
				<?php
					if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				?>
				
				<nav class="navigation comment-navigation" role="navigation">
					<h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'ruxen' ); ?></h1>
					<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'ruxen' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'ruxen' ) ); ?></div>
				</nav>
				
				<?php endif; ?>

				<?php if ( ! comments_open() && get_comments_number() ) : ?>
				<p class="no-comments"><?php _e( 'Comments are closed.' , 'ruxen' ); ?></p>
				<?php endif; ?>
			</ol>

		<?php endif; ?>

		<?php
		$comments_args = array(
			'id_form'           => 'commentform',
			'id_submit'         => 'submit',
			'class_submit'		=> 'btn btn-danger pull-right',
			'title_reply'       => '<div class="comment-title graybar">' . __('<i class="fa fa-pencil-square"></i> Leave a Reply', 'ruxen') . '</div>',
			'title_reply_to'    => '<div class="comment-title graybar">' . __('Leave a Reply to', 'ruxen') . ' %s' . '</div>',
			'cancel_reply_link' => __( 'Cancel Reply', 'ruxen'),
			'label_submit'      => __( 'Post Comment', 'ruxen'),

			'comment_field' =>  '<div class="form-group"><textarea class="form-control" placeholder="' . __('Add your comment here', 'ruxen') . '..." name="comment" class="commentbody" id="comment" rows="5" tabindex="4"></textarea></div>',

			'comment_notes_after' => '<p class="form-allowed-tags">' .
			sprintf( '<div class="well well-sm">' .
			  __( 'You may use these HTML tags and attributes: %s', 'ruxen' ),
			  '<code>' . allowed_tags() . '</code></div>'
			) . '</p>',

			'comment_notes_before' => '',

			'fields' => apply_filters( 'comment_form_default_fields', array(
				'author' =>
					'<div class="form-group"><input class="form-control" type="text" placeholder="' . __('Name', 'ruxen') . ' ' . ( $req ?  '(' . __('Required', 'ruxen') . ')' : '') . '" name="author" id="author" value="' . esc_attr($comment_author) . '" size="22" tabindex="1"' . ($req ? "aria-required='true'" : '' ). ' /></div>',

				'email' =>
					'<div class="form-group"><input class="form-control" type="text" placeholder="' . __('Email', 'ruxen') . ' ' . ( $req ? '(' . __('Required', 'ruxen') . ')' : '') . '" name="email" id="email" value="' . esc_attr($comment_author_email) . '" size="22" tabindex="1"' . ($req ? "aria-required='true'" : '' ). ' /></div>',

				'url' =>
					'<div class="form-group"><input class="form-control" type="text" placeholder="' . __('Website URL', 'ruxen') . '" name="url" id="url" value="' . esc_attr($comment_author_url) . '" size="22" tabindex="1" /></div>'

				)
			)

		);
			comment_form( $comments_args );
		?>
		
</section>
<!-- COMMENT AREA END -->
<?php endif; ?>