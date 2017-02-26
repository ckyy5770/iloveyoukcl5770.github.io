<?php
add_action('widgets_init', 'about_widget_init');
function about_widget_init() {
    register_widget('about_widget');
}

function widgets_script(){
    wp_enqueue_media();
    wp_enqueue_script('widgets_script', get_template_directory_uri() . '/inc/widgets/widgets.js');
}
add_action('admin_enqueue_scripts', 'widgets_script');

class about_widget extends WP_Widget {

    function __construct() {
		parent::__construct(
			'about-widget', // Base ID
			theme_name . ' - About Me', // Name
			array( 'classname' => 'about-widget', 'description' => '', 'width' => 250, 'height' => 350 ) // Args
		);
	}

    function widget($args, $instance) {
        extract($args);

        $title = isset( $instance['title'] ) ? apply_filters('widget_title', $instance['title']) : '' ;
        $image = isset( $instance['image'] ) ? esc_url($instance['image']) : '' ;
        $image_shape = isset( $instance['image_shape'] ) ? esc_attr($instance['image_shape']) : 'rounded' ;
        $image_size = isset( $instance['image_size'] ) ? esc_attr($instance['image_size']) : 'default' ;
        $text = isset( $instance['text'] ) ? esc_attr($instance['text']) : '' ;

        echo $before_widget;

        if ($title) :
            echo $before_title;
            echo $title;
            echo $after_title;
        endif;
        ?>
        <?php
        echo '<div class="asalah_about_me">';
            echo '<div class="author_image_wrapper '.$image_size.' '.$image_shape.'">';
                echo '<img class="img-responsive" src="'.$image.'" alt="'.$title.'" />';
            echo '</div>';
            echo '<div class="author_text_wrapper">';
                echo '<p>'.do_shortcode($text).'</p>';
            echo '</div>';
        echo '</div>';
        ?>
        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['image'] = $new_instance['image'];
        $instance['image_shape'] = $new_instance['image_shape'];
        $instance['image_size'] = $new_instance['image_size'];
        $instance['text'] = $new_instance['text'];
        return $instance;
    }

    function form($instance) {
        $defaults = array('title' => __('About Me', 'asalah'), 'image' => '', 'image_shape' => 'rounded', 'image_size' => 'default', 'text' => '');
        $instance = wp_parse_args((array) $instance, $defaults);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'asalah'); ?>:</label>
            <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
        </p>
        <p>
         <label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Image', 'asalah'); ?>:</label><br />
           <img class="custom_media_image" src="<?php if(!empty($instance['image'])){echo $instance['image'];} ?>" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" />
           <input type="text" class="widefat custom_media_url" name="<?php echo $this->get_field_name('image'); ?>" id="<?php echo $this->get_field_id('image'); ?>" value="<?php echo $instance['image']; ?>">
           <input type="button" value="<?php _e( 'Upload Image', 'asalah' ); ?>" class="button custom_media_upload" id="custom_image_uploader"/>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('image_shape'); ?>"><?php _e('Image Shape', 'asalah'); ?>: </label>
          <select id="<?php echo $this->get_field_id('image_shape'); ?>" name="<?php echo $this->get_field_name('image_shape'); ?>" >
              <option value="rounded" <?php if ($instance['image_shape'] == 'rounded') echo "selected=\"selected\"";
          else echo ""; ?>><?php _e('Rounded', 'asalah'); ?></option>
              <option value="circle" <?php if ($instance['image_shape'] == 'circle') echo "selected=\"selected\"";
          else echo ""; ?>><?php _e('Circle', 'asalah'); ?></option>
          </select>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('image_size'); ?>"><?php _e('Image Size', 'asalah'); ?>: </label>
          <select id="<?php echo $this->get_field_id('image_size'); ?>" name="<?php echo $this->get_field_name('image_size'); ?>" >
              <option value="default" <?php if ($instance['image_size'] == 'default') echo "selected=\"selected\"";
          else echo ""; ?>><?php _e('Default', 'asalah'); ?></option>
              <option value="large" <?php if ($instance['image_size'] == 'large') echo "selected=\"selected\"";
          else echo ""; ?>><?php _e('Large', 'asalah'); ?></option>
              <option value="medium" <?php if ($instance['image_size'] == 'medium') echo "selected=\"selected\"";
          else echo ""; ?>><?php _e('Medium', 'asalah'); ?></option>
              <option value="small" <?php if ($instance['image_size'] == 'small') echo "selected=\"selected\"";
          else echo ""; ?>><?php _e('Small', 'asalah'); ?></option>
          </select>
        </p>
        <p>
           <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Content:', 'asalah' ); ?>:</label>
            <textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $instance['text']; ?></textarea>
        </p>
        <?php
    }

}
?>