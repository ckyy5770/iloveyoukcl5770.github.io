<?php get_header(); ?>


	<main class="main_content 404_page col-md-6">
		<header class="page-header page_header_404 page_404_main_title clearfix">
			<h1 class="page-title page_title_404 title"><?php _e( '404', 'asalah' ); ?></h1>
		</header><!-- .page-header -->

		<div class="content_wrapper_404">
			<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'asalah' ); ?></p>
			<?php get_search_form(); ?>
		</div>
	</main><!-- .main_content -->

	<!-- start site side container -->
	<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
	<aside class="side_content side_content_404 widget_area_404 widget_area col-md-6">
		<h3 class="screen-reader-text"><?php _e('404 Page Sidebar', 'asalah') ?></h3>
		<?php dynamic_sidebar( 'sidebar-3' ); ?>
	</aside>
	<?php endif; ?>
	<!-- end site side container .site_side_container -->

<?php get_footer(); ?>