<?php
if (   ! is_active_sidebar( 'footer-1'  )
	&& ! is_active_sidebar( 'footer-2' )
	&& ! is_active_sidebar( 'footer-3'  )
)
return;

$footer_widget_col = 'col-md-4';
// if (asalah_option('asalah_footer_three')) {
// 	$footer_widget_col = 'col-md-4';
// }
?>
<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
<div id="first_footer_widget" class="widget_area <?php echo esc_attr($footer_widget_col); ?>">
	<?php dynamic_sidebar( 'footer-1' ); ?>
</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
<div id="second_footer_widget" class="widget_area <?php echo esc_attr($footer_widget_col); ?>">
	<?php dynamic_sidebar( 'footer-2' ); ?>
</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
<div id="third_footer_widget" class="widget_area <?php echo esc_attr($footer_widget_col); ?>">
	<?php dynamic_sidebar( 'footer-3' ); ?>
</div>
<?php endif; ?>