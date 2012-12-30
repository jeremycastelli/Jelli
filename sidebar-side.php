<?php
/**
 * widgets side
 *
 * @package WordPress
 * @subpackage pitch
 * @since pitch 1.0
 */
?>
				<div id="sidebar-side" class="sidebar" role="complementary">
				
					<?php get_search_form(); ?>

					<?php if ( is_active_sidebar( 'side' ) ) : ?>

						<?php dynamic_sidebar( 'side' ); ?>

					<?php else : ?>

						<!-- No widgets in sidebar-->
						
						

					<?php endif; ?>

				</div>