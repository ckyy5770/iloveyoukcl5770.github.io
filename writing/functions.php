<?php
// global variables
$themename = "Writing";
define('theme_name', $themename);

if ( ! isset( $content_width ) ) {
	$content_width = 960;
}

$social_networks = array("facebook" => "Facebook", "twitter" => "Twitter", "google-plus" =>  "Google Plus", "behance" => "Behance", "dribbble" => "Dribbble", "linkedin" => "Linked In", "youtube" => "Youtube", 'vimeo-square' => 'Vimeo', "vk" => "VK", "vine" => "Vine", "digg" => "Digg", "skype" => "Skype", "instagram" => "Instagram", "pinterest" => "Pinterest", "github" => "Github", "bitbucket" => "Bitbucket", "stack-overflow" => "Stack Overflow", "renren" => "Ren Ren", "flickr" => "Flickr", "soundcloud" => "Soundcloud", "steam" => "Steam", "qq" => "QQ", "slideshare" => "Slideshare", "rss" =>  "RSS");


if ( ! function_exists( 'writing_setup' ) ) :
function writing_setup() {

	load_theme_textdomain( 'asalah', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );

 /* include customizer library */


 require "inc/fonts.php";
 require "inc/mods.php";

	/* --------
	add thumbnail sizes
	------------------------------------------- */
	add_theme_support( 'post-thumbnails' );
	if (asalah_option('asalah_single_thumb_crop') != 'no') {
		set_post_thumbnail_size( 825, 510, true );
	} else {
		set_post_thumbnail_size( 825, 510, false );
	}
	add_image_size('full_blog', 940, 400, true);
	add_image_size('single_full_blog', 940, 400, false);
	add_image_size('masonry_blog', 455, 310, true);
	add_image_size('list_blog', 267, 205, true);
	add_image_size('asalah_small_thumbnail', 50, 50, true);

	/* --------
	add html5 markup
	------------------------------------------- */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	));

	/* --------
	add post formats
	------------------------------------------- */
	add_theme_support( 'post-formats', array(
		'image', 'video', 'gallery', 'audio'
	));

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu' ),
			'asalah-secondary-menu' => __( 'Secondary Menu' ),
		)
	);

	/* --------
	add editor style
	------------------------------------------- */
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css' ) );
}
endif;
add_action( 'after_setup_theme', 'writing_setup' );



/* --------
options getters functions
------------------------------------------- */

if ( ! function_exists( 'asalah_option' ) ) :
function asalah_option($id) {
    if (!$id) {
    	return;
    }
    if (get_theme_mod($id) !== null ) {
        return get_theme_mod($id);
    }
}
endif;

if ( !function_exists( 'asalah_post_option' ) ) :
function asalah_post_option($id, $postid = '') {
    global $post;

    if ($post && $postid == '') {
        $post_id = $post->ID;
    } else {
        $post_id = $postid;
    }
    $post_meta = get_post_meta($post_id, $id, true);
    if (isset($post_meta)) {
        return $post_meta;
    }
}
endif;

if ( ! function_exists( 'asalah_cross_option' ) ) :
function asalah_cross_option($id, $postid = '') {
    global $post;

    if ($post && $postid == '') {
        $post_id = $post->ID;
    } else {
        $post_id = $postid;
    }

    if (asalah_option($id) && !asalah_post_option($id, $post_id)) {
        $output = asalah_option($id);
    }elseif(asalah_post_option($id, $post_id)) {
        $output = asalah_post_option($id, $post_id);
    }else{
        $output = null;
    }
    return $output;
}
endif;

/* --------
register widgets
------------------------------------------- */
function asalah_widgets_init() {
	register_sidebar(array(
	    'name' => __('Default sidebar', 'asalah'),
	    'id' => 'sidebar-1',
	    'description' => __('This is the default sidebar in your blog, add widgets here and it will appear on all pages have this sidebar'  , 'asalah'),
	    'before_widget' => '<div id="%1$s" class="widget_container widget_content widget %2$s clearfix">',
	    'after_widget' => "</div>",
	    'before_title' => '<h4 class="widget_title title"><span class="page_header_title">',
	    'after_title' => '</span></h4>',
	));

	register_sidebar(array(
	    'name' => __('Sliding Sidebar', 'asalah'),
	    'id' => 'sidebar-2',
	    'description' => __('This is the sliding side bar, it slides from the right side if you click on user info button'  , 'asalah'),
	    'before_widget' => '<div id="%1$s" class="widget_container widget_content widget %2$s clearfix">',
	    'after_widget' => "</div>",
	    'before_title' => '<h4 class="widget_title title"><span class="page_header_title">',
	    'after_title' => '</span></h4>',
	));

	register_sidebar(array(
	    'name' => __('404 page sidebar', 'asalah'),
	    'id' => 'sidebar-3',
	    'description' => __('Here you add widgets to 404 Error page'  , 'asalah'),
	    'before_widget' => '<div id="%1$s" class="widget_container widget_content widget %2$s clearfix">',
	    'after_widget' => "</div>",
	    'before_title' => '<h4 class="widget_title title"><span class="page_header_title">',
	    'after_title' => '</span></h4>',
	));

	register_sidebar(array(
	    'name' => __('Footer Widgets 1', 'asalah'),
	    'id' => 'footer-1',
	    'description' => '',
	    'before_widget' => '<div id="%1$s" class="widget_container widget_content widget %2$s clearfix">',
	    'after_widget' => "</div>",
	    'before_title' => '<h4 class="widget_title title"><span class="page_header_title">',
	    'after_title' => '</span></h4>',
	));

	register_sidebar(array(
	    'name' => __('Footer Widgets 2', 'asalah'),
	    'id' => 'footer-2',
	    'description' => '',
	    'before_widget' => '<div id="%1$s" class="widget_container widget_content widget %2$s clearfix">',
	    'after_widget' => "</div>",
	    'before_title' => '<h4 class="widget_title title"><span class="page_header_title">',
	    'after_title' => '</span></h4>',
	));

	register_sidebar(array(
	    'name' => __('Footer Widgets 3', 'asalah'),
	    'id' => 'footer-3',
	    'description' => '',
	    'before_widget' => '<div id="%1$s" class="widget_container widget_content widget %2$s clearfix">',
	    'after_widget' => "</div>",
	    'before_title' => '<h4 class="widget_title title"><span class="page_header_title">',
	    'after_title' => '</span></h4>',
	));

}
add_action( 'widgets_init', 'asalah_widgets_init' );

/* --------
enqueue asalah scripts and styles
------------------------------------------- */
function asalah_scripts() {
	/* --------
	add google fonts
	------------------------------------------- */
	$protocol = is_ssl() ? 'https' : 'http';
	if (asalah_cross_option('asalah_load_fonts_locally') != 'yes') {
	if ( !asalah_option('asalah_default_logo') ) {
		wp_enqueue_style( 'asalah-podkova', "$protocol://fonts.googleapis.com/css?family=Podkova:700" );
	}
	wp_enqueue_style( 'asalah-rokkit', "$protocol://fonts.googleapis.com/css?family=Rokkitt:400,700" );
	wp_enqueue_style( 'asalah-lora', "$protocol://fonts.googleapis.com/css?family=Lora:400,700&subset=latin,latin-ext" );
} else {
	if ( !asalah_option('asalah_default_logo') ) {
		wp_enqueue_style( 'asalah-podkova', get_template_directory_uri() . '/framework/googlefonts/podkova.css' );
	}
	wp_enqueue_style( 'asalah-rokkit', get_template_directory_uri() . '/framework/googlefonts/rokkitt.css' );
	wp_enqueue_style( 'asalah-lora', get_template_directory_uri() . '/framework/googlefonts/lora.css' );
}

	/* --------
	add theme styles
	------------------------------------------- */
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );

	if ( is_rtl() ) {
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/framework/bootstrap/css/bootstrap.css', array(), '1' );
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/framework/bootstrap/css/bootstrap.rtl.css', array(), '1' );
	}else{
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/framework/bootstrap/css/bootstrap.css', array(), '1' );
	}

	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/framework/font-awesome/css/font-awesome.min.css', array(), '1' );

	wp_enqueue_style( 'asalah-plugins', get_template_directory_uri() . '/pluginstyle.css', array(), '1' );

	if ( !is_rtl() ) {
		wp_enqueue_style( 'asalah-style', get_stylesheet_uri(), array(), '3.12');
	}

	wp_enqueue_style( 'asalah-ie', get_template_directory_uri() . '/css/ie.css', array( 'asalah-style' ), '1' );
	wp_style_add_data( 'asalah-ie', 'conditional', 'lt IE 9' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/* --------
	include theme scripts
	------------------------------------------- */
	// header scripts
	wp_enqueue_script( 'asalah-modernizr', get_template_directory_uri() . '/js/modernizr.js', array( 'jquery' ), '1' );

	// footer scripts
	wp_enqueue_script( 'asalah-bootstrap', get_template_directory_uri() . '/framework/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '1', true );
	wp_enqueue_script( 'asalah-script', get_template_directory_uri() . '/js/asalah.js', array( 'jquery' ), '3.12', true );
	// wp_enqueue_script( 'asalah-pinterest-script', '//assets.pinterest.com/js/pinit.js', array( 'jquery' ), '1', true );

	if (asalah_cross_option('asalah_pagination_style') == 'ajax') {
		global $wp_query;
		wp_enqueue_script( 'asalah-ajax-script', get_template_directory_uri() . '/js/ajaxpagination.js', array( 'jquery'), '3.12', true );

		// define js vars
		if (is_page()) {
			$writing_core_variables_array = array(
	        'ajax_load' =>  get_template_directory_uri() . '/ajax-load.php',
					'query_vars' => json_encode( array('page'=>''))
	    );
		} else {
	    $writing_core_variables_array = array(
	        'ajax_load' =>  get_template_directory_uri() . '/ajax-load.php',
					'query_vars' => json_encode( $wp_query->query )
	    );
		}

	    wp_localize_script( 'asalah-ajax-script', 'writing_core_vars', $writing_core_variables_array );
		}
}
add_action( 'wp_enqueue_scripts', 'asalah_scripts' );


function asalah_post_options_style() {
    wp_register_style('asalah_admin_css', get_template_directory_uri().'/admin-style.css', array(), '', 'all' );
    wp_enqueue_style('asalah_admin_css');
}
add_action('admin_enqueue_scripts', 'asalah_post_options_style');
/* --------
enqueue customizer live preview
------------------------------------------- */
function asalah_customizer_live_preview() {
    wp_enqueue_script( 'asalah-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'jquery', 'customize-preview' ), '1.5', true );
}
add_action( 'customize_preview_init', 'asalah_customizer_live_preview' );

/* Data validation */

function check_number( $value ) {
    $value = (int) $value; // Force the value into integer type.
    return ( 0 < $value ) ? $value : null;
}


/* --------
AJAX hits counter
------------------------------------------- */
if (asalah_cross_option('asalah_hits_counter') != 'no') {
	// Run this code on 'after_theme_setup', when plugins have already been loaded.
	add_action('after_setup_theme', 'asalah_hits_counter');
	// This function loads the plugin.
	function asalah_hits_counter() {

		if (!class_exists('AJAX_Hits_Counter')) {
			// load Social if not already loaded
			include_once(TEMPLATEPATH.'/inc/ajax-hits-counter/ajax-hits-counter.php');
		}
	}
}
/* --------
post meta tags
------------------------------------------- */
if ( ! function_exists( 'asalah_post_meta' ) ) :
function asalah_post_meta() {
	if ( is_sticky() && is_home() && ! is_paged() ) {
		printf( '<span class="blog_meta_item sticky_post">%s</span>', __( 'Featured', 'asalah' ) );
	}

	$format = get_post_format();
	if ( current_theme_supports( 'post-formats', $format ) ) {

		switch ($format) {
			case 'audio':
				$format_icon = 'fa-music';
				break;
			case 'video':
				$format_icon = 'fa-video-camera';
				break;
			case 'image':
				$format_icon = 'fa-camera-retro';
				break;
			case 'aside':
				$format_icon = 'fa-align-left';
				break;
			case 'quote':
				$format_icon = 'fa-quote-left';
				break;
			case 'link':
				$format_icon = 'fa-external-link';
				break;
			case 'gallery':
				$format_icon = 'fa-photo';
				break;
			case 'status':
				$format_icon = 'fa-comment';
				break;
			case 'chat':
				$format_icon = 'fa-comments-o';
				break;
			default:
				$format_icon = '';
		}

		printf( '<span class="blog_meta_item blog_meta_format entry_format"><a href="%1$s">%2$s</a></span>',
			esc_url( get_post_format_link( $format )),
			sprintf( '<i class="fa %s"></i>',  $format_icon)
		);
	}

	if ( 'post' == get_post_type() ) {
		if (asalah_cross_option('asalah_show_categories') != 'no') {
				$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'asalah' ) );
				if ( $categories_list && asalah_categorized_blog() ) {
					printf( '<span class="blog_meta_item blog_meta_category">%1$s %2$s</span>',
						_x( 'In', 'Used before category names.', 'asalah' ),
						$categories_list
					);
				}
			}

		if (asalah_cross_option('asalah_show_tags') != 'no') {
			$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'asalah' ) );
			if ( $tags_list ) {
				printf( '<span class="blog_meta_item blog_meta_tags">%1$s %2$s</span>',
					_x( 'Tags', 'Used before tag names.', 'asalah' ),
					$tags_list
				);
			}
		}
	}

if (asalah_cross_option('asalah_show_date') != 'no') {
	if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date()
		);

		printf( '<span class="blog_meta_item blog_meta_date"><span class="screen-reader-text"></span>%1$s</span>', $time_string );
	}
}


    if ( ('post' == get_post_type()) && (asalah_cross_option('asalah_hits_counter') != 'no') ) {
		//if ( is_multi_author() ) {
			printf( '<span class="blog_meta_item blog_meta_views">%1$s %2$s</span>',
				ajax_hits_counter_get_hits(get_the_ID()),
                __('Views', 'asalah')
			);
		//}
	}

if (asalah_cross_option('asalah_show_comments_number') != 'no') {
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="blog_meta_item blog_meta_comments">';
		comments_popup_link( __( 'Leave a comment', 'asalah' ), __( '1 Comment', 'asalah' ), __( '% Comments', 'asalah' ) );
		echo '</span>';
	}
}

	if ( is_attachment() && wp_attachment_is_image() ) {
		// Retrieve attachment metadata.
		$metadata = wp_get_attachment_metadata();

		printf( '<span class="blog_meta_item"><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
			_x( 'Full size', 'Used before full size attachment link.', 'asalah' ),
			esc_url( wp_get_attachment_url() ),
			$metadata['width'],
			$metadata['height']
		);
	}

if (asalah_cross_option('asalah_show_author') != 'no') {
	if ( 'post' == get_post_type() ) {
		//if ( is_multi_author() ) {
			printf( '<span class="blog_meta_item blog_meta_author"><span class="author vcard"><a class="meta_author_avatar_url" href="%2$s">%1$s</a> <a class="url fn n" href="%2$s">%3$s</a></span></span>',
				get_avatar(get_the_author_meta('ID'), 25),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				get_the_author()
			);
		//}
	}
}


}
endif;

/* --------
post thumbnail
------------------------------------------- */
if ( ! function_exists( 'asalah_post_thumbnail' ) ) :
function asalah_post_thumbnail($size = 'full_blog') {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="blog_post_banner blog_post_image">
		<?php the_post_thumbnail($size); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>
	<div class="blog_post_banner blog_post_image">
		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php
				the_post_thumbnail( $size, array( 'alt' => get_the_title() ) );
			?>
		</a>
	</div>
	<?php endif; // End is_singular()
}
endif;

/* --------
post excerpt
------------------------------------------- */
if ( ! function_exists( 'asalah_excerpt_more' ) && ! is_admin() ) :
function asalah_excerpt_more( $more ) {
    if ( asalah_cross_option('asalah_post_excerpt_text')):
        $excerpt_text = ' '.asalah_cross_option('asalah_post_excerpt_text').' ';
    else:
        $excerpt_text = ' &hellip; ';
    endif;

	$more = sprintf( '<a href="%1$s" class="more_link more_link_dots">%2$s</a>', esc_url( get_permalink( get_the_ID() ) ), $excerpt_text );
	return $more;
}
add_filter( 'excerpt_more', 'asalah_excerpt_more', 999 );
endif;

function asalah_more_link($more_link, $more_link_text) {
	if ( asalah_cross_option('asalah_post_excerpt_text')):
			$excerpt_text = ' '.asalah_cross_option('asalah_post_excerpt_text').' ';
	else:
			$excerpt_text = ' &hellip; ';
	endif;

$more = sprintf( '<a href="%1$s" class="more_link more_link_dots">%2$s</a>', esc_url( get_permalink( get_the_ID() ) ), $excerpt_text );
return $more;
}
add_filter('the_content_more_link', 'asalah_more_link', 10, 2);

 function asalah_excerpt_length($more) {
		return 200;
}
add_filter('excerpt_length', 'asalah_excerpt_length', 999);

if ( ! function_exists( 'asalah_excerpt' ) ) :

function asalah_excerpt($limit) {

	if ( asalah_cross_option('asalah_post_excerpt_text')):
			$excerpt_text = ' '.asalah_cross_option('asalah_post_excerpt_text').' ';
	else:
			$excerpt_text = ' &hellip; ';
	endif;

$more = '<a href="'.esc_url( get_permalink( get_the_ID() ) ).'" class="more_link more_link_dots">'.$excerpt_text.'</a>';
	$content = get_the_excerpt();
	return wp_trim_words($content, $limit, $more);

}
endif;

/* --------
author contact methods
------------------------------------------- */

function change_contact_info($contactmethods) {
    unset($contactmethods['aim']);
    unset($contactmethods['yim']);
    unset($contactmethods['jabber']);
    unset($contactmethods['url']);
    unset($contactmethods['googleplus']);
    $contactmethods['twitter'] = 'Twitter';
    $contactmethods['facebook'] = 'Facebook';
    $contactmethods['linkedin'] = 'Linked In';
    $contactmethods['gplus'] = 'Google +';
    $contactmethods['pinterest'] = 'Pinterest';
    return $contactmethods;
}

add_filter('user_contactmethods','change_contact_info',10,1);

/* --------
facebook comments
------------------------------------------- */
if ( ! function_exists('asalah_facebook_comment_intgrate')):
function asalah_facebook_comment_intgrate() {
    if ( get_theme_mod('asalah_enable_facebook_comments')):
        if ( get_theme_mod('asalah_enable_facebook_comments') == true):
            if ( get_theme_mod('asalah_fb_id') != ""):
                $facebook_app = get_theme_mod('asalah_fb_id');
            elseif ( get_theme_mod('asalah_facebook_app_id')):
                    if ( get_theme_mod('asalah_facebook_app_id') != " "):
                        $facebook_app = get_theme_mod('asalah_facebook_app_id');
                    endif;
            endif;
						if (!isset($facebook_app)) { echo 'Facebook App ID is missing!'; return false;}
            $facebook_head_script = "<meta property='fb:app_id' content='".$facebook_app."' />";
            echo $facebook_head_script;
        endif;
    else:
        return;
    endif;
};
endif;
add_action( 'wp_head', 'asalah_facebook_comment_intgrate' );

/* --------
post comments
------------------------------------------- */
if ( ! function_exists( 'asalah_comment' ) ) :
function asalah_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;

    switch ($comment->comment_type) :
        case 'pingback' :
        case 'trackback' :
            ?>
            <li class="post pingback">
                <p><?php _e('Pingback: ', 'asalah'); ?> <?php comment_author_link(); ?> (<?php edit_comment_link(__('Edit', 'asalah'), '<span class="edit-link">', '</span>'); ?>)</p>
                <?php
                break;
        default :
                ?>
            <li <?php comment_class("media the_comment"); ?> id="comment-<?php comment_ID(); ?>">
                <a class="pull-left commenter" href="#">
                    <?php
                    $avatar_size = 50;
                    if ('0' != $comment->comment_parent)
                        $avatar_size = 50;

                    echo get_avatar($comment, $avatar_size);
                    ?>
                </a>
                <div class="media-body comment_body">
                	<div class="comment_content_wrapper">
	                    <div class="media-heading clearfix">
	                        <b class="commenter_name title"><?php echo get_comment_author_link(); ?></b>
	                        <div class="comment_info"><a class="comment_time" href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>"><time pubdate datetime="<?php echo get_comment_time('c'); ?>"><?php echo get_comment_date() . ' at ' . get_comment_time(); ?></time></a> <?php comment_reply_link(array_merge($args, array('reply_text' => "- ".__('Reply', 'asalah'), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></div>
	                    </div>

    		<?php
    		comment_text();
    		echo "</div>"; // end comment_content_wrapper
            break;

    endswitch;
}
endif;


/* --------
comments nav
------------------------------------------- */
if ( ! function_exists( 'asalah_comment_nav' ) ) :
function asalah_comment_nav() {
	// Are there comments to navigate through?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<nav class="navigation comment-navigation clearfix" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'asalah' ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'asalah' ) ) ) :
					printf( '<div class="comment-nav nav-previous">%s</div>', $prev_link );
				endif;

				if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'asalah' ) ) ) :
					printf( '<div class="comment-nav nav-next">%s</div>', $next_link );
				endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}
endif;

/* --------
layout classes, sidebar and content classes
------------------------------------------- */
if ( ! function_exists( 'asalah_default_sidebar_class' ) ) :
function asalah_default_sidebar_class() {

    if (asalah_option("asalah_sidebar_position") == "left") {
        $class = "col-md-3 pull-left";
    } else {
        $class = "col-md-3 pull-right";
    }
    return $class;
}
endif;

if ( ! function_exists( 'asalah_default_content_class' ) ) :
function asalah_default_content_class() {
    // first check sidebar position option from option panel
		if (is_active_sidebar( 'sidebar-1' )) {
			if ((intval(asalah_option('asalah_site_width')) < 701) && (intval(asalah_option('asalah_site_width') > 499))) {
				$class = "col-md-12";

			} elseif (asalah_option("asalah_sidebar_position") == "left") {
	        $class = "col-md-9 pull-right";
	    } elseif (asalah_option("asalah_sidebar_position") == "none") {
	        $class = "col-md-12";
	    } else {
	        $class = "col-md-9 pull-left";
	    }
		} else {
			$class = "col-md-12";
		}

    return $class;
}
endif;

if ( ! function_exists( 'asalah_sidebar_class' ) ) :
function asalah_sidebar_class($id = '') {
    global $post;

    if ($id == '') {
        $id = $post->ID;
    }

    // first check sidebar position option from option panel
		if (asalah_cross_option("asalah_sidebar_position", $id) == "left") {
        $class = "col-md-3 pull-left";
    } else {
        $class = "col-md-3 pull-right";
    }


    return $class;
}
endif;

if ( ! function_exists( 'asalah_content_class' ) ) :
function asalah_content_class($id = '') {
    global $post;
    if ($id == '') {
        $id = $post->ID;
    }

    // first check sidebar position option from option panel
		if (is_active_sidebar( 'sidebar-1' )) {
			if ((intval(asalah_cross_option('asalah_site_width')) < 701) && (intval(asalah_cross_option('asalah_site_width') > 499))) {
				$class = "col-md-12";

			} elseif (asalah_cross_option("asalah_sidebar_position", $id) == "left") {
	        $class = "col-md-9 pull-right";
	    } elseif (asalah_cross_option("asalah_sidebar_position", $id) == "none") {
	        $class = "col-md-12";
	    } else {
	        $class = "col-md-9 pull-left";
	    }
		} else {
			$class = "col-md-12";
		}

    return $class;
}
endif;

/* --------
default blog style
------------------------------------------- */
if ( ! function_exists( 'asalah_blog_class' ) ) :
function asalah_blog_class($id = '') {
    global $post;
    if ($id == '') {
        $id = $post->ID;
    }
    $class = '';
    if (asalah_cross_option('asalah_blog_style')) {
    	$class .= ' ' . asalah_cross_option('asalah_blog_style') . '_blog_style';
    }

    return $class;
}
endif;

/* --------
posts pagination
------------------------------------------- */
if ( ! function_exists( 'asalah_pagination' ) ) :
function asalah_pagination($id = '', $totalpages = '') {
    global $post;
    global $paged;
		$max = $totalpages;

    if ($post && $id == '') {
        $id = $post->ID;
    }

    $next_arrow = '<i class="fa fa-angle-right"></i>';
    $prev_arrow = '<i class="fa fa-angle-left"></i>';

    if ( is_rtl() ) {
    	$next_arrow = '<i class="fa fa-angle-left"></i>';
    	$prev_arrow = '<i class="fa fa-angle-right"></i>';
    }
    if (asalah_cross_option('asalah_pagination_style', $id) == 'num') {
		the_posts_pagination( array(
			'mid_size' => 2,
			'prev_text'          => $prev_arrow,
			'next_text'          => $next_arrow,
			'before_page_number' => '',
		) );
	} else if (asalah_cross_option('asalah_pagination_style', $id) == 'ajax') {

		if($max > 1) {
			$my_current_lang = apply_filters( 'wpml_current_language', NULL );
            $lang_data = '';
              if ($my_current_lang != '') {
                $lang_data = 'data-lang="'.$my_current_lang.'"';
              }
		echo '<div class="navigation_links ajax_load_more navigation_prev ajax_nav_container" data-cycle="1" data-posttype="post" data-postsperpage="'.get_option('posts_per_page').'" data-loopfile="content.php" data-totalpages="'.$max.'" data-loaderimage="'.get_template_directory_uri().'/images/loader.gif" '.$lang_data.'" data-pageid="'.$id.'"><a class="ajax_load_more" href="javascript: void(0)">'.__("Load More", "asalah").'</a></div><div class="hidden ajax_data_helper" data-newtotalpages="'.$max.'" ></div>';

		}
	} else{
    	if ( get_next_posts_link() ):
			echo '<div class="navigation_links navigation_next">';
			next_posts_link('Older Posts');
			echo '</div>';
		endif;

		if ( get_previous_posts_link() ):
			echo '<div class="navigation_links navigation_prev">';
			previous_posts_link('Newer Posts');
			echo '</div>';
		endif;
    }
}
endif;

/* --------
customizer style
------------------------------------------- */
function style_customizer_css() {
		/* Start Customizer Style */
		$output = '<style type="text/css">';
if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'carousel' )) {
		$output .= ".gallery {";
		$output .=  "margin-bottom: 1.6em;";
		$output .= "}";
		$output .= ".gallery-item {";
		$output .= "display: inline-block;";
		$output .= "padding: 1.79104477%;";
		$output .= "text-align: center;";
		$output .= "vertical-align: top;";
		$output .= "width: 100%;";
		$output .= "}";
		$output .= ".gallery-columns-2 .gallery-item {";
		$output .= "max-width: 50%;";
		$output .= "}";
		$output .= ".gallery-columns-3 .gallery-item {";
		$output .= "max-width: 33.33%;";
		$output .= "}";
		$output .= ".gallery-columns-4 .gallery-item {";
		$output .= "max-width: 25%;";
		$output .= "}";
		$output .= ".gallery-columns-5 .gallery-item {";
		$output .= "max-width: 20%;";
		$output .= "}";
		$output .= ".gallery-columns-6 .gallery-item {";
		$output .= "max-width: 16.66%;";
		$output .= "}";
		$output .= ".gallery-columns-7 .gallery-item {";
		$output .= "max-width: 14.28%;";
		$output .= "}";
		$output .= ".gallery-columns-8 .gallery-item {";
		$output .= "max-width: 12.5%;";
		$output .= "}";
		$output .= ".gallery-columns-9 .gallery-item {";
		$output .= "max-width: 11.11%;";
		$output .= "}";
		$output .= ".gallery-icon img {";
		$output .= "margin: 0 auto;";
		$output .= "}";
		$output .= ".gallery-caption {";
		$output .= "color: #707070;";
		$output .= "color: rgba(51, 51, 51, 0.7);";
		$output .= "display: block;";
		$output .= "font-family: 'Lora', sans-serif;";
		$output .= "font-size: 12px;";
		$output .= "font-size: 1.2rem;";
		$output .= "line-height: 1.5;";
		$output .= "padding: 0.5em 0;";
		$output .= "}";
		$output .= ".gallery-columns-6 .gallery-caption,";
		$output .= ".gallery-columns-7 .gallery-caption,";
		$output .= ".gallery-columns-8 .gallery-caption,";
		$output .= ".gallery-columns-9 .gallery-caption {";
		$output .= "display: none;";
		$output .= "}";
}

		/* Site Width */


		if (asalah_cross_option('asalah_after_the_kartha') != 'true') {
			if (!(asalah_cross_option('asalah_site_width')) || (asalah_cross_option('asalah_site_width') > 989)) {
				set_theme_mod( 'asalah_site_width', 910 );
				set_theme_mod( 'asalah_after_the_kartha', 'true' );
			}
		}
		if ((asalah_cross_option('asalah_site_width')) && (asalah_cross_option('asalah_site_width') > 499) ) {
			$output .= "@media screen and (min-width: ". asalah_cross_option('asalah_site_width') ."px) {";
			$output .= '.container { width:'. asalah_cross_option('asalah_site_width') .'px; }';
			$output .= "}";

		}

		if (!(asalah_cross_option('asalah_site_width')) && (intval(asalah_cross_option('asalah_site_width')) > 992)) {
			$output .= "@media screen and (min-width: 992px) {";
				$output .= ".container {";
				  $output .= "width: 910px;";
				$output .= "}";

				$output .= ".main_content.col-md-9 {";
					$output .= "width: 695px;";
					$output .= "padding-right: 30px;";
				$output .= "}";

				$output .= ".main_content.col-md-9.pull-right {";
					$output .= "padding-right: 15px;";
					$output .= "padding-left: 30px;";
				$output .= "}";

				$output .= ".side_content.col-md-3 {";
					$output .= "padding-left: 0;";
					$output .= "width: 295px;";
				$output .= "}";

				$output .= ".side_content.col-md-3.pull-left {";
					$output .= "padding-left: 15px;";
					$output .= "padding-right: 0;";
				$output .= "}";
			$output .= "}";
		}


		if (intval(asalah_cross_option('asalah_logo_font_size')) > 0) {
			$output .= ".site_logo a { font-size: ".asalah_cross_option('asalah_logo_font_size')."px;}";
		}
		/*Main Site Style */

		if (asalah_option('asalah_enable_body_background_color') || get_theme_mod('asalah_main_font_type') || asalah_option('asalah_enable_main_text_color') || (asalah_option('asalah_main_font_size')) || (asalah_option('asalah_main_line_height'))) {
			$output .= 'body {';

				if (asalah_option('asalah_enable_body_background_color') == true ) {
					$output .= "background-color:".asalah_option('asalah_body_background_color').";";
				}

				if ( get_theme_mod('asalah_main_font_type')) {
					$body_font_type = customizer_library_get_font_stack(get_theme_mod('asalah_main_font_type'));

					$output .= "font-family:".$body_font_type.";";
				}

				if (asalah_option('asalah_enable_main_text_color') == true) {
					$body_font_color = asalah_option('asalah_main_text_color');

					$output .= "color:".$body_font_color.";";
				}

				if ((asalah_option('asalah_main_font_size')) && (asalah_option('asalah_main_font_size') != 'false')) {
					$output .= "font-size:".asalah_option('asalah_main_font_size')."px;";
				}

				if ((asalah_option('asalah_main_line_height')) && (asalah_option('asalah_main_line_height') != 'false')) {
					$output .= "line-height:".asalah_option('asalah_main_line_height')."px;";
				}

			$output .= "}";

			if (!asalah_option('asalah_enable_top_menu_color') && asalah_option('asalah_enable_body_background_color') ) {
				$output .= ".dropdown-menu { background-color: ".asalah_option('asalah_body_background_color').";}";
			}
		}

		/* End Body class and start another class depends on body font color */

		if (isset($body_font_color)) {
			$output .= ".site_content a, .dropdown-menu .current-menu-ancestor, .dropdown-menu .current-menu-ancestor > a, .dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus, .dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus, .title, .nav > li > a, h3.comment-reply-title, h1, h2, h3, h4, h5, h6, .header_social_icons a, .main_nav .current-menu-item, .main_nav .current-menu-item > a, .main_nav .current-menu-ancestor, .main_nav .current-menu-ancestor > a, #wp-calendar thead th {color:".$body_font_color.";}";
		}

		/* End Main Site Style */

		if (asalah_option('asalah_enable_text_hover_color') == true) {
			$title_hover_color = asalah_option('asalah_text_hover_color');

			$output .= ".title a:hover, .post_navigation_item .post_info_wrapper .post_title a:hover {color:".$title_hover_color.";}";
		}

		 /* Start Content Style */
		 if (asalah_option('asalah_enable_post_background_color')) {
			 $output .= '.bg-color {';

				 if (asalah_option('asalah_enable_post_background_color') == true) {
					  $post_bg_color = asalah_option('asalah_post_background_color');

					 $output .= "background-color:".$post_bg_color.";";
				 }

			 $output .= '}';

		 }


		/* End Content Style */


		/* Start Header Style */
		if ((asalah_option('asalah_header_height') != 0) || (asalah_option('asalah_header_background')) || (asalah_option('asalah_enable_header_color')) || (asalah_option('asalah_enable_header_text_color'))) {
			$output .= ".header_logo_wrapper {";

				if ( asalah_option('asalah_header_height') != 0) {
					$header_height = strval(asalah_option('asalah_header_height'));

					$output .= "height:".$header_height."px;";
				}

				if ( asalah_option('asalah_header_background')) {
		        $header_background = asalah_option('asalah_header_background');

						$output .= "background: url('".$header_background."');";

						/* in case that height height not set, set padding for style */
						if (!isset($header_height)) {
							$output .= "padding: 10px 0;";
						}


							if (asalah_option('asalah_header_background_style') == 'tiled') {
								$output .= "background-repeat: repeat;";
							} else if (asalah_option('asalah_header_background_style') == 'cover') {
								$output .= "background-size: cover; background-repeat: no-repeat;";
							} else {
								$output .= "background-repeat: no-repeat;";
							}

		    }

				if (asalah_option('asalah_enable_header_color') == true ) {
					$header_bg_color = asalah_option('asalah_header_color');

					$output .= "background-color:".$header_bg_color.";";

					/* in case that height height not set, set padding for style */
					if (!isset($header_height)) {
						$output .= "padding: 10px 0;";
					}

				}

				if (asalah_option('asalah_enable_header_text_color') == true ) {
					$header_font_color = asalah_option('asalah_header_text_color');

					$output .= "color:".$header_font_color.";";
				}

			$output .= "}";
		}

		if (asalah_option('asalah_enable_header_hover_color') == true ) {
			$header_hover_color = asalah_option('asalah_header_hover_color');

			$output .= ".header_logo_wrapper a:hover {color:".$header_hover_color." !important;}";
		}

		/* End header_logo_wrapper class and start another classes depends on header style settings */

		if ( isset($header_font_color)) {
			$output .= ".header_logo_wrapper a, .header_logo_wrapper .nav > li > a {color:".$header_font_color.";}";
		}

		/* End Header Style */

		/* Start Logo Style */

			// remove logo dot if enabled
		 if ( true == asalah_option('asalah_remove_logo_dot')){
				 $output .= ".logo_dot {";
				 	$output .= "display: none;";
				 $output .= "}";
		 }

		 // center logo
		 if ( true == asalah_cross_option('asalah_center_logo')) {
				 $output .= ".logo_wrapper {";
					 $output .= "width: auto;";
					 $output .= "float: none;";
					 $output .= "text-align: center;";
				 $output .= "}";

				 $output .= ".site_logo, .site_logo a {";
					 $output .= "display: inline-block;";
					 $output .= "float: none!important;";
				 $output .= "}";
		 }


		/* End Logo Style */

		/* Start Top Menu Style */

		$output .= ".top_menu_wrapper, .header_search > form.search .search_text, .sticky_header .top_menu_wrapper {";

			if (asalah_option('asalah_enable_top_menu_color') == true) {
				$top_bg_color = asalah_option('asalah_top_menu_color');

				$output .= "background-color:". $top_bg_color .";";

			} else if (asalah_option('asalah_enable_body_background_color')) {
				$top_bg_color = asalah_option('asalah_body_background_color');

				$output .= "background-color:". $top_bg_color .";";

			}


		$output .= "}";

		if (asalah_option('asalah_enable_top_menu_color') == true) {
			$output .= ".dropdown-menu { background-color: ".asalah_option('asalah_top_menu_color').";}";
		}

		if (asalah_option('asalah_enable_top_menu_hover_color') == true ) {
			$top_hover_color = asalah_option('asalah_top_menu_hover_color');

			$output .= ".top_menu_wrapper a:hover, .top_menu_wrapper a:hover, .header_search:hover, .top_menu_wrapper .nav > li > a:hover, .header_search input:hover[type='text'], .dropdown-menu > li > a:hover {color:".$top_hover_color." !important;}";
		}


		/* End top menu Wrapper Class and start other classes depends on Top Menu Style */

		if (isset($top_bg_color)) {

			$output .= ".header_search, .sticky_header .header_info_wrapper { border-color:". $top_bg_color .";}";
		}

		if (asalah_option('asalah_enable_top_menu_text_color') == true) {
			$top_text_color = asalah_option('asalah_top_menu_text_color');

			$output .= ".top_menu_wrapper a, .header_search, .top_menu_wrapper .nav > li > a, .header_search input[type='text'], .dropdown-menu > li > a { color:".$top_text_color.";}";
			$output .= ".header_search ::-webkit-input-placeholder { /* WebKit, Blink, Edge */color:".$top_text_color.";}";
		}

		/* End Top Menu Style */

		/* Start Headlines Style */

		/* General Headline */
		if (get_theme_mod('asalah_head_font_type')) {
			$output .= "h1,h2,h3,h4,h5,h6 {";

				if (get_theme_mod('asalah_head_font_type')) {
					$headline_font_type = customizer_library_get_font_stack(get_theme_mod('asalah_head_font_type'));

					$output .= "font-family:". $headline_font_type ."!important;";
				}

			$output .= "}";
		}

		/* Headlines Sizes */

		if ((asalah_option('asalah_h1_font_size')) && (asalah_option('asalah_h1_font_size') != 'false')) {
			$h1_size = asalah_option('asalah_h1_font_size');

			$output .= "h1, .page_main_title .title, .blog_single .blog_post_title .title, .main_content.col-md-12 .blog_single .blog_post_title .title {font-size:". $h1_size ."px;}";
		}

			if ((asalah_option('asalah_h2_font_size')) && (asalah_option('asalah_h2_font_size') != 'false')) {
				$h2_size = asalah_option('asalah_h2_font_size');

				$output .= "h2, .blog_posts_wrapper.masonry_blog_style .blog_post_title .title, .main_content.col-md-9 .blog_posts_wrapper.list_blog_style .blog_post_title .title, .blog_post_title .title {font-size:". $h2_size ."px;}";
			}

				if ((asalah_option('asalah_h3_font_size')) && (asalah_option('asalah_h3_font_size') != 'false')) {
					$h3_size = asalah_option('asalah_h3_font_size');

					$output .= "h3 {font-size:". $h3_size ."px;}";
				}

					if ((asalah_option('asalah_h4_font_size')) && (asalah_option('asalah_h4_font_size') != 'false')) {
						$h4_size = asalah_option('asalah_h4_font_size');

						$output .= "h4 {font-size:". $h4_size ."px;}";
					}

						if ((asalah_option('asalah_h5_font_size')) && (asalah_option('asalah_h5_font_size') != 'false')) {
							$h5_size = asalah_option('asalah_h5_font_size');

							$output .= "h5 {font-size:". $h5_size ."px;}";
						}

							if ((asalah_option('asalah_h6_font_size')) && (asalah_option('asalah_h6_font_size') != 'false')) {
								$h6_size = asalah_option('asalah_h6_font_size');

								$output .= "h6 {font-size:". $h6_size ."px;}";
							}

		/* End Headline Styles */

		/* Headlines Sizes */

		if ((asalah_option('asalah_h1_line_height')) && (asalah_option('asalah_h1_line_height') != 'false')) {
			$h1_size = asalah_option('asalah_h1_line_height');

			$output .= "h1 {line-height:". $h1_size ."px;}";
		}

			if ((asalah_option('asalah_h2_line_height')) && (asalah_option('asalah_h2_line_height') != 'false')) {
				$h2_size = asalah_option('asalah_h2_line_height');

				$output .= "h2, .blog_posts_wrapper.masonry_blog_style .blog_post_title .title, .main_content.col-md-9 .blog_posts_wrapper.list_blog_style .blog_post_title .title, .blog_post_title .title {line-height:". $h2_size ."px;}";
			}

				if ((asalah_option('asalah_h3_line_height')) && (asalah_option('asalah_h3_line_height') != 'false')) {
					$h3_size = asalah_option('asalah_h3_line_height');

					$output .= "h3 {line-height:". $h3_size ."px;}";
				}

					if ((asalah_option('asalah_h4_line_height')) && (asalah_option('asalah_h4_line_height') != 'false')) {
						$h4_size = asalah_option('asalah_h4_line_height');

						$output .= "h4 {line-height:". $h4_size ."px;}";
					}

						if ((asalah_option('asalah_h5_line_height')) && (asalah_option('asalah_h5_line_height') != 'false')) {
							$h5_size = asalah_option('asalah_h5_line_height');

							$output .= "h5 {line-height:". $h5_size ."px;}";
						}

							if ((asalah_option('asalah_h6_line_height')) && (asalah_option('asalah_h6_line_height') != 'false')) {
								$h6_size = asalah_option('asalah_h6_line_height');

								$output .= "h6 {line-height:". $h6_size ."px;}";
							}

		/* End Headline Styles */


		/* Start Blog Style */
		if ((get_theme_mod('asalah_blog_font_type')) || (asalah_option('asalah_blog_font_size')) || (asalah_option('asalah_blog_line_height'))) {
			$output .= ".main_content.col-md-12 .blog_single .blog_post_text, .main_content.col-md-9 .blog_single .blog_post_text {";

				if ( get_theme_mod('asalah_blog_font_type')) {
					$blog_font_type = customizer_library_get_font_stack(get_theme_mod('asalah_blog_font_type'));

					$output .= "font-family:". $blog_font_type .";";
				}

				if ((asalah_option('asalah_blog_font_size')) && (asalah_option('asalah_blog_font_size') != 'false')) {
					$blog_font_size = asalah_option('asalah_blog_font_size');

					$output .= "font-size:". $blog_font_size ."px;";
				}

				if ((asalah_option('asalah_blog_line_height')) && (asalah_option('asalah_blog_line_height') != 'false')) {
					$blog_line_height = asalah_option('asalah_blog_line_height');

					$output .= "line-height:". $blog_line_height ."px;";
				}

			$output .= "}";
		}

		/* Start Blog Description Style */
		if ((get_theme_mod('asalah_blog_font_type')) || (asalah_option('asalah_blog_description_font_size')) || (asalah_option('asalah_blog_description_line_height'))) {
			$output .= ".main_content.col-md-12 .blog_posts_list .blog_post_text, .blog_post_description, .blog_posts_wrapper.masonry_blog_style .blog_post_description, .main_content.col-md-12 .blog_posts_wrapper.list_blog_style.blog_posts_list .blog_post_text, .blog_posts_wrapper.list_blog_style .blog_post_description p {";

				if ( get_theme_mod('asalah_blog_font_type')) {
					$blog_font_type = customizer_library_get_font_stack(get_theme_mod('asalah_blog_font_type'));

					$output .= "font-family:". $blog_font_type .";";
				}

				if ((asalah_option('asalah_blog_description_font_size')) && (asalah_option('asalah_blog_description_font_size') != 'false')) {
					$blog_font_size = asalah_option('asalah_blog_description_font_size');

					$output .= "font-size:". $blog_font_size ."px;";
				}

				if ((asalah_option('asalah_blog_description_line_height')) && (asalah_option('asalah_blog_description_line_height') != 'false')) {
					$blog_line_height = asalah_option('asalah_blog_description_line_height');

					$output .= "line-height:". $blog_line_height ."px;";
				}

			$output .= "}";
		}

		/* Start Menu Font Style */
		if ((get_theme_mod('asalah_menu_font_type')) || (asalah_option('asalah_menu_font_size')) || (asalah_option('asalah_menu_line_height'))) {
			$output .= ".nav > li > a, .dropdown-menu > li > a {";

				if ( get_theme_mod('asalah_menu_font_type')) {
					$blog_font_type = customizer_library_get_font_stack(get_theme_mod('asalah_menu_font_type'));

					$output .= "font-family:". $blog_font_type .";";
				}

				if ((asalah_option('asalah_menu_font_size')) && (asalah_option('asalah_menu_font_size') != 'false')) {
					$blog_font_size = asalah_option('asalah_menu_font_size');

					$output .= "font-size:". $blog_font_size ."px;";
				}

				if ((asalah_option('asalah_menu_line_height')) && (asalah_option('asalah_menu_line_height') != 'false')) {
					$blog_line_height = asalah_option('asalah_menu_line_height');

					$output .= "line-height:". $blog_line_height ."px;";
				}

			$output .= "}";
		}

		/* End Blog Style */

		/* Start Main Color Styles */

		if (asalah_option( 'asalah_main_color' )) {
	    $color = asalah_option( 'asalah_main_color' );

			// start color

    	$output .='.skin_color, .skin_color_hover:hover, a, .user_info_button:hover, .header_social_icons a:hover, .blog_post_meta .blog_meta_item a:hover, .widget_container ul li a:hover, .asalah_post_gallery_nav_container ul.flex-direction-nav > li a:hover:before, .post_navigation_item:hover a.post_navigation_arrow, .comment_body p a:hover, .author_text .social_icons_list a:hover, .author_text .social_icons_list a:active {';
        $output .="color: " . $color . ";";
      $output .="}";

    	// start background color
			$output .='.skin_bg, .skin_bg_hover:hover, .blog_post_control_item a:hover, .widget_container.asalah-social-widget .widget_social_icon:hover, .tagcloud a:hover {';
	      $output .="background-color: " . $color . ";";
	    $output .="}";

      // start border color
			$output .='.skin_border, .blog_post_control_item a, .navigation.pagination .nav-links .page-numbers:hover, .navigation.pagination .nav-links .page-numbers.current, .navigation_links a:hover {';
		    $output .="border-color: " . $color . ";";
	    $output .="}";

      // start border left color
			$output .='.skin_border_left {';
        $output .="border-left-color: " . $color . ";";
      $output .="}";

      // start border right color
			$output .='.skin_border_right {';
        $output .="border-right-color: " . $color . ";";
      $output .="}";

      // start border top color
			$output .='.skin_border_top {';
      	$output .="border-top-color: " . $color . ";";
      $output .="}";

			// start reading progress bar color
			$output .= "progress[value]::-webkit-progress-value {";
				$output .= "background-color:". $color .";";
			$output .= "}";

			$output .= "progress[value]::-moz-progress-bar {";
				$output .= "background-color:". $color .";";
			$output .= "}";

      // start border top color
			$output .= '.skin_border_bottom, .comment_body p a:hover {';
        $output .= "border-bottom-color: " . $color . ";";
      $output .= "}";
		}

		/* End Main Color Styles */

		/* Start Custom CSS */

			if (asalah_option('asalah_enable_custom_css')) {
				$custom_css = asalah_option('asalah_custom_css_code');

				$output .= $custom_css;
			}

		/* End Custom CSS */

    $output .= '</style>';
		/* End Customizer Styles */

		echo $output;
}
add_action( 'wp_head', 'style_customizer_css' );

/*---------
Custom Script Javascript
---------------------------------------------*/

function script_customizer_js() {
    if (!asalah_option('asalah_enable_custom_js')) {
    	return;
    }

    $custom_js = json_encode(asalah_option('asalah_custom_js_code'));

    echo '<script type="text/javascript">'.json_decode($custom_js).'</script>';

}
add_action( 'wp_footer', 'script_customizer_js' );

/*---------
Custom Background and header
---------------------------------------------*/

add_theme_support('custom-background');
add_theme_support( "custom-header");

/* --------
post share
------------------------------------------- */
if ( ! function_exists( 'asalah_post_share' ) ) :
function asalah_post_share() {

		$image_url = '';
		if (has_post_thumbnail() ) {
			$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
			$image_url = $image_url[0];
		}

		$pinterest_title = str_replace(' ', '%20', get_the_title() );
		$pinterest_media = '';
		$pinterest_media_sep = '';
		if ($image_url != '') {
			$pinterest_media_sep = '&amp;media=';
			$pinterest_media =  $image_url;

		}
        ?>
        <div class="blog_post_control_item blog_post_share">
        	<span class="share_item share_sign"><i class="fa fa-share <?php if (is_rtl()) { echo 'fa-flip-horizontal';} ?>"></i></span>

					<?php if (asalah_cross_option('asalah_facebook_share') != 'no') { ?>
        	<span class="social_share_item_wrapper"><a rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="share_item share_item_social share_facebook" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>', 'facebook-share-dialog', 'width=626,height=436');
                                return false;"><i class="fa fa-facebook"></i></a></span>
					<?php } ?>

					<?php if (asalah_cross_option('asalah_twitter_share') != 'no') { ?>
        	<span class="social_share_item_wrapper"><a rel="nofollow" href="https://twitter.com/share?url=<?php the_permalink(); ?>" target="_blank" class="share_item share_item_social share_twitter"><i class="fa fa-twitter"></i></a></span>
					<?php } ?>

					<?php if (asalah_cross_option('asalah_gplus_share') != 'no') { ?>
        	<span class="social_share_item_wrapper"><a rel="nofollow" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,
                                        '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
                                return false;" class="share_item share_item_social share_googleplus"><i class="fa fa-google-plus"></i></a></span>
					<?php } ?>

					<?php if (asalah_cross_option('asalah_linkedin_share') != 'no') { ?>
        	<span class="social_share_item_wrapper"><a rel="nofollow" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>" target="_blank" class="share_item share_item_social share_linkedin"><i class="fa fa-linkedin"></i></a></span>
					<?php } ?>

					<?php if (asalah_cross_option('asalah_pinterest_share') != 'no') { ?>
        	<span class="social_share_item_wrapper"><a rel="nofollow" href="https://www.pinterest.com/pin/create/button/?url=<?php the_permalink(); ?><?php echo esc_attr($pinterest_media_sep) . esc_url($pinterest_media); ?>&amp;description=<?php echo esc_attr($pinterest_title); ?>" class="share_item share_item_social share_pinterest" target="_blank"><i class="fa fa-pinterest"></i></a></span>
					<?php } ?>

					<?php if (asalah_cross_option('asalah_reddit_share') == 'yes') { ?>
					<span class="social_share_item_wrapper"><a rel="nofollow" href="https://reddit.com/submit?url=<?php the_permalink(); ?>" class="share_item share_item_social share_reddit" target="_blank"><i class="fa fa-reddit"></i></a></span>
					<?php } ?>

					<?php if (asalah_cross_option('asalah_tumblr_share') == 'yes') { ?>
					<span class="social_share_item_wrapper"><a rel="nofollow" href="https://www.tumblr.com/share/link?url=<?php the_permalink(); ?>" class="share_item share_item_social share_tumblr" target="_blank"><i class="fa fa-tumblr"></i></a></span>
					<?php } ?>

					<?php if (asalah_cross_option('asalah_vk_share') == 'yes') { ?>
        	<span class="social_share_item_wrapper"><a rel="nofollow" href="https://vk.com/share.php?url=<?php the_permalink(); ?>" class="share_item share_item_social share_vk" target="_blank"><i class="fa fa-vk"></i></a></span>
					<?php } ?>

					<?php if (asalah_cross_option('asalah_pocket_share') == 'yes') { ?>
					<span class="social_share_item_wrapper"><a class="share_item share_item_social share_pinterest" href="https://getpocket.com/save?url=<?php the_permalink(); ?>&title=<?php echo $pinterest_title; ?>" data-event-category="Social" data-event-action="Share:pocket"><i class="fa fa-get-pocket"></i></a></span>
					<?php } ?>

        </div>
        <?php
}
endif;

/* --------
get plog posts list
------------------------------------------- */
if ( ! function_exists( 'asalah_return_blogposts_list' ) ) :
function asalah_return_blogposts_list($num = "3", $thumb = 'thumbnail', $orderby = 'date', $cat = '', $tag_ids = '') {
    global $post;

    $args = array('posts_per_page' => $num, 'orderby' => $orderby);

    if ($tag_ids != '') {
        $tags = explode(',', $tag_ids);
        $tags_array = array();
        if (count($tags) > 0) {
            foreach ($tags as $tag) {
                if (!empty($tag)) {
                    $tags_array[] = $tag;
                }
            }
        }
        $args['tag_slug__in'] = $tags_array;
    }
    $wp_query = new WP_Query($args);

    $output = '';
    if ($wp_query->have_posts()) :
        $output .= '<ul class="post_list">';
        while ($wp_query->have_posts()) : $wp_query->the_post();
            $output .= '<li class="post_item clearfix">';

                $output .= '<div class="post_thumbnail_wrapper">';
                	$output .= '<a href="' . get_permalink() . '" title="' . get_the_title() . '">';
                		if (!has_post_thumbnail()) {
                			$post_title = get_the_title();
                			$output .= '<span class="post_text_thumbnail title">'.$post_title.'</span>';
                		}else{
                			$output .= get_the_post_thumbnail($post->ID, $thumb, array('class' => 'img-responsive'));
                		}
                	$output .= '</a>';
                $output .= '</div>'; // end post_thumnail and a

	            $output .= '<div class="post_info_wrapper">';
		            $output .= '<h5 class="title post_title"><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h5>';

		            $output .= '<span class="post_meta_item post_meta_time post_time">' . get_the_time(get_option('date_format')) . '</span>';
	            $output .= '</div>'; // end post_info
            $output .= '</li>'; // end post_item
        endwhile;
        $output .= '</ul>';
    endif;
    return $output;
}
endif;

/* --------
asalah latest tweets widget
------------------------------------------- */
if ( ! function_exists( 'asalah_twitter_tweets' ) ) :
function asalah_twitter_tweets($consumerkey = '', $consumersecret = '', $accesstoken = '', $accesstokensecret = '', $screenname = '', $tweets_count = 2) {

    if (empty($consumerkey) || empty($consumersecret) || empty($accesstokensecret) || empty($accesstoken)) {
        return __('Your twitter application info is not set correctly in option panel, please create please login to Twitter Application Manager here https://apps.twitter.com/ , create new application and new access token, then go to theme customizer social section and fill the data you got from Twitter application', 'asalah');
    } else {
        $twitter = new pencilTwitterOAuth($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);

        $tweets = $twitter->get('statuses/user_timeline', array('screen_name' => $screenname, 'count' => $tweets_count));

        $output = '';

        if (is_array($tweets) && !isset($tweets->errors)) {
            $i = 0;
            $lnk_msg = NULL;

            $output .= "<ul>";
            foreach ($tweets as $tweet) {

                $lnk_page = 'http://twitter.com/#!/' . $screenname;
                $page_name = $tweet->user->name;

                $msg = $tweet->text;

                if (is_array($tweet->entities->urls)) {
                    try {
                        if (array_key_exists('0', $tweet->entities->urls)) {
                            $lnk_msg = $tweet->entities->urls[0]->url;
                        } else {
                            $lnk_msg = NULL;
                        }
                    } catch (Exception $e) {
                        $lnk_msg = NULL;
                    }
                }



                $lnk_tweet = 'http://twitter.com/#!/' . $screenname . '/status/' . $tweet->id_str;


                /* Tweet Time */
                $time = strtotime($tweet->created_at);
                $delta = abs(time() - $time); /* in seconds */
                $result = '';
                if ($delta < 1) {
                    $result = ' just now';
                } elseif ($delta < 60) {
                    $result = $delta . ' seconds ago';
                } elseif ($delta < 120) {
                    $result = ' about a minute ago';
                } elseif ($delta < (45 * 60)) {
                    $result = ' about ' . round(($delta / 60), 0) . ' minutes ago';
                } elseif ($delta < (2 * 60 * 60)) {
                    $result = ' about an hour ago';
                } elseif ($delta < (24 * 60 * 60)) {
                	$timetext = sprintf( _n( 'an hour', '%s hours', round(($delta / 3600), 0), 'asalah' ), round(($delta / 3600), 0)) ;
                    $result = ' about ' . $timetext . ' ago';
                } elseif ($delta < (48 * 60 * 60)) {
                    $result = ' about a day ago';
                } elseif ($delta > (48 * 60 * 60) && $delta < (24 * 60 * 60 * 30)) {
                	$timetext = sprintf( _n( 'a day', '%s days', round(($delta / 86400), 0), 'asalah' ), round(($delta / 86400), 0)) ;
                	$result = ' about ' . $timetext . ' ago';
                } elseif ($delta > (24 * 60 * 60 * 30) && $delta < (24 * 60 * 60 * 30 * 12)) {
                	$timetext = sprintf( _n( 'a month', '%s months', round(($delta / 2592000), 0), 'asalah' ), round(($delta / 2592000), 0)) ;
                	$result = ' about ' . $timetext . ' ago';
                } elseif ($delta > (24 * 60 * 60 * 30 * 12)) {
                	$timetext = sprintf( _n( 'a year', '%s years', round(($delta / 31104000), 0), 'asalah' ), round(($delta / 2592000), 0)) ;
                	$result = ' about ' . $timetext . ' ago';
                }


                if ($i >= $tweets_count)
                    break;


                $output .= '<li class="tweet-item">';
                $output .= '<a rel="nofollow" target="_blank" href="' . $lnk_tweet . '" class="tweet_icon"><i class="fa fa-twitter"></i></a>';
                $output .= '<a target="_blank" class="tweet_name" href="' . $lnk_tweet . '">' . $page_name . '</a> ';

                $output .= '<span class="tweet_text">';
                $output .= asalah_make_clickable($msg);
                $output .= '</span>';

                $output .= '<div class="tweet_control">';
	                $output .= '<a rel="nofollow" href="' . $lnk_tweet . '" target="_blank" class="tweet_time">' . $result . '</a>';

	                $output .= '<span class="tweet_links">';
	                $output .= '<a class="tweet_link tweet_link_reply" href="http://twitter.com/intent/tweet?in_reply_to='.$tweet->id_str.'"><i class="fa fa-reply"></i></a>';
	                $output .= '<a class="tweet_link tweet_link_retweet" href="http://twitter.com/intent/retweet?tweet_id='.$tweet->id_str.'"><i class="fa fa-retweet"></i></a>';
	                $output .= '<a class="tweet_link tweet_link_retweet" href="http://twitter.com/intent/favorite?tweet_id='.$tweet->id_str.'"><i class="fa fa-star"></i></a>';
	                $output .= '</span>';
                $output .= '</div>'; // end tweet_control

	            $output .= '</li>';


                $i++;
            } /* foreach */

            $output .= "</ul>";
            $output .= '<script>
window.twttr=(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if(d.getElementById(id))return;js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;}(document,"script","twitter-wjs"));
</script>';
            return $output;
            if (!empty($output)) {
                //return; $output;
            }
        } else {
            if (isset($tweets->errors)):
                $output .= '<span class="tweet_error">Message: ' . $tweets->errors[0]->message . ', Please check your Twitter Authentication Data or internet connection.</span>';
            else:
                $output .= '<span class="tweet_error">Please check your internet connection.</span>';
            endif;

            if (!empty($output)) {
                return $output;
            }
        }
    }
}
endif;

/* --------
asalah wordpress gallery
------------------------------------------- */
if ( !(class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'carousel' ))) {
	remove_shortcode('gallery');
}
if ( ! function_exists( 'asalah_gallery_shortcode' ) && !( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'carousel' ))) :
function asalah_gallery_shortcode( $attr ) {

		$post = get_post();

    static $instance = 0;
    $instance++;

    if ( ! empty( $attr['ids'] ) ) {
        // 'ids' is explicitly ordered, unless you specify otherwise.
        if ( empty( $attr['orderby'] ) ) {
            $attr['orderby'] = 'post__in';
        }
        $attr['include'] = $attr['ids'];
    }

    /**
     * Filter the default gallery shortcode output.
     *
     * If the filtered output isn't empty, it will be used instead of generating
     * the default gallery template.
     *
     * @since 2.5.0
     *
     * @see gallery_shortcode()
     *
     * @param string $output The gallery output. Default empty.
     * @param array  $attr   Attributes of the gallery shortcode.
     */
    $output = apply_filters( 'post_gallery', '', $attr );
    if ( $output != '' ) {
        return $output;
    }

    $html5 = current_theme_supports( 'html5', 'gallery' );
    $atts = shortcode_atts( array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post ? $post->ID : 0,
        'itemtag'    => $html5 ? 'figure'     : 'dl',
        'icontag'    => $html5 ? 'div'        : 'dt',
        'captiontag' => $html5 ? 'figcaption' : 'dd',
        'columns'    => 3,
        'size'       => 'thumbnail',
        'include'    => '',
        'exclude'    => '',
        'link'       => '',
        'type' => '', // this attribute has been added for post_foramts only
        'format_size' => 'full_blog', // this attribute has been added for post_foramts only
    ), $attr, 'gallery' );
    $format_size = $atts['format_size'];
    $id = intval( $atts['id'] );

    if ( ! empty( $atts['include'] ) ) {
        $_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( ! empty( $atts['exclude'] ) ) {
        $attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
    } else {
        $attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
    }

    if ( empty( $attachments ) ) {
        return '';
    }

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment ) {
            $output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
        }
        return $output;
    }

    $itemtag = tag_escape( $atts['itemtag'] );
    $captiontag = tag_escape( $atts['captiontag'] );
    $icontag = tag_escape( $atts['icontag'] );
    $valid_tags = wp_kses_allowed_html( 'post' );
    if ( ! isset( $valid_tags[ $itemtag ] ) ) {
        $itemtag = 'dl';
    }
    if ( ! isset( $valid_tags[ $captiontag ] ) ) {
        $captiontag = 'dd';
    }
    if ( ! isset( $valid_tags[ $icontag ] ) ) {
        $icontag = 'dt';
    }

    $columns = intval( $atts['columns'] );
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    $float = is_rtl() ? 'right' : 'left';

    $selector = "gallery-{$instance}";

    $gallery_style = '';

    /**
     * Filter whether to print default gallery styles.
     *
     * @since 3.1.0
     *
     * @param bool $print Whether to print default gallery styles.
     *                    Defaults to false if the theme supports HTML5 galleries.
     *                    Otherwise, defaults to true.
     */
    if ( apply_filters( 'use_default_gallery_style', ! $html5 ) ) {
        $gallery_style = "
        <style type='text/css'>
            #{$selector} {
                margin: auto;
            }
            #{$selector} .gallery-item {
                float: {$float};
                margin-top: 10px;
                text-align: center;
                width: {$itemwidth}%;
            }
            #{$selector} img {
                border: 2px solid #cfcfcf;
            }
            #{$selector} .gallery-caption {
                margin-left: 0;
            }
            /* see gallery_shortcode() in wp-includes/media.php */
        </style>\n\t\t";
    }

    $size_class = sanitize_html_class( $atts['size'] );
    $wrapper_class = 'filterable_grid';
    switch ($columns) {
        case 1:
            $column_class = "full_column";
            break;
        case 2:
            $column_class = "one_half";
            break;
        case 3:
            $column_class = "one_third";
            break;
        case 4:
            $column_class = "one_fourth";
            break;
        case 5:
            $column_class = "one_fifth";
            break;
        case 6:
            $column_class = "one_sixth";
            break;
        case 7:
            $column_class = "one_seventh";
            break;
        case 8:
            $column_class = "one_eighth";
            break;
        case 9:
            $column_class = "one_ninth";
            break;
        default:
            $column_class = "one_fourth";
    }
    if ($atts['type'] == 'post_format') {
    	$wrapper_class = 'asalah_post_gallery asalah_post_gallery_format';
    	$column_class = 'full_column';
    }
    $gallery_div = "<div class='filterable_wrapper'><div id='$selector' class='clearfix gallery galleryid-{$id} asalah_row gallery_row gallery-columns-{$columns} gallery-size-{$size_class} {$wrapper_class} '>";

    /**
     * Filter the default gallery shortcode CSS styles.
     *
     * @since 2.5.0
     *
     * @param string $gallery_style Default CSS styles and opening HTML div container
     *                              for the gallery shortcode output.
     */
    $output = apply_filters( 'gallery_style', $gallery_style . $gallery_div );

    $i = 0;
    if ($atts['type'] == 'post_format') {
    	$output .= '<ul class=" grid_slider slides">';
    }
    foreach ( $attachments as $id => $attachment ) {

        $attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
        if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
            $the_image = wp_get_attachment_image_src( $id, $atts['size'] );
            $thumb_attributes = $the_image[0];
            $image_attributes = wp_get_attachment_url($id);
            $attachment_title = get_the_title($id);
            if ( $captiontag && trim($attachment->post_excerpt) ) {
                $image_output = '<a href="'. $image_attributes.'" title="'.wptexturize($attachment->post_excerpt).'">';
            }else{
                $image_output = '<a href="'. $image_attributes.'" title="'.$attachment_title.'">';
            }
            $image_output .= '<img src="'.$thumb_attributes.'">';
            $image_output .= '</a>';
        } elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
            $image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
        }elseif ($atts['type'] == 'post_format') {
        	if (is_single()) {
        		$format_size = 'full';
        	}elseif (asalah_option('asalah_blog_gallery_crop') == 'no' && asalah_cross_option('asalah_blog_style') != 'list') {
				$format_size = 'full';
			}
        	$the_image = wp_get_attachment_image_src( $id, $format_size );
        	$thumb_attributes = $the_image[0];
            $image_attributes = wp_get_attachment_url($id);
            $attachment_title = get_the_title($id);
            $image_output = '';
            $gallery_image_url = '';
            if (!is_single()) {
                $gallery_image_url = ' href="'.esc_url( get_permalink() ).'" ';
                $image_output .= '<a '.$gallery_image_url.' >';
            }
            $image_output .= '<img class="img-responsive" alt="'.$attachment_title.'" src="'.$thumb_attributes.'">';
            if (!is_single()) {
                $image_output .= '</a>';
            }
        } else {
            $image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr );
        }
        $image_meta  = wp_get_attachment_metadata( $id );

        $orientation = '';
        if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
            $orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
        }

        if ($atts['type'] == 'post_format') {
        	$output .= '<li class="grid_slide item">';
        }
        $output .= "<{$itemtag} class='gallery_column filterable_item {$column_class}'>";
        $output .= "
            <{$icontag} class='gallery-icon {$orientation}'>
                $image_output
            </{$icontag}>";

        	if ( $captiontag && trim($attachment->post_excerpt) ) {
	            $output .= "
	                <{$captiontag} class='wp-caption-text gallery-caption' id='$selector-$id'>
	                " . wptexturize($attachment->post_excerpt) . "
	                </{$captiontag}>";
	        }


        $output .= "</{$itemtag}>";
        if ($atts['type'] == 'post_format') {
        	$output .= '</li>';
        }

        if ( ! $html5 && $columns > 0 && ++$i % $columns == 0 ) {
            $output .= '<br style="clear: both" />';
        }
    }
    if ($atts['type'] == 'post_format') {

    	$output .= '</ul>';// end grid_slider slides ul
    	$output .= '<div class="asalah_post_gallery_nav_container clearfix"></div>'; // slider navigation area
    }

    if ( ! $html5 && $columns > 0 && $i % $columns !== 0 ) {
        $output .= "
            <br style='clear: both' />";
    }

    $output .= "
        </div></div>\n";

    return $output;
}
endif;
if ( !(class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'carousel' ))) {
	$shortcode_add = 'add';
	$shortcode_translation = 'shortcode';
	$shortcode_variable = $shortcode_add . '_' . $shortcode_translation;
	$shortcode_variable('gallery', 'asalah_gallery_shortcode');
}


/* --------
make clickable in new window
------------------------------------------- */
if ( ! function_exists( 'asalah_make_clickable' ) ) :
function asalah_make_clickable($content) {
	return preg_replace('/<a /','<a target="_blank" ', make_clickable($content));
}
endif;

/* --------
social networks list
------------------------------------------- */
if ( ! function_exists( 'asalah_social_icons_list' ) ) :
function asalah_social_icons_list($class = '') {
    global $social_networks;

    $activated = 0;

    $wrapper_class = '';
    if ($class) {
    	$wrapper_class = $class;
    }

    $output = "";
    foreach ($social_networks as $network => $social ) {
        $id = "asalah_" . $network . "_url";
        if (asalah_option($id) != "") {
            $activated++;
            if ($activated == 1) {
                $output .= '<div class="social_icons_list '.$wrapper_class.'">';
            }
            $social_url = asalah_option($id);
            $output .= '<a rel="nofollow" target="_blank" href="'.esc_url($social_url).'" title="'.$social.'" class="social_icon social_' . $network . ' social_icon_' . $network . '"><i class="fa fa-' . $network . '"></i></a>';
        }
    }
    if ($activated != "0") {
        $output .= '</div>'; // end social_icons_list in case it's already opened
    }

    if ($output != '') {
        return $output;
    }
}
endif;



/* --------
Hex Color Shift
------------------------------------------- */



if (asalah_option('asalah_enable_post_background_color') == true) {
	$post_bg_color = asalah_option('asalah_post_background_color');
} else if (asalah_option('asalah_enable_body_background_color')) {
$post_bg_color = asalah_option('asalah_body_background_color');
}

if (isset($post_bg_color)) {
	function asalah_colors_change() {
		?>
		<script type="text/javascript">
		jQuery(document).ready( function ($) {
			var post_bg_color = '<?php if (asalah_option('asalah_enable_post_background_color') == true) {
				$post_bg_color = asalah_option('asalah_post_background_color');
			} else if (asalah_option('asalah_enable_body_background_color')) {
			$post_bg_color = asalah_option('asalah_body_background_color');
			}
			echo $post_bg_color; ?>';
			function decrease_brightness(hex, percent){
						// strip the leading # if it's there
				hex = hex.replace(/^\s*#|\s*$/g, '');

				// convert 3 char codes --> 6, e.g. `E0F` --> `EE00FF`
				if(hex.length == 3){
						hex = hex.replace(/(.)/g, '$1$1');
				}
				var r = parseInt(hex.substr(0, 2), 16),
						g = parseInt(hex.substr(2, 2), 16),
						b = parseInt(hex.substr(4, 2), 16);

				var luma = ((r * 299) + (g * 587) + (b * 114)) / 1000;

				if (luma > 128) {
					return '#' +
					 ((0|(1<<8) + r * (100 - percent) / 100).toString(16)).substr(1) +
					 ((0|(1<<8) + g * (100 - percent) / 100).toString(16)).substr(1) +
					 ((0|(1<<8) + b * (100 - percent) / 100).toString(16)).substr(1);
				} else {
					return '#' +
					 ((0|(1<<8) + r + (256 - r) * percent / 100).toString(16)).substr(1) +
					 ((0|(1<<8) + g + (256 - g) * percent / 100).toString(16)).substr(1) +
					 ((0|(1<<8) + b + (256 - b) * percent / 100).toString(16)).substr(1);

				}
		 }

			var border_color = decrease_brightness(post_bg_color, 13);
			var lighter_border_color = decrease_brightness(post_bg_color, 7);
			var darker_color = decrease_brightness(post_bg_color, 18);
			var meta_color = decrease_brightness(post_bg_color, 60);
			var light_bg = decrease_brightness(post_bg_color, 5);

			var output = '<style>';
			output += '.site_side_container, .side_content.widget_area .widget_container .widget_title > span, .asalah_select_container, .uneditable-input, #wp-calendar tbody td:hover, .reading-progress-bar, .site form.search-form input {';
				output += "background-color:"+post_bg_color+";";
			output += "}";

		 output += ".page-links, .post_navigation, .media.the_comment, #wp-calendar thead th, .post_related, table tr, .post_content table, .author_box.author-info, .blog_posts_wrapper .blog_post, .blog_posts_wrapper.masonry_blog_style .blog_post_meta, .blog_post_meta .blog_meta_item a {";
			 output += 'border-bottom-color:'+border_color+';';
		 output += '}';

		 output += ".page-links, table, .post_content table th, .post_content table td, .second_footer.has_first_footer .second_footer_content_wrapper, .blog_posts_wrapper.masonry_blog_style .blog_post_meta {";
			 output += 'border-top-color:'+border_color+';';
		 output += "}";

		 output += '.navigation.pagination .nav-links .page-numbers, .navigation_links a, input[type="submit"], .blog_post_control_item .share_item.share_sign {';
			 output += 'border-color:'+border_color+';';
		 output += '}';

		 output += 'table th:last-child, table td:last-child {';

				 output += 'border-left-color:'+border_color+';';

				 output += 'border-right-color:'+border_color+';';

		 output += '}';

		 output += 'table th, table td {border-right-color:'+border_color+'border-left-color:'+border_color+';';

		 output += '}';

		 output += ".widget_container ul li {";
			 output += 'border-bottom-color:'+lighter_border_color+';';
		 output += '}';

		 output += '.site_side_container {';
		 	 output += 'border-left-color:'+lighter_border_color+';'
		 output += '};';


		 output += '.blog_meta_item.blog_meta_format a {';
			 output += 'color:'+darker_color+';';
		 output += '}';

		 output += '.widget_container, .asalah_post_list_widget .post_info_wrapper .post_meta_item, select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input, blockquote cite, .mobile_menu_button, .blog_post_meta .blog_meta_item a, .blog_post_readmore.blog_post_control_item a:hover, .blog_post_meta .blog_meta_item, .site form.search-form i.search_submit_icon, .widget_container caption  {';
			 output += 'color:'+meta_color+';';
		 output += '}';

		 output += ".blog_post_readmore.blog_post_control_item a:hover {";
			 output += 'border-bottom-color:'+meta_color+';';
		 output += '}';

		 output += '#wp-calendar thead th {';
			 output += 'background-color:'+lighter_border_color+';';
			 output += 'border-right-color:'+post_bg_color+';';
			 output += 'border-left-color:'+post_bg_color+';';
		 output += '}';

		 output += '.page_main_title .title, .page-links > span, .navigation.comment-navigation .comment-nav a, .side_content.widget_area .widget_container .widget_title:after, .widget_container.asalah-social-widget .widget_social_icon, .tagcloud a, input[type="submit"]:hover, .widget_container caption {';
			 output += 'background-color:'+light_bg+';';
		 output += '}';


		 output += '.comment_content_wrapper , dd {';
			 output += 'border-right-color:'+light_bg+';';
			 output += 'border-left-color:'+light_bg+';';
		 output += '}';

		 output += ".page_404_main_title {";
			 output += 'border-bottom-color:'+light_bg+';';
		 output += '}';

		 output += '.page-links > span {';
			 output += 'border-color:'+light_bg+';';
		 output += '}';

		 output += '.user_info_button, .widget_container caption, .footer_wrapper, .user_info_button {';
			 output += 'border-color:'+decrease_brightness(post_bg_color, 6)+';';
		 output += '}';

		 output += '.site form.search-form i.search_submit_icon {';
			 output += 'background-color:'+decrease_brightness(post_bg_color, 6)+';';
		 output += '}';

		 output += '#wp-calendar tbody tr:first-child td.pad {';
			 output += 'border-right-color:'+post_bg_color+';';
			 output += 'border-left-color:'+post_bg_color+';';
		 output += '}';

		 output += '#wp-calendar tbody td {';
			 output += 'background-color:'+decrease_brightness(post_bg_color, 4)+';';
			 output += 'color:'+decrease_brightness(post_bg_color, 53)+';';
			 output += 'border-right-color:'+post_bg_color+';';
			 output += 'border-left-color:'+post_bg_color+';';
		 output += '}';

		 output += 'blockquote:before, .bypostauthor .commenter_name:after, .sticky.blog_post_container:before {';
			 output += 'color:'+lighter_border_color+';';
		 output += '}';
		 output += "</style>";

		 jQuery('body').append(output);

		})
		</script>
		<?php
	}
	add_action('wp_footer', 'asalah_colors_change');
}

if (asalah_option('asalah_enable_top_menu_color')) {
	$top_menu_wrapper_color = asalah_option('asalah_top_menu_color');
} else if (asalah_option('asalah_enable_body_background_color')) {
	$top_menu_wrapper_color = asalah_option('asalah_body_background_color');
} else if (asalah_option('asalah_enable_post_background_color') && (asalah_cross_option('asalah_sticky_menu') != 'yes') ) {
	$top_menu_wrapper_color = asalah_option('asalah_post_background_color');
}

if (isset($top_menu_wrapper_color)) {
	function asalah_top_bar_colors_change() {
		?>
		<script type="text/javascript">
		jQuery(document).ready( function ($) {
			var post_bg_color = '<?php if (asalah_option('asalah_enable_top_menu_color')) {
				$top_menu_wrapper_color = asalah_option('asalah_top_menu_color');
			} else if (asalah_option('asalah_enable_body_background_color')) {
				$top_menu_wrapper_color = asalah_option('asalah_body_background_color');
			} else if (asalah_option('asalah_enable_post_background_color')) {
				$top_menu_wrapper_color = asalah_option('asalah_post_background_color');
			}
			echo $top_menu_wrapper_color; ?>';
			function decrease_brightness(hex, percent){
						// strip the leading # if it's there
				hex = hex.replace(/^\s*#|\s*$/g, '');

				// convert 3 char codes --> 6, e.g. `E0F` --> `EE00FF`
				if(hex.length == 3){
						hex = hex.replace(/(.)/g, '$1$1');
				}
				var r = parseInt(hex.substr(0, 2), 16),
						g = parseInt(hex.substr(2, 2), 16),
						b = parseInt(hex.substr(4, 2), 16);

				var luma = ((r * 299) + (g * 587) + (b * 114)) / 1000;

				if (luma > 128) {
					return '#' +
					 ((0|(1<<8) + r * (100 - percent) / 100).toString(16)).substr(1) +
					 ((0|(1<<8) + g * (100 - percent) / 100).toString(16)).substr(1) +
					 ((0|(1<<8) + b * (100 - percent) / 100).toString(16)).substr(1);
				} else {
					return '#' +
					 ((0|(1<<8) + r + (256 - r) * percent / 100).toString(16)).substr(1) +
					 ((0|(1<<8) + g + (256 - g) * percent / 100).toString(16)).substr(1) +
					 ((0|(1<<8) + b + (256 - b) * percent / 100).toString(16)).substr(1);

				}
		 }

			var border_color = decrease_brightness(post_bg_color, 13);
			var lighter_border_color = decrease_brightness(post_bg_color, 7);
			var darker_color = decrease_brightness(post_bg_color, 18);
			var meta_color = decrease_brightness(post_bg_color, 60);
			var light_bg = decrease_brightness(post_bg_color, 5);


		 output = '<style>';
		 output += '.dropdown-menu, .header_search > form.search .search_text {';
			 output += 'background-color:'+post_bg_color+';';
		 output += '}';
		 output += ".widget_container ul li, .site input.search-field, .top_menu_wrapper, .header_search > form.search .search_text {";
			 output += 'border-bottom-color:'+lighter_border_color+';';
		 output += '}';

		output += '.dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus, .dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus, .dropdown-menu .current-menu-ancestor, .dropdown-menu .current-menu-ancestor > a {';
		   output += 'background-color:'+light_bg+';';
		output += '}';

		output += '.navbar-nav > li > .dropdown-menu {';
			output += 'border-right-color:'+light_bg+';';
			output += 'border-left-color:'+light_bg+';';
		output += '}';

		output += '.mobile_menu_button, .navbar-nav > li > .dropdown-menu, .dropdown-submenu > .dropdown-menu {';
			output += 'border-color:'+light_bg+';';
		output += '}';

		 output += '.header_search > form.search .search_text { color:'+meta_color+';}';

		 output += '.header_search ::-webkit-input-placeholder { /* WebKit, Blink, Edge */color:'+meta_color+';}';

		 output += ".header_search, .sticky_header .header_info_wrapper { border-left-color: "+lighter_border_color+"; border-right-color:"+lighter_border_color+"; }";
			output += "</style>";

 		 jQuery('body').append(output);

 		})
 		</script>
 		<?php
 	}
 	add_action('wp_footer', 'asalah_top_bar_colors_change');
 }


/* --------
include theme files
------------------------------------------- */
require get_template_directory() . '/inc/bootstrapmenu.php';
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/postoptions.php';
require get_template_directory() . '/inc/banner.php';
require get_template_directory() . '/inc/formats/formats.php';
require get_template_directory() . '/inc/widgets/tweets.php';
require get_template_directory() . '/framework/twitter/twitteroauth.php';
require get_template_directory() . '/inc/googlefonts.php';


/* --------
include widgets
------------------------------------------- */
require get_template_directory() . '/inc/widgets/postlist.php';
require get_template_directory() . '/inc/widgets/about.php';
require get_template_directory() . '/inc/widgets/fbpage.php';
require get_template_directory() . '/inc/widgets/gplus.php';
require get_template_directory() . '/inc/widgets/social.php';

// Run this code on 'after_theme_setup', when plugins have already been loaded.
add_action('after_setup_theme', 'asalah_instaram_slider');
// This function loads the plugin.
function asalah_instaram_slider() {

	if (!class_exists('JR_InstagramSlider')) {
		// load Social if not already loaded
		include_once(TEMPLATEPATH.'/inc/widgets/instaram_slider.php');
	}
}

/* custom header code */

if (asalah_cross_option('asalah_custom_header_code')) {
	function asalah_header_code() {
			echo asalah_cross_option('asalah_custom_header_code');
		}
	add_action('asalah_custom_header', 'asalah_header_code', 0);
}

/* Word Count */

function asalah_word_count() {
    global $post;
    $content = get_post_field( 'post_content', get_the_id() );
    $word_count = str_word_count( strip_tags( $content ) );
    return $word_count;
}

if (!function_exists('ar_str_word_count'))
{
    function mb_str_word_count($string, $format = 0, $charlist = '[]') {
        mb_internal_encoding( 'UTF-8');
        mb_regex_encoding( 'UTF-8');

        $words = mb_split('[^\x{0600}-\x{06FF}]', $string);
        switch ($format) {
            case 0:
                return count($words);
                break;
            case 1:
            case 2:
                return $words;
                break;
            default:
                return $words;
                break;
        }
    };
}

/* Update Notice */

function my_update_notice() {
	$current_theme_version = get_theme_mod('asalah_theme_version');
	$theme = wp_get_theme();

	global $pagenow;
	if ($pagenow != 'themes.php') {
	if (!isset($current_theme_version) || ($current_theme_version != $theme->get('Version'))) {
		?>
		<div class="updated is-dismissable notice" style="position:relative;">
				<h1><?php echo 'You have updated to version '. $theme->get("Version") .', Enjoy using Writing!'; ?></h1>
				<h2>If you like the theme, we'll be very grateful if you rate us :) <img class="starsrating" src="<?php echo get_template_directory_uri()?>/staratings.png" height="20px" /><a href="https://ahmad.works/go/tfdownload/" target="_blank">Click Here To Rate</a></h2>
				<b>What's new in the version:</b>
				<ul>
					<li>- Fix issue with Reading more button.</li>
				</ul>
				<a class="notice-dismiss" href="?ignore_bostan_update_message=1"><span class="screen-reader-text">Dismiss this notice</span></a>
		</div>
		<?php
	}
}


}


add_action( 'admin_notices', 'my_update_notice' );


add_action('admin_init', 'example_nag_ignore');

function example_nag_ignore() {

	$theme = wp_get_theme();
				/* If user clicks to ignore the notice, add that to their user meta */
				if ( isset($_GET['ignore_bostan_update_message']) && '1' == $_GET['ignore_bostan_update_message'] ) {

						 $themeversion = $theme->get('Version');
						 set_theme_mod( 'asalah_theme_version', $themeversion );
	}
}

/* License Notice */

        function my_license_notice() {
          $current_license_note = get_theme_mod('asalah_license_notice');

          if (empty($current_license_note)) {
            ?>
            <div class="updated is-dismissable notice" style="position:relative;">
                <h2>Notice:</h2>
                <b>The “Regular License” of Writing theme gives you the write to use it in one website only, if you want to use the theme for multiple sites, you need to purchase a license for each site. thanks.</b>
                <p><a href="http://themeforest.net/item/writing-clean-minimal-blog-wordpress-theme/11547928?ref=ahmadworks&utm_source=panel&utm_medium=license_notice">Purchase Writing License Now</a> | <a href="?ignore_asalah_license_message=1">Dismiss this notice</a></p>
                <a class="notice-dismiss" href="?ignore_asalah_license_message=1"><span class="screen-reader-text">Dismiss this notice</span></a>
            </div>
            <?php
          }
        }
        add_action( 'admin_notices', 'my_license_notice' );

        add_action('admin_init', 'license_ignore');

        function license_ignore() {

                /* If user clicks to ignore the notice, add that to their user meta */
                if ( isset($_GET['ignore_asalah_license_message']) && '1' == $_GET['ignore_asalah_license_message'] ) {

                     set_theme_mod( 'asalah_license_notice', true );
        	}
        }
if (!asalah_cross_option('asalah_autoupdate_notice')) {
	if (!class_exists('Envato_WP_Toolkit')) {
		/* Update Notice */

		function update_plugin_missing() {

				?>
				<div class="error" style="position:relative;">
						<p>It seems that you don't have Envato Toolkit activated, please install it so that you could be notified automatically of new Writing updates!</p>
						<p><b>You could download the plugin <a href="https://github.com/envato/envato-wordpress-toolkit/archive/master.zip">here</a></p>
						<a class="notice-dismiss" href="?ignore_asalah_autoupdate_message=1"><span class="screen-reader-text">Dismiss this notice</span></a>
				</div>
				<?php
				add_action( 'admin_notices', 'update_plugin_missing' );

				add_action('admin_init', 'autoupdate_ignore');

        function autoupdate_ignore() {

                /* If user clicks to ignore the notice, add that to their user meta */
                if ( isset($_GET['ignore_asalah_autoupdate_message']) && '1' == $_GET['ignore_asalah_autoupdate_message'] ) {

                     set_theme_mod( 'asalah_autoupdate_notice', true );
        	}
        }
		}
	} else {

		function envato_toolkit_credentials_admin_notices() {
			?>
			<div class="error" style="position:relative;">
					<p>It seems that you didn't enter your username and API key at Envato Toolkit plugin used for Writing auto updates yet!</p>
					<p><b>Please go to <a href="<?php echo admin_url('?page=envato-wordpress-toolkit');?>">plugin's settings page</a>.
					</br>if you didn't generate your API key yet, you can get it through (My Settings) page at your Themeforest account and then choose API Keys tab where you can generate a free API key. :)</p>
			</div>
			<?php
		}
			// Use credentials used in toolkit plugin so that we don't have to show our own forms anymore
		$credentials = get_option( 'envato-wordpress-toolkit' );
		if ( empty( $credentials['user_name'] ) || empty( $credentials['api_key'] ) ) {
		    add_action( 'admin_notices', 'envato_toolkit_credentials_admin_notices' );
		    return;
		}
	}
}
?>
