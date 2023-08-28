<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<!-- content-problem.php -->

<?php include(locate_template('config/data.php')); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php // HEADER ?>
	<header class="entry-header">

		<?php if( get_field('type') === 'sport' ) : ?>
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark">
					<?php the_title(); ?> 
					<?php the_field('grade_sport'); ?>
					<span class="old-grade"><?php the_field('grade'); ?></span>
				</a>
			</h1>
		<?php endif; ?>


		<?php if( get_field('type') === 'trad' || get_field('type') === 'boulder' ) : ?>
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark">
					<?php the_title(); ?> 
					<?php the_field('grade'); ?>
				</a>
			</h1>
		<?php endif; ?>

		<div class="entry-meta">
			<?php klifur5_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'klifur5' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="post-section problem-image"> <?php // IMAGE ?>
		<?php if( get_field('image') ) : ?>
		<?php $image = get_field('image'); ?>
			<?php if( is_single() ) : ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php else: ?>
				<a href="<?php the_permalink(); ?>" rel="bookmark">
					<img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" />
				</a>
			<?php endif; ?>
		<?php endif; ?>
	</div>

	<div class="post-section"> <?php // CONTENT AND TABLE ?>
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'klifur5' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'klifur5' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>

		<table class="problem-table" data-user-id="<?php echo get_current_user_id(); ?>">
			<tr>
				<td><?php _e( 'Crag', 'klifur5') ?></td>
				<td>
					<?php $the_crag = get_field('crag'); ?>
					<a href="<?php echo $the_crag->guid; ?>"><?php echo $the_crag->post_title; ?></a>
					<?php $crag_id = $the_crag->ID; // used in single-problem.php?>
				</td>
			</tr>

			<?php if( get_field('sector') ) : ?>
				<tr>
					<td><?php _e( 'Sector', 'klifur5') ?></td>
					<td><?php the_field('sector'); ?></td>
					<?php if( is_single() ) $sector = get_field('sector'); // used in single-problem.php ?>
				</tr>
			<?php endif; ?>

			<?php if( get_field('stone') ) : ?>
				<tr>
					<td><?php _e( 'Stone', 'klifur5') ?></td>
					<td><?php the_field('stone'); ?></td>
					<?php if( is_single() ) $stone = get_field('stone'); // used in single-problem.php ?>
				</tr>
			<?php endif; ?>

			<tr>
				<td><?php _e( 'Type', 'klifur5') ?></td>
				<td><?php the_field('type'); ?></td>
				<?php if( is_single() ) $type = get_field('type'); // used in single-problem.php ?>
			</tr>

			<?php if( is_single() && $site == 'klifur' ) : ?>
				<tr>
					<td><?php _e( 'First ascent', 'klifur5') ?></td>
					<td>
						<?php
							$first = get_field('first_ascent');
							echo $first[display_name];
						?>
					</td>
				</tr>
				<?php endif; ?>

				<?php if( is_single() ) : ?>
				<tr data-post-id="<?php the_ID(); ?>">
					<!-- User lists -->
					<td><?php _e( 'Markings', 'klifur5') ?></td>
					<td class="btn-icons">
						<span class="fav"><a class="<?php if( $post->fav ) echo 'on ' ?>" data-list-no="1"></a></span>
						<span class="fin"><a class="<?php if( $post->fin ) echo 'on ' ?>" data-list-no="2"></a></span>
						<span class="pro"><a class="<?php if( $post->pro ) echo 'on ' ?>" data-list-no="3"></a></span>
					</td>
				</tr>
			<?php endif; ?>

		</table>
	</div>

	<?php // VIDEO ?>
	<?php if( get_field('video') ) : ?>
		<div class="post-section problem-video">
			<h2><?php _e( 'Video', 'klifur5') ?></h2>
			<p><?php the_field('video'); ?></p>
		</div>
	<?php endif; ?>


	<?php //FOOTER ?>
	<footer class="entry-meta-comments">
		<?php if ( comments_open() && ! is_single() ) : ?>
			<div class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'klifur5' ) . '</span>', __( 'One comment so far', 'klifur5' ), __( 'View all % comments', 'klifur5' ) ); ?>
			</div><!-- .comments-link -->
		<?php endif; // comments_open() ?>

		<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
			<?php get_template_part( 'author-bio' ); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->

</article><!-- #post -->
