<?php if ( is_active_sidebar( 'footer-sidebar' ) ) : ?>
	<?php dynamic_sidebar( 'footer-sidebar' ); ?>
<?php else : ?>
	<!-- No widgets in sidebar-->
<?php endif; ?>