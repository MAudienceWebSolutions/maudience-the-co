<?php

if ( is_singular() ) {
	return;
}

$sidebar = '';
if ( is_product_category() ) {
	$term_id = get_queried_object()->term_id;

	// WooCommerce Category Archive Custom Sidebar
	$sidebar = crb_get_term_meta_hierarchically(array(
		'term_id' => $term_id,
		'field_name' => 'crb_product_category_custom_sidebar',
		'taxonomy' => 'product_cat',
	));
}

# If sidebar is not set or the $term_id is not present, assign 'default-sidebar'
if ( empty( $sidebar ) ) {
	$sidebar = 'widgetized-filter-bar';
}

?>

<div class="shop-filter">
	<ul class="filter-widgets">
		<?php
		$crb_shop_default_filter_title = carbon_get_theme_option('crb_shop_default_filter_title');
		if ( !empty($crb_shop_default_filter_title) ): ?>
			<div class="shop-filter-title">
				<?php echo apply_filters('the_title', $crb_shop_default_filter_title); ?>
			</div><!-- /.shop-filter-title -->
		<?php endif;  ?>

		<?php dynamic_sidebar( $sidebar ); ?>
	</ul><!-- /.filter-widgets -->
</div><!-- /.shop-filter -->