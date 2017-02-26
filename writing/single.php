<?php get_header(); ?>
	<main class="main_content <?php echo asalah_content_class(); ?>">
		<div class="blog_posts_wrapper blog_single blog_posts_single">

		<?php
			get_template_part( 'content', get_post_format() );

			if (asalah_cross_option('show_author_box') != 'no') {
				get_template_part( 'author', 'bio' );
			}

			add_theme_support('post-thumbnails');
			add_image_size( 'post_nav_thumb', 60, 60, true );
			$posts_not_in = array($post->ID);

			if ( asalah_option('asalah_show_posts_navigation') != 'no') {
				$next_post = get_next_post();
				$prev_post = get_previous_post();

				if (!empty($prev_post) || !empty($next_post)) {
					echo "<section class='post_navigation'><div class='row'>";
					echo '<h3 class="screen-reader-text">'.__('Post Navigation', 'asalah').'</h3>';

					if (!empty( $prev_post )) {
						array_push($posts_not_in, $prev_post->ID);
						$has_post_thumbnail = 'has_post_thumbnail';
						if (!has_post_thumbnail($prev_post->ID)) {
							$has_post_thumbnail = 'no_post_thumbnail';
						}
						?>
						<div class="post_navigation_item post_navigation_prev <?php echo esc_attr($has_post_thumbnail); ?> <?php if (is_rtl()) { echo 'pull-left'; } ?> col-md-6">
							<a class="post_navigation_arrow" href="<?php echo get_the_permalink($prev_post->ID); ?>" title="<?php echo get_the_title($prev_post->ID) ?>" rel="prev">
							<i class="fa fa-angle-double-left"></i>
							</a>
							<div class="post_thumbnail_wrapper">
								<a href="<?php echo get_the_permalink($prev_post->ID); ?>" title="<?php echo get_the_title($prev_post->ID) ?>" rel="prev">
								<?php echo get_the_post_thumbnail($prev_post->ID, array( 60, 60, true), array("class" => "img-responsive") ); ?>
								</a>
							</div>
							<div class="post_info_wrapper">
								<a href="<?php echo get_the_permalink($prev_post->ID); ?>" title="<?php echo get_the_title($prev_post->ID) ?>" rel="prev">
								<span class="post_navigation_title title"><?php _e('Previous Post:', 'asalah') ?></span>
								</a>
								<h4 class="title post_title"><a href="<?php echo get_the_permalink($prev_post->ID); ?>"><?php echo get_the_title($prev_post->ID) ?></a></h4>
								<p></p>
							</div>
						</div>
						<?php
					}

					if (!empty( $next_post )) {
						array_push($posts_not_in, $next_post->ID);
						$has_post_thumbnail = 'has_post_thumbnail';
						if (!has_post_thumbnail($next_post->ID)) {
							$has_post_thumbnail = 'no_post_thumbnail';
						}
						?>
						<div class="post_navigation_item post_navigation_next <?php echo esc_attr($has_post_thumbnail); ?> <?php if (!is_rtl()) { echo 'pull-right'; } ?> col-md-6">
							<a class="post_navigation_arrow" href="<?php echo get_the_permalink($next_post->ID); ?>" title="<?php echo get_the_title($next_post->ID) ?>" rel="next">
							<i class="fa fa-angle-double-right"></i>
							</a>
							<div class="post_thumbnail_wrapper">
								<a href="<?php echo get_the_permalink($next_post->ID); ?>" title="<?php echo get_the_title($next_post->ID) ?>" rel="next">
								<?php echo get_the_post_thumbnail($next_post->ID, array( 60, 60, true), array("class" => "img-responsive") ); ?>
								</a>
							</div>
							<div class="post_info_wrapper">
								<a href="<?php echo get_the_permalink($next_post->ID); ?>" title="<?php echo get_the_title($next_post->ID) ?>" rel="next">
								<span class="post_navigation_title title"><?php _e('Next Post:', 'asalah') ?></span>
								</a>
								<h4 class="title post_title"><a href="<?php echo get_the_permalink($next_post->ID); ?>"><?php echo get_the_title($next_post->ID) ?></a></h4>
								<p></p>
							</div>
						</div>
						<?php
					}
					echo "</div></section>"; // end post_navigation and row
				}
			}

			// start related posts
			if (asalah_cross_option('asalah_show_related') != 'no') {
				$args = array('orderby' => 'rand', 'posts_per_page' => 3, 'ignore_sticky_posts' => 1, 'post__not_in' => $posts_not_in, 'meta_query' => array(array( 'key' => '_thumbnail_id', 'value'   => '', 'compare' => '!=', )) );
				$posts_relation_setting = asalah_cross_option('asalah_relation_posts');
				if ($posts_relation_setting != '') {
					if ($posts_relation_setting == 'category') {
						$categories = get_the_category($post->ID);
						foreach ( $categories as $category ) {
							if (isset($cats)) {
								$cats .= ','.$category->term_id;
							} else {
								$cats = $category->term_id;
							}
						}
						if ($cats != '') {
							$args['cat'] = $cats;
						}
					} else if ($posts_relation_setting == 'tag') {
						$posttags = get_the_tags($post->ID);
						if ($posttags) {
						  foreach($posttags as $tag) {
						    if (isset($tags)) {
									$tags .= ','.$tag->name;
								} else {
									$tags = $tag->name;
								}
						  }
							if ($tags != '') {
								$args['tag'] = $tags;
							}
						}
					} else if ($posts_relation_setting == 'author') {
						$authors = $post->post_author;
						if ($authors) {
								$args['author'] = $authors;
							}
					}

				} else {
					$categories = get_the_category($post->ID);
					foreach ( $categories as $category ) {
						if (isset($cats)) {
							$cats .= ','.$category->term_id;
						} else {
							$cats = $category->term_id;
						}
					}
					if ($cats != '') {
						$args['cat'] = $cats;
					}
				}

				$related_query = new WP_Query($args);
				if ($related_query->have_posts()):
					echo '<div class="post_related">';
						echo '<h3 class="related_title title">'.__('Related Posts', 'asalah').':</h3>';
						echo '<div class="row">';
						while ($related_query->have_posts()) : $related_query->the_post();
						?>
							<div id="post-<?php the_ID(); ?>" <?php post_class('blog_post_container col-md-4'); ?> >

								<div class="blog_post clearfix">
									<a title="<?php echo get_the_title(); ?>" href="<?php echo esc_url(get_permalink()); ?>">
										<?php asalah_post_thumbnail('masonry_blog'); ?>
									</a>

									<div class="blog_post_title">
										<?php
										the_title( sprintf( '<h4 class="entry-title title post_title"><a title="%s" href="%s">',the_title_attribute( 'echo=0' ), esc_url( get_permalink() ) ), '</a></h4>' );
										?>
									</div>

								</div>
							</div><!-- #post-## -->
						<?php
						endwhile;
						echo '</div>'; // end row
					echo '</div>';	// end post_related
				endif;
			}

			wp_reset_postdata();

			if (asalah_cross_option('asalah_enable_facebook_comments')): ?>
			    <div id="fb-root"></div>
			    <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
					<?php if (asalah_cross_option('asalah_facebook_comments_html5') == "no" ) : ?>
				    <fb:comments href="<?php the_permalink(); ?>" width="<?php if (asalah_cross_option("asalah_facebook_comments_width") != '') { echo asalah_cross_option("asalah_facebook_comments_width"); } else {echo '100%';} ?>" num-posts="<?php echo asalah_cross_option('asalah_facebook_comments_num'); ?>" ></fb:comments>
					<?php elseif (asalah_cross_option('asalah_facebook_comments_html5') == "yes" ) : ?>
						<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-numposts="<?php echo asalah_cross_option("asalah_facebook_comments_num"); ?>" data-width="<?php if (asalah_cross_option("asalah_facebook_comments_width") != '') { echo asalah_cross_option("asalah_facebook_comments_width"); } else {echo '100%';}  ?>"></div>
					<?php endif; ?>

			<?php endif;

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		?>

		</div><!-- .blog_posts_wrapper -->
	</main><!-- .main_content -->

	<?php if ((asalah_cross_option('asalah_sidebar_position') != 'none') && is_active_sidebar( 'sidebar-1' )): ?>
		<?php if (!((asalah_cross_option('asalah_site_width') < 701) && (asalah_cross_option('asalah_site_width') > 499) )) { ?>
		<aside class="side_content widget_area <?php echo asalah_sidebar_class(); ?>">
			<?php get_sidebar(); ?>
		</aside>
		<?php } ?>
	<?php endif; ?>


<?php get_footer(); ?>