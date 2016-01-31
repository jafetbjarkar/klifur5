<?php /**
*
* Some variables available from content-problem.php:
* $crag_id, $sector, $stone, $type
*
* This file needs $args  used in WP_Query()
* Remember to add <?php wp_reset_query(); ?> after this file include
*/
?>

<!-- [PATH] inc/problem-thumbs.php -->

<?php
$wp_query = null;
$wp_query = new WP_Query($args); ?>

<div class="problem-thumbs-area" data-user-id="<?php echo get_current_user_id(); ?>">
    <h2 class="results-heading"><?php echo $wp_query->found_posts; ?> related routes</h2>

<?php if( $wp_query->have_posts() ) : ?>

		<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
			<div class="problem-thumb" data-post-id="<?php the_ID(); ?>">
				<header class="entry-header">
					<h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?> <?php the_field('grade'); ?></a></h3>
				</header><!-- .entry-header -->

				<?php // IMAGE ?>
				<div class="th-image-wrapper">
					<!-- User lists -->
					<div class="btn-icons btn-icons-th">
						<span class="fav"><a class="<?php if( $post->fav ) echo 'on ' ?>" data-list-no="1"></a></span>
						<span class="fin"><a class="<?php if( $post->fin ) echo 'on ' ?>" data-list-no="2"></a></span>
						<span class="pro"><a class="<?php if( $post->pro ) echo 'on ' ?>" data-list-no="3"></a></span>
					</div>

					<?php if( get_field('image') ) : ?>
						<?php $image = get_field('image');
							if( !empty($image) ): ?>
								<a href="<?php the_permalink(); ?>" rel="bookmark">
									<img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
								</a>
						<?php endif; ?>
					<?php endif; ?>
				</div>

				<?php the_content( ); ?>



				<div class="gradient"></div> <!-- just to add gradient to bottom -->
            </div> <!-- .problem-thumb -->
		<?php endwhile; ?>


	<?php endif; ?>
</div> <!-- .problem-thumb-area -->
