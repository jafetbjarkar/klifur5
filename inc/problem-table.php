<?php
/**
* Render the Problem Table
*
* This file needs $args  used in WP_Query()
* Remember to add <?php wp_reset_query(); ?> after this file include
*/
?>

<!-- inc/problem-table.php -->

<?php
$wp_query = null;
$wp_query = new WP_Query($args); ?>

<?php $no_of_routes = $wp_query->found_posts; ?>
<?php $text = sprintf( _n( '%s route', '%s routes', $no_of_routes, 'klifur5' ), $no_of_routes ); ?>

<h2 class="results-heading">
<?php
	if($no_of_routes > 0) {
		echo $text;
	} else {
		echo _e( 'No route has been added yet', 'klifur5' );
	}
 ?>

</h2>

<?php if( $wp_query->have_posts() ) :  ?>

	<?php // Get current post index number
		// $posts_per_page = $wp_query->query_vars[posts_per_page].'<br>';
		// $counter = $posts_per_page * ($paged - 1)  + 1;
	 ?>

 	<table id="myTable" class="tablesorter problem-table category-problem-table" data-user-id="<?php echo get_current_user_id(); ?>">
	 	<thead>
	  		<tr>
	  			<th><?php _e( 'Route', 'klifur5' ); ?></th>
					<th><?php _e( 'Grade', 'klifur5' ); ?></th>
					<th><?php _e( 'Area', 'klifur5' ); ?></th>
					<th><?php _e( 'Sector', 'klifur5' ); ?></th>

					<?php if($site == 'klifur') : ?>
						<th><?php _e( 'Stone', 'klifur5' ); ?></th>
					<?php endif; ?>

					<th><?php _e( 'Date', 'klifur5' ); ?></th>
					<th></th>
					<th></th>
	  		</tr>
	  	</thead>
	  	<tbody>
		  	<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
				<tr data-post-id="<?php the_ID(); ?>">
					<td><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></td>
					<td>
						<?php if( get_field('type') === 'sport' ) : ?>
							<?php if( get_field('grade_sport')  ) { the_field('grade_sport'); } ?>
						<?php endif; ?>
						
						<?php if( get_field('type') === 'trad' || get_field('type') === 'boulder' ) : ?>
							<?php if( get_field('grade')  ) { the_field('grade'); } ?>
						<?php endif; ?>
					</td>
					<td>
						<?php $the_crag = get_field('crag'); ?>
						<a href="<?php echo $the_crag->guid; ?>"><?php echo $the_crag->post_title; ?></a>
					</td>
					<td><?php the_field('sector'); ?></td>

					<?php if($site == 'klifur') : ?>
						<td><?php the_field('stone'); ?></td>
					<?php endif ?>

					<td><?php echo get_the_date(); ?></td>

					<!-- Meta icons -->
					<td class="meta-icons">
						<!-- Type icon -->
						<?php if( get_field('type') ) $type = get_field('type'); ?>
						<span class="type tooltip" title="<?php echo $type ?>"><?php echo strtoupper( $type[0] ); ?></span>

						<!-- Image -->
						<?php if( get_field('image') ) : ?>
							<span class="image tooltip" title="Has image">p</span>
						<?php  endif; ?>

						<!-- Video -->
						<?php if( get_field('video') ) : ?>
							<span class="video tooltip" title="Has video">v</span>
						<?php  endif; ?>

						<!-- Comments icon -->
						<?php if( get_comments_number() > 0 ) : ?>
							<span class="comments tooltip" title="Has comment">f</span>
						<?php endif; ?>
					</td>

					<!-- User lists -->
					<td class="btn-icons">
						<span class="fav"><a class="<?php if( $post->fav ) echo 'on ' ?>" data-list-no="1"></a></span>
						<span class="fin"><a class="<?php if( $post->fin ) echo 'on ' ?>" data-list-no="2"></a></span>
						<span class="pro"><a class="<?php if( $post->pro ) echo 'on ' ?>" data-list-no="3"></a></span>
					</td>

		  	<?php endwhile; ?>
		</tbody>
  	</table>
<?php endif; ?>
