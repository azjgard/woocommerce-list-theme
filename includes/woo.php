<?php
/**
 * woo.php
 * WooCommerce customizations.
 */

// ---------------------------------------------------------------------------------

/*
 * Show a warning message when this theme is enabled but WooCommerce is disabled.
 */

function disabledWcShowWarningMessage() {
	if(!function_exists('wc_get_text_attributes')) {
		$warning = '<b>WARNING:</b> This theme needs WooCommerce to function!';
		?>
			<div class="error">
				<p><?php echo $warning ?></p>
			</div>
        <?php
	}
	add_action('admin_notices', 'disabledWcShowWarningMessage');
}

// ---------------------------------------------------------------------------------

/**
 * Show WooCommerce products in a single column.
 */

// Change the number of columns per row in the Woocommerce
if (!function_exists('loop_columns')) {
	function loop_columns() {
	    return 1;
	}
	add_filter('loop_shop_columns', 'loop_columns', 999);
}

// ---------------------------------------------------------------------------------

/**
 * Remove the WooCommerce select box that capacitates sorting.
 */

if (!function_exists('remove_woocommerce_sorting_dropdown')) {
	function remove_woocommerce_sorting_dropdown() {
		remove_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10 );
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10 );
	}
	add_action('init' , 'remove_woocommerce_sorting_dropdown');
}

// ---------------------------------------------------------------------------------

/**
 * Remove WooCommerce breadcrumbs.
 */

remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);

// ---------------------------------------------------------------------------------

/**
 * Add an input box for product quantity for all WooCommerce products.
 */

function quantity_inputs_for_woocommerce_loop_add_to_cart_link( $html, $product ) {
	if ( $product && $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() && ! $product->is_sold_individually() ) {
		$html = '<form action="' . esc_url( $product->add_to_cart_url() ) . '" class="cart-form" method="post" enctype="multipart/form-data">';
		$html .= woocommerce_quantity_input( array(), $product, false );
		$html .= '<button type="submit" class="add-to-cart button alt">' . esc_html( $product->add_to_cart_text() ) . '</button>';
		$html .= '</form>';
	}
	return $html;
}
add_filter('woocommerce_loop_add_to_cart_link', 'quantity_inputs_for_woocommerce_loop_add_to_cart_link', 10, 2);

// ---------------------------------------------------------------------------------

/**
 * Hide the page title on the WooCommerce shop page.
 */

if (!function_exists('show_woocommerce_page_title')) {
	function show_woocommerce_page_title() { return false; }
	add_filter('woocommerce_show_page_title', 'show_woocommerce_page_title');
}

// ---------------------------------------------------------------------------------

/**
 * Overwrite the WooCommerce core function to generate a link to the product page
 * in the product title.
 */

function woocommerce_template_loop_product_title() {
	echo '<h2 class="woocommerce-loop-product__title"><a href="'. get_the_permalink() . '">' . get_the_title() . '</a></h2>';
}

// ---------------------------------------------------------------------------------
