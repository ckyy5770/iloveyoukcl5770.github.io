<?php
add_action("admin_init", "asalah_post_metaboxes");

function asalah_post_metaboxes() {
    $global_types = array('post','page');
    $types = array('post', 'page');

    // add meta box for commons options in posts and pages

    add_meta_box("post_options", sprintf(__('%s - Post Options.', 'asalah'), theme_name), "asalah_posts_meta_options", "post", "normal", "core");

    add_meta_box("Page_options", sprintf(__('%s - Page Options.', 'asalah'), theme_name), "asalah_page_options", "page", "normal", "core");

    add_meta_box("asalah_blog_template_box", sprintf(__('%s - Blog Template Options.', 'asalah'), theme_name), "page_blog_template_options", "page", "normal", "high");

    foreach ($global_types as $type) {
        add_meta_box("asalah_general_page_options", sprintf(__('%s - General Page Options.', 'asalah'), theme_name), "asalah_global_options", $type, "normal", "core");
    }
}

function asalah_post_options($value, $validation = "") {
    global $post;

    $depends_on_templates = "";
    if (isset($value['templates']) && $value['templates'] != "" ) {

        $mother_templates_atts = '';
        foreach($value['templates'] as $template) {
            $mother_templates_atts .= 'page-templates/'.$template.'.php ';
        }
        $depends_on_templates = ' data_mother_templates="'.$mother_templates_atts.'"';
    }
    ?>

    <div class="option-item asalah_post_option_item" id="<?php echo esc_attr($value['id']) ?>-item" <?php echo esc_attr($depends_on_templates); ?> >
        <span class="label"><?php echo esc_attr($value['name']); ?></span>
        <?php
        $id = esc_attr($value['id']);
        $get_meta = get_post_custom($post->ID);
        $current_value = "";
        if (isset($value['default']) && $value['default']) {
        	$current_value = $value['default'];
        }
        if (isset($get_meta[$id][0])) {
            if ($validation == 'html') {
                $current_value = balanceTags($get_meta[$id][0]);
            }elseif($validation == 'url') {
                $current_value = esc_url($get_meta[$id][0]);
            }elseif($validation == 'attr') {
                $current_value = esc_attr($get_meta[$id][0]);
            }else{
                $current_value = $get_meta[$id][0];
            }
        }

        switch ($value['type']) {

            case 'text':
                ?>
                <input  name="<?php echo esc_attr($value['id']); ?>" id="<?php echo esc_attr($value['id']); ?>" type="text" value="<?php echo ($current_value) ?>" />
                <?php
                break;

            case 'color':
                ?>
                <input class="asalah_color" name="<?php echo esc_attr($value['id']); ?>" id="<?php echo esc_attr($value['id']); ?>" type="text" value="<?php echo ($current_value) ?>"  />
                <?php
                break;

            case 'image':
                ?>
                <input  name="<?php echo esc_attr($value['id']); ?>" id="<?php echo esc_attr($value['id']); ?>" class="input-upload" type="text" value="<?php echo ($current_value) ?>" />
                <a href="#" class="aq_upload_button button" rel="image">Upload</a><p></p>
                <?php
                break;

            case 'video':
                ?>
                <input  name="<?php echo esc_attr($value['id']); ?>" id="<?php echo esc_attr($value['id']); ?>" class="input-upload" type="text" value="<?php echo ($current_value) ?>" />
                <a href="#" class="aq_upload_button button" rel="video">Upload</a><p></p>
                <?php
                break;

            case 'select':
                ?>
                <select name="<?php echo esc_attr($value['id']); ?>" id="<?php echo esc_attr($value['id']); ?>">
                    <?php foreach ($value['options'] as $key => $option) { ?>
                        <option value="<?php echo esc_attr($key); ?>" <?php
                        if ($current_value == $key) {
                            echo ' selected="selected"';
                        }
                        ?>><?php echo esc_attr($option); ?></option>
                            <?php } ?>
                </select>
                <?php
                break;

            case 'textarea':
                ?>
                <textarea name="<?php echo esc_attr($value['id']); ?>" id="<?php echo esc_attr($value['id']); ?>" type="<?php echo esc_attr($value['type']); ?>" cols="" rows=""><?php echo ($current_value) ?></textarea>
                <?php
                break;
        }
        ?>
    </div>
    <?php
}


function asalah_page_options() {

    global $asalah_data;

    asalah_post_options(
            array("name" => __("Show Title", 'asalah'),
                "id" => "asalah_show_title",
                "type" => "select",
                "options" => array(
                    false => __('Same as site options', 'asalah'),
                    'yes' => __('Yes', 'asalah'),
                    'no' => __('No', 'asalah')
    )));

    asalah_post_options(
            array("name" => __("Show Share Icons", 'asalah'),
                "id" => "asalah_show_share",
                "type" => "select",
                "options" => array(
                    false => __('Same as site options', 'asalah'),
                    'yes' => __('Yes', 'asalah'),
                    'no' => __('No', 'asalah')
    )));

    asalah_post_options(
            array("name" => __("Show Author Box", 'asalah'),
                "id" => "show_author_box",
                "type" => "select",
                "options" => array(
                    false => __('Same as site options', 'asalah'),
                    'yes' => __('Yes', 'asalah'),
                    'no' => __('No', 'asalah')
    )));

    asalah_post_options(
            array("name" => __("Enable Facebook Comments", 'asalah'),
                "id" => "asalah_enable_facebook_comments",
                "type" => "select",
                "options" => array(
                    'no' => __('No', 'asalah'),
                    'yes' => __('Yes', 'asalah'),
    )));

    wp_nonce_field( basename( __FILE__ ), 'asalah_page_options' );

}

add_action('save_post', 'save_page_options');
function save_page_options() {
    global $post;

    if ( isset($post) ) : // check if post is exists

    /* Verify the nonce before proceeding. */
    if ( !isset( $_POST['asalah_page_options'] ) || !wp_verify_nonce( $_POST['asalah_page_options'], basename( __FILE__ ) ) )
        return $post->ID;

    /* Get the post type object. */
    $post_type = get_post_type_object( $post->post_type );

    /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $post_type->cap->edit_post, $post->ID ) )
        return $post->ID;

        $custom_meta_fields = array(
          'asalah_show_title',
          'asalah_show_share',
          'show_author_box',
          'asalah_enable_facebook_comments',
        );

    foreach ($custom_meta_fields as $custom_meta_field) {

        if (isset($_POST[$custom_meta_field])):
            update_post_meta($post->ID, $custom_meta_field, htmlspecialchars(stripslashes($_POST[$custom_meta_field])));
        else:
            if (isset($post->ID) && isset($custom_meta_field) && $custom_meta_field != '') {
                delete_post_meta($post->ID, $custom_meta_field);
            }
        endif;
    }

    endif; // end if check if post is exists
}

function asalah_posts_meta_options() {
    global $asalah_data;

    asalah_post_options(
            array("name" => __("Show Title", 'asalah'),
                "id" => "asalah_show_title",
                "type" => "select",
                "options" => array(
                    false => __('Same as site options', 'asalah'),
                    'yes' => __('Yes', 'asalah'),
                    'no' => __('No', 'asalah')
    )));

    asalah_post_options(
            array("name" => __("Show Meta Info", 'asalah'),
                "id" => "asalah_show_meta",
                "type" => "select",
                "options" => array(
                    false => __('Same as site options', 'asalah'),
                    'yes' => __('Yes', 'asalah'),
                    'no' => __('No', 'asalah')
    )));

    asalah_post_options(
            array("name" => __("Show Share Icons", 'asalah'),
                "id" => "asalah_show_share",
                "type" => "select",
                "options" => array(
                    false => __('Same as site options', 'asalah'),
                    'yes' => __('Yes', 'asalah'),
                    'no' => __('No', 'asalah')
    )));

    asalah_post_options(
            array("name" => __("Show Author Box", 'asalah'),
                "id" => "show_author_box",
                "type" => "select",
                "options" => array(
                    false => __('Same as site options', 'asalah'),
                    'yes' => __('Yes', 'asalah'),
                    'no' => __('No', 'asalah')
    )));

    asalah_post_options(
            array("name" => __("Custom Description", 'asalah'),
                "id" => "asalah_custom_description",
                "type" => "textarea",
                "default" => "",
                ));

    wp_nonce_field( basename( __FILE__ ), 'asalah_posts_meta_options' );
}

add_action('save_post', 'asalah_save_post');

function asalah_save_post() {
    global $post;

    if ( isset($post) ) : // check if post is exists
    /* Verify the nonce before proceeding. */
    if ( !isset( $_POST['asalah_posts_meta_options'] ) || !wp_verify_nonce( $_POST['asalah_posts_meta_options'], basename( __FILE__ ) ) )
        return $post->ID;

    /* Get the post type object. */
    $post_type = get_post_type_object( $post->post_type );

    /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $post_type->cap->edit_post, $post->ID ) )
        return $post->ID;

    $custom_meta_fields = array(
      'asalah_show_meta',
      'asalah_show_share',
      'asalah_show_title',
      'show_author_box',
      'asalah_custom_description',
    );
    foreach ($custom_meta_fields as $custom_meta_field) {

        if (isset($_POST[$custom_meta_field])):
            update_post_meta($post->ID, $custom_meta_field, htmlspecialchars(stripslashes($_POST[$custom_meta_field])));
        else:
            if (isset($post->ID) && isset($custom_meta_field) && $custom_meta_field != '') {
                delete_post_meta($post->ID, $custom_meta_field);
            }
        endif;
    }
    endif; // end if check if post is exists
}

function page_blog_template_options() {
    asalah_post_options(
            array("name" => __("Pagination Style", 'asalah'),
                "id" => "asalah_pagination_style",
                "type" => "select",
                "templates" => array('blog'),
                "options" => array(
                    false => __('Same as site options', 'asalah'),
                    'nav' => __('Older/Newer Links', 'asalah'),
                    'num' => __('Numerical', 'asalah'),
                    'ajax' => __('Ajax', 'asalah')
    )));

    asalah_post_options(
            array("name" => __("Blog Style", 'asalah'),
                "id" => "asalah_blog_style",
                "type" => "select",
                "templates" => array('blog'),
                "options" => array(
                    false => __('Same as site options', 'asalah'),
                    'default' => __('Default', 'asalah'),
                    'banners' => __('Banners First', 'asalah'),
                    'masonry' => __('Masonry', 'asalah'),
                    'list' => __('List', 'asalah'),
    )));

    wp_nonce_field( basename( __FILE__ ), 'page_blog_template_options' );

}

add_action('save_post', 'save_blog_template');

function save_blog_template() {
    global $post;

    if ( isset($post) ) : // check if post is exists

    /* Verify the nonce before proceeding. */
    if ( !isset( $_POST['page_blog_template_options'] ) || !wp_verify_nonce( $_POST['page_blog_template_options'], basename( __FILE__ ) ) )
        return $post->ID;

    /* Get the post type object. */
    $post_type = get_post_type_object( $post->post_type );

    /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $post_type->cap->edit_post, $post->ID ) )
        return $post->ID;

    $custom_meta_fields = array(
        'asalah_blog_style',
        'asalah_pagination_style',
    );

    foreach ($custom_meta_fields as $custom_meta_field) {

        if (isset($_POST[$custom_meta_field])):
            update_post_meta($post->ID, $custom_meta_field, htmlspecialchars(stripslashes($_POST[$custom_meta_field])));
        else:
            if (isset($post->ID) && isset($custom_meta_field) && $custom_meta_field != '') {
                delete_post_meta($post->ID, $custom_meta_field);
            }
        endif;
    }

    endif; // end if check if post is exists
}



function asalah_global_options() {

    global $asalah_data;

    asalah_post_options(
            array("name" => __("Sidebar Position", 'asalah'),
                "id" => "asalah_sidebar_position",
                "type" => "select",
                "options" => array(
                    false => __('Same as site options', 'asalah'),
                    'left' => __('Left Sidebar', 'asalah'),
                    'right' => __('Right Sidebar', 'asalah'),
                    'none' => __('No Sidebar', 'asalah'),
    )));


    wp_nonce_field( basename( __FILE__ ), 'asalah_global_options' );
}

add_action('save_post', 'save_global');
function save_global() {
    global $post;

    if ( isset($post) ) : // check if post is exists

    /* Verify the nonce before proceeding. */
    if ( !isset( $_POST['asalah_global_options'] ) || !wp_verify_nonce( $_POST['asalah_global_options'], basename( __FILE__ ) ) )
        return $post->ID;

    /* Get the post type object. */
    $post_type = get_post_type_object( $post->post_type );

    /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $post_type->cap->edit_post, $post->ID ) )
        return $post->ID;

    $custom_meta_fields = array(
        'asalah_sidebar_position',
    );

    foreach ($custom_meta_fields as $custom_meta_field) {

        if (isset($_POST[$custom_meta_field])):
            update_post_meta($post->ID, $custom_meta_field, htmlspecialchars(stripslashes($_POST[$custom_meta_field])));
        else:
            if (isset($post->ID) && isset($custom_meta_field) && $custom_meta_field != '') {
                delete_post_meta($post->ID, $custom_meta_field);
            }
        endif;
    }

    endif; // end if check if post is exists
}
?>