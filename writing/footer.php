					</div> <!-- .row -->
				</div> <!-- .container -->
			</section> <!-- .site_content -->

			<footer class="site-footer">
				<h3 class="screen-reader-text"><?php _e('Site Footer', 'asalah') ?></h3>
				<div class="footer_wrapper">
					<div class="container">

						<?php
							$first_footer = "no_first_footer";
							if (  is_active_sidebar( 'footer-1'  )
										|| is_active_sidebar( 'footer-2' )
										|| is_active_sidebar( 'footer-3'  )
							):
							$first_footer = "has_first_footer";
						?>
						<div class="first_footer widgets_footer row">
							<?php get_sidebar('footer'); ?>
						</div>
						<?php endif; ?>

						<?php if (asalah_option('asalah_footer_credits')): ?>
							<div class="second_footer <?php echo esc_attr($first_footer); ?> row">
								<div class="col-md-12">
									<div class="second_footer_content_wrapper footer_credits">
										<?php echo asalah_option('asalah_footer_credits'); ?>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</footer><!-- .site-footer -->
		</div><!-- .site_main_container -->

		<!-- start site side container -->
		<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
			<div class="sliding_close_helper_overlay"></div>
			<div class="site_side_container <?php if (asalah_cross_option('asalah_sticky_menu') == 'yes') { echo 'sticky_sidebar';}?>">
				<h3 class="screen-reader-text"><?php _e('Sliding Sidebar', 'asalah') ?></h3>
				<div class="info_sidebar">
					<?php dynamic_sidebar( 'sidebar-2' ); ?>
					<?php if ((intval(asalah_cross_option('asalah_site_width')) < 701) && (intval(asalah_cross_option('asalah_site_width')) > 499) && (asalah_option('asalah_sidebar_position') != 'none')) { ?>
						<?php dynamic_sidebar( 'sidebar-1' ); ?>
					<?php } ?>
				</div>

			</div>
		<?php else: ?>
			<?php if ((intval(asalah_cross_option('asalah_site_width')) < 701) && (intval(asalah_cross_option('asalah_site_width')) > 499) && (asalah_option('asalah_sidebar_position') != 'none')) { ?>
				<div class="sliding_close_helper_overlay"></div>
				<div class="site_side_container">
					<h3 class="screen-reader-text"><?php _e('Sliding Sidebar', 'asalah') ?></h3>
					<div class="info_sidebar">
							<?php dynamic_sidebar( 'sidebar-1' ); ?>
					</div>
				</div>
				<?php } ?>
		<?php endif; ?>
		</div> <!-- end site side container .site_side_container -->
</div><!-- .site -->

<?php wp_footer(); ?>
<?php if (asalah_cross_option('asalah_custom_footer_code')) {
	echo asalah_cross_option('asalah_custom_footer_code');
} ?>

<?php if (asalah_cross_option('asalah_sticky_menu') == "yes") {
	?>
	<script type="text/javascript">
	jQuery(window).scroll(function() {
			var scrolling = jQuery(window).scrollTop();
			var main_navbar_offset = jQuery('.site_header').height();
			if (jQuery(window).scrollTop() > main_navbar_offset) {
				jQuery('.sticky_header .header_info_wrapper').not('.mobile_menu_opened .header_info_wrapper').show('slow');
			} else if (jQuery(window).scrollTop() < main_navbar_offset) {
				jQuery('.sticky_header .header_info_wrapper').not('.mobile_menu_opened .header_info_wrapper').hide('slow');

			}
	 });
 </script>
<?php } ?>

</body>
</html>