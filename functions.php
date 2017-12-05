<?php

/**
 * WooCommerce customizations
 */

require(get_stylesheet_directory() . '/includes/woo.php');

/**
 * Enqueuing theme styles
 */

require(get_stylesheet_directory() . '/includes/enqueue.php');

/**
 * Show current template being used on all pages where it exists
 */

if (current_user_can('manage_options')) {
	function show_template() {
		global $template;
		echo '<div style="background-color: #eee; border: 1px solid #000; padding: 5px;"><strong>Current template: </strong>' . $template . '</div>';
	}
//	add_action('wp_head', 'show_template');
}


add_action( 'pre_get_posts', 'custom_pre_get_posts_query' );

function custom_pre_get_posts_query( $q ) {
  // Don't execute if we're querying regular blog posts
	if ( ! $q->is_main_query() ) return;
	if ( ! $q->is_post_type_archive() ) return;
	
	if ( ! is_admin() && is_shop() ) {

		$q->set( 'tax_query', array(array(
			'taxonomy' => 'product_cat',
			'field' => 'slug',
			'terms' => array( 'knives' ), // Don't display products in the knives category on the shop page
			'operator' => 'NOT IN'
		)));

    // TODO: don't display products whose SKUs end in -###
	
	}
	remove_action( 'pre_get_posts', 'custom_pre_get_posts_query' );
}


// This works :)


// 1. We need to get all categories
// 2. Nope. We are hardcoding the sidebar!

// Separate "plugin" for managing the filters? I think so...

$args = array(
    'post_type' => 'product',
    'posts_per_page' => 10,
    'meta_key' => '_sku',
    'meta_value' =>  '392611903-501' 
);
$products = new WP_Query( $args );

$posts = $products->posts;

/* foreach($posts as $post) { */
/*   var_dump($post); */
/*  echo '-----------------------------<br><br><br><br>'; */
/*   var_dump(get_post_meta($post->ID)); */
/*  echo '<h1>'.$post->post_title.'</h1>'; */
/*  echo '<br><br><br><br>'; */
/* } */



function add_query_vars_filter( $vars ){
  $vars[] = "category";
  $vars[] = "attribute";
  $vars[] = "inclusive";
  return $vars;
}

add_filter( 'query_vars', 'add_query_vars_filter' );

