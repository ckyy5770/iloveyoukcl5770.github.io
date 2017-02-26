<?php
function asalah_register_theme_customizer( $wp_customize ) {
$style_direction = (is_rtl()) ? 'right' : 'left';
	// Helper functions for fonts.

	$font_choices = customizer_library_get_font_choices();
	$font_sizes = array("false"=>'Default', '10'=>'10', '12'=>'12', '14'=>'14', '16'=>'16', '18'=>'18', '20'=>'20', '22'=>'22', '24'=>'24', '26'=>'26', '28'=>'28', '30'=>'30', '32'=>'32', '34'=>'34','36'=>'36','38'=>'38','40'=>'40','45'=>'45','50'=>'50','55'=>'55','60'=>'60','65'=>'65','70'=>'70');

	/* --------
	add new sections
	------------------------------------------- */
	$wp_customize->add_section( 'asalah_layout' , array(
	    'title'      => __('Layout','asalah'),
	    'priority'   => 20,
	) );

	$wp_customize->add_section( 'asalah_header_style' , array(
	    'title'      => __('Header Style','asalah'),
	    'priority'   => 20,
	) );

	$wp_customize->add_section( 'asalah_logo_style' , array(
	    'title'      => __('Logo Style','asalah'),
	    'priority'   => 20,
	) );

	$wp_customize->add_section( 'asalah_site_style' , array(
	    'title'      => __('General Style','asalah'),
	    'priority'   => 20,
	) );

	$wp_customize->add_section( 'asalah_typography' , array(
	    'title'      => __('Typography','asalah'),
	    'priority'   => 20,
	) );
    $wp_customize->add_section( 'asalah_social' , array(
        'title'      => __('Social Settings','asalah'),
        'priority'   => 20,
    ) );

    $wp_customize->add_section( 'asalah_custom_code' , array(
        'title'      => __('Add Header/Footer Content','asalah'),
        'priority'   => 20,
    ) );

    $wp_customize->add_section( 'asalah_facebook_comments' , array(
        'title'      => __('Facebook Comments','asalah'),
        'priority'   => 20,
    ) );

    $wp_customize->add_section( 'background_image', array(
            'title'          => __( 'Background Image', 'asalah' ),
            'theme_supports' => 'custom-background',
            'priority'       => 20,
        ) );

	$wp_customize->remove_section( 'header_image' );
	$wp_customize->remove_section( 'colors' );

	/* --------
	change title and description to postMessage
	------------------------------------------- */

	/* --------
	add title logo settings
	------------------------------------------- */


    $wp_customize->add_setting(
        'asalah_show_tagline',
        array(
            'default'     => false,
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('asalah_show_tagline', array(
        'label'      => __('Tagline Place', 'asalah'),
        'section'    => 'title_tagline',
        'settings'   => 'asalah_show_tagline',
        'type'       => 'select',
        'choices'    => array(
            'beside' => __('Beside Title', 'asalah'),
            'below' => __('Below Title', 'asalah'),
            'hide' => __('Hide', 'asalah'),
        ),
    ));



    /* footer credits */
    $wp_customize->add_setting(
        'asalah_site_description',
        array(
            'sanitize_callback' => 'esc_attr',
						'transport' => 'postMessage',
        )
    );

    $wp_customize->add_control('asalah_site_description', array(
        'label'      => __('Site Description - Few words about your blog to introducte it to search engines and social networks', 'asalah'),
        'section'    => 'title_tagline',
        'settings'   => 'asalah_site_description',
    ));

    /* footer credits */
    $wp_customize->add_setting(
        'asalah_footer_credits',
        array(
            'sanitize_callback' => 'esc_attr',
						'default' => '',
        )
    );

    $wp_customize->add_control('asalah_footer_credits', array(
        'label'      => __('Footer Credits Text', 'asalah'),
        'section'    => 'title_tagline',
        'settings'   => 'asalah_footer_credits',
    ));

    /* facebook id */
		$wp_customize->add_setting(
        'asalah_default_share_thumb',
        array(
            'default'     => '',
            'sanitize_callback' => 'esc_url',
        )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'asalah_default_share_thumb', array(
        'label'      => __('Site Default Image for Share', 'asalah'),
				'description' => ('Image to be used when sharing on social media instead of logo image (should be more than 200×200px)'),
        'section'    => 'asalah_social',
        'settings'   => 'asalah_default_share_thumb',
    )));

    $wp_customize->add_setting(
        'asalah_fb_id',
        array(

            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('asalah_fb_id', array(
        'label'      => __('Facebook App ID', 'asalah'),
        'section'    => 'asalah_social',
        'settings'   => 'asalah_fb_id',
    ));

    /* twitter security keys */
    $wp_customize->add_setting(
        'asalah_conk_id',
        array(

            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('asalah_conk_id', array(
        'label'      => __('Twitter Consumer Key', 'asalah'),
        'section'    => 'asalah_social',
        'settings'   => 'asalah_conk_id',
    ));

    $wp_customize->add_setting(
        'asalah_cons_id',
        array(

            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('asalah_cons_id', array(
        'label'      => __('Twitter Consumer Secret', 'asalah'),
        'section'    => 'asalah_social',
        'settings'   => 'asalah_cons_id',
    ));

    $wp_customize->add_setting(
        'asalah_at_id',
        array(

            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('asalah_at_id', array(
        'label'      => __('Twitter Access Token', 'asalah'),
        'section'    => 'asalah_social',
        'settings'   => 'asalah_at_id',
    ));

    $wp_customize->add_setting(
        'asalah_ats_id',
        array(

            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('asalah_ats_id', array(
        'label'      => __('Twitter Access Token Secret', 'asalah'),
        'section'    => 'asalah_social',
        'settings'   => 'asalah_ats_id',
    ));

		/* Social Share buttons */

		$share_buttons = array('facebook' => 'Facebook', 'twitter' => 'Twitter', 'gplus' => 'Google+', 'pinterest' => 'Pinterest', 'linkedin' => 'Linkedin', 'vk' => 'VK', 'tumblr' => 'Tumblr', 'reddit' => 'Reddit', 'pocket' => 'Pocket');

		foreach ($share_buttons as $network=>$social) {
			$wp_customize->add_setting(
	        'asalah_'.$network.'_share',
	        array(
	            'sanitize_callback' => 'esc_attr',
	        )
	    );

			$wp_customize->add_control('asalah_'.$network.'_share', array(
	        'label'      => __($social.' Share', 'asalah'),
	        'section'    => 'asalah_social',
	        'settings'   => 'asalah_'.$network.'_share',
	        'type'       => 'select',

	        'choices'    => array(
	            'yes' => __('Yes', 'asalah'),
	            'no' => __('No', 'asalah'),
	        ),
	    ));
		}
    /* social profiles */
    global $social_networks;
    foreach ($social_networks as $network => $social ) {
        $wp_customize->add_setting(
            'asalah_'.$network.'_url',
            array(

                'sanitize_callback' => 'esc_url',
            )
        );

        $wp_customize->add_control('asalah_'.$network.'_url', array(
            'label'      => $social.' URL',
            'section'    => 'asalah_social',
            'settings'   => 'asalah_'.$network.'_url',
        ));
    }

    /* Facebook Comments */

    $wp_customize->add_setting(
        'asalah_enable_facebook_comments',
        array(
            'default'     => false,
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('asalah_enable_facebook_comments', array(
        'label'      => 'Enable facebook comments at single posts',
        'section'    => 'asalah_facebook_comments',
        'type'       => 'checkbox',
    ));

    function asalah_facebook_app_id_callback( $control ) {
        if (( $control->manager->get_setting('asalah_fb_id')->value() != ' ' )) {
            return true;
        } else {
            return false;
        }
    }

    $wp_customize->add_setting(
        'asalah_facebook_app_id',
        array(
					  'default' => '',
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control(
        'asalah_facebook_app_id',
        array(
            'section'  => 'asalah_facebook_comments',
            'label'    => 'Facebook App ID',
            'type'     => 'text',
            'active_callback' => 'asalah_facebook_app_id_callback',
        )
    );

    $wp_customize->add_setting(
        'asalah_facebook_comments_html5',
        array(
            'sanitize_callback' => 'esc_attr',
        )
    );

		$wp_customize->add_control('asalah_facebook_comments_html5', array(
        'label'      => __('Use HTML5', 'asalah'),
        'section'    => 'asalah_facebook_comments',
        'settings'   => 'asalah_facebook_comments_html5',
        'type'       => 'select',

        'choices'    => array(
            'yes' => __('Yes', 'asalah'),
            'no' => __('No', 'asalah'),
        ),
    ));
		//
		// $wp_customize->add_setting(
    //     'asalah_facebook_comments_scheme',
    //     array(
    //         'default'     => '',
    //         'sanitize_callback' => 'esc_attr',
    //     )
    // );
    // $wp_customize->add_control('asalah_facebook_comments_scheme', array(
    //     'label'      => __('Facebook Comments style', 'asalah'),
    //     'section'    => 'asalah_facebook_comments',
    //     'settings'   => 'asalah_facebook_comments_scheme',
    //     'type'       => 'select',
    //
    //     'choices'    => array(
    //         'light' => __('Light', 'asalah'),
    //         'dark' => __('Dark', 'asalah'),
    //     ),
    // ));

		$wp_customize->add_setting(
        'asalah_facebook_comments_width',
        array(
            'default'            => '100&#37;',
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control(
        'asalah_facebook_comments_width',
        array(
            'section'  => 'asalah_facebook_comments',
            'label'    => 'Facebook Comments Width',
            'type'     => 'text',
            'active_callback' => 'asalah_facebook_app_id_callback',
        )
    );

		$wp_customize->add_setting(
        'asalah_facebook_comments_num',
        array(
            'default'            => '',
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control(
        'asalah_facebook_comments_num',
        array(
            'section'  => 'asalah_facebook_comments',
            'label'    => 'Number of comments',
            'type'     => 'text',
            'active_callback' => 'asalah_facebook_app_id_callback',
        )
    );

		/* Logo Style Section */

		/* upload site logo */
    $wp_customize->add_setting(
        'asalah_default_logo',
        array(
            'default'     => '',
            'sanitize_callback' => 'esc_url',
        )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'asalah_default_logo', array(
        'label'      => __('Site Logo', 'asalah'),
        'section'    => 'asalah_logo_style',
        'settings'   => 'asalah_default_logo',
    )));

    $wp_customize->add_setting(
        'asalah_default_logo_retina',
        array(
            'default'     => '',
            'sanitize_callback' => 'esc_url',
        )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'asalah_default_logo_retina', array(
        'label'      => __('Retina Logo ( Double size as default logo )', 'asalah'),
        'section'    => 'asalah_logo_style',
        'settings'   => 'asalah_default_logo_retina',
    )));

		/* logo font size */

		$option = 'asalah_logo_font_size';
		$section = 'asalah_logo_style';
		$max = 100;
		$min = 0;
			$wp_customize->add_setting( $option,
			array(
				'default' => 0,
				'sanitize_callback' => 'esc_attr',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control( $option,
			array(
				'label' => 'Logo Font Size (0 for auto)',
				'section' => $section,
				'settings' => $option,
				'type' => 'range',
				'description' => '<style>.customize-control-range { position:relative;}</style><input type="number" data-customize-setting-link="'.$option.'" oninput="rangeInput'.$option.'.value=this.value" name="amountInput'.$option.'" min="'.$min.'" max="'.$max.'" value="'.esc_attr( $wp_customize->get_setting($option)->value() ).'" style="width: 50px;position: absolute;'.$style_direction.': 145px;bottom: 6px;" />',
				'input_attrs' => array(
					'min'   => $min,
					'max'   => $max,
					'step'  => 5,
					'class' => 'test-class test',
					'style' => 'width: 140px',
					'oninput' => 'amountInput'.$option.'.value=this.value',
					'name' => 'rangeInput'.$option.'',
			),
			)
		);

		$option = 'asalah_logo_width';
		$section = 'asalah_logo_style';
		$max = 500;
		$min = 0;
			$wp_customize->add_setting( $option,
			array(
				'default' => 0,
				'sanitize_callback' => 'esc_attr',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control( $option,
			array(
				'label' => 'Logo Width ( 0 for auto width )',
				'section' => $section,
				'settings' => $option,
				'type' => 'range',
				'description' => '<style>.customize-control-range { position:relative;}</style><input type="number" data-customize-setting-link="'.$option.'" oninput="rangeInput'.$option.'.value=this.value" name="amountInput'.$option.'" min="'.$min.'" max="'.$max.'" value="'.esc_attr( $wp_customize->get_setting($option)->value() ).'" style="width: 50px;position: absolute;'.$style_direction.': 145px;bottom: 6px;" />',
				'input_attrs' => array(
					'min'   => $min,
					'max'   => $max,
					'step'  => 5,
					'class' => 'test-class test',
					'style' => 'width: 140px',
					'oninput' => 'amountInput'.$option.'.value=this.value',
					'name' => 'rangeInput'.$option.'',
			),
			)
		);

				$option = 'asalah_logo_height';
				$section = 'asalah_logo_style';
				$max = 500;
				$min = 0;
					$wp_customize->add_setting( $option,
					array(
						'default' => 0,
						'sanitize_callback' => 'esc_attr',
						'transport' => 'postMessage',
					)
				);

				$wp_customize->add_control( $option,
					array(
						'label' => 'Logo Height ( 0 for auto Height )',
						'section' => $section,
						'settings' => $option,
						'type' => 'range',
						'description' => '<style>.customize-control-range { position:relative;}</style><input type="number" data-customize-setting-link="'.$option.'" oninput="rangeInput'.$option.'.value=this.value" name="amountInput'.$option.'" min="'.$min.'" max="'.$max.'" value="'.esc_attr( $wp_customize->get_setting($option)->value() ).'" style="width: 50px;position: absolute;left: 145px;bottom: 6px;" />',
						'input_attrs' => array(
							'min'   => $min,
							'max'   => $max,
							'step'  => 5,
							'class' => 'test-class test',
							'style' => 'width: 140px',
							'oninput' => 'amountInput'.$option.'.value=this.value',
							'name' => 'rangeInput'.$option.'',
					),
					)
				);


		/* logo options */

		$wp_customize->add_setting(
				'asalah_remove_logo_dot',
				array(
						'default'     => false,
						'sanitize_callback' => 'esc_attr',
						'transport'   => 'postMessage',
				)
		);

		$wp_customize->add_control('asalah_remove_logo_dot', array(
				'label'      => 'Remove logo dot',
				'section'    => 'asalah_logo_style',
				'type'       => 'checkbox',
		));


		$wp_customize->add_setting(
				'asalah_center_logo',
				array(
						'default'     => false,
						'sanitize_callback' => 'esc_attr',
						'transport'   => 'postMessage',
				)
		);

		$wp_customize->add_control('asalah_center_logo', array(
				'label'      => 'Center logo',
				'section'    => 'asalah_logo_style',
				'type'       => 'checkbox',
		));

		/* Header Style Section */

		$wp_customize->add_setting(
        'asalah_header_avatar',
        array(
            'default'     => '',
            'sanitize_callback' => 'esc_url',

        )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'asalah_header_avatar', array(
        'label'      => __('Header User Avatar', 'asalah'),
        'section'    => 'asalah_header_style',
        'settings'   => 'asalah_header_avatar',
    )));


		$wp_customize->add_setting(
				'asalah_header_background',
				array(
						'default'     => 0,
						'sanitize_callback' => 'esc_url',
				)
		);

		$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'asalah_header_background', array(
				'label'      => __('Header Background', 'asalah'),
				'section'    => 'asalah_header_style',
				'settings'   => 'asalah_header_background',
		)));

		$wp_customize->add_setting(
				'asalah_boxed_header',
				array(
						'default'     => false,
						'sanitize_callback' => 'esc_attr',

				)
		);

		$wp_customize->add_control('asalah_boxed_header', array(
				'label'      => 'Boxed Header',
				'section'    => 'asalah_header_style',
				'type'       => 'checkbox',
		));

		function asalah_header_background_style_callback( $control ) {
				if ( ($control->manager->get_setting('asalah_header_background')->value() == true) ) {
						return true;
				} else {
						return false;
				}
		}

		$wp_customize->add_setting(
        'asalah_header_background_style',
        array(
            'default'     => 'single',
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('asalah_header_background_style', array(
        'label'      => __('Header Background Style', 'asalah'),
        'section'    => 'asalah_header_style',
        'settings'   => 'asalah_header_background_style',
        'type'       => 'select',
				'active_callback' => 'asalah_header_background_style_callback',
        'choices'    => array(
            'single' => __('Single', 'asalah'),
            'tiled' => __('Tiled', 'asalah'),
            'cover' => __('Cover', 'asalah'),
        ),
    ));

		$option = 'asalah_header_height';
		$section = 'asalah_header_style';
		$max = 500;
		$min = 0;
			$wp_customize->add_setting( $option,
			array(
				'default' => 0,
				'sanitize_callback' => 'esc_attr',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control( $option,
			array(
				'label' => 'Header Height ( 0 for auto Height )',
				'section' => $section,
				'settings' => $option,
				'type' => 'range',
				'description' => '<style>.customize-control-range { position:relative;}</style><input type="number" data-customize-setting-link="'.$option.'" oninput="rangeInput'.$option.'.value=this.value" name="amountInput'.$option.'" min="'.$min.'" max="'.$max.'" value="'.esc_attr( $wp_customize->get_setting($option)->value() ).'" style="width: 50px;position: absolute;'.$style_direction.': 145px;bottom: 6px;" />',
				'input_attrs' => array(
					'min'   => $min,
					'max'   => $max,
					'step'  => 5,
					'class' => 'test-class test',
					'style' => 'width: 140px',
					'oninput' => 'amountInput'.$option.'.value=this.value',
					'name' => 'rangeInput'.$option.'',
			),
			)
		);


		$wp_customize->add_setting(
				'asalah_enable_header_color',
				array(
						'default'     => false,
						'sanitize_callback' => 'esc_attr',

				)
		);

		$wp_customize->add_control('asalah_enable_header_color', array(
				'label'      => 'Change Header Color',
				'section'    => 'asalah_header_style',
				'type'       => 'checkbox',
		));

		function asalah_header_color_callback( $control ) {
				if ( ($control->manager->get_setting('asalah_enable_header_color')->value() == true) ) {
						return true;
				} else {
						return false;
				}
		}

		$wp_customize->add_setting(
				'asalah_header_color',
				array(
						'default'     => '#fff',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport'   => 'postMessage',
				)
		);

		$wp_customize->add_control(
				new WP_Customize_Color_Control(
						$wp_customize,
						'asalah_header_color',
						array(
								'label'      => __( 'Header background Color', 'asalah' ),
								'section'    => 'asalah_header_style',
								'settings'   => 'asalah_header_color',
								'active_callback' => 'asalah_header_color_callback'
						)
				)
		);

		$wp_customize->add_setting(
				'asalah_enable_header_text_color',
				array(
						'default'     => false,
						'sanitize_callback' => 'esc_attr',

				)
		);

		$wp_customize->add_control('asalah_enable_header_text_color', array(
				'label'      => 'Change Header Text Color',
				'section'    => 'asalah_header_style',
				'type'       => 'checkbox',
		));

		function asalah_header_color_text_callback( $control ) {
				if ( ($control->manager->get_setting('asalah_enable_header_text_color')->value() == true) ) {
						return true;
				} else {
						return false;
				}
		}

		$wp_customize->add_setting(
				'asalah_header_text_color',
				array(
						'default'     => '#333',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport'   => 'postMessage',
				)
		);

		$wp_customize->add_control(
				new WP_Customize_Color_Control(
						$wp_customize,
						'asalah_header_text_color',
						array(
								'label'      => __( 'Header Text Color', 'asalah' ),
								'section'    => 'asalah_header_style',
								'settings'   => 'asalah_header_text_color',
								'active_callback' => 'asalah_header_color_text_callback'
						)
				)
		);

		$wp_customize->add_setting(
				'asalah_enable_header_hover_color',
				array(
						'default'     => false,
						'sanitize_callback' => 'esc_attr',

				)
		);

		$wp_customize->add_control('asalah_enable_header_hover_color', array(
				'label'      => 'Change Header Text Hover Color',
				'section'    => 'asalah_header_style',
				'type'       => 'checkbox',
		));

		function asalah_header_color_hover_callback( $control ) {
				if ( ($control->manager->get_setting('asalah_enable_header_hover_color')->value() == true) ) {
						return true;
				} else {
						return false;
				}
		}

		$wp_customize->add_setting(
				'asalah_header_hover_color',
				array(
						'default'     => '#333',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport'   => 'postMessage',
				)
		);

		$wp_customize->add_control(
				new WP_Customize_Color_Control(
						$wp_customize,
						'asalah_header_hover_color',
						array(
								'label'      => __( 'Header Text Hover Color', 'asalah' ),
								'section'    => 'asalah_header_style',
								'settings'   => 'asalah_header_hover_color',
								'active_callback' => 'asalah_header_color_hover_callback'
						)
				)
		);

		$wp_customize->add_setting(
				'asalah_enable_top_menu_color',
				array(
						'default'     => false,
						'sanitize_callback' => 'esc_attr',

				)
		);

		$wp_customize->add_control('asalah_enable_top_menu_color', array(
				'label'      => 'Change Top Menu Color',
				'section'    => 'asalah_header_style',
				'type'       => 'checkbox',
		));

		function asalah_top_menu_color_callback( $control ) {
				if ( ($control->manager->get_setting('asalah_enable_top_menu_color')->value() == true) ) {
						return true;
				} else {
						return false;
				}
		}

		$wp_customize->add_setting(
				'asalah_top_menu_color',
				array(
						'default'     => '#fff',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport'   => 'postMessage',
				)
		);

		$wp_customize->add_control(
				new WP_Customize_Color_Control(
						$wp_customize,
						'asalah_top_menu_color',
						array(
								'label'      => __( 'Top Menu Background Color', 'asalah' ),
								'section'    => 'asalah_header_style',
								'settings'   => 'asalah_top_menu_color',
								'active_callback' => 'asalah_top_menu_color_callback'

						)
				)
		);

		$wp_customize->add_setting(
				'asalah_enable_top_menu_text_color',
				array(
						'default'     => false,
						'sanitize_callback' => 'esc_attr',

				)
		);

		$wp_customize->add_control('asalah_enable_top_menu_text_color', array(
				'label'      => 'Change Top Menu Text Color',
				'section'    => 'asalah_header_style',
				'type'       => 'checkbox',
		));

		function asalah_top_menu_text_color_callback( $control ) {
				if ( ($control->manager->get_setting('asalah_enable_top_menu_text_color')->value() == true) ) {
						return true;
				} else {
						return false;
				}
		}

		$wp_customize->add_setting(
				'asalah_top_menu_text_color',
				array(
						'default'     => '#333',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport'   => 'postMessage',
				)
		);

		$wp_customize->add_control(
				new WP_Customize_Color_Control(
						$wp_customize,
						'asalah_top_menu_text_color',
						array(
								'label'      => __( 'Top Menu Text Color', 'asalah' ),
								'section'    => 'asalah_header_style',
								'settings'   => 'asalah_top_menu_text_color',
								'active_callback' => 'asalah_top_menu_text_color_callback'

						)
				)
		);

		$wp_customize->add_setting(
				'asalah_enable_top_menu_hover_color',
				array(
						'default'     => false,
						'sanitize_callback' => 'esc_attr',

				)
		);

		$wp_customize->add_control('asalah_enable_top_menu_hover_color', array(
				'label'      => 'Change Top Menu Text Hover Color',
				'section'    => 'asalah_header_style',
				'type'       => 'checkbox',
		));

		function asalah_top_menu_hover_color_callback( $control ) {
				if ( ($control->manager->get_setting('asalah_enable_top_menu_hover_color')->value() == true) ) {
						return true;
				} else {
						return false;
				}
		}

		$wp_customize->add_setting(
				'asalah_top_menu_hover_color',
				array(
						'default'     => '#333',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport'   => 'postMessage',
				)
		);

		$wp_customize->add_control(
				new WP_Customize_Color_Control(
						$wp_customize,
						'asalah_top_menu_hover_color',
						array(
								'label'      => __( 'Top Menu Text Hover Color', 'asalah' ),
								'section'    => 'asalah_header_style',
								'settings'   => 'asalah_top_menu_hover_color',
								'active_callback' => 'asalah_top_menu_hover_color_callback'

						)
				)
		);

		/* General Style Section */

    $wp_customize->add_setting(
        'asalah_fav_icon',
        array(
            'default'     => false,
            'sanitize_callback' => 'esc_url',
        )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'asalah_fav_icon', array(
        'label'      => __('Fav Icon', 'asalah'),
        'section'    => 'asalah_site_style',
        'settings'   => 'asalah_fav_icon',
    )));

		$wp_customize->add_setting(
				'asalah_enable_body_background_color',
				array(
						'default'     => false,
						'sanitize_callback' => 'esc_attr',

				)
		);

		$wp_customize->add_control('asalah_enable_body_background_color', array(
				'label'      => 'Change Site Background Color',
				'section'    => 'asalah_site_style',
				'type'       => 'checkbox',
		));

		function asalah_body_background_color_callback( $control ) {
				if ( ($control->manager->get_setting('asalah_enable_body_background_color')->value() == true) ) {
						return true;
				} else {
						return false;
				}
		}

		$wp_customize->add_setting(
				'asalah_body_background_color',
				array(
						'default'     => '#fff',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport'   => 'postMessage',
				)
		);



		$wp_customize->add_control(
				new WP_Customize_Color_Control(
						$wp_customize,
						'asalah_body_background_color',
						array(
								'label'      => __( 'Site Background Color', 'asalah' ),
								'section'    => 'asalah_site_style',
								'settings'   => 'asalah_body_background_color',
								'active_callback' => 'asalah_body_background_color_callback'
						)
				)
		);

		$wp_customize->add_setting(
				'asalah_enable_post_background_color',
				array(
						'default'     => false,
						'sanitize_callback' => 'esc_attr',

				)
		);

		$wp_customize->add_control('asalah_enable_post_background_color', array(
				'label'      => 'Change Content Background Color',
				'section'    => 'asalah_site_style',
				'type'       => 'checkbox',
		));

		function asalah_post_background_color_callback( $control ) {
				if ( ($control->manager->get_setting('asalah_enable_post_background_color')->value() == true) ) {
						return true;
				} else {
						return false;
				}
		}

		$wp_customize->add_setting(
				'asalah_post_background_color',
				array(
						'default' => '',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport'   => 'postMessage',
				)
		);



		$wp_customize->add_control(
				new WP_Customize_Color_Control(
						$wp_customize,
						'asalah_post_background_color',
						array(
								'label'      => __( 'Content Background Color', 'asalah' ),
								'section'    => 'asalah_site_style',
								'settings'   => 'asalah_post_background_color',
								'active_callback' => 'asalah_post_background_color_callback'
						)
				)
		);


		$wp_customize->add_setting(
				'asalah_main_color',
				array(
						'default'     => '#f47e00',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport'   => 'postMessage',
				)
		);

		$wp_customize->add_control(
				new WP_Customize_Color_Control(
						$wp_customize,
						'asalah_main_color',
						array(
								'label'      => __( 'Main Color', 'asalah' ),
								'section'    => 'asalah_site_style',
								'settings'   => 'asalah_main_color',
						)
				)
		);

		$wp_customize->add_setting(
				'asalah_enable_main_text_color',
				array(
						'default'     => false,
						'sanitize_callback' => 'esc_attr',

				)
		);

		$wp_customize->add_control('asalah_enable_main_text_color', array(
				'label'      => 'Change Main Text Color',
				'section'    => 'asalah_site_style',
				'type'       => 'checkbox',
		));

		function asalah_main_text_color_callback( $control ) {
				if ( ($control->manager->get_setting('asalah_enable_main_text_color')->value() == true) ) {
						return true;
				} else {
						return false;
				}
		}

		$wp_customize->add_setting(
				'asalah_main_text_color',
				array(
						'default' => '#333',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport'   => 'postMessage',
				)
		);

		$wp_customize->add_control(
				new WP_Customize_Color_Control(
						$wp_customize,
						'asalah_main_text_color',
						array(
								'label'      => __( 'Main Text Color', 'asalah' ),
								'section'    => 'asalah_site_style',
								'settings'   => 'asalah_main_text_color',
								'active_callback' => 'asalah_main_text_color_callback'
						)
				)
		);

		$wp_customize->add_setting(
				'asalah_enable_text_hover_color',
				array(
						'default'     => false,
						'sanitize_callback' => 'esc_attr',

				)
		);

		$wp_customize->add_control('asalah_enable_text_hover_color', array(
				'label'      => 'Change Titles Hover Color',
				'section'    => 'asalah_site_style',
				'type'       => 'checkbox',
		));

		function asalah_text_hover_color_callback( $control ) {
				if ( ($control->manager->get_setting('asalah_enable_text_hover_color')->value() == true) ) {
						return true;
				} else {
						return false;
				}
		}

		$wp_customize->add_setting(
				'asalah_text_hover_color',
				array(
						'default' => '#333',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport'   => 'postMessage',
				)
		);

		$wp_customize->add_control(
				new WP_Customize_Color_Control(
						$wp_customize,
						'asalah_text_hover_color',
						array(
								'label'      => __( 'Titles Hover Color', 'asalah' ),
								'section'    => 'asalah_site_style',
								'settings'   => 'asalah_text_hover_color',
								'active_callback' => 'asalah_text_hover_color_callback'
						)
				)
		);

		/* custom css and js */


		    function asalah_custom_css_callback( $control ) {
		        if ( ($control->manager->get_setting('asalah_enable_custom_css')->value() == true)) {
		            return true;
		        } else {
		            return false;
		        }
		    }

		    $wp_customize->add_setting(
		        'asalah_enable_custom_css',
		        array(
		            'default'     => 0,
		            'sanitize_callback' => 'esc_attr',
		        )
		    );

		    $wp_customize->add_control('asalah_enable_custom_css', array(
		        'label'      => __('Enable Custom CSS Code', 'asalah'),
		        'section'    => 'asalah_site_style',
		        'settings'   => 'asalah_enable_custom_css',
		        'type'       => 'checkbox',
		    ));

		    $wp_customize->add_setting(
		        'asalah_custom_css_code',
		        array(
		            'default'     => '',
			    'sanitize_callback' => 'balanceTags',
								'transport'   => 'postMessage',
		        )
		    );

		    $wp_customize->add_control('asalah_custom_css_code', array(
		        'label'      => __('Add Custom CSS Code', 'asalah'),
		        'section'    => 'asalah_site_style',
		        'settings'   => 'asalah_custom_css_code',
		        'type'       => 'textarea',
		        'active_callback' => 'asalah_custom_css_callback',
		    ));

		        function asalah_custom_js_callback( $control ) {
		        if ( ($control->manager->get_setting('asalah_enable_custom_js')->value() == true)) {
		            return true;
		        } else {
		            return false;
		        }
		    }

		        $wp_customize->add_setting(
		        'asalah_enable_custom_js',
		        array(
		            'default'     => false,
		            'sanitize_callback' => 'esc_attr',
		        )
		    );

		    $wp_customize->add_control('asalah_enable_custom_js', array(
		        'label'      => __('Enable Custom JS Code', 'asalah'),
		        'section'    => 'asalah_site_style',
		        'settings'   => 'asalah_enable_custom_js',
		        'type'       => 'checkbox',
		    ));

		    $wp_customize->add_setting(
		        'asalah_custom_js_code',
		        array(
		            'default'     => '',
								'sanitize_callback' => 'balanceTags'
		        )
		    );

		        $wp_customize->add_control('asalah_custom_js_code', array(
		        'label'      => __('Add Custom JS Code', 'asalah'),
		        'section'    => 'asalah_site_style',
		        'settings'   => 'asalah_custom_js_code',
		        'type'       => 'textarea',
		        'active_callback' => 'asalah_custom_js_callback',
		    ));

				/* Custom Content Section */

				$wp_customize->add_setting(
		        'asalah_custom_header_code',
		        array(
		            'default'     => '',

								'transport'   => 'postMessage',
		        )
		    );

		        $wp_customize->add_control('asalah_custom_header_code', array(
		        'label'      => __('Add Header Content Code', 'asalah'),
		        'section'    => 'asalah_custom_code',
		        'settings'   => 'asalah_custom_header_code',
		        'type'       => 'textarea',
		    ));

				$wp_customize->add_setting(
		        'asalah_custom_footer_code',
		        array(
		            'default'     => '',
								'transport'   => 'postMessage',
		        )
		    );

		        $wp_customize->add_control('asalah_custom_footer_code', array(
		        'label'      => __('Add Footer Content Code', 'asalah'),
		        'section'    => 'asalah_custom_code',
		        'settings'   => 'asalah_custom_footer_code',
		        'type'       => 'textarea',
		    ));

					/* typography */
					$wp_customize->add_setting(
							'asalah_load_fonts_locally',
							array(
									'default'     => 'no',
									'sanitize_callback' => 'esc_attr',
							)
					);

					$wp_customize->add_control('asalah_load_fonts_locally', array(
							'label'      => __('Load Fonts Locally? (don\'t load from google fonts CDN)', 'asalah'),
							'section'    => 'asalah_typography',
							'settings'   => 'asalah_load_fonts_locally',
							'type'       => 'select',
							'choices'    => array(
									'yes' => __('Yes', 'asalah'),
									'no' => __('No', 'asalah')
							),
					));

					$wp_customize->add_setting(
							'asalah_main_font_type',
							array(
									'default'     => false,
									'sanitize_callback' => 'esc_attr',
							)
					);

					$wp_customize->add_control('asalah_main_font_type', array(
							'label'      => __('Site Main Font Type', 'asalah'),
							'section'    => 'asalah_typography',
							'settings'   => 'asalah_main_font_type',
							'type'       => 'select',
							'choices'    => $font_choices,
					));

					$option = 'asalah_main_font_size';
					$section = 'asalah_typography';
					$max = 100;
					$min = 0;
						$wp_customize->add_setting( $option,
						array(
							'default' => 0,
							'sanitize_callback' => 'esc_attr',
							'transport' => 'postMessage',
						)
					);

					$wp_customize->add_control( $option,
						array(
							'label' => 'Site Main Font Size (0 for auto)',
							'section' => $section,
							'settings' => $option,
							'type' => 'range',
							'description' => '<style>.customize-control-range { position:relative;}</style><input type="number" data-customize-setting-link="'.$option.'" oninput="rangeInput'.$option.'.value=this.value" name="amountInput'.$option.'" min="'.$min.'" max="'.$max.'" value="'.esc_attr( $wp_customize->get_setting($option)->value() ).'" style="width: 50px;position: absolute;'.$style_direction.': 145px;bottom: 6px;" />',
							'input_attrs' => array(
								'min'   => $min,
								'max'   => $max,
								'step'  => 2,
								'class' => 'test-class test',
								'style' => 'width: 140px',
								'oninput' => 'amountInput'.$option.'.value=this.value',
								'name' => 'rangeInput'.$option.'',
						),
						)
					);

					$option = 'asalah_main_line_height';
					$section = 'asalah_typography';
					$max = 100;
					$min = 0;
						$wp_customize->add_setting( $option,
						array(
							'default' => 0,
							'sanitize_callback' => 'esc_attr',
							'transport' => 'postMessage',
						)
					);

					$wp_customize->add_control( $option,
						array(
							'label' => 'Site Main Line Height (0 for auto)',
							'section' => $section,
							'settings' => $option,
							'type' => 'range',
							'description' => '<style>.customize-control-range { position:relative;}</style><input type="number" data-customize-setting-link="'.$option.'" oninput="rangeInput'.$option.'.value=this.value" name="amountInput'.$option.'" min="'.$min.'" max="'.$max.'" value="'.esc_attr( $wp_customize->get_setting($option)->value() ).'" style="width: 50px;position: absolute;'.$style_direction.': 145px;bottom: 6px;" />',
							'input_attrs' => array(
								'min'   => $min,
								'max'   => $max,
								'step'  => 2,
								'class' => 'test-class test',
								'style' => 'width: 140px',
								'oninput' => 'amountInput'.$option.'.value=this.value',
								'name' => 'rangeInput'.$option.'',
						),
						)
					);

					$wp_customize->add_setting(
							'asalah_menu_font_type',
							array(
									'default'     => false,
									'sanitize_callback' => 'esc_attr',
							)
					);

					$wp_customize->add_control('asalah_menu_font_type', array(
							'label'      => __('Menu Font Type', 'asalah'),
							'section'    => 'asalah_typography',
							'settings'   => 'asalah_menu_font_type',
							'type'       => 'select',
							'choices'    => $font_choices,
					));

					$option = 'asalah_menu_font_size';
					$section = 'asalah_typography';
					$max = 100;
					$min = 0;
						$wp_customize->add_setting( $option,
						array(
							'default' => 0,
							'sanitize_callback' => 'esc_attr',
							'transport' => 'postMessage',
						)
					);

					$wp_customize->add_control( $option,
						array(
							'label' => 'Menu Font Size (0 for auto)',
							'section' => $section,
							'settings' => $option,
							'type' => 'range',
							'description' => '<style>.customize-control-range { position:relative;}</style><input type="number" data-customize-setting-link="'.$option.'" oninput="rangeInput'.$option.'.value=this.value" name="amountInput'.$option.'" min="'.$min.'" max="'.$max.'" value="'.esc_attr( $wp_customize->get_setting($option)->value() ).'" style="width: 50px;position: absolute;'.$style_direction.': 145px;bottom: 6px;" />',
							'input_attrs' => array(
								'min'   => $min,
								'max'   => $max,
								'step'  => 2,
								'class' => 'test-class test',
								'style' => 'width: 140px',
								'oninput' => 'amountInput'.$option.'.value=this.value',
								'name' => 'rangeInput'.$option.'',
						),
						)
					);

					$option = 'asalah_menu_line_height';
					$section = 'asalah_typography';
					$max = 100;
					$min = 0;
						$wp_customize->add_setting( $option,
						array(
							'default' => 0,
							'sanitize_callback' => 'esc_attr',
							'transport' => 'postMessage',
						)
					);

					$wp_customize->add_control( $option,
						array(
							'label' => 'Menu Line Height (0 for auto)',
							'section' => $section,
							'settings' => $option,
							'type' => 'range',
							'description' => '<style>.customize-control-range { position:relative;}</style><input type="number" data-customize-setting-link="'.$option.'" oninput="rangeInput'.$option.'.value=this.value" name="amountInput'.$option.'" min="'.$min.'" max="'.$max.'" value="'.esc_attr( $wp_customize->get_setting($option)->value() ).'" style="width: 50px;position: absolute;'.$style_direction.': 145px;bottom: 6px;" />',
							'input_attrs' => array(
								'min'   => $min,
								'max'   => $max,
								'step'  => 2,
								'class' => 'test-class test',
								'style' => 'width: 140px',
								'oninput' => 'amountInput'.$option.'.value=this.value',
								'name' => 'rangeInput'.$option.'',
						),
						)
					);

					$wp_customize->add_setting(
							'asalah_head_font_type',
							array(
									'default'     => false,
									'sanitize_callback' => 'esc_attr',
							)
					);

					$wp_customize->add_control('asalah_head_font_type', array(
							'label'      => __('Headlines Font Type', 'asalah'),
							'section'    => 'asalah_typography',
							'settings'   => 'asalah_head_font_type',
							'type'       => 'select',
							'choices'    => $font_choices,
					));

					$headings = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');

					foreach ($headings as $head) {

											$option = 'asalah_'.$head.'_font_size';
											$section = 'asalah_typography';
											$max = 100;
											$min = 0;
												$wp_customize->add_setting( $option,
												array(
													'default' => 0,
													'sanitize_callback' => 'esc_attr',
													'transport' => 'postMessage',
												)
											);

											$wp_customize->add_control( $option,
												array(
													'label' => $head.' Font Size (0 for auto)',
													'section' => $section,
													'settings' => $option,
													'type' => 'range',
													'description' => '<style>.customize-control-range { position:relative;}</style><input type="number" data-customize-setting-link="'.$option.'" oninput="rangeInput'.$option.'.value=this.value" name="amountInput'.$option.'" min="'.$min.'" max="'.$max.'" value="'.esc_attr( $wp_customize->get_setting($option)->value() ).'" style="width: 50px;position: absolute;left: 145px;bottom: 6px;" />',
													'input_attrs' => array(
														'min'   => $min,
														'max'   => $max,
														'step'  => 2,
														'class' => 'test-class test',
														'style' => 'width: 140px',
														'oninput' => 'amountInput'.$option.'.value=this.value',
														'name' => 'rangeInput'.$option.'',
												),
												)
											);

											$option = 'asalah_'.$head.'_line_height';
											$section = 'asalah_typography';
											$max = 100;
											$min = 0;
												$wp_customize->add_setting( $option,
												array(
													'default' => 0,
													'sanitize_callback' => 'esc_attr',
													'transport' => 'postMessage',
												)
											);

											$wp_customize->add_control( $option,
												array(
													'label' => $head.' Line Height (0 for auto)',
													'section' => $section,
													'settings' => $option,
													'type' => 'range',
													'description' => '<style>.customize-control-range { position:relative;}</style><input type="number" data-customize-setting-link="'.$option.'" oninput="rangeInput'.$option.'.value=this.value" name="amountInput'.$option.'" min="'.$min.'" max="'.$max.'" value="'.esc_attr( $wp_customize->get_setting($option)->value() ).'" style="width: 50px;position: absolute;'.$style_direction.': 145px;bottom: 6px;" />',
													'input_attrs' => array(
														'min'   => $min,
														'max'   => $max,
														'step'  => 2,
														'class' => 'test-class test',
														'style' => 'width: 140px',
														'oninput' => 'amountInput'.$option.'.value=this.value',
														'name' => 'rangeInput'.$option.'',
												),
												)
											);

					}

					$wp_customize->add_setting(
							'asalah_blog_font_type',
							array(
									'default'     => 'false',
									'sanitize_callback' => 'esc_attr',
							)
					);

					$wp_customize->add_control('asalah_blog_font_type', array(
							'label'      => __('Blog Content Font Type', 'asalah'),
							'section'    => 'asalah_typography',
							'settings'   => 'asalah_blog_font_type',
							'type'       => 'select',
							'choices'    => $font_choices,
					));

					$option = 'asalah_blog_font_size';
					$section = 'asalah_typography';
					$max = 100;
					$min = 0;
						$wp_customize->add_setting( $option,
						array(
							'default' => 0,
							'sanitize_callback' => 'esc_attr',
							'transport' => 'postMessage',
						)
					);

					$wp_customize->add_control( $option,
						array(
							'label' => 'Blog Content Font Size (0 for auto)',
							'section' => $section,
							'settings' => $option,
							'type' => 'range',
							'description' => '<style>.customize-control-range { position:relative;}</style><input type="number" data-customize-setting-link="'.$option.'" oninput="rangeInput'.$option.'.value=this.value" name="amountInput'.$option.'" min="'.$min.'" max="'.$max.'" value="'.esc_attr( $wp_customize->get_setting($option)->value() ).'" style="width: 50px;position: absolute;'.$style_direction.': 145px;bottom: 6px;" />',
							'input_attrs' => array(
								'min'   => $min,
								'max'   => $max,
								'step'  => 2,
								'class' => 'test-class test',
								'style' => 'width: 140px',
								'oninput' => 'amountInput'.$option.'.value=this.value',
								'name' => 'rangeInput'.$option.'',
						),
						)
					);

					$option = 'asalah_blog_line_height';
					$section = 'asalah_typography';
					$max = 100;
					$min = 0;
						$wp_customize->add_setting( $option,
						array(
							'default' => 0,
							'sanitize_callback' => 'esc_attr',
							'transport' => 'postMessage',
						)
					);

					$wp_customize->add_control( $option,
						array(
							'label' => 'Blog Content Line Height (0 for auto)',
							'section' => $section,
							'settings' => $option,
							'type' => 'range',
							'description' => '<style>.customize-control-range { position:relative;}</style><input type="number" data-customize-setting-link="'.$option.'" oninput="rangeInput'.$option.'.value=this.value" name="amountInput'.$option.'" min="'.$min.'" max="'.$max.'" value="'.esc_attr( $wp_customize->get_setting($option)->value() ).'" style="width: 50px;position: absolute;'.$style_direction.': 145px;bottom: 6px;" />',
							'input_attrs' => array(
								'min'   => $min,
								'max'   => $max,
								'step'  => 2,
								'class' => 'test-class test',
								'style' => 'width: 140px',
								'oninput' => 'amountInput'.$option.'.value=this.value',
								'name' => 'rangeInput'.$option.'',
						),
						)
					);

					$option = 'asalah_blog_description_font_size';
					$section = 'asalah_typography';
					$max = 100;
					$min = 0;
						$wp_customize->add_setting( $option,
						array(
							'default' => 0,
							'sanitize_callback' => 'esc_attr',
							'transport' => 'postMessage',
						)
					);

					$wp_customize->add_control( $option,
						array(
							'label' => 'Blog Post Description Font Size (0 for auto)',
							'section' => $section,
							'settings' => $option,
							'type' => 'range',
							'description' => '<style>.customize-control-range { position:relative;}</style><input type="number" data-customize-setting-link="'.$option.'" oninput="rangeInput'.$option.'.value=this.value" name="amountInput'.$option.'" min="'.$min.'" max="'.$max.'" value="'.esc_attr( $wp_customize->get_setting($option)->value() ).'" style="width: 50px;position: absolute;'.$style_direction.': 145px;bottom: 6px;" />',
							'input_attrs' => array(
								'min'   => $min,
								'max'   => $max,
								'step'  => 2,
								'class' => 'test-class test',
								'style' => 'width: 140px',
								'oninput' => 'amountInput'.$option.'.value=this.value',
								'name' => 'rangeInput'.$option.'',
						),
						)
					);

					$option = 'asalah_blog_description_line_height';
					$section = 'asalah_typography';
					$max = 100;
					$min = 0;
						$wp_customize->add_setting( $option,
						array(
							'default' => 0,
							'sanitize_callback' => 'esc_attr',
							'transport' => 'postMessage',
						)
					);

					$wp_customize->add_control( $option,
						array(
							'label' => 'Blog Post Description Line Height (0 for auto)',
							'section' => $section,
							'settings' => $option,
							'type' => 'range',
							'description' => '<style>.customize-control-range { position:relative;}</style><input type="number" data-customize-setting-link="'.$option.'" oninput="rangeInput'.$option.'.value=this.value" name="amountInput'.$option.'" min="'.$min.'" max="'.$max.'" value="'.esc_attr( $wp_customize->get_setting($option)->value() ).'" style="width: 50px;position: absolute;'.$style_direction.': 145px;bottom: 6px;" />',
							'input_attrs' => array(
								'min'   => $min,
								'max'   => $max,
								'step'  => 2,
								'class' => 'test-class test',
								'style' => 'width: 140px',
								'oninput' => 'amountInput'.$option.'.value=this.value',
								'name' => 'rangeInput'.$option.'',
						),
						)
					);



    /* change layout settings */

		/* Site Width */

		$option = 'asalah_site_width';
		$section = 'asalah_layout';
		$max = 2000;
		$min = 500;
			$wp_customize->add_setting( $option,
			array(
				'default' => 910,
				'sanitize_callback' => 'esc_attr',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control( $option,
			array(
				'label' => 'Site Width (Minimum 500px)',
				'section' => $section,
				'settings' => $option,
				'type' => 'range',
				'description' => '<style>.customize-control-range { position:relative;}</style><input type="number" data-customize-setting-link="'.$option.'" oninput="rangeInput'.$option.'.value=this.value" name="amountInput'.$option.'" min="'.$min.'" max="'.$max.'" value="'.esc_attr( $wp_customize->get_setting($option)->value() ).'" style="width: 50px;position: absolute;'.$style_direction.': 145px;bottom: 6px;" />',
				'input_attrs' => array(
					'min'   => $min,
					'max'   => $max,
					'step'  => 5,
					'class' => 'test-class test',
					'style' => 'width: 140px',
					'oninput' => 'amountInput'.$option.'.value=this.value',
					'name' => 'rangeInput'.$option.'',
			),
			)
		);

    $wp_customize->add_setting(
        'asalah_sidebar_position',
        array(
            'default'     => false,
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('asalah_sidebar_position', array(
        'label'      => __('Sidebar Position', 'asalah'),
        'section'    => 'asalah_layout',
        'settings'   => 'asalah_sidebar_position',
        'type'       => 'select',
        'choices'    => array(
            'left' => __('Left Sidebar', 'asalah'),
            'right' => __('Right Sidebar', 'asalah'),
            'none' => __('No Sidebar', 'asalah'),
        ),
    ));

		/* Enable/disable Sticky Menu */

		$wp_customize->add_setting(
				'asalah_sticky_menu',
				array(
						'default'     => 'no',
						'sanitize_callback' => 'esc_attr',
				)
		);

		$wp_customize->add_control('asalah_sticky_menu', array(
				'label'      => __('Sticky Menu?', 'asalah'),
				'section'    => 'asalah_layout',
				'settings'   => 'asalah_sticky_menu',
				'type'       => 'select',
				'choices'    => array(
						'yes' => __('Yes', 'asalah'),
						'no' => __('No', 'asalah')
				),
		));

		/* Enable/disable Sticky Logo */

		$wp_customize->add_setting(
				'asalah_sticky_logo',
				array(
						'default'     => 'no',
						'sanitize_callback' => 'esc_attr',
				)
		);

		$wp_customize->add_control('asalah_sticky_logo', array(
				'label'      => __('Sticky Logo at mobile', 'asalah'),
				'section'    => 'asalah_layout',
				'settings'   => 'asalah_sticky_logo',
				'type'       => 'select',
				'choices'    => array(
						'yes' => __('Yes', 'asalah'),
						'no' => __('No', 'asalah')
				),
		));

		/*Blog Style */

    $wp_customize->add_setting(
        'asalah_blog_style',
        array(
            'default'     => false,
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('asalah_blog_style', array(
        'label'      => __('Default Blog Style', 'asalah'),
        'section'    => 'asalah_layout',
        'settings'   => 'asalah_blog_style',
        'type'       => 'select',
        'choices'    => array(
            'default' => __('Default', 'asalah'),
            'banners' => __('Banners First', 'asalah'),
            'masonry' => __('Masonry', 'asalah'),
            'list' => __('List', 'asalah'),
        ),
    ));

		/* Show/Hide Post Content */

		$wp_customize->add_setting(
				'asalah_post_content_show',
				array(
						'default'     => 'yes',
						'sanitize_callback' => 'esc_attr',
				)
		);

		$wp_customize->add_control('asalah_post_content_show', array(
				'label'      => __('Show Post Content', 'asalah'),
				'section'    => 'asalah_layout',
				'settings'   => 'asalah_post_content_show',
				'type'       => 'select',
				'choices'    => array(
						'yes' => __('Yes', 'asalah'),
						'no' => __('No', 'asalah')
				),
		));

    /* post excerpt */

    function asalah_post_excerpt_callback( $control ) {
        if ( ($control->manager->get_setting('asalah_blog_style')->value() != 'masonry') || $control->manager->get_setting('asalah_blog_style')->value() != 'list' ) {
            return true;
        } else {
            return false;
        }
    }

    $wp_customize->add_setting(
        'asalah_post_excerpt',
        array(
            'default'     => 'enabled',
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('asalah_post_excerpt', array(
        'label'      => __('Post Excerpt', 'asalah'),
        'section'    => 'asalah_layout',
        'settings'   => 'asalah_post_excerpt',
        'type'       => 'select',
        'active_callback' => 'asalah_post_excerpt_callback',
        'choices'    => array(
            'enabled' => __('Enabled', 'asalah'),
            'disabled' => __('Disabled', 'asalah'),
        ),
    ));

    $wp_customize->add_setting(
        'asalah_post_excerpt_limit',
        array(
            'default'            => '',
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control(
        'asalah_post_excerpt_limit',
        array(
            'section'  => 'asalah_layout',
            'label'    => 'Except length (No. of words)',
            'type'     => 'text'
        )
    );

    $wp_customize->add_setting(
        'asalah_post_excerpt_text',
        array(
            'sanitize_callback' => 'esc_attr',
            'default'            => ' &hellip; ',
        )
    );

    $wp_customize->add_control(
        'asalah_post_excerpt_text',
        array(
            'section'  => 'asalah_layout',
            'label'    => 'End of Excerpt text',
            'type'     => 'text',
            'active_callback' => 'asalah_post_excerpt_callback',
        )
    );

		$wp_customize->add_setting(
				'asalah_cont_read_show',
				array(
						'default'     => 'yes',
						'sanitize_callback' => 'esc_attr',
				)
		);

		$wp_customize->add_control('asalah_cont_read_show', array(
				'label'      => __('Show Continue Reading Button', 'asalah'),
				'section'    => 'asalah_layout',
				'settings'   => 'asalah_cont_read_show',
				'type'       => 'select',
				'choices'    => array(
						'yes' => __('Yes', 'asalah'),
						'no' => __('No', 'asalah')
				),
		));

		$wp_customize->add_setting(
				'asalah_cont_read_text',
				array(
						'default'     => 'Continue Reading',
						'sanitize_callback' => 'esc_attr',
				)
		);

		$wp_customize->add_control('asalah_cont_read_text', array(
				'label'      => __('Continue Reading Button Text', 'asalah'),
				'section'    => 'asalah_layout',
				'settings'   => 'asalah_cont_read_text',
				'type'       => 'text',
				));

    $wp_customize->add_setting(
        'asalah_pagination_style',
        array(
            'default'     => false,
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('asalah_pagination_style', array(
        'label'      => __('Pagination Style', 'asalah'),
        'section'    => 'asalah_layout',
        'settings'   => 'asalah_pagination_style',
        'type'       => 'select',
        'choices'    => array(
            'nav' => __('Older/Newer Links', 'asalah'),
            'num' => __('Numerical', 'asalah'),
						'ajax' => __('Ajax', 'asalah')
        ),
    ));

    $wp_customize->add_setting(
        'asalah_blog_image_crop',
        array(
            'default'     => false,
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('asalah_blog_image_crop', array(
        'label'      => __('Crop Blog Banners in Blog List', 'asalah'),
        'section'    => 'asalah_layout',
        'settings'   => 'asalah_blog_image_crop',
        'type'       => 'select',
        'choices'    => array(
            'yes' => __('Yes', 'asalah'),
            'no' => __('No', 'asalah')
        ),
    ));

    $wp_customize->add_setting(
        'asalah_blog_gallery_crop',
        array(
            'default'     => false,
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('asalah_blog_gallery_crop', array(
        'label'      => __('Crop Gallery Images in Blog List', 'asalah'),
        'section'    => 'asalah_layout',
        'settings'   => 'asalah_blog_gallery_crop',
        'type'       => 'select',
        'choices'    => array(
            'yes' => __('Yes', 'asalah'),
            'no' => __('No', 'asalah')
        ),
    ));

		$wp_customize->add_setting(
				'asalah_single_thumb_crop',
				array(
						'default'     => 'yes',
						'sanitize_callback' => 'esc_attr',
				)
		);

		$wp_customize->add_control('asalah_single_thumb_crop', array(
				'label'      => __('Crop Single Page Image', 'asalah'),
				'section'    => 'asalah_layout',
				'settings'   => 'asalah_single_thumb_crop',
				'type'       => 'select',
				'choices'    => array(
						'yes' => __('Yes', 'asalah'),
						'no' => __('No', 'asalah')
				),
		));


		/* Title and Featured Image position at single posts */

		$wp_customize->add_setting(
        'asalah_single_title_above_featured',
        array(
            'default'     => false,
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('asalah_single_title_above_featured', array(
        'label'      => __('Featured Image Position at Single Posts/Pages', 'asalah'),
        'section'    => 'asalah_layout',
        'settings'   => 'asalah_single_title_above_featured',
        'type'       => 'select',
        'choices'    => array(
            false => __('Above Title', 'asalah'),
            true => __('Under Title', 'asalah'),
        ),
    ));

    $wp_customize->add_setting(
        'show_author_box',
        array(
            'default'     => false,
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('show_author_box', array(
        'label'      => __('Show Author Box', 'asalah'),
        'section'    => 'asalah_layout',
        'settings'   => 'show_author_box',
        'type'       => 'select',
        'choices'    => array(
            'yes' => __('Yes', 'asalah'),
            'no' => __('No', 'asalah')
        ),
    ));

		$wp_customize->add_setting(
        'asalah_show_posts_navigation',
        array(
            'default'     => false,
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('asalah_show_posts_navigation', array(
        'label'      => __('Show Posts Navigation', 'asalah'),
        'section'    => 'asalah_layout',
        'settings'   => 'asalah_show_posts_navigation',
        'type'       => 'select',
        'choices'    => array(
            'yes' => __('Yes', 'asalah'),
            'no' => __('No', 'asalah')
        ),
    ));

    $wp_customize->add_setting(
        'asalah_show_related',
        array(
            'default'     => false,
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('asalah_show_related', array(
        'label'      => __('Show Related Posts', 'asalah'),
        'section'    => 'asalah_layout',
        'settings'   => 'asalah_show_related',
        'type'       => 'select',
        'choices'    => array(
            'yes' => __('Yes', 'asalah'),
            'no' => __('No', 'asalah')
        ),
    ));

    $wp_customize->add_setting(
        'asalah_relation_posts',
        array(
            'default'     => false,
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('asalah_relation_posts', array(
        'label'      => __('Related Posts According to', 'asalah'),
        'section'    => 'asalah_layout',
        'settings'   => 'asalah_relation_posts',
        'type'       => 'select',
        'choices'    => array(
            'category' => __('Categories', 'asalah'),
            'tag' => __('Tags', 'asalah'),
						'author' => __('Author', 'asalah'),
        ),
    ));

    $wp_customize->add_setting(
        'asalah_show_share',
        array(
            'default'     => false,
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('asalah_show_share', array(
        'label'      => __('Show Share Icons', 'asalah'),
        'section'    => 'asalah_layout',
        'settings'   => 'asalah_show_share',
        'type'       => 'select',
        'choices'    => array(
            'yes' => __('Yes', 'asalah'),
            'no' => __('No', 'asalah')
        ),
    ));

    $wp_customize->add_setting(
        'asalah_hits_counter',
        array(
            'default'     => false,
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('asalah_hits_counter', array(
        'label'      => __('Show views number', 'asalah'),
        'section'    => 'asalah_layout',
        'settings'   => 'asalah_hits_counter',
        'type'       => 'select',
        'choices'    => array(
            'yes' => __('Yes', 'asalah'),
            'no' => __('No', 'asalah')
        ),
    ));

    $wp_customize->add_setting(
        'asalah_show_meta',
        array(
            'default'     => false,
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('asalah_show_meta', array(
        'label'      => __('Show Meta Info', 'asalah'),
        'section'    => 'asalah_layout',
        'settings'   => 'asalah_show_meta',
        'type'       => 'select',
        'choices'    => array(
            'yes' => __('Yes', 'asalah'),
            'no' => __('No', 'asalah')
        ),
    ));

		$wp_customize->add_setting(
        'asalah_show_categories',
        array(
            'default'     => false,
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('asalah_show_categories', array(
        'label'      => __('Show Categories in Post Meta', 'asalah'),
        'section'    => 'asalah_layout',
        'settings'   => 'asalah_show_categories',
        'type'       => 'select',
        'choices'    => array(
            'yes' => __('Yes', 'asalah'),
            'no' => __('No', 'asalah')
        ),
    ));

		$wp_customize->add_setting(
        'asalah_show_tags',
        array(
            'default'     => false,
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('asalah_show_tags', array(
        'label'      => __('Show Tags in Post Meta', 'asalah'),
        'section'    => 'asalah_layout',
        'settings'   => 'asalah_show_tags',
        'type'       => 'select',
        'choices'    => array(
            'yes' => __('Yes', 'asalah'),
            'no' => __('No', 'asalah')
        ),
    ));

		$wp_customize->add_setting(
        'asalah_show_date',
        array(
            'default'     => false,
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('asalah_show_date', array(
        'label'      => __('Show Date in Post Meta', 'asalah'),
        'section'    => 'asalah_layout',
        'settings'   => 'asalah_show_date',
        'type'       => 'select',
        'choices'    => array(
            'yes' => __('Yes', 'asalah'),
            'no' => __('No', 'asalah')
        ),
    ));

		$wp_customize->add_setting(
        'asalah_show_comments_number',
        array(
            'default'     => false,
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('asalah_show_comments_number', array(
        'label'      => __('Show Comments Number in Post Meta', 'asalah'),
        'section'    => 'asalah_layout',
        'settings'   => 'asalah_show_comments_number',
        'type'       => 'select',
        'choices'    => array(
            'yes' => __('Yes', 'asalah'),
            'no' => __('No', 'asalah')
        ),
    ));

		$wp_customize->add_setting(
        'asalah_show_author',
        array(
            'default'     => false,
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('asalah_show_author', array(
        'label'      => __('Show Author in Post Meta', 'asalah'),
        'section'    => 'asalah_layout',
        'settings'   => 'asalah_show_author',
        'type'       => 'select',
        'choices'    => array(
            'yes' => __('Yes', 'asalah'),
            'no' => __('No', 'asalah')
        ),
    ));

		$wp_customize->add_setting(
        'asalah_reading_progress',
        array(
            'default'     => false,
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('asalah_reading_progress', array(
        'label'      => __('Show Reading Progress Bar', 'asalah'),
        'section'    => 'asalah_layout',
        'settings'   => 'asalah_reading_progress',
        'type'       => 'select',
        'choices'    => array(
            'yes' => __('Yes', 'asalah'),
            'no' => __('No', 'asalah')
        ),
    ));

    /* Custom Background */

    $wp_customize->add_setting( 'background_image', array(
        'default'        => get_theme_support( 'custom-background', 'default-image' ),
        'theme_supports' => 'custom-background',
        'sanitize_callback' => 'esc_attr',
    ) );

    $wp_customize->add_setting( new WP_Customize_Background_Image_Setting( $wp_customize, 'background_image_thumb', array(
        'theme_supports' => 'custom-background',
        'sanitize_callback' => 'esc_attr',
    ) ) );

    $wp_customize->add_control( new WP_Customize_Background_Image_Control( $wp_customize ) );

    $wp_customize->add_setting( 'background_repeat', array(
        'default'        => 'repeat',
        'theme_supports' => 'custom-background',
        'sanitize_callback' => 'esc_attr',
    ) );

    $wp_customize->add_control( 'background_repeat', array(
        'label'      => __( 'Background Repeat', 'asalah' ),
        'section'    => 'background_image',
        'type'       => 'radio',
        'choices'    => array(
            'no-repeat'  => __('No Repeat', 'asalah'),
            'repeat'     => __('Tile', 'asalah'),
            'repeat-x'   => __('Tile Horizontally', 'asalah'),
            'repeat-y'   => __('Tile Vertically', 'asalah'),
        ),
    ) );

    $wp_customize->add_setting( 'background_position_x', array(
        'default'        => 'left',
        'theme_supports' => 'custom-background',
        'sanitize_callback' => 'esc_attr',
    ) );

    $wp_customize->add_control( 'background_position_x', array(
        'label'      => __( 'Background Position', 'asalah' ),
        'section'    => 'background_image',
        'type'       => 'radio',
        'choices'    => array(
            'left'       => __('Left', 'asalah'),
            'center'     => __('Center', 'asalah'),
            'right'      => __('Right', 'asalah'),
        ),
    ) );

    $wp_customize->add_setting( 'background_attachment', array(
        'default'        => 'fixed',
        'theme_supports' => 'custom-background',
        'sanitize_callback' => 'esc_attr',
    ) );

    $wp_customize->add_control( 'background_attachment', array(
        'label'      => __( 'Background Attachment', 'asalah' ),
        'section'    => 'background_image',
        'type'       => 'radio',
        'choices'    => array(
            'fixed'      => __('Fixed', 'asalah'),
            'scroll'     => __('Scroll', 'asalah'),
        ),
        ) );


				$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
				$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
				$wp_customize->get_setting( 'asalah_center_logo' )->transport = 'postMessage';
				$wp_customize->get_setting( 'asalah_remove_logo_dot' )->transport = 'postMessage';


}
add_action( 'customize_register', 'asalah_register_theme_customizer' );
?>