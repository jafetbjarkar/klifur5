<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
				
				<?php //link = admin_url( 'admin-ajax.php?action=my_user_vote&post_id=874' ); ?>
				<?php //echo '<a class="user_vote" data-post_id="874" href="' . $link . '">vote for this article</a>';  ?>
					
				<?php 
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

				$args = array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'posts_per_page' => get_option('posts_per_page'),
					'category_name' => 'blog',
					'paged' => $paged,
					'tax_query' => array(
					    array(
					      'taxonomy' => 'post_format',
					      'field' => 'slug',
					      'terms' => 'post-format-video',
					      'operator' => 'NOT IN'
					    ),
					     array(
					      'taxonomy' => 'post_format',
					      'field' => 'slug',
					      'terms' => 'post-format-image',
					      'operator' => 'NOT IN'
					    )
					  )
				);
				//$wp_query = null;

				
				$wp_query = new WP_Query($args);

				//$wp_query = new WP_Query($args);


				if( $wp_query->have_posts() ) :  ?>
						<?php // the loop ?>
					  	<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
							<?php //Sif ( false === get_post_format() ) : // has no special format  ?>
								<?php get_template_part('content'); ?>
							<?php // endif; ?>
					  	<?php endwhile; ?>

					  	<?php twentythirteen_paging_nav(); //virkar ekki?? ?>
						

						<?php wp_reset_query(); ?>
				<?php endif; ?>
		
			



		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
