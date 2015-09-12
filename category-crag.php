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

<!-- category-crag.php -->

<?php include(locate_template('config/data.php')); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		
		<div class="banner-map">
			<?php echo $map_embed; ?>	
		</div>
		
		<?php // Get all problems for problem count ?>
		<?php // Notice: This will be heavy when the problems increase. Will maybe have to fix later ?>
			<?php $args = array(
				'posts_per_page' => -1,
				'caller_get_posts'=> 1,
				'category_name' => 'problem',
			);
			$my_query2 = null;
			$my_query2 = new WP_Query($args); ?>
			
			<?php if( $my_query2->have_posts() ) : ?>
				<?php while ($my_query2->have_posts()) : $my_query2->the_post(); ?>
					<?php $the_crag = get_field('crag'); ?>
					<?php $problem_count[] =  $the_crag->post_title; ?>
				<?php endwhile; ?>
			<?php endif; ?>
			<?php wp_reset_query(); ?>


		<?php // Render the crag table ?>
		<?php if ( have_posts() ) : ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<?php //link = admin_url( 'admin-ajax.php?action=my_user_vote&post_id=874' ); ?>
				<?php //echo '<a class="user_vote" data-post_id="874" href="' . $link . '">vote for this article</a>';  ?>

				<?php $args = array(
					'posts_per_page' => -1,
					'category_name' => 'crag',
					'orderby' => 'title',
					'order' => 'ASC'
				);
				$my_query = null;
				$my_query = new WP_Query($args);
				if( $my_query->have_posts() ) :  ?>
				 	<table id="myTable" class="tablesorter">
				 	<thead>
				  		<tr>
				  			<th>Klifursvæði</th>
								<th>Leiðir</th>
								<th><?php echo $climbing_types[0]; ?></th>
								<th><?php echo $climbing_types[1]; ?></th>
								<th><?php echo $climbing_types[2]; ?></th>
								<th>Athugasemdir</th>
								<th>Dagsetning</th>
				  		</tr>
				  	</thead>
				  	<tbody>
					  	<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>

							<tr>
								<td><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></td>
								<?php $type = get_field('type_of_climbing'); ?>
								<td>
									<?php 
										$count = 0;
										foreach($problem_count as $problem) {
											if( $problem == get_the_title() ) {
												$count++;
											}
										}
										echo $count;
									?>
								</td>
								<td class="check"> <?php if ( in_array($climbing_types[0], $type) ) echo 'C'; ?> </td>	
								<td class="check"> <?php if ( in_array($climbing_types[1], $type) ) echo 'C'; ?> </td>	
								<td class="check"> <?php if ( in_array($climbing_types[2], $type) ) echo 'C'; ?> </td>	
								
								<td><?php comments_number('0','1','%'); ?></td>
								<td><?php echo get_the_date(); ?></td>
					  	<?php endwhile; ?>
					</tbody>
				  	</table>
				<?php endif; ?>
				<?php wp_reset_query(); ?>

			</article>

			<?php //klifur5_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>