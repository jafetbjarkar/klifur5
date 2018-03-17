<?php
/**
 * The sidebar containing the footer widget area
 * If no active widgets in this sidebar, hide it completely.
 */

if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
  <!-- [PATH] sidebar-main.php -->
	<div id="secondary" class="sidebar-container">
		<div class="widget-area">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div>
	</div><!-- #secondary -->
<?php endif; ?>
