<?php

// ADD CATEGORY NICENAMES in body and post class
function category_id_class( $classes ) {
	global $post;
	foreach ( get_the_category( $post->ID ) as $category ) {
		$classes[] = $category->category_nicename;
	}
	return $classes;
}
add_filter( 'post_class', 'category_id_class' );
add_filter( 'body_class', 'category_id_class' );



/* ADMIN BAR CHANGES */
/**
 * Always show the admin bar
 */
show_admin_bar(true);

/**
 * Add log in and register buttons to admin panel when user is not logged in
 */
function admin_bar_add_login( $wp_admin_bar ){
	if( !is_user_logged_in() ) {
		$loginURL = wp_login_url();
		$args = array (
			id => 'log-in-button',
			title => 'Log in',
			href => $loginURL,
		);
	  	$wp_admin_bar -> add_menu( $args );
	 }
}
add_action( 'admin_bar_menu', 'admin_bar_add_login' );

/**
 * Remove the WP logo
 */
function admin_bar_remove_wp_logo() {
    global $wp_admin_bar;
    /* Remove their stuff */
    $wp_admin_bar->remove_menu('wp-logo');

}
add_action('wp_before_admin_bar_render', 'admin_bar_remove_wp_logo', 0);

function admin_bar_remove_search() {
    global $wp_admin_bar;
    /* Remove their stuff */
    $wp_admin_bar->remove_menu('search');
    
}
add_action('wp_before_admin_bar_render', 'admin_bar_remove_search', 0);


/* LOGIN / LOGOUT REDIRECT */
/*
 * Automatically redirect to current page after user logout WordPress.
 */
function get_current_logout( $logout_url ){
  if ( !is_admin() ) {
    $logout_url = add_query_arg('redirect_to', urlencode(( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']), $logout_url);
  }
  return $logout_url;
}
add_filter('logout_url', 'get_current_logout');

/*
 * Redirect users to home page. Admin goes to back panel
 */
function my_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	global $user;
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		//check for admins
		if ( in_array( 'administrator', $user->roles ) ) {
			// redirect them to the default place
			return $redirect_to;
		} else {
			return home_url();
		}
	} else {
		return $redirect_to;
	}
}
add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );


/* NUMERIC PAGING */
/*
 * Add navigation with page numbers. Overrides the default function in functions.php
 */
function twentythirteen_paging_nav() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}
	?>

	<nav class="navigation numeric-navigation" role="navigation">
	<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>
	<ul>

	<?php
	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link() );

	echo '</ul></nav>' . "\n";
}


/* AJAX CALLS */
/* Handle user lists */
function user_lists() {
 
    // The $_REQUEST contains all the data sent via ajax
    if ( isset($_REQUEST) ) {
        $user_ID = $_REQUEST['user_ID'];
        $post_ID = $_REQUEST['post_ID'];
        $list_no = $_REQUEST['list_no'];

        $result['post_ID'] = $post_ID;
         
        // Get value from database if exists - if not =$value = 0
		global $wpdb;
		$value = $wpdb->get_results( '
			SELECT * FROM wp_user_lists 
			WHERE user_id = '.$user_ID.'
			AND post_id = '.$post_ID,
			OBJECT
		);

		// name $list depending on clicked value
		switch($list_no) {
			case 1 : $list = 'fav'; break;
			case 2 : $list = 'fin'; break;
			case 3 : $list = 'pro'; break;
			default: die();
		}

		// update wp_user_lists table
		if( !$value ) { // if the query returned NO results
			// add row
			$result['action'] = 'Add row';
			$update = $wpdb->insert( 
				'wp_user_lists', 
				array( 
					'user_id' => $user_ID,
					'post_id' => $post_ID,
					$list => 1 
				), 
				array( 
					'%d', 
					'%d',
					'%d'
				)
			);
			$result['new_value'] = 1;
			
		} else {
			// set new value
			if( $value[0]->$list ) {
				$new_value = 0;
				$result['new_value'] = 0;
			} else {
				$new_value = 1;
				$result['new_value'] = 1;
			}

			// update table
			$result['action'] = 'Edit row';
			$update = $wpdb->update( 
				'wp_user_lists', 
				array( 
					$list => $new_value
				), 
				array( 'user_id' => $user_ID, 'post_id' => $post_ID )
			);
		}

		// Update wp_postemta with no. of favourites, finished or projects
		// if( $result ) {
		// 	$update = update_post_meta($_REQUEST["post_id"], "votes", $new_vote_count);
		// }

		// if adding new value to database failed -The results array
		if($update == false) { // add values to $result
			$result['type'] = "error";
		} else {
			$result['type'] = "success";
		}
		
		$result = json_encode($result); // encode and return the results
		echo $result;
    }
    // Always die in functions echoing ajax content
   die();
}
add_action( 'wp_ajax_user_lists', 'user_lists' );


/* WP_USER_LISTS  */
/*
 * add hooks to $wp_query to make contents of wp_user_lists available
 */
function add_user_lists ($fields) {
	$query_fields = ", wp_user_lists.* ";
	$fields .= " $query_fields";
	return $fields;
}
function join_user_lists ($join) {
	$user_ID = get_current_user_id();
	$query_join = "LEFT JOIN wp_user_lists ON wp_posts.ID=wp_user_lists.post_id AND wp_user_lists.user_id=$user_ID";
	if ($query_join) $join .= " $query_join";
	return $join;
}

if( is_user_logged_in() ) {
	add_filter('posts_fields','add_user_lists');
	add_filter('posts_join_paged','join_user_lists');
}

// queries for wp_user_lists
function query_user_lists($where) {
	global $url_fav, $url_fin, $url_pro;
	$query_where .= "AND wp_user_lists.";
	if ($url_fav) $where .= $query_where."fav ";
	if ($url_fin) $where .= $query_where."fin ";
	if ($url_pro) $where .= $query_where."pro ";
	return $where;
}
// filter moved to category-problem.php because it breaks other queries (problem-form-> crag query)
//add_filter('posts_where','query_user_lists');


// - LOGIN LOGO
function my_login_logo() {
	global $site;

	if($site == 'klifur') {
	  $login_logo = '/images/klifur-login-logo.svg';
	} elseif($site == 'isalp') {
	  $login_logo = '/images/klifur-login-logo.svg';
	} ?>
  <style type="text/css">
      .login h1 a {
          background-image: url(<?php echo get_stylesheet_directory_uri() . $login_logo; ?> );
          background-size: 300px auto;
          width: 300px;
      }
  </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

