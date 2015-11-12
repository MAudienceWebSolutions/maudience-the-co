<?php

/* ==========================================================================
	# Hooks in this file:
		* woocommerce_before_shop_loop_item_title
		* woocommerce_shop_loop_item_title
		* woocommerce_after_shop_loop_item_title
		* woocommerce_after_shop_loop_item
========================================================================== */

/**
 | woocommerce_before_shop_loop_item_title hook
 |
 | woocommerce_show_product_loop_sale_flash - 10
 | woocommerce_template_loop_product_thumbnail - 10
 */
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail' ); 	

/**
 | woocommerce_shop_loop_item_title hook
 |
 | @hooked woocommerce_template_loop_product_title - 10
 */
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title' );

add_action( 'woocommerce_shop_loop_item_title', 'crb_woocommerce_template_loop_product_title' );
function crb_woocommerce_template_loop_product_title() {

	global $product;

	$product_title = get_the_title();

	if ( $product->get_sku() ) {
		$sku_prefix = '';

		if ( is_single() ) {
			$sku_prefix = __( 'Item #: ', 'crb' );
		}

		$product_title .= '<small>' . $sku_prefix . $product->get_sku() . '</small>';
	}

	?>

	<h3><?php echo $product_title; ?></h3>

	<?php
}

/**
 | woocommerce_after_shop_loop_item_title hook
 |
 | woocommerce_template_loop_rating - 5
 | woocommerce_template_loop_price - 10
 */
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price' );

add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail' );
add_action( 'woocommerce_after_shop_loop_item_title', 'crb_woocommerce_after_shop_loop_item_title' );
function crb_woocommerce_after_shop_loop_item_title() {
	global $product;
	
	$regular_price = $product->regular_price;
	$price         = $product->price;

	if ( $price ): ?>
		<span class="price">
			<?php if ( $regular_price && $regular_price !== $price ): ?>
				<del>
					<span class="amount"><?php echo wc_price( $regular_price ); ?></span>
				</del>
			<?php endif; ?>

			<ins>
				<span class="amount"><?php echo wc_price( $price ); ?></span>
			</ins>
		</span>
	<?php endif;
}

/**
 | woocommerce_after_shop_loop_item hook
 |
 | woocommerce_template_loop_add_to_cart - 10
 */
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );

add_action( 'woocommerce_after_shop_loop_item', 'crb_woocommerce_after_shop_loop_item' );
function crb_woocommerce_after_shop_loop_item() {
	if ( is_single() ) {
		return;
	}
	?>
	<a href="<?php the_permalink(); ?>" class="btn btn-view"><?php _e( 'View Product', 'crb' ); ?></a>
	<?php
}

/**
 | Override the dropdown prefix change from "Any %s" to "%s"
 */
add_filter('gettext', 'crb_override_layered_nav_widget_dropdown_prefix', 10, 3);
function crb_override_layered_nav_widget_dropdown_prefix($translations, $text, $domain) {
	if ( $text == 'Any %s' && $domain == 'woocommerce' ) {
		$translations = '%s';
	}

	return $translations;
}