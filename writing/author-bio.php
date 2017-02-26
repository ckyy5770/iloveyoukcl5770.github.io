<div class="author_box author-info">
	<div class="author-avatar">
		<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), 80 ); ?>
		</a>
	</div><!-- .author-avatar -->

	<div class="author-description author_text">
		<h3 class="author-title">
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
			<?php echo get_the_author(); ?>
			</a>
		</h3>

		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
		</p><!-- .author-bio -->

        <div class="social_icons_list">
            <?php if (get_the_author_meta('facebook') != "") { ?>
        			<a rel="nofollow" href="http://facebook.com/<?php echo get_the_author_meta('facebook') ?>" class="social_icon social_facebook social_icon_facebook" ><i class="fa fa-facebook"></i></a>
            <?php } ?>
            <?php if (get_the_author_meta('twitter') != "") {?>
        	 <a rel="nofollow" href="http://twitter.com/<?php echo get_the_author_meta('twitter') ?>" target="_blank" class="social_icon social_twitter social_icon_twitter"><i class="fa fa-twitter"></i></a>
            <?php } ?>

            <?php if (get_the_author_meta('gplus') != "") { ?>
        	 <a rel="nofollow" href="<?php echo get_the_author_meta('gplus') ?>" class="social_icon social_gplus social_icon_gplus"><i class="fa fa-google-plus"></i></a>
            <?php } ?>

            <?php if (get_the_author_meta('linkedin') != "") { ?>
        	     <a rel="nofollow" href="<?php echo get_the_author_meta('linkedin') ?>" target="_blank" class="social_icon social_linkedin social_icon_linkdin"><i class="fa fa-linkedin"></i></a>
            <?php } ?>
            <?php if (get_the_author_meta('pinterest') != "") {?>

  		     <a rel="nofollow" href="<?php echo get_the_author_meta('pinterest') ?>" class="social_icon social_pinterest social_icon_pinterest" target="_blank"><i class="fa fa-pinterest"></i></a>

            <?php } ?>
        </div>

	</div><!-- .author-description -->
</div><!-- .author-info -->
