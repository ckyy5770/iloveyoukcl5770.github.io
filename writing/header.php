<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php if (asalah_option('asalah_fav_icon')): ?>
		<link rel="shortcut icon" href="<?php echo asalah_option("asalah_fav_icon"); ?>" title="Favicon" />
	<?php endif; ?>
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	<script>(function(){document.documentElement.className='js'})();</script>


	<?php
	if (!class_exists('WPSEO_Meta')) {

	?> <!-- start open graph tags tags --> <?php

	if (asalah_option('asalah_fb_id')): ?>
	<meta property="fb:app_id" content="<?php echo asalah_option('asalah_fb_id'); ?>" />
	<?php endif; // end checking for asalah_fb_id

	$og_page_type = "website";
	if (is_single()) {
		$og_page_type = "article";
	}
	?>

    <meta property="og:type" content="<?php echo esc_attr($og_page_type); ?>" />


    <?php if (is_single() || is_page() ): ?>
    	<meta property="og:title" content="<?php echo get_the_title(); ?>" />
    	<meta property="og:url" content="<?php echo get_the_permalink(); ?>" />
	<?php elseif (is_archive() && !is_author()): ?>
		<meta property="og:title" content="<?php echo get_the_archive_title(); ?>" />
	<?php elseif(is_home() || is_front_page() ): ?>
		<meta property="og:title" content="<?php echo bloginfo('name'); ?>" />
		<meta property="og:url" content="<?php echo esc_url( home_url( '/' ) ); ?>" />
    <?php endif; ?>

    <?php if( ( is_single() || is_page() ) && has_post_thumbnail() ):

    $og_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );
    ?>
    <meta property="og:image" content="<?php echo esc_url($og_image_url[0]); ?>" />
	<?php else:
		if (asalah_cross_option('asalah_default_share_thumb')) { ?>
			<meta property="og:image" content="<?php echo esc_url(asalah_cross_option('asalah_default_share_thumb')); ?>" />
		<?php } elseif (asalah_cross_option('asalah_default_logo')) { ?>
			<meta property="og:image" content="<?php echo esc_url(asalah_cross_option('asalah_default_logo')); ?>" />
		<?php } ?>
	<?php endif; ?>
	<?php
	$og_description = get_bloginfo( 'description' );
	if ( is_single() || is_page() ) {
		$og_description = get_post_field('post_excerpt', $post->ID);
	} elseif (is_archive()) {
		if (get_the_archive_description() != '') {
			$og_description = get_the_archive_description();
		} else {
			$og_description = get_bloginfo( 'description' );
		}
	}elseif (asalah_option('asalah_site_description')) {
		$og_description = asalah_option('asalah_site_description');
	}

	if ($og_description != ''):
	?>
    <meta property="og:description" content="<?php echo esc_attr($og_description); ?>" />
	<?php endif; ?>
  <?php } //end meta tags if yoast plugin isn't used ?>

	<?php wp_head(); ?>
	<?php do_action('asalah_custom_header'); ?>
</head>

<body <?php body_class(); ?>>

<?php if (asalah_option('asalah_fb_id')): ?>
    <!-- Load facebook SDK -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/<?php echo get_locale(); ?>/sdk.js#xfbml=1&version=v2.7&appId=<?php echo asalah_option('asalah_fb_id'); ?>";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <!-- End Load facebook SDK -->
<?php endif;
?>

<?php if ((asalah_option('asalah_reading_progress') == "yes") && (is_single())) : ?>
	<progress value="0" id="reading_progress" <?php if (asalah_cross_option('asalah_sticky_menu') == 'yes') { echo 'class="progress_sticky_header"';}?>></progress>
<?php endif;?>

<?php if (asalah_cross_option('asalah_sticky_menu') == "yes") { ?>

			<!-- top menu area -->
			<div class="sticky_header">
			<div class="top_menu_wrapper">
				<div class="container">

					<div class="mobile_menu_button">
						<span class="mobile_menu_text"><?php echo _x( 'Menu', 'Used for mobile menu.', 'asalah' ); ?></span>
						<span>-</span><span>-</span><span>-</span>
					</div>

					<div class="top_header_items_holder">

						<?php if ( has_nav_menu( 'primary' ) ) : ?>
							<div class="main_menu pull-left">
								<?php
								wp_nav_menu(array(
										'container' => 'div',
										'container_class' => 'main_nav',
										'theme_location' => 'primary',
										'menu_class' => 'nav navbar-nav',
										'fallback_cb' => '',
										'walker' => new wp_bootstrap_navwalker(),
										));
								?>
							</div>
						<?php endif; ?>

						<div class="header_icons pull-right text_right">
							<!-- start header social icons -->
							<?php echo asalah_social_icons_list('header_social_icons pull-left'); ?>
							<!-- end header social icons -->


								<?php if ( (is_active_sidebar( 'sidebar-2' )) || ((intval(asalah_cross_option('asalah_site_width')) < 701) && (intval(asalah_cross_option('asalah_site_width')) > 499) && (asalah_option('asalah_sidebar_position') != 'none')) ) : ?>
									<?php if ( asalah_option('asalah_header_avatar') ): ?>
										<div class="header_info_wrapper">
													<a id="user_info_icon" class="user_info_avatar user_info_avatar_image user_info_button" href="#">
														<img class="img-responsive" src="<?php echo  asalah_option('asalah_header_avatar') ;?>">
													</a>
										</div>
									<?php else: ?>
										<div class="header_info_wrapper">
											<a id="user_info_icon" class="user_info_avatar user_info_avatar_icon user_info_button skin_color_hover" href="#">
												<i class="fa fa-align-center"></i>
											</a>
										</div>
									<?php endif; ?>
								<?php endif; ?>

							<!-- start search box -->
							<div class="header_search pull-right">
									<?php get_template_part( 'header', 'searchform' ); ?>
							</div>
							<!-- end search box -->
						</div>
					</div> <!-- end .top_header_items_holder -->

				</div>
			</div>
			<!-- top menu area -->
		</div>

<?php } ?>
<div id="page" class="hfeed site">



	<!-- start site main container -->
	<div class="site_main_container<?php if (asalah_option('asalah_enable_post_background_color')) {echo ' container bg-color'; } ?>">
		<!-- header -->

		<header class="site_header">
			<!-- top menu area -->
<?php if (asalah_cross_option('asalah_sticky_menu') == 'yes') { ?>
		<div class="invisible_header"></div>
	<?php } else { ?>
			<div class="top_menu_wrapper">
				<div class="container">

					<div class="mobile_menu_button">
						<span class="mobile_menu_text"><?php echo _x( 'Menu', 'Used for mobile menu.', 'asalah' ); ?></span>
						<span>-</span><span>-</span><span>-</span>
					</div>

					<div class="top_header_items_holder">

						<?php if ( has_nav_menu( 'primary' ) ) : ?>
							<div class="main_menu pull-left">
								<?php
								wp_nav_menu(array(
								    'container' => 'div',
								    'container_class' => 'main_nav',
								    'theme_location' => 'primary',
								    'menu_class' => 'nav navbar-nav',
								    'fallback_cb' => '',
								    'walker' => new wp_bootstrap_navwalker(),
								    ));
								?>
							</div>
						<?php endif; ?>

						<div class="header_icons pull-right text_right">
							<!-- start header social icons -->
							<?php echo asalah_social_icons_list('header_social_icons pull-left'); ?>
							<!-- end header social icons -->

							<!-- start search box -->
							<div class="header_search pull-right">
							    <?php get_template_part( 'header', 'searchform' ); ?>
							</div>
							<!-- end search box -->
						</div>
					</div> <!-- end .top_header_items_holder -->

				</div>
			</div>
			<!-- top menu area -->
<?php } ?>
			<!-- header logo wrapper -->
			<div class="header_logo_wrapper <?php if (asalah_cross_option('asalah_boxed_header')) { echo 'container';} ?> <?php if (asalah_cross_option('asalah_sticky_logo') == "yes") { echo 'sticky_logo';}?>">
				<div class="container">
					<div class="logo_wrapper">
						<?php if ( asalah_option('asalah_default_logo') ):

							$is_retina_logo = " no_retina_logo";

							// logo size
							$logo_width = 'auto';
							$logo_height = 'auto';
							$logo_size_att = '';
							$logo_style_att = '';

							if (asalah_option('asalah_logo_width') && asalah_option('asalah_logo_width') != 0) {
								$logo_width = strval(asalah_option('asalah_logo_width'));
								$logo_size_att .= ' width="'.strval(asalah_option('asalah_logo_width')).'px"';
								$logo_style_att .= '.site_logo_image { width : '.$logo_width.'px; }';
							}

							if (asalah_option('asalah_logo_height') && asalah_option('asalah_logo_height') != 0) {
								$logo_height = strval(asalah_option('asalah_logo_height'));
								$logo_size_att .= ' height="'.strval(asalah_option('asalah_logo_height')).'px"';
								$logo_style_att .= '.site_logo_image { height : '.$logo_height.'px; }';
							}

							if ($logo_style_att != '') {
								echo '<style>';
									echo esc_attr($logo_style_att);
								echo '</style>';
							}

							if (asalah_option('asalah_default_logo_retina')) {
								$is_retina_logo = " has_retina_logo";
						?>
								<a class="asalah_logo retina_logo" title="<?php bloginfo( 'name' ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<img <?php echo $logo_size_att; ?> src="<?php echo asalah_option('asalah_default_logo_retina'); ?>" class="site_logo img-responsive site_logo_image pull-left clearfix" alt="<?php bloginfo( 'name' ); ?>" />
								</a>
							<?php } // end asalah_default_logo_retina ?>

							<a class="asalah_logo default_logo <?php echo esc_attr($is_retina_logo); ?>" title="<?php bloginfo( 'name' ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img <?php echo $logo_size_att; ?> src="<?php echo asalah_option('asalah_default_logo'); ?>" class="site_logo img-responsive site_logo_image pull-left clearfix" alt="<?php bloginfo( 'name' ); ?>" />
							</a>
							<h1 class="screen-reader-text site_logo site-title pull-left clearfix"><?php bloginfo( 'name' ); ?></h1>
						<?php else: ?>
							<h1 class="site_logo site-title pull-left clearfix"><a title="<?php bloginfo( 'name' ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a><span class="logo_dot skin_color">.</span></h1>

							<?php
							$description = get_bloginfo( 'description' );
							$tagline_class = 'title_tagline_beside';
							if ( $description && ( asalah_option('asalah_show_tagline') == 'below' || asalah_option('asalah_show_tagline') == 'beside' ) ) :
								$tagline_class = 'title_tagline_'.asalah_option('asalah_show_tagline');
							?>
								<p class="<?php echo $tagline_class; ?> logo_tagline site_tagline"><?php echo $description; ?></p>
							<?php endif; ?>
						<?php endif; // end if asalah_default_logo ?>
					</div>
					<div class="header_info_wrapper">

						<!-- <a id="user_info_icon" class="user_info_icon user_info_button skin_color_hover" href="#">
							<i class="fa fa-align-center"></i>
						</a> -->

						<?php if ( (is_active_sidebar( 'sidebar-2' )) || ((intval(asalah_cross_option('asalah_site_width')) < 701) && (intval(asalah_cross_option('asalah_site_width')) > 499) && (asalah_option('asalah_sidebar_position') != 'none')) ) : ?>
							<?php if ( asalah_option('asalah_header_avatar') ): ?>
								<a id="user_info_icon" class="user_info_avatar user_info_avatar_image user_info_button" href="#">
									<img class="img-responsive" src="<?php echo  asalah_option('asalah_header_avatar') ;?>">
								</a>
							<?php else: ?>
								<a id="user_info_icon" class="user_info_avatar user_info_avatar_icon user_info_button skin_color_hover" href="#">
									<i class="fa fa-align-center"></i>
								</a>
							<?php endif; ?>
						<?php endif; ?>

					</div>
					<?php if ( has_nav_menu( 'asalah-secondary-menu' ) ) : ?>
					<div class="main_menu secondary-menu pull-left">
						<?php wp_nav_menu( array(
						'theme_location' => 'asalah-secondary-menu',
						'container' => 'div',
						'container_class' => 'main_nav',
						'menu_class' => 'nav navbar-nav',
						'fallback_cb' => '',
						'walker' => new wp_bootstrap_navwalker(), ) ); ?>

					</div>
					<?php endif; ?>
				</div>

			</div>
			<!-- header logo wrapper -->
<?php if (asalah_cross_option('asalah_sticky_logo') == "yes") { ?>
<div class="invisible_header_logo"></div>
<?php } ?>
		</header>
		<!-- header -->

		<!-- start stie content -->
		<section id="content" class="site_content">
			<div class="container">
				<div class="row">
