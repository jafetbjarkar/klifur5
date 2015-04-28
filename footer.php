<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>


			</div><!-- #main -->
		<footer id="colophon" class="site-footer" role="contentinfo">
			<?php get_sidebar( 'main' ); ?>
			<?php include('custom/partner-logo.php'); ?>
		</footer><!-- #colophon -->
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
	<!-- Extra scripts -->
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/min/extra-min.js"></script>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-11339300-2', 'auto');
	  ga('send', 'pageview');

	</script>
</body>
</html>