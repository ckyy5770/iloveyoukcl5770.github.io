<?php
/*
 * Template Name: Blog Page
 */
get_header();

// add option to classes to avoid the need of resetting the query in after query
$sidebar_postition = asalah_cross_option('asalah_sidebar_position');
$sidebar_class = asalah_sidebar_class();
?>
    <h4 class="page-title screen-reader-text"><?php _e( 'Blog Posts', 'asalah' ); ?></h4>
    <main class="main_content <?php echo asalah_content_class(); ?>">

        <?php
        if ( get_query_var('paged') ) {
            $paged = get_query_var('paged');
        } elseif ( get_query_var('page') ) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        $wp_query = new WP_Query(array('post_type' => 'post', 'paged' => $paged));

        if ( have_posts() ) :
            $current_page_id = $post->ID;
            ?>

            <div class="blog_posts_wrapper blog_posts_list clearfix <?php echo asalah_blog_class(); ?>">

                <?php

                get_template_part( 'content', get_post_format() );
                ?>
                <div class="ajax_content_container"></div>
            </div> <!-- .blog_posts_wrapper -->

            <?php
            $totalpages = '';
            if (asalah_cross_option('asalah_pagination_style', $id) == 'ajax') {
              $totalpages = $wp_query->max_num_pages;
            }
            asalah_pagination($current_page_id, $totalpages);

        else :
            get_template_part( 'content', 'none' );

        endif;
        ?>

    </main><!-- .main_content -->
    <?php if ($sidebar_postition != 'none' ): ?>
        <aside class="side_content widget_area <?php echo esc_attr($sidebar_class); ?>">
            <?php get_sidebar(); ?>
        </aside>
    <?php endif; ?>

<?php get_footer(); ?>