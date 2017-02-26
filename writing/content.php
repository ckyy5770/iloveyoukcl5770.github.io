<?php
	$blog_thumbnail_size = 'full_blog';
	$asalah_content = '';

	if ( asalah_cross_option('asalah_post_excerpt_limit') == '') {
		$excerpt_limit = 80;
		if ((asalah_cross_option('asalah_blog_style') == 'masonry') ) {
			$excerpt_limit = 30;
		}elseif (asalah_cross_option('asalah_blog_style') == 'list') {
			$excerpt_limit = 36;
			if ( (asalah_cross_option('asalah_sidebar_position') != 'none') ) {
				$excerpt_limit = 25;
			}
		}

	}
	else {
			$excerpt_limit = asalah_cross_option('asalah_post_excerpt_limit');
	}



	if (asalah_cross_option('asalah_blog_style') == 'masonry' ) {
		$blog_thumbnail_size = 'masonry_blog';
	}elseif (asalah_cross_option('asalah_blog_style') == 'list') {
		$blog_thumbnail_size = 'list_blog';
	}

	$blog_style = 'default';
	if (asalah_cross_option('asalah_blog_style')) {
		$blog_style = asalah_cross_option('asalah_blog_style');
	}

	$article_tag = 'article';
	if (is_single() || is_page() ) {
		$article_tag = 'div';
	}

	if (asalah_option('asalah_blog_image_crop') == 'no' && $blog_style != 'list') {
		$blog_thumbnail_size = '';
	}

	if (asalah_option('asalah_single_thumb_crop') == 'no') {
		if ((is_page() && !is_page_template( 'blog' ))) {
		$blog_thumbnail_size = '';
		}
	}

	if (isset($ajaxpost_id)) {

			if ( asalah_cross_option('asalah_post_excerpt_limit', $ajaxpost_id) == '') {
				$excerpt_limit = 80;
				if ((asalah_cross_option('asalah_blog_style', $ajaxpost_id) == 'masonry') ) {
					$excerpt_limit = 30;
				}elseif (asalah_cross_option('asalah_blog_style', $ajaxpost_id) == 'list') {
					$excerpt_limit = 36;
					if ( (asalah_cross_option('asalah_sidebar_position', $ajaxpost_id) != 'none') ) {
						$excerpt_limit = 25;
					}
				}

			}
			else {
					$excerpt_limit = asalah_cross_option('asalah_post_excerpt_limit', $ajaxpost_id);
			}



			if (asalah_cross_option('asalah_blog_style', $ajaxpost_id) == 'masonry' ) {
				$blog_thumbnail_size = 'masonry_blog';
			}elseif (asalah_cross_option('asalah_blog_style', $ajaxpost_id) == 'list') {
				$blog_thumbnail_size = 'list_blog';
			}

			$blog_style = 'default';
			if (asalah_cross_option('asalah_blog_style', $ajaxpost_id)) {
				$blog_style = asalah_cross_option('asalah_blog_style', $ajaxpost_id);
			}

			$article_tag = 'article';
			if (is_single($ajaxpost_id) || is_page($ajaxpost_id) ) {
				$article_tag = 'div';
			}

			if (asalah_option('asalah_blog_image_crop', $ajaxpost_id) == 'no' && $blog_style != 'list') {
				$blog_thumbnail_size = '';
			}

			if (asalah_option('asalah_single_thumb_crop', $ajaxpost_id) == 'no') {
				if ((is_page($ajaxpost_id) && !is_page_template( 'blog' ))) {
				$blog_thumbnail_size = '';
				}
			}
	}


	while ( have_posts() ) : the_post(); ?>
		<<?php echo esc_attr($article_tag); ?> id="post-<?php the_ID(); ?>" <?php post_class('blog_post_container'); ?> >

			<?php
				if (is_page() && asalah_cross_option('asalah_show_title') != 'no') {
					?>
					<header class="page-header page_main_title clearfix">
						<?php
							the_title( '<h1 class="entry-title title post_title">', '</h1>' );
						?>
					</header><!-- .page-header -->
					<?php
				}
			?>


			<div class="blog_post clearfix">
				<?php
				/* if blog style is masonry bring post thumbnail before post title */
				if ( !is_single() && $blog_style == 'masonry' ) {
					asalah_blog_post_banner($blog_thumbnail_size);
				}elseif ( !is_single() && ( $blog_style == 'list' || $blog_style == 'banners' ) ) {
					?>
					<div class="posts_list_wrapper clearfix">
						<div class="post_thumbnail_wrapper">
							<?php
							if ($blog_style == "banners")  {
								asalah_blog_post_banner($blog_thumbnail_size);
							}else{
								asalah_post_thumbnail($blog_thumbnail_size);
							}
							?>
						</div>
						<div class="post_info_wrapper"> <!-- use this wrapper in list style only to group all info far from thumbnail wrapper -->
				<?php } ?>


				<?php if (!asalah_cross_option('asalah_single_title_above_featured')) { ?>
				<?php if ( is_single() && get_post_format() != false ) { ?>
					<?php asalah_blog_post_banner(); ?>
				<?php }	?>
				<?php } ?>

				<?php if (!is_page()) : ?>
					<div class="blog_post_title">
						<?php
						if ( is_single() ) :
							if ( asalah_cross_option('asalah_show_title') != 'no'):
								the_title( '<h1 class="entry-title title post_title">', '</h1>' );
							endif;
						else :
							the_title( sprintf( '<h2 class="entry-title title post_title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
						endif;
						?>
					</div>
				<?php endif; ?>

				<?php if (asalah_cross_option('asalah_show_meta') != 'no'): ?>
				<div class="blog_post_meta clearfix">
					<?php
						asalah_post_meta();
						edit_post_link( __( 'Edit', 'asalah' ), '<span class="blog_meta_item edit_link">', '</span>' );
					?>
				</div>
				<?php endif; ?>

				<?php
				/* if blog style is not masonry put post thumbnail after title and meta */
				if ( !is_single() && $blog_style == 'default' ) {
					asalah_blog_post_banner($blog_thumbnail_size);
				}
				?>

				<?php if (asalah_cross_option('asalah_single_title_above_featured')) { ?>
				<?php if ( is_single() && get_post_format() != false ) { ?>
					<?php asalah_blog_post_banner(); ?>
					<script type="text/javascript">
						jQuery('.blog_posts_wrapper.blog_posts_single .blog_post_banner').addClass('undertitle');
					</script>
				<?php }	?>
				<?php } ?>

				<div class="entry-content blog_post_text blog_post_description">
					<?php
						if (is_single() || is_page()):
						    /* translators: %s: Name of current post */
						    the_content( sprintf(
						    	__( 'Continue reading %s', 'asalah' ),
						    	the_title( '<span class="screen-reader-text">', '</span>', false )
						    ) );

						    wp_link_pages( array(
						    	'before'      => '<div class="page-links clearfix">',
						    	'after'       => '</div>',
						    	'link_before' => '<span>',
						    	'link_after'  => '</span>',
						    	'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'asalah' ) . ' </span>%',
						    	'separator'   => '<span class="screen-reader-text">, </span>',
						    ) );
						else:

                            if (asalah_cross_option('asalah_post_content_show') != 'no') {
							    						if (asalah_cross_option('asalah_post_excerpt') != "disabled"):
																if (asalah_cross_option('asalah_custom_description') != '') {
																	$asalah_content = asalah_cross_option('asalah_custom_description');
																} else {
																	$asalah_content = '<p>'.asalah_excerpt($excerpt_limit).'</p>';
																}
                              else:
                                    $asalah_content = '<p>'.get_the_content().'</p>';
                              endif;

                            }
														echo $asalah_content;
						endif;
					?>

				</div>

					<div class="blog_post_control clearfix">
						<?php if ( !is_single() && !is_page() && $blog_style !== 'masonry' ) : ?>

							<?php if (asalah_cross_option('asalah_cont_read_show') != 'no') { ?>
								<?php if ((asalah_cross_option('asalah_post_excerpt') != 'disabled') || (asalah_cross_option('asalah_post_content_show') != 'yes')) { ?>

								<?php if ((strpos($asalah_content, 'class="more_link more_link_dots"') != false) || (asalah_cross_option('asalah_custom_description') != '')) { ?>
									<?php $readmore_text = (asalah_cross_option('asalah_cont_read_text')) ? __(asalah_cross_option('asalah_cont_read_text'), 'asalah') : __('Continue Reading', 'asalah') ; ?>
                  <div class="blog_post_control_item blog_post_readmore">
                      <?php echo sprintf( '<a href="%1$s" class="read_more_link">%2$s</a>', esc_url( get_permalink() ), $readmore_text ); ?>
                  </div>
								<?php }  ?>
									<?php } else if ((asalah_cross_option('asalah_post_excerpt') == 'disabled') && (asalah_cross_option('asalah_post_content_show') != 'no') && (strpos(get_the_content(), 'class="more_link more_link_dots"'))) { ?>
										<?php $readmore_text = (asalah_cross_option('asalah_cont_read_text')) ? __(asalah_cross_option('asalah_cont_read_text'), 'asalah') : __('Continue Reading', 'asalah') ; ?>
	                  <div class="blog_post_control_item blog_post_readmore">
	                      <?php echo sprintf( '<a href="%1$s" class="read_more_link">%2$s</a>', esc_url( get_permalink() ), $readmore_text ); ?>
	                  </div>
              <?php } ?>
							<?php } ?>
						<?php endif; ?>

				<?php if (asalah_cross_option('asalah_show_share') != 'no'): ?>
						<?php
						if ( is_single() || (!is_single() && $blog_style !== 'masonry') ):
							asalah_post_share();
						endif;
						?>
				<?php endif; ?>
					</div>

				<?php if ( !is_single() && ( $blog_style == 'list' || $blog_style == 'banners' ) ) { ?>
						</div> <!-- .post_info_wrapper close post_info_wrapper in cas of list style-->
					</div> <!-- .posts_list_wrapper -->
				<?php } ?>

			</div>
		</<?php echo esc_attr($article_tag); ?>><!-- #post-## -->
	<?php
	endwhile;
?>

<!-- Reading progress bar -->
<?php if (asalah_option('asalah_reading_progress') == "yes") {
	if ( is_single()) {
			?>

			<script type="text/javascript">
			jQuery(document).ready( function($) {
				if ('max' in document.createElement('progress')) {

							var getMax = function(){
						 return $(document).height() - $(window).height() - $('.top_menu_wrapper').height();
				 }

				 var getValue = function(){
						 return $(window).scrollTop() - $('.top_menu_wrapper').height();
				 }
				var progressBar = $('#reading_progress');

				progressBar.attr({ max: getMax() });

				$(document).on('scroll', function(){
						progressBar.attr({ value: getValue(), max: getMax() });
				});

				$(window).resize(function(){
						// On resize, both Max/Value attr needs to be calculated
						progressBar.attr({ max: getMax(), value: getValue() });
				});

				$('a.btn').click(function(){
					// On resize, both Max/Value attr needs to be calculated
					progressBar.attr({ max: getMax(), value: getValue() });
				});

				} else {

				var progressBar = $('.reading-progress-bar');
				var max = getMax();
				var value;
				var width;

				var getWidth = function() {
						value = getValue();
						width = (value/max) * 100;
						width = width + '%';
						return width;
				}

				var setWidth = function(){
						progressBar.css({ width: getWidth() });
				}

				$(document).on('scroll', setWidth);
				$(window).on('resize', function(){
						max = getMax();
						setWidth();
				});
				}


			});
			</script>
		<?php }} ?>