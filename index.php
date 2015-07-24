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

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
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


				<?php // Add ad widgets ?>
				<?php if( $counter == 1 || $counter == 3 || $counter == 7 ) : ?>
					
					<?php 
						switch ($counter) {
							case 1:
								$place = 1;
								break;
							case 3:
								$place = 2;
								break;
							case 7:
								$place = 3;
								break;
						}
					?>

					<?php $sidebar_id = 'sidebar-ad'.$place; ?>

					<?php if ( is_active_sidebar( $sidebar_id  ) ) : ?>
						<div id="<?php echo $sidebar_id; ?>" class="<?php echo $sidebar_id; ?> hentry" role="complementary">
							<?php dynamic_sidebar( $sidebar_id ); ?>
						</div><!-- #primary-sidebar -->
					<?php endif; ?>
					
				<?php endif; ?>
				<?php $counter++; ?>

			<?php endwhile; ?>

			<?php twentythirteen_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

<pre>
<?php 
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
?>
</pre>
