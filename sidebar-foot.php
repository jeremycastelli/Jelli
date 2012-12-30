<?php
/**
 * Widgets foot
 *
 * @package WordPress
 * @subpackage pitch
 * @since pitch 1.0
 */
?>
				<div id="foot-widgets" class="sidebar clearfix" role="complementary">
				
				

					<?php if ( is_active_sidebar( 'foot' ) ) : ?>

						<?php dynamic_sidebar( 'foot' ); ?>

					<?php else : ?>

						<!-- No widgets in sidebar -->
						
					<?php endif; ?>

				</div>