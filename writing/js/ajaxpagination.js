function readyFn(jQuery) {

	"use strict";

/* --------
 apply ajax loading posts
 ------------------------------------------- */
jQuery(".navigation_links.ajax_load_more a").on('click', function(){
	jQuery(this).html('Loading...');

  var ajax_nav_container = jQuery(this).parent();
  var ajaxcontainer = jQuery('.ajax_content_container');
  var posttype = ajax_nav_container.attr('data-posttype');
  var postsperpage = ajax_nav_container.attr('data-postsperpage');
  var loopfile = ajax_nav_container.attr('data-loopfile');
  var totalpages = ( ajax_nav_container.attr('data-totalpages') );
  var count = parseInt( ajax_nav_container.attr('data-cycle') );
  var lang_data = ajax_nav_container.attr('data-lang');
  var pageid = ajax_nav_container.attr('data-pageid');




  if ( jQuery(this).hasClass('ajax_load_more') && (count) <= totalpages ) {
    count++;
    ajax_nav_container.attr('data-cycle', count);
    loadArticle(count, posttype, postsperpage, loopfile, ajaxcontainer, pageid);

    if (count == totalpages) {
      ajax_nav_container.hide();
    }


  } else {
    return false;
  }
	jQuery(this).html('Load More');
});

function loadArticle(pagenumber, posttype, postsperpage, loopfile, ajaxcontainer, pageid){
  ajaxcontainer.addClass("animated");

  var query_vars = writing_core_vars.query_vars;

  jQuery.ajax({
    url: writing_core_vars.ajax_load,
    type:'POST',
    data: "action=loadposts&page_no="+ pagenumber + '&loop_file='+loopfile+'&posts_per_page='+postsperpage+'&post_type='+posttype+'&query_vars='+query_vars+'&pageid='+pageid,
    success: function(html){
      var content = '<div class="fadeInDown">'+html+'</div>';
      var $blogisotope = jQuery('.blog_posts_wrapper.masonry_blog_style').imagesLoaded( function() {

    		//jQuery(".video_fit_container").fitVids();

    		$blogisotope.isotope({
    			// options
    			itemSelector : '.blog_post_container',
    			transformsEnabled: false,
    			isOriginLeft: jQuery('body.rtl').length ? false : true
    		});

    	});


      jQuery('.ajax_content_container').append(content);
			var slider = jQuery('.grid_slider');
			slider.imagesLoaded( function() {
			if (jQuery('body.rtl').length) {
		    jQuery('.grid_slider').not('.grid_slider.slick-initialized').slick({
		      slide: '.grid_slide.item',
		      adaptiveHeight: true,
		      arrow: true,
		    });
		  } else {

		  jQuery('.grid_slider').not('.grid_slider.slick-initialized').slick({
		    slide: '.grid_slide.item',
		    adaptiveHeight: true,
		    arrow: true
		  });
		};
	});
			var $blogisotope = jQuery('.blog_posts_wrapper.masonry_blog_style').imagesLoaded( function() {

    		//jQuery(".video_fit_container").fitVids();

    		$blogisotope.isotope({
    			// options
    			itemSelector : '.blog_post_container',
    			transformsEnabled: false,
    			isOriginLeft: jQuery('body.rtl').length ? false : true
    		});

    	});


      var $blogisotope = jQuery('.blog_posts_wrapper.masonry_blog_style').isotope('reloadItems');
      jQuery( ".blog_post_control_item .share_item.share_sign" ).not(".blog_single .blog_post_control_item .share_item.share_sign").on('touchstart mouseenter', function() {
        jQuery(this).parent().find('.social_share_item_wrapper').addClass('animating');
      });
      jQuery( ".blog_post_control_item.blog_post_share" ).not(".blog_single .blog_post_control_item.blog_post_share").on('mouseleave', function() {
        jQuery(this).find('.social_share_item_wrapper').removeClass('animating');
      });

  }});


};

}
jQuery( document ).ready( readyFn );