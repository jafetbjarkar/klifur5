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
		
		<div class="banner-map">
			<iframe width="640" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps/ms?msid=205265335858135699416.00048240a25d103bca6b8&amp;msa=0&amp;ie=UTF8&amp;t=m&amp;ll=65.007224,-19.248047&amp;spn=3.715753,15.358887&amp;z=6&amp;output=embed"></iframe>
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
				  			<th>Crag</th>
							<th>Problems</th>
							<th>Boulder</th>
							<th>Sport</th>
							<th>Trad</th>
							<th>Comments</th>
							<th>Date</th>
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
								<td class="check"> <?php if ( in_array('Boulder', $type) ) echo 'C'; ?> </td>	
								<td class="check"> <?php if ( in_array('Sport climbing', $type) ) echo 'C'; ?> </td>	
								<td class="check"> <?php if ( in_array('Traditional climbing', $type) ) echo 'C'; ?> </td>	
								
								<td><?php comments_number('0','1','%'); ?></td>
								<td><?php echo get_the_date(); ?></td>
					  	<?php endwhile; ?>
					</tbody>
				  	</table>
				<?php endif; ?>
				<?php wp_reset_query(); ?>

			</article>

			<?php //twentythirteen_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>