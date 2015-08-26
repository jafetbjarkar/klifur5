<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Klifur.is
 * @since Klifur.is 1.0
 */

get_header(); ?>
	
	<!-- index.php -->
	
	<!-- Index banner image -->
	<div class="banner-image">
		<a href="<?php the_permalink(); ?>" rel="bookmark">
			<img src="<?php echo( get_header_image() ); ?>" alt="<?php echo( get_bloginfo( 'title' ) ); ?>" />
		</a>
	</div>

	<div id="primary" class="content-area">
		<div id="content" class="site-content-masonry" role="main">
			<div class="grid-sizer"></div>
			<?php if ( have_posts() ) : ?>
				
				<?php $counter = 1; // used to insert ad widgets ?>

				<?php /* The loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					
					<?php // klifur.is ?>
					<?php // Single post for 'crags' and 'problem' categories ?>
					<?php // Get category for current post ?>
					<?php $category = get_the_category()[0]->slug; ?>
					<?php if( $category == 'crag' || $category == 'problem') : ?>
						<?php get_template_part( 'content', $category ); ?>
					<?php else : // normal posts + format ?>
						<?php get_template_part( 'content', get_post_format() ); ?>
					<?php endif; ?>

					
					<?php // Add widgets into posts ?>
					<?php if( $counter == 1 || $counter == 2 || $counter == 4 || $counter == 8 ) : ?>
						<?php 
							switch ($counter) {
								case 1:
									$sidebar_id = 'widget-forum';
									break;
								case 2:
									$sidebar_id = 'widget-ad1';
									break;
								case 4:
									$sidebar_id = 'widget-ad2';
									break;
								case 8:
									$sidebar_id = 'widget-ad3';
									break;
							}
						?>
						<?php if ( is_active_sidebar( $sidebar_id  ) ) : ?>
							<div id="<?php echo $sidebar_id; ?>" class="<?php echo $sidebar_id; ?> hentry" role="complementary">
								<?php dynamic_sidebar( $sidebar_id ); ?>
							</div><!-- #primary-sidebar -->
						<?php endif; ?>
					<?php endif; ?>


					<?php $counter++; ?>

				<?php endwhile; ?>

				

			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>

		</div><!-- #content -->
		<?php twentythirteen_paging_nav(); ?>
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>