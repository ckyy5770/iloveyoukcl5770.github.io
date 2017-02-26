(function( $ ) {
    "use strict";
    var top_bar = true;

    var rtl = jQuery('body').css('direction') == 'rtl' ? true : false;
 	// Site title.
 	wp.customize( 'blogname', function( value ) {
 		value.bind( function( to ) {
 			$( '.site-title a' ).text( to );
 		} );
 	} );

    // Site tagline.
    wp.customize( 'blogdescription', function( value ) {
        value.bind( function( to ) {
            $( '.logo_tagline' ).text( to );
        } );
    } );

    // Footer Credits
    wp.customize( 'asalah_footer_credits', function( value ) {
        value.bind( function( to ) {
            $( '.footer_credits' ).text( to );
        } );
    } );


    wp.customize( 'asalah_custom_css_code', function( value ) {
        value.bind( function( to ) {
            var output = "<style>"+to+"</style>";
            $('body').append(output);
        } );
    } );


    wp.customize( 'asalah_center_logo', function( value ) {
        value.bind( function( to ) {
          if (to) {
            $( '.logo_wrapper' ).css({
                'float': 'none',
                'text-align':      'center',
                'width':           '100%'
            });

            $('.site_logo').removeClass('pull-left');
            $('.site_logo').removeClass('pull-right');
            $( '.site_logo, .site_logo a' ).css({
                'float': 'none!important',
                'display':      'inline-block'
            });
          } else {
            if (rtl) {
              $( '.logo_wrapper' ).css({
                'float': 'right',
                'width': '50%',
                'text-align':      'auto'
            });
              $('.site_logo').addClass('pull-right');
            }
            else {
            $( '.logo_wrapper' ).css({
              'float': 'left',
              'width': '50%',
          });
            $('.site_logo').addClass('pull-left');
          }}


    } );
    });

    wp.customize( 'asalah_remove_logo_dot', function( value ) {
        value.bind( function( to ) {
          if (to) {
            $('.logo_dot').css('display', 'none');
          } else {
            $('.logo_dot').css('display', 'inline');
          }
        } );
    } );

    wp.customize( 'show_author_box', function( value ) {
        value.bind( function( to ) {
          if (to == 'no') {
            $('.author_box').css('display', 'none');
          } else {
            $('.author_box').css('display', 'inline');
          }
        } );
    } );

    wp.customize( 'asalah_show_related', function( value ) {
        value.bind( function( to ) {
          if (to == 'no') {
            $('.post_related').css('display', 'none');
          } else {
            $('.post_related').css('display', 'inline');
          }
        } );
    } );

    wp.customize( 'asalah_show_posts_navigation', function( value ) {
        value.bind( function( to ) {
          if (to == 'no') {
            $('.post_navigation').css('display', 'none');
          } else {
            $('.post_navigation').css('display', 'inline');
          }
        } );
    } );

    wp.customize( 'asalah_hits_counter', function( value ) {
        value.bind( function( to ) {
          if (to == 'no') {
            $('.blog_meta_views').css('display', 'none');
          } else {
            $('.blog_meta_views').css('display', 'inline');
          }
        } );
    } );

    wp.customize( 'asalah_show_share', function( value ) {
        value.bind( function( to ) {
          if (to == 'no') {
            $('.blog_post_share').css('display', 'none');
          } else {
            $('.blog_post_share').css('display', 'inline');
          }
        } );
    } );

    wp.customize( 'asalah_show_categories', function( value ) {
        value.bind( function( to ) {
          if (to == 'no') {
            $('.blog_meta_category').css('display', 'none');
          } else {
            $('.blog_meta_category').css('display', 'inline');
          }
        } );
    } );

    wp.customize( 'asalah_show_tags', function( value ) {
        value.bind( function( to ) {
          if (to == 'no') {
            $('.blog_meta_tags').css('display', 'none');
          } else {
            $('.blog_meta_tags').css('display', 'inline');
          }
        } );
    } );

    wp.customize( 'asalah_show_date', function( value ) {
        value.bind( function( to ) {
          if (to == 'no') {
            $('.blog_meta_date').css('display', 'none');
          } else {
            $('.blog_meta_date').css('display', 'inline');
          }
        } );
    } );

    wp.customize( 'asalah_show_comments_number', function( value ) {
        value.bind( function( to ) {
          if (to == 'no') {
            $('.blog_meta_comments').css('display', 'none');
          } else {
            $('.blog_meta_comments').css('display', 'inline');
          }
        } );
    } );

    wp.customize( 'asalah_show_author', function( value ) {
        value.bind( function( to ) {
          if (to == 'no') {
            $('.blog_meta_author').css('display', 'none');
          } else {
            $('.blog_meta_author').css('display', 'inline');
          }
        } );
    } );

    wp.customize( 'asalah_header_color', function( value ) {
        value.bind( function( to ) {
          $('.header_logo_wrapper').css('background-color', to);
        } );
    } );

    wp.customize( 'asalah_header_height', function( value ) {
        value.bind( function( to ) {
          $('.header_logo_wrapper').css('height', to);
        } );
    } );

    wp.customize( 'asalah_logo_font_size', function( value ) {
        value.bind( function( to ) {
          if (to > 0) {
          $('.site_logo a').css('font-size', to+'px');
        } else {
          $('.site_logo a').css('font-size', 'inherit');
        }
        } );
    } );

    wp.customize( 'asalah_logo_height', function( value ) {
        value.bind( function( to ) {
          if (to > 40) {
          $('.site_logo_image').css('height', to);
        }
        } );
    } );

    wp.customize( 'asalah_logo_width', function( value ) {
        value.bind( function( to ) {
          if ( to > 40) {
          $('.site_logo_image').css('width', to);
        }
        } );
    } );


    wp.customize( 'asalah_site_width', function( value ) {
        value.bind( function( to ) {
          $('.container').css('width', to);
          $('.main_content.col-md-9').css({'width': '75%', 'padding-right': '15px'});
          $('.side_content.col-md-3').css({'width': '25%', 'padding-left': '15px'})
          if (to < 701) {
            $('.side_content').hide();
            $('.main_content').removeClass('col-md-9');
            $('.main_content').addClass('col-md-12');
            $('.main_content').css('width', '100%');
          } else {
            if ($('.side_content').length) {
              $('.side_content').show();
              $('.main_content').addClass('col-md-9');
              $('.main_content').removeClass('col-md-12');
            }
          }
        } );
    } );

    wp.customize( 'asalah_header_text_color', function( value ) {
        value.bind( function( to ) {
          $('.header_logo_wrapper a, .header_logo_wrapper .nav > li > a').css('color', to);
        } );
    } );

    wp.customize( 'asalah_top_menu_color', function( value ) {
        value.bind( function( to ) {
          $('.top_menu_wrapper').addClass('top_menu_color');
          top_menu_colors(to);
        } );
    } );

    wp.customize( 'asalah_top_menu_text_color', function( value ) {
        value.bind( function( to ) {
          $('.top_menu_wrapper a, .header_search, .top_menu_wrapper .nav > li > a, .header_search input[type="text"]').css({'color': to});
        } );
    } );

    wp.customize( 'asalah_body_background_color', function( value ) {
        value.bind( function( to ) {
          $('body').css('background-color', to);
          $('body').addClass('custom_bg_color');
          if (!$('.bg-color').length) {
            Site_content_colors(to);
          }
          if (!jQuery('.top_menu_wrapper').hasClass('top_menu_color')) {
            top_menu_colors(to);
          }
        } );
    } );

    wp.customize( 'asalah_post_background_color', function( value ) {
        value.bind( function( to ) {
          $('.bg-color').css('background-color', to);
          Site_content_colors(to);
          if ((!jQuery('body').hasClass('custom_bg_color')) && (!jQuery('.top_menu_wrapper').hasClass('top_menu_color')) && (!jQuery('.sticky_header').length)) {
            top_menu_colors(to);
          }
        } );
    } );

    wp.customize( 'asalah_main_text_color', function( value ) {
        value.bind( function( to ) {
          $('body, .site_content a, .dropdown-menu .current-menu-ancestor, .dropdown-menu .current-menu-ancestor > a, .dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus, .dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus, .title, .nav > li > a, h3.comment-reply-title, h1, h2, h3, h4, h5, h6, .header_social_icons a, .main_nav .current-menu-item, .main_nav .current-menu-item > a, .main_nav .current-menu-ancestor, .main_nav .current-menu-ancestor > a, #wp-calendar thead th').css('color', to);
        } );
    } );

    wp.customize( 'asalah_main_font_size', function( value ) {
        value.bind( function( to ) {
          if (to > 0) {
          $('body').css('font-size', to+'px');
        } else {
          $('body').css('font-size', 'inherit');
        }
        } );
    } );

    wp.customize( 'asalah_main_line_height', function( value ) {
        value.bind( function( to ) {
          if (to > 0) {
          $('body').css('line-height', to+'px');
        } else {
          $('body').css('line-height', 'inherit');
        }
        } );
    } );

    wp.customize( 'asalah_menu_font_size', function( value ) {
        value.bind( function( to ) {
          if (to > 0) {
          $('.nav > li > a').css('font-size', to+'px');
        } else {
          $('.nav > li > a').css('font-size', 'inherit');
        }
        } );
    } );

    wp.customize( 'asalah_menu_line_height', function( value ) {
        value.bind( function( to ) {
          if (to > 0) {
          $('.nav > li > a').css('line-height', to+'px');
        } else {
          $('.nav > li > a').css('line-height', 'inherit');
        }
        } );
    } );

    wp.customize( 'asalah_h1_font_size', function( value ) {
        value.bind( function( to ) {
          if (to > 0) {
          $('h1').not('.logo_dot').css('font-size', to+'px');
          $('.logo_dot').css('font-size', '44px');}
          else {
            $('h1').css('font-size', 'inherit');
            $('.logo_dot').css('font-size', '44px')
          }
        } );
    } );

    wp.customize( 'asalah_h2_font_size', function( value ) {
        value.bind( function( to ) {
          if (to > 0) {
          $('h2').css('font-size', to+'px');}
          else {
            $('h2').css('font-size', 'inherit');
          }
        } );
    } );

    wp.customize( 'asalah_h3_font_size', function( value ) {
        value.bind( function( to ) {
          if (to > 0) {
          $('h3').css('font-size', to+'px');}
          else {
            $('h3').css('font-size', 'inherit');
          }
        } );
    } );

    wp.customize( 'asalah_h4_font_size', function( value ) {
        value.bind( function( to ) {
          if (to > 0) {
          $('h4').css('font-size', to+'px');}
          else {
            $('h4').css('font-size', 'inherit');
          }
        } );
    } );

    wp.customize( 'asalah_h5_font_size', function( value ) {
        value.bind( function( to ) {
          if (to > 0) {
          $('h5').css('font-size', to+'px');}
          else {
            $('h5').css('font-size', 'inherit');
          }
        } );
    } );

    wp.customize( 'asalah_h6_font_size', function( value ) {
        value.bind( function( to ) {
          if (to > 0) {
          $('h6').css('font-size', to+'px');}
          else {
            $('h6').css('font-size', 'inherit');
          }
        } );
    } );

    wp.customize( 'asalah_h1_line_height', function( value ) {
        value.bind( function( to ) {
          if (to > 0) {
          $('h1').css('line-height', to+'px'); }
          else {
            $('h1').css('line-height', 'inherit');
          }
        } );
    } );

    wp.customize( 'asalah_h2_line_height', function( value ) {
        value.bind( function( to ) {
          if (to > 0) {
          $('h2').css('line-height', to+'px');}
          else {
            $('h2').css('line-height', 'inherit');
          }
        } );
    } );

    wp.customize( 'asalah_h3_line_height', function( value ) {
        value.bind( function( to ) {
          if (to > 0) {
          $('h3').css('line-height', to+'px');}
          else {
            $('h3').css('line-height', 'inherit');
          }
        } );
    } );

    wp.customize( 'asalah_h4_line_height', function( value ) {
        value.bind( function( to ) {
          if (to > 0) {
          $('h4').css('line-height', to+'px');}
          else {
            $('h4').css('line-height', 'inherit');
          }
        } );
    } );

    wp.customize( 'asalah_h5_line_height', function( value ) {
        value.bind( function( to ) {
          if (to > 0) {
          $('h5').css('line-height', to+'px');}
          else {
            $('h5').css('line-height', 'inherit');
          }
        } );
    } );

    wp.customize( 'asalah_h6_line_height', function( value ) {
        value.bind( function( to ) {
          if (to > 0) {
          $('h6').css('line-height', to+'px');}
          else {
            $('h6').css('line-height', 'inherit');
          }
        } );
    } );

    wp.customize( 'asalah_blog_font_size', function( value ) {
        value.bind( function( to ) {
          if (to > 0) {
          $('.main_content.col-md-12 .blog_single .blog_post_text, .main_content.col-md-9 .blog_single .blog_post_text').css('font-size', to+'px');}
          else {
            $('.main_content.col-md-12 .blog_single .blog_post_text, .main_content.col-md-9 .blog_single .blog_post_text').css('font-size', 'inherit');
          }
        } );
    } );

    wp.customize( 'asalah_blog_line_height', function( value ) {
        value.bind( function( to ) {
          if (to > 0) {
          $('.main_content.col-md-12 .blog_single .blog_post_text, .main_content.col-md-9 .blog_single .blog_post_text').css('line-height', to+'px');}
          else {
            $('.main_content.col-md-12 .blog_single .blog_post_text, .main_content.col-md-9 .blog_single .blog_post_text').css('line-height', 'inherit');
          }
        } );
    } );

    wp.customize( 'asalah_blog_description_font_size', function( value ) {
        value.bind( function( to ) {
          if (to > 0) {
          $('.main_content.col-md-12 .blog_posts_list .blog_post_text,.blog_post_description, .blog_posts_wrapper.masonry_blog_style .blog_post_description, .main_content.col-md-12 .blog_posts_wrapper.list_blog_style.blog_posts_list .blog_post_text, .blog_posts_wrapper.list_blog_style .blog_post_description p').css('font-size', to+'px');}
          else {
            $('.main_content.col-md-12 .blog_posts_list .blog_post_text,.blog_post_description, .blog_posts_wrapper.masonry_blog_style .blog_post_description, .main_content.col-md-12 .blog_posts_wrapper.list_blog_style.blog_posts_list .blog_post_text, .blog_posts_wrapper.list_blog_style .blog_post_description p').css('font-size', 'inherit');
          }
        } );
    } );

    wp.customize( 'asalah_blog_description_line_height', function( value ) {
        value.bind( function( to ) {
          if (to > 0) {
          $('.main_content.col-md-12 .blog_posts_list .blog_post_text,.blog_post_description, .blog_posts_wrapper.masonry_blog_style .blog_post_description, .main_content.col-md-12 .blog_posts_wrapper.list_blog_style.blog_posts_list .blog_post_text, .blog_posts_wrapper.list_blog_style .blog_post_description p').css('line-height', to+'px');}
          else {
            $('.main_content.col-md-12 .blog_posts_list .blog_post_text,.blog_post_description, .blog_posts_wrapper.masonry_blog_style .blog_post_description, .main_content.col-md-12 .blog_posts_wrapper.list_blog_style.blog_posts_list .blog_post_text, .blog_posts_wrapper.list_blog_style .blog_post_description p').css('line-height', 'inherit');
          }
        } );
    } );

    wp.customize( 'asalah_custom_header_code', function( value ) {
        value.bind( function( to ) {

        });
      });

    wp.customize( 'asalah_custom_footer_code', function( value ) {
        value.bind( function( to ) {

        });
      });

    wp.customize( 'asalah_main_color', function( value ) {
        value.bind( function( to ) {
        	$( ".asalah_skin_switcher" ).remove();
        	$('body').append('<div class="asalah_skin_switcher">foobar</div>');
        	var response = '';
        	response = response + ' <style> ' + '.skin_color, .skin_color_hover:hover, a, .user_info_button:hover, .header_social_icons a:hover, .blog_post_meta .blog_meta_item a:hover, .widget_container ul li a:hover, .asalah_post_gallery_nav_container ul.flex-direction-nav > li a:hover:before, .post_navigation_item:hover a.post_navigation_arrow, .comment_body p a:hover { color:' + to + ';}' +' </style>';

        	response = response + ' <style> ' + '.skin_bg, .skin_bg_hover:hover, .blog_post_control_item a:hover, .widget_container.asalah-social-widget .widget_social_icon:hover, .tagcloud a:hover { background-color:' + to + ';}' +' </style>';

        	response = response + ' <style> ' + '.skin_border, .blog_post_control_item a, .navigation.pagination .nav-links .page-numbers:hover, .navigation.pagination .nav-links .page-numbers.current, .navigation_links a:hover { border-color:' + to + ';}' +' </style>';

        	response = response + ' <style> ' + '.skin_border_left { border-left-color:' + to + ';}' +' </style>';

          response = response + ' <style> ' + ' progress[value]::-webkit-progress-value {background-color:' + to + ';}' +' </style>';

          response = response + ' <style> ' + ' progress[value]::-moz-progress-bar {background-color:' + to + ';}' +' </style>';

        	response = response + ' <style> ' + '.skin_border_right { border-right-color:' + to + ';}' +' </style>';

        	response = response + ' <style> ' + '.skin_border_top { border-top-color:' + to + ';}' +' </style>';

        	response = response + ' <style> ' + '.skin_border_bottom, .comment_body p a:hover { border-bottom-color:' + to + ';}' +' </style>';

        	$(".asalah_skin_switcher").html(response);

            // $( '.skin_color, .skin_color_hover:hover, a, .user_info_button:hover, .header_social_icons a:hover, .blog_post_meta .blog_meta_item a:hover, .widget_container ul li a:hover, .asalah_post_gallery_nav_container ul.flex-direction-nav > li a:hover:before, .post_navigation_item:hover a.post_navigation_arrow, .comment_body p a:hover' ).css( 'color', to );

            // $( '.skin_bg, .skin_bg_hover:hover, .blog_post_control_item a:hover, .blog_post_control_item .share_item.share_sign:hover, .widget_container.asalah-social-widget .widget_social_icon:hover, .tagcloud a:hover' ).css( 'background-color', to );

            // $( '.skin_border, .blog_post_control_item a, .blog_post_control_item .share_item.share_sign, .navigation.pagination .nav-links .page-numbers:hover, .navigation.pagination .nav-links .page-numbers.current, .navigation_links a:hover' ).css( 'border-color', to );

            // $( '.skin_border_left' ).css( 'border-left-color', to );

            // $( '.skin_border_right' ).css( 'border-right-color', to );

            // $( '.skin_border_top' ).css( 'border-top-color', to );

            // $( '.skin_border_bottom, .comment_body p a:hover' ).css( 'border-bottom-color', to );
        } );
    });
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

    function Site_content_colors(post_bg_color) {

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

    }

    function top_menu_colors(post_bg_color) {

      var border_color = decrease_brightness(post_bg_color, 13);
      var lighter_border_color = decrease_brightness(post_bg_color, 7);
      var darker_color = decrease_brightness(post_bg_color, 18);
      var meta_color = decrease_brightness(post_bg_color, 60);
      var light_bg = decrease_brightness(post_bg_color, 5);
      var output = '<style>';

      output += '.dropdown-menu, .header_search > form.search .search_text, .top_menu_wrapper, .sticky_header .top_menu_wrapper {';
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
     }
})( jQuery );