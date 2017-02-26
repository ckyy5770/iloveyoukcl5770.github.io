<?php
add_action('widgets_init', 'fbpage_widget_init');

function fbpage_widget_init() {
    register_widget('fbpage_widget');
}

class fbpage_widget extends WP_Widget {

    function __construct() {
		parent::__construct(
			'fbpage-widget', // Base ID
			theme_name . ' - Facebook Page', // Name
			array( 'classname' => 'asalah-fbpage-widget', 'description' => '', 'width' => 250, 'height' => 350 ) // Args
		);
	}

    function widget($args, $instance) {
        extract($args);

        $title = isset( $instance['title'] ) ? apply_filters('widget_title', $instance['title']) : '';
        $fburl = isset( $instance['fburl'] ) ? esc_url($instance['fburl']) : '';

        echo $before_widget;

        if ($title) :
            echo $before_title;
            echo $title;
            echo $after_title;
        endif;

        echo '<div class="fb-page" data-href="'.$fburl.'" data-hide-cover="false" data-show-facepile="true" data-show-posts="true" data-adapt-container-width="true"><div class="fb-xfbml-parse-ignore"></div></div>';
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['fburl'] = $new_instance['fburl'];
        return $instance;
    }

    function form($instance) {
        $defaults = array('title' => __('Facebook Page', 'asalah'), 'fburl' => '');
        $instance = wp_parse_args((array) $instance, $defaults);
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'asalah'); ?>: </label>
            <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('fburl'); ?>"><?php _e('Facebook Page URL', 'asalah'); ?>: </label>
            <input id="<?php echo $this->get_field_id('fburl'); ?>" name="<?php echo $this->get_field_name('fburl'); ?>" value="<?php echo $instance['fburl']; ?>" type="text" />
        </p>
        <?php
    }

}
?>