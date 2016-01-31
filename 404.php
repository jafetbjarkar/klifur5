<?php
/**
 * The template for displaying 404 pages (Not Found)
 */

get_header(); ?>

	<!-- [PATH] 404.php -->
	<div id="primary" class="content-area">
		<div id="content" class="site-content">

			<header class="page-header">
				<h1 class="page-title"><?php _e( 'Not Found', 'klifur5' ); ?></h1>
			</header>

			<div class="page-wrapper">
				<div class="page-content">
					<h2><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'klifur5' ); ?></h2>
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'klifur5' ); ?></p>

					<?php get_search_form(); ?>
				</div>
			</div>

		</div>
	</div> <!-- #primary -->

<?php get_footer(); ?>
