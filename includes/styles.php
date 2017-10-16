<?php

function storefront_parent_theme_enqueue_styles() {
	$t_uri = get_template_directory_uri();
	$s_uri = get_stylesheet_directory_uri();

	wp_enqueue_style('storefront-style'      , $t_uri.'/style.css');
	wp_enqueue_style('storefront-child-style', $s_uri.'/style.css', array('storefront-style'));
}
add_action( 'wp_enqueue_scripts', 'storefront_parent_theme_enqueue_styles' );

include(get_stylesheet_directory() . '/woocommerce-display-attributes/woocommerce-display-attributes.php');
