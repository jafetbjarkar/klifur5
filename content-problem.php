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

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php // HEADER ?>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?> <?php the_field('grade'); ?></a></h1>
		<div class="entry-meta">
			<?php twentythirteen_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
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
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>

		<table class="problem-table" data-user-id="<?php echo get_current_user_id(); ?>">
			<tr>
				<td>Crag</td>
				<td>
					<?php $the_crag = get_field('crag'); ?>
					<a href="<?php echo $the_crag->guid; ?>"><?php echo $the_crag->post_title; ?></a>
					<?php $crag_id = $the_crag->ID; // used in single-problem.php?> 
				</td>
			</tr>
			<tr>
				<td>Sector</td>
				<td><?php the_field('sector'); ?></td>
				<?php if( is_single() ) $sector = get_field('sector'); // used in single-problem.php ?>
			</tr>
			<tr>
				<td>Stone</td>
				<td>
					<?php the_field('stone'); ?>
					<?php if( is_single() ) $stone = get_field('stone'); // used in single-problem.php ?>
					<?php// if( !$stone ) $stone = NULL; ?>
				</td>
			</tr>
			<tr>
				<td>Type</td>
				<td><?php the_field('type'); ?></td>
				<?php if( is_single() ) $type = get_field('type'); // used in single-problem.php ?>
			</tr>
			<?php if( is_single() ) : ?>
				<tr>
					<td>First Ascent</td>
					<td>
						<?php 
							$first = get_field('first_ascent'); 
							echo $first[display_name];
						?>
					</td>
				</tr>
				<tr data-post-id="<?php the_ID(); ?>">
					<!-- User lists -->
					<td>My stuff</td>
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
			<h2>Video</h2>
			<p><?php the_field('video'); ?></p>
		</div>
	<?php endif; ?>
	

	<?php //FOOTER ?>
	<footer class="entry-meta-comments">
		<?php if ( comments_open() && ! is_single() ) : ?>
			<div class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'twentythirteen' ) . '</span>', __( 'One comment so far', 'twentythirteen' ), __( 'View all % comments', 'twentythirteen' ) ); ?>
			</div><!-- .comments-link -->
		<?php endif; // comments_open() ?>

		<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
			<?php get_template_part( 'author-bio' ); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->

</article><!-- #post -->