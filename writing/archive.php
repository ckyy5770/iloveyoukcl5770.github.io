<?php
get_header(); ?>

	<main class="main_content archive_page_content <?php echo asalah_default_content_class(); ?>">

		<header class="page-header page_main_title clearfix">
			<?php
				the_archive_title( '<h1 class="page-title title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description"><span class="archive_arrow">&#8594;</span>', '</div>' );
			?>
		</header><!-- .page-header -->

		<?php if ( have_posts() ) : ?>

			<div class="blog_posts_wrapper blog_posts_list clearfix <?php echo asalah_blog_class(); ?>">
				<?php if ( is_home() && ! is_front_page() ) : ?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>
				<?php endif; ?>

				<?php

				get_template_part( 'content', get_post_format() );
				if (asalah_cross_option('asalah_pagination_style', $id) == 'ajax') { ?>
					<div class="ajax_content_container"></div>
				<?php }
				?>
			</div> <!-- .blog_posts_wrapper -->

			<?php
			$totalpages = '';
			if (asalah_cross_option('asalah_pagination_style', $id) == 'ajax') {
				$totalpages = $wp_query->max_num_pages;
			}
			asalah_pagination($id,$totalpages);

		else :
			get_template_part( 'content', 'none' );

		endif;

		?>
	</main><!-- .main_content -->

	<?php if ((asalah_option('asalah_sidebar_position') != 'none')): ?>
		<?php if (!((asalah_cross_option('asalah_site_width') < 701) && (asalah_cross_option('asalah_site_width') > 499) )) { ?>
		<aside class="side_content widget_area <?php echo asalah_default_sidebar_class(); ?>">
			<?php get_sidebar(); ?>
		</aside>
		<?php } ?>
	<?php endif; ?>

<?php get_footer(); ?>