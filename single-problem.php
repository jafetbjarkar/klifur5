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

<!-- single-problem.php -->
	
<?php // use inlude instead of get_template_part() because I need to pass variables from the inluded file ?>
<?php include(locate_template('content-problem.php')); ?>

<?php $args = array(
	'post_type' => 'post',
	'post_status' => 'publish',
	'posts_per_page' => true, // load all posts
	'caller_get_posts'=> 1,
	'category_name' => 'problem',
	// single meta pair
	// 'meta_key' => 'stone',
	// 'meta_value' => $stone,

	// multiple meta pairs
	'meta_query' => array(
	    array(
	      'key' => 'crag',
	      'value' => $crag_id,
	      //'compare' => '=',
	      //'type' => 'numeric'
	    ),
	    ($sector ? array(
			'key' => 'sector',
			'value' => $sector,
			'compare' => '=',
			//'type' => 'char'
		) : false),
	    ($stone ? array(
			'key' => 'stone',
			'value' => $stone,
			'compare' => '=',
			//'type' => 'char'
		) : false),
  	)
); ?>

<?php include(locate_template('inc/problem-thumbs.php')); ?>

<?php wp_reset_query(); ?>

