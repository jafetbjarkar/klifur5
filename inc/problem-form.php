<?php
/**
* Populate form options
* Used in category-problem.php
*/
?>

<!-- inc/problem-form.php -->

<?php
//if($url_crag==NULL || $url_crag==false ) $url_crag = "";

/* QUERY CRAGS FOR CRAG DR0P DOWN */
$args = array(  
		'posts_per_page' => true,
		'category_name' => 'crag',
		'orderby' => 'title',
		'order' => 'ASC',					
	);
	$wp_query = null;
	$wp_query = new WP_Query($args);
?>



<!-- Generate the selection form -->
<div class="problem-form">
	<form action="" >
		<select name="crag" id="crag">
			<option value="">All crags</option>
			<?php if ( have_posts() ) : ?>
				<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
					<?php $id = get_the_ID(); ?>
					<?php $title = get_the_title(); ?>
					<option value="<?php echo the_ID(); ?>" <?php if($id==$url_crag) echo "selected"; ?> > <?php echo $title; ?> </option>
				<?php endwhile; ?>
			<?php endif; ?>
		</select>
		<?php wp_reset_query(); // End querying the crags  ?>
		
		<?php // Could not find a way to display ACF field select choices outside loop ?>
		<?php include(locate_template('custom/data.php')); ?>
		<select name="type" id="type">
			<option value="">Type</option>
			<?php foreach($type_of_climbing as $key => $value) : ?>
				<option value="<?php echo $key ?>" <?php if( $url_type == $key ) echo 'selected' ?>>
					<?php echo $value; ?>
				</option>
			<?php endforeach; ?>
		</select>
		
		<div class="sexy-buttons">
			<?php if( is_user_logged_in() ) : ?>
				<fieldset class="metabuttons user-buttons">
					<span class="tooltip" title="My projects">
						<input type="checkbox" name="pro" <?php if($url_pro=='on') echo 'checked'; ?>>
						<label for="pro"></label>
					</span>
					<span class="tooltip" title="Finished">
						<input type="checkbox" name="fin" <?php if($url_fin=='on') echo 'checked'; ?>>
						<label for="fin"></label>
					</span>
					<span class="tooltip" title="My favorites">
						<input type="checkbox" name="fav" <?php if($url_fav=='on') echo 'checked'; ?>> 
						<label for="fav"></label>
					</span>
				</fieldset>
			<?php endif; ?>
			
			<fieldset class="metabuttons">
				<span class="tooltip" title="Image"> <!-- Has image button -->
					<input type="checkbox" name="img" <?php if($url_img=='on') echo 'checked'; ?>> 
					<label for="img"></label>
				</span>
				<span class="tooltip" title="Video">
					<input type="checkbox" name="vid" <?php if($url_vid=='on') echo 'checked'; ?>> <!-- Has video -->
					<label for="vid"></label>
				</span>
				<span class="tooltip" title="Thumbnails">
					<input type="checkbox" name="thumb" <?php if($url_thumb=='on') echo 'checked'; ?>> <!-- Thumbs -->
					<label for="thumb"></label>
				</span>
			</fieldset>
		</div>
		

	</form>
</div> <!-- .problem-form -->