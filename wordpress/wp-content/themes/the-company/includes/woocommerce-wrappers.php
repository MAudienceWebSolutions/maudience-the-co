<?php

/* ==========================================================================
	# Hooks in this file:
		* woocommerce_breadcrumb_home_url
		* woocommerce_before_main_content
		* woocommerce_after_main_content
		* woocommerce_sidebar
		* woocommerce_show_page_title
		* woocommerce_before_shop_loop
========================================================================== */

/**
 | woocommerce_before_main_content hook
 |
 | woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 | woocommerce_breadcrumb - 20
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

add_action( 'woocommerce_before_main_content', 'crb_woocommerce_before_main_content' );
function crb_woocommerce_before_main_content() {
	?>

	<?php get_template_part('fragments/woocommerce-breadcrumbs'); ?>

	<div class="main">
		<div class="shell clearfix">
			<div class="content">
				<?php get_template_part('fragments/woocommerce-filter-bar'); ?>

	<?php
}

/**
 | woocommerce_after_main_content hook
 |
 | woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

add_action( 'woocommerce_after_main_content', 'crb_woocommerce_after_main_content', 999 );
function crb_woocommerce_after_main_content() {
	// Products per page
	if ( !is_singular() ) {
		get_template_part('fragments/woocommerce-products-per-page');
	}
	?>

			</div><!-- /.content -->

	<?php
}

/**
 | Hide default sidebar
 */
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar' );

add_action( 'woocommerce_sidebar', 'crb_woocommerce_get_sidebar', 999 );
function crb_woocommerce_get_sidebar() {
	/*
	if ( is_singular() ) {
		return;
	}
	*/

	?>

			<div class="sidebar">
				<?php get_sidebar(); ?>
			</div><!-- /.sidebar -->
		</div><!-- /.shell -->
	</div><!-- /.main -->

	<?php
}

/**
 | Hide page title
 |
 | https://codex.wordpress.org/Function_Reference/_return_false
 */
add_filter( 'woocommerce_show_page_title', '__return_false' );

/**
 | woocommerce_before_shop_loop hook
 |
 | woocommerce_result_count - 20
 | woocommerce_catalog_ordering - 30
 */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );