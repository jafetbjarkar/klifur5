<?php
/**
 * The template for displaying crag content
 *
 * Used on index, archive and search
 *
 * @package WordPress
 * @subpackage Klifur.is
 * @since Klifur.is 1.0
 */
?>

<!-- content-crag.php -->

<?php // add banner image if exists (only in single-crag.php) ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		
		<div class="entry-meta">
			<?php klifur5_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'klifur5' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->
	
	<?php // BANNER map ?>
	<?php if( get_field('banner_image') ) : ?>
		<?php $image = get_field('banner_image'); ?>
		<div class="banner-image">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			</a>
		</div>
	<?php endif; ?>

	<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'klifur5' ) ); ?>
	<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'klifur5' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	
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