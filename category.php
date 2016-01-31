<?php
/**
 * The template for displaying Category pages
 */

get_header(); ?>

	<!-- [PATH] category.php -->

	<div id="primary" class="content-area">
		<div id="content" class="site-content-masonry">
			<div class="grid-sizer"></div>

			<?php if ( have_posts() ) : ?>

				<?php /* The loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php endwhile; ?>

			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>

		</div>
		<?php klifur5_paging_nav(); ?>

	</div> <!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
