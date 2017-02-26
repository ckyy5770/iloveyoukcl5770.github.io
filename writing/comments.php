<?php

if ( post_password_required() ) {
	return;
}
?>

<section id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title title">
			<?php
				$comments_number = get_comments_number();
				if ( 1 === $comments_number ) {
					/* translators: %s: post title */
					_x( 'One Comment', 'comments title', 'asalah' );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_x(
							'%1$s comments',
							'plural comments title',
							'asalah'
						),
						number_format_i18n( $comments_number )
					);
				}
			?>

			<span class="screen-reader-text">On <?php echo get_the_title(); ?></span>

		</h3>

		<?php asalah_comment_nav(); ?>

		<ul class="media-list comments_list col-md-12">
		    <?php
		    wp_list_comments(array('callback' => 'asalah_comment'));
		    ?>
		</ul>

		<?php asalah_comment_nav(); ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'asalah' ); ?></p>
	<?php endif; ?>

	<?php
		if (is_user_logged_in()) {
			$args = array(
					'id_form' => 'commentform',
					'id_submit' => 'submit',
					'title_reply' => __('Leave a reply', 'asalah') . ':',
					'title_reply_to' => __('Leave a Reply to %s', 'asalah'),
					'cancel_reply_link' => __('Cancel Reply', 'asalah'),
					'label_submit' => __('Post Comment', 'asalah'),
					'comment_field' => '<div class="comment_textarea clearfix col-md-12"><textarea id="comment" name="comment" aria-required="true" class="col-md-12" rows="7"></textarea></div></div>',
					'must_log_in' => '',
					'logged_in_as' => '<div class="row">',
					'comment_notes_before' => '<p class="comment-notes">' . __('Your email address will not be published.', 'asalah') . '</p><div class="row">',
					'comment_notes_after' => '',
					'fields' => apply_filters('comment_form_default_fields', array(
							'author' => '<div class="col-md-4"><input id="author" name="author" class="form-control col-md-12" type="text" placeholder="'.__('Name', 'asalah').'"></div>',
							'email' => '<div class="col-md-4"><input id="email" name="email" class="form-control col-md-12" type="text" placeholder="'.__('Email', 'asalah').'"></div>',
							'url' => '<div class="col-md-4"><input id="url" name="url" class="form-control col-md-12" type="text" placeholder="'.__('Website', 'asalah').'"></div></div>')
					)
			);
		} else {
				if (floatval(get_bloginfo( 'version' )) > 4.3) {
					$args = array(
					    'id_form' => 'commentform',
					    'id_submit' => 'submit',
					    'title_reply' => __('Leave a reply', 'asalah') . ':',
					    'title_reply_to' => __('Leave a Reply to %s', 'asalah'),
					    'cancel_reply_link' => __('Cancel Reply', 'asalah'),
					    'label_submit' => __('Post Comment', 'asalah'),
					    'comment_field' => '<div class="comment_textarea clearfix col-md-12"><textarea id="comment" name="comment" aria-required="true" class="col-md-12" rows="7"></textarea></div>',
					    'must_log_in' => '',
					    'logged_in_as' => '',
					    'comment_notes_before' => '<p class="comment-notes">' . __('Your email address will not be published.', 'asalah') . '</p><div class="row">',
					    'comment_notes_after' => '',
					    'fields' => apply_filters('comment_form_default_fields', array(
					        'author' => '<div class="col-md-4"><input id="author" name="author" class="form-control col-md-12" type="text" placeholder="'.__('Name', 'asalah').'"></div>',
					        'email' => '<div class="col-md-4"><input id="email" name="email" class="form-control col-md-12" type="text" placeholder="'.__('Email', 'asalah').'"></div>',
					        'url' => '<div class="col-md-4"><input id="url" name="url" class="form-control col-md-12" type="text" placeholder="'.__('Website', 'asalah').'"></div></div>')
					    )
					);
			} else {
				$args = array(
				    'id_form' => 'commentform',
				    'id_submit' => 'submit',
				    'title_reply' => __('Leave a reply', 'asalah') . ':',
				    'title_reply_to' => __('Leave a Reply to %s', 'asalah'),
				    'cancel_reply_link' => __('Cancel Reply', 'asalah'),
				    'label_submit' => __('Post Comment', 'asalah'),
				    'comment_field' => '<div class="comment_textarea clearfix col-md-12"><textarea id="comment" name="comment" aria-required="true" class="col-md-12" rows="7"></textarea></div></div>',
				    'must_log_in' => '',
				    'logged_in_as' => '',
				    'comment_notes_before' => '<p class="comment-notes">' . __('Your email address will not be published.', 'asalah') . '</p><div class="row">',
				    'comment_notes_after' => '',
				    'fields' => apply_filters('comment_form_default_fields', array(
				        'author' => '<div class="col-md-4"><input id="author" name="author" class="form-control col-md-12" type="text" placeholder="'.__('Name', 'asalah').'"></div>',
				        'email' => '<div class="col-md-4"><input id="email" name="email" class="form-control col-md-12" type="text" placeholder="'.__('Email', 'asalah').'"></div>',
				        'url' => '<div class="col-md-4"><input id="url" name="url" class="form-control col-md-12" type="text" placeholder="'.__('Website', 'asalah').'"></div>')
				    )
				);
			}
	}
		comment_form($args);
	?>

</section><!-- .comments-area -->
