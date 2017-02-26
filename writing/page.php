<?php get_header(); ?>

	<main class="main_content <?php echo asalah_content_class(); ?>">
		<div class="blog_posts_wrapper blog_single blog_page_single">

		<?php
			get_template_part( 'content', get_post_format() );

			if (asalah_cross_option('show_author_box') != 'no') {
				get_template_part( 'author', 'bio' );
			}

			if (asalah_post_option('asalah_enable_facebook_comments') === 'yes'): ?>
			    <div id="fb-root"></div>
			    <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
					<?php if (asalah_cross_option('asalah_facebook_comments_html5') == "no" ) : ?>
				    <fb:comments href="<?php the_permalink(); ?>" width="<?php if (asalah_cross_option("asalah_facebook_comments_width") != '') { echo asalah_cross_option("asalah_facebook_comments_width"); } else {echo '100%';} ?>"  num-posts="<?php echo asalah_cross_option('asalah_facebook_comments_num'); ?>" ></fb:comments>
					<?php elseif (asalah_cross_option('asalah_facebook_comments_html5') == "yes" ) : ?>
						<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-numposts="<?php echo asalah_cross_option("asalah_facebook_comments_num"); ?>" data-width="<?php if (asalah_cross_option("asalah_facebook_comments_width") != '') { echo asalah_cross_option("asalah_facebook_comments_width"); } else {echo '100%';} ?>"></div>
					<?php endif; ?>

			<?php endif;

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		?>

		</div><!-- .blog_posts_wrapper -->
	</main><!-- .main_content -->

	<?php if ((asalah_cross_option('asalah_sidebar_position') != 'none')  && is_active_sidebar( 'sidebar-1' )): ?>
		<?php if (!((asalah_cross_option('asalah_site_width') < 701) && (asalah_cross_option('asalah_site_width') > 499) )) { ?>
		<aside class="side_content widget_area <?php echo asalah_sidebar_class(); ?>">
			<?php get_sidebar(); ?>
		</aside>
		<?php } ?>
	<?php endif; ?>

<?php get_footer(); ?>