<?php
/**
 * Footer template
 * Contains footer content and the closing of the #main and #page div elements.
 */

// FOR DEBUGGING
// ini_set('display_errors',1);
// ini_set('display_startup_errors',1);
// error_reporting(-1);
 ?>


		<!-- [PATH] footer.php -->
		</div><!-- #main -->
		<footer id="colophon" class="site-footer">
			<?php get_sidebar( 'main' ); ?>
			<?php include('config/partner-logo.php'); ?>
		</footer>
	</div><!-- #page -->

	<!-- The notification popup window -->
	<div class="notification"></div>

	<?php wp_footer(); ?>

	<!-- Add the tablesorter plugin for this site -->
	<script src="<?php bloginfo('template_url'); ?>/js/min/jquery.tablesorter-min.js"></script>
	<!-- enable ACF -->
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/min/advanced-custom-fields-min.js"></script>
	<!-- enable crag maps -->
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
	<!-- enable imagelightbox -->
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/min/imagelightbox-min.js"></script>
	<!-- Tooltipster -->
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/min/jquery.tooltipster.min.js"></script>
	<!-- Rearange layout on index -->
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/min/masonry-min.js"></script>
	<!-- Extra scripts -->
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/min/extra-min.js"></script>

</body>
</html>
