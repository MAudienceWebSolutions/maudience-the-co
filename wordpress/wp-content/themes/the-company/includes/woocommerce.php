<?php

/* ==========================================================================
	# Hooks in this file:
		* loop_shop_per_page
		* woocommerce_output_related_products_args
		* woocommerce_breadcrumb_home_url
		* woocommerce_product_categories_widget_args
========================================================================== */

/**
 | Modify products count
 */
add_filter( 'loop_shop_per_page', 'crb_wc_get_products_per_page', 20 );
function crb_wc_get_products_per_page() {
	$products_per_page = 12;
	if ( !empty($_COOKIE['products_per_page']) && is_numeric($_COOKIE['products_per_page']) ) {
		$products_per_page = absint($_COOKIE['products_per_page']);
	}

	return $products_per_page;
}

/**
 | Change related products count
 */
add_filter( 'woocommerce_output_related_products_args', 'crb_woocommerce_output_related_products_args' );
function crb_woocommerce_output_related_products_args( $args ) {
	$args['posts_per_page'] = 3;
	$args['columns']        = 3;
	return $args;
}

/**
 | Modify the WooCommerce Breadcrumbs Home Link, replacing it with Shop Link
 */
function crb_woocommerce_breadcrumb_home_url() {
	return get_permalink(woocommerce_get_page_id('shop'));
}

/**
 | Modify Categories depth for the Categories Widget
 */
add_filter('woocommerce_product_categories_widget_args', 'crb_woocommerce_product_categories_widget_args', 100);
function crb_woocommerce_product_categories_widget_args($list_args) {
	$list_args['child_of'] = 0;
	$list_args['depth'] = 2;
	$list_args['walker'] = new Crb_WC_Product_Cat_List_Walker;
	if ( is_product_category() ) {
		$list_args['child_of'] = get_queried_object()->term_id;
	} elseif ( is_singular('product') ) {
		$product_categories = wp_get_post_terms(get_the_id(), 'product_cat');
		if ( !empty($product_categories) && !empty($product_categories[0]) ) {
			$list_args['child_of'] = $product_categories[0]->parent;
			// $list_args['child_of'] = $product_categories[0]->term_id;
		}
	}

	return $list_args;
}