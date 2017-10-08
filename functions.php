<?php

function storefront_parent_theme_enqueue_styles() {
    wp_enqueue_style( 'storefront-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'storefront-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'storefront-style' )
    );
}
add_action( 'wp_enqueue_scripts', 'storefront_parent_theme_enqueue_styles' );

// Change the number of columns per row in the Woocommerce
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 1; // 3 products per row
	}
}
add_filter('loop_shop_columns', 'loop_columns', 999);

function remove_woocommerce_sorting_dropdown() {
  remove_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10 );
  remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10 );
}
add_action('init' , 'remove_woocommerce_sorting_dropdown');

// remove Woocommerce breadcrumbs
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);

// Add quantity input next to Add to Cart link
function quantity_inputs_for_woocommerce_loop_add_to_cart_link( $html, $product ) {
	if ( $product && $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() && ! $product->is_sold_individually() ) {
		$html = '<form action="' . esc_url( $product->add_to_cart_url() ) . '" class="cart-form" method="post" enctype="multipart/form-data">';
    /* $html .= '<span class="qty-text">Qty: </span>'; */
    $html .= woocommerce_quantity_input( array(), $product, false );
		$html .= '<button type="submit" class="add-to-cart button alt">' . esc_html( $product->add_to_cart_text() ) . '</button>';
		$html .= '</form>';
	}
	return $html;
}
add_filter( 'woocommerce_loop_add_to_cart_link', 'quantity_inputs_for_woocommerce_loop_add_to_cart_link', 10, 2 );

function show_woocommerce_page_title() {
  return false; 
}
add_filter('woocommerce_show_page_title', 'show_woocommerce_page_title');

// Overwrite Woocommerce core function to generate a link to the product
// in the product title
function woocommerce_template_loop_product_title() {
  echo '<h2 class="woocommerce-loop-product__title"><a href="'. get_the_permalink() . '">' . get_the_title() . '</a></h2>';
}
