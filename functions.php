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
