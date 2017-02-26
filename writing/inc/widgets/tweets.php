<?php
add_action('widgets_init', 'tweets_widget_init');

function tweets_widget_init() {
    register_widget('tweets_widget');
}

class tweets_widget extends WP_Widget {


    function __construct() {
		parent::__construct(
			'tweets-widget', // Base ID
			'Writing - Tweets', // Name
			array( 'description' => '','classname' => 'asalah-tweets-widget','width' => 250, 'height' => 350 ) // Args
		);
	}


    function widget($args, $instance) {
        extract($args);

        global $asalah_data;

        $title = isset( $instance['title'] ) ? apply_filters('widget_title', $instance['title']) : '' ;
        $username = isset( $instance['username'] ) ? $instance['username'] : '' ;
        $number = isset( $instance['title'] ) ? $instance['number'] : '' ;

        echo $before_widget;

        if ($title) :
            echo $before_title;
            echo $title;
            echo $after_title;
        endif;

        $consumerkey = asalah_option('asalah_conk_id');
        $consumersecret = asalah_option('asalah_cons_id');
        $accesstoken = asalah_option('asalah_at_id');
        $accesstokensecret = asalah_option('asalah_ats_id');

        echo asalah_twitter_tweets($consumerkey, $consumersecret, $accesstoken, $accesstokensecret, $username, $number);

        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['username'] = $new_instance['username'];
        $instance['number'] = $new_instance['number'];
        return $instance;
    }

    function form($instance) {
        $defaults = array('title' => __('Tweets', 'asalah'), 'username' => '', 'number' => '');
        $instance = wp_parse_args((array) $instance, $defaults);
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'asalah'); ?>: </label>
            <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Username', 'asalah'); ?>: </label>
            <input id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" value="<?php echo $instance['username']; ?>" type="text" size="3" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number Of Posts', 'asalah'); ?>: </label>
            <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>" type="text" size="3" />
        </p>
        <?php
    }

}
?>