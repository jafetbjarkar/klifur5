<?php
/**
 * The template for displaying all single posts
 */

get_header(); ?>

	<!-- [PATH] single.php -->
	<div id="primary" class="content-area">
		<div id="content" class="site-content">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); // the loop ?>

				<?php // Single post for 'crags' and 'problem' categories ?>
				<?php $category = get_the_category()[0]->slug; // Get category for current post ?>
				<?php if( $category == 'crag' ) : ?>
					<?php get_template_part( 'single', $category ); ?>
					<?php //klifur5_post_nav(); ?>
					<?php comments_template(); ?>

				<?php elseif( $category == 'problem' ) : ?>
					<?php get_template_part( 'single', $category ); ?>
					<?php //klifur5_post_nav(); ?>
					<?php comments_template(); ?>

				<?php else : // normal posts + format ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
					<?php //klifur5_post_nav(); ?>
					<?php comments_template(); ?>
				<?php endif; ?>

			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
