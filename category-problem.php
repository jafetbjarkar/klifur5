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
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<?php /* GET INFORMATION FROM URL */
			$url_crag 		= $_GET["crag"];
			$url_sector 	= $_GET["sector"];
			$usr_stone 		= $_GET["stone"];
			$url_img 		= $_GET["img"];
			$url_vid 		= $_GET["vid"];
			$url_comments 	= $_GET["comments"];
			$url_type 		= $_GET["type"];
			$url_thumb 		= $_GET["thumb"];

			$url_fav 		= $_GET["fav"];
			$url_fin 		= $_GET["fin"];
			$url_pro		= $_GET["pro"];

			/* GET THE FORM */
			include(locate_template('inc/problem-form.php')); ?>
			
			<?php
			/* QUERY PROBLEMS */
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'category_name' => 'problem',
				'posts_per_page' => 50,
				'paged' => $paged,
				
				'meta_query' => array(
					'relation' => 'AND',

					($url_crag ? array(
				      'key' => 'crag',
				      'value' => $url_crag,
				      'compare' => '='
				    ): false),

				    ($url_vid ? array(
				      'key' => 'video',
				      'value' => NULL,
				      'compare' => '!=',
				      //'type' => 'char'
				    ) : false),
					
				    ($url_img ? array(
				      'key' => 'image',
				      'value' => NULL,
				      'compare' => '!=',
				      //'type' => 'char'
				    ) : false),

				    ($url_type ? array(
				      'key' => 'type',
				      'value' => $url_type,
				      'compare' => '=',
				      //'type' => 'char'
				    ) : false),
			  	)
			); ?>
			
			<?php add_filter('posts_where','query_user_lists'); ?>

			<?php
			if( !$url_thumb ) {
				/* Problem table */
				include(locate_template('inc/problem-table.php'));
			} else {
				/* Problem thumbs */
				include(locate_template('inc/problem-thumbs.php'));
			}


			if( !$wp_query->have_posts() ) : ?>
			 	 <p> Engin leið fannst. <a href="http://klifur.is/wp-admin/post-new.php">Veist þú um eina?</a></p>
			<?php endif; ?>
			
			<!-- <pre>
				<?php //var_dump($wp_query); ?>
			</pre> -->

		</article>
		
		<?php remove_filter('posts_where','query_user_lists'); ?>

		<?php twentythirteen_paging_nav(); ?>
		<?php wp_reset_query(); ?>

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>