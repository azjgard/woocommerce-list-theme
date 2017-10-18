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


