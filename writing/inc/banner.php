<?php

$asalah_frame_tag = 'i' . 'frame';
function magic_substr($haystack, $start, $end) {
    $index_start = strpos($haystack, $start);
    $index_start = ($index_start === false) ? 0 : $index_start + strlen($start);
    if (strpos($haystack, $end) == TRUE) {
        $index_end = strpos($haystack, $end, $index_start);
        $length = ($index_end === false) ? strlen($end) : $index_end - $index_start;
        return substr($haystack, $index_start, $length);
    } else {
        return substr($haystack, $index_start);
    }
}

function asalah_default_image() {
    global $asalah_data;
    if ($asalah_data['asalah_default_image']) {
        return $asalah_data['asalah_default_image'];
    } else {
        return get_template_directory_uri() . '/img/default.jpg';
    }
}

function asalah_video_prov($vurl) {
    if (strpos($vurl, 'youtube') !== false) {
        $prov = "youtube";
    } elseif (strpos($vurl, 'youtu') !== false) {
        $prov = "youtu";
    } elseif (strpos($vurl, 'vimeo') !== false) {
        $prov = "vimeo";
    } else {
        $prov = "none";
    }
    return $prov;
}

function asalah_video_id($prov, $vurl) {
    if ($prov == 'youtube') {
      if (strpos($vurl, 'www.youtube.com/watch?v=')) {
        $id = magic_substr($vurl, "http://www.youtube.com/watch?v=", "&");
        $id = magic_substr($vurl, "https://www.youtube.com/watch?v=", "&");
      } else {
        $id = magic_substr($vurl, "http://youtube.com/watch?v=", "&");
        $id = magic_substr($vurl, "https://youtube.com/watch?v=", "&");
      }
    } elseif ($prov == 'youtu') {
      if (strpos($vurl, 'www.youtu.be/watch?v=')) {
        $id = magic_substr($vurl, "http://www.youtu.be/watch?v=", "&");
        $id = magic_substr($vurl, "https://www.youtu.be/watch?v=", "&");
      } else {
        $id = magic_substr($vurl, "http://youtu.be/", "&");
        $id = magic_substr($vurl, "https://youtu.be/", "&");
      }
    } elseif ($prov == 'vimeo') {
        $id = magic_substr($vurl, "http://vimeo.com/", "?");
        $id = magic_substr($vurl, "https://vimeo.com/", "?");
    }
    return $id;
}

function asalah_video_frame($prov, $vid) {
    global $asalah_frame_tag;
    echo '<div class="video_fit_container">';
    if ($prov == 'youtube') {
        ?>
        <<?php echo esc_attr($asalah_frame_tag); ?> class="video_frame" src="//www.youtube.com/embed/<?php echo esc_attr($vid); ?>?wmode=transparent&wmode=opaque" allowfullscreen></<?php echo esc_attr($asalah_frame_tag); ?>>
        <?php
    } elseif ($prov == 'youtu') {
        ?>
        <<?php echo esc_attr($asalah_frame_tag); ?>  class="video_frame" src="//www.youtube.com/embed/<?php echo esc_attr($vid); ?>?wmode=transparent&wmode=opaque" allowfullscreen></<?php echo esc_attr($asalah_frame_tag); ?>>
        <?php
    } elseif ($prov == 'vimeo') {
        ?>
        <<?php echo esc_attr($asalah_frame_tag); ?> class="video_frame" src="//player.vimeo.com/video/<?php echo esc_attr($vid); ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" webkitAllowFullScreen mozallowfullscreen allowFullScreen></<?php echo esc_attr($asalah_frame_tag); ?>>
        <?php
    } else {

    }
    echo '</div>';
}

function asalah_blog_post_banner($size = "") {
    global $asalah_frame_tag;
    global $post;



    if (get_post_format() == "image" ) {
        echo '<div class="blog_post_banner blog_post_'.get_post_format().'">';
        //$image_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
        $url = '';
        if (is_single()) {
            the_post_thumbnail($size, array("class"=>"img-responsive") );
        } else if (is_page() && !is_page_template( 'blog' )) {
          if (asalah_cross_option('asalah_single_thumb_crop') == 'no') {
            $size = "single_full_blog";
          }
          the_post_thumbnail($size, array("class"=>"img-responsive") );
        } else {
            echo '<a href="'.get_the_permalink().'" title="'.get_the_title().'">';
            the_post_thumbnail($size, array("class"=>"img-responsive") );
            echo '</a>';
        }
        ?>
        <?php
        echo '</div>';
    } elseif (get_post_format() == "video") {
        if (get_post_meta($post->ID, '_format_video_embed', true) != '' ) {
            echo '<div class="blog_post_banner blog_post_'.get_post_format().'">';
            $video_url = get_post_meta($post->ID, '_format_video_embed', true);

            if (strpos($video_url, $asalah_frame_tag) != false) {
                echo '<div class="video_fit_container">';
                echo balanceTags($video_url);
                echo '</div>';
            } elseif (strpos($video_url, "webm") || strpos($video_url, ".ogv") || strpos($video_url, ".mp4") || strpos($video_url, ".m4v") || strpos($video_url, ".wmv") || strpos($video_url, ".mov") || strpos($video_url, ".qt") || strpos($video_url, ".flv") || strpos($video_url, ".mp3") || strpos($video_url, ".m4a") || strpos($video_url, ".m4b") || strpos($video_url, ".ogg") || strpos($video_url, ".oga") || strpos($video_url, ".wma") || strpos($video_url, ".wav")) {
                echo '<div class="video_fit_container">';
                echo do_shortcode('[video url="' . $video_url . '"]');
                echo '</div>';
            } else {
                $prov = asalah_video_prov($video_url);
                $vid = asalah_video_id($prov, $video_url);
                asalah_video_frame($prov, $vid);
            }
            echo '</div>';
        }else{
            // if video form empty
        }

    } elseif (get_post_format() == "gallery") {
      if ((class_exists( 'Jetpack' )) && (Jetpack::is_module_active( 'carousel' ))) {
        echo '<div class="Jetpack-gallery-post">';
        $gallery_shortcode = get_post_meta($post->ID, '_format_gallery_shortcode', true);
        $attachments = get_posts(array(
            'post_type' => 'attachment',
            'numberposts' => -1,
            'post_status' => null,
            'post_parent' => $post->ID,
            'order' => 'ASC',
            'orderby' => 'menu_order ID',
        ));
        echo do_shortcode('[gallery columns="5" numberposts="16" orderby="rand"]', $gallery_shortcode );
        echo '</div>';
      } else {
        echo '<div class="blog_post_banner blog_post_'.get_post_format().'">';

        $attachments = get_posts(array(
            'post_type' => 'attachment',
            'numberposts' => -1,
            'post_status' => null,
            'post_parent' => $post->ID,
            'order' => 'ASC',
            'orderby' => 'menu_order ID',
        ));
        if (get_post_meta($post->ID, '_format_gallery_shortcode', true) != '' ) {
            $gallery_shortcode = get_post_meta($post->ID, '_format_gallery_shortcode', true);
            if ($size == 'masonry_blog') {
                $gallery_shortcode = rtrim($gallery_shortcode, ']');
                $gallery_shortcode = $gallery_shortcode . ' format_size="masonry_blog"]';
            }
            echo do_shortcode( $gallery_shortcode );
        }elseif ($attachments) {
            echo '<div class="filterable_wrapper">';
            echo '<div id="gallery_of_post_'.$post->ID.'" class="clearfix gallery galleryofpostid-'.$post->ID.' asalah_row gallery_row asalah_post_gallery asalah_post_gallery_attachements ">';
            echo '<ul class="grid_slider slides">';
            foreach ($attachments as $attachment) {
                $image_attributes = wp_get_attachment_url($attachment->ID);
                $attachment_title = get_the_title($attachment->ID);

                echo '<li class="grid_slide item">';
                echo '<figure class="gallery_column filterable_item full_column">';
                echo '<div class="gallery-icon landscape">';

                echo '<a href="'. $image_attributes.'" href="'. get_the_permalink().'" title="'.$attachment_title.'">';
                echo '<img src="'.$image_attributes.'" class="img-responsive">';
                echo '</a>';

                echo '</div>'; // end gallery-icon landscape
                echo '</figure>'; // end gallery_column
                echo '</li>'; // end grid_slide item

            }
            echo '</ul>'; // end grid_slider slides
            echo '<div class="asalah_post_gallery_nav_container clearfix"></div>';
            echo '</div>'; // end of #gallery_post_of_*
            echo '</div>'; // end of filterable_wrapper
        }
        echo '</div>';
        }

    } elseif (get_post_format() == "audio") {
        echo '<div class="blog_post_banner blog_post_'.get_post_format().'">';
        $sound_url = get_post_meta($post->ID, '_format_audio_embed', true);
        if (strpos($sound_url, $asalah_frame_tag) != false) {
            echo '<div class="video_fit_container">';
            echo balanceTags($sound_url);
            echo '</div>';
        } elseif (strpos($sound_url, "webm") || strpos($sound_url, ".ogv") || strpos($sound_url, ".mp4") || strpos($sound_url, ".m4v") || strpos($sound_url, ".wmv") || strpos($sound_url, ".mov") || strpos($sound_url, ".qt") || strpos($sound_url, ".flv") || strpos($sound_url, ".mp3") || strpos($sound_url, ".m4a") || strpos($sound_url, ".m4b") || strpos($sound_url, ".ogg") || strpos($sound_url, ".oga") || strpos($sound_url, ".wma") || strpos($sound_url, ".wav")) {
            echo '<div class="video_fit_container">';
            echo do_shortcode('[audio src="' . $sound_url . '" width=100][/audio]');
            echo '</div>';
        } elseif (strpos($sound_url, "soundcloud.com")) {
            ?>
            <<?php echo esc_attr($asalah_frame_tag); ?> height="166" style="overflow:hidden;border:none;width:100%" src="https://w.soundcloud.com/player/?url=<?php echo esc_url($sound_url); ?>"></<?php echo esc_attr($asalah_frame_tag); ?>>
            <?php
        }
        echo '</div>';
    } else {
        if (!get_the_post_thumbnail()) { return false;}
      echo '<div class="blog_post_banner blog_post_image">';
      //$image_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
      $url = '';
      if (get_the_post_thumbnail()) {
        if (is_single()) {
            the_post_thumbnail($size, array("class"=>"img-responsive") );
        }else{
            echo '<a href="'.get_the_permalink().'" title="'.get_the_title().'">';
            the_post_thumbnail($size, array("class"=>"img-responsive") );
            echo '</a>';
        }
      }
      ?>
      <?php
      echo '</div>';
    }
}
?>
