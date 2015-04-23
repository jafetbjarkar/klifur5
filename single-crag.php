<?php
/**
 * The template for displaying crag content
 *
 * Used when displaying single crag
 *
 * @package WordPress
 * @subpackage Klifur.is
 * @since Klifur.is 1.0
 */
?>

<?php // BANNER ?>
<?php $image = get_field('banner_image'); ?>
<div class="banner-image">
	<?php if( !empty($image) ): ?>
		<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
		<span><?php the_title(); ?>: <?php the_field('type_of_climbing'); ?></span>
	<?php endif; ?>
</div>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php // TITILE, META, CONTENT ?>
	<div class="post-section">
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			
			<div class="entry-meta">
				<?php twentythirteen_entry_meta(); ?>
				<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->
	
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div>
		
	<?php // DIRECTIONS, MAP ?>
	<div class="post-section">
		<?php if( get_field('directions') ) : ?>
				<h2>Directions</h2>
				<p><?php the_field('directions')  ?></p>
		<?php endif; ?>

		<h2>Map</h2>
		<?php $location = get_field('map'); ?>
		<?php if( !empty($location) ): ?>
			<div class="acf-map">
				<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
			</div>
		<?php endif; ?>
	</div>

	<?php // VIDEO ?>
	<?php if( get_field('video') ) : ?>
		<div class="post-section">
			<h2>Video</h2>
			<p><?php the_field('video'); ?></p>
		</div>
	<?php endif; ?>
	

	<?php // PROBLEMS TABLE ?>
	<div class="related-problems">
		
		<?php $crag = get_the_id(); ?>

		<?php $args = array(
			//'post_type' => 'post',
			//'post_status' => 'publish',
			'posts_per_page' => true,
			//'caller_get_posts'=> 1,
			'category_name' => 'problem',
			// Get meta values
			'meta_key' => 'crag',
			'meta_value' => $crag
		); ?>

		<?php include(locate_template('inc/problem-table.php'));

		if( !$wp_query->have_posts() ) : ?>
		 	<p> Engin leið fannst. <a href="http://klifur.is/wp-admin/post-new.php">Veist þú um eina?"</a></p>
		<?php endif; ?>

		<?php wp_reset_query(); ?>

	</div> <!-- .relatied-problems -->

</article>
