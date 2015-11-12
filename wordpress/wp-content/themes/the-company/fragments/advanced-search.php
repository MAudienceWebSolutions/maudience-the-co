<?php

$categories = get_terms('product_cat', array(
	'hide_empty' => false,
	'parent'     => 0,
));

if ( ! $categories || ! class_exists( 'WooCommerce' ) ) {
	return;
}

$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>
<div class="search-advanced <?php echo apply_filters('crb_search_advanced_class', 'search-advanced-pimary'); ?>">
	<form action="<?php echo $shop_page_url; ?>" method="get">
		<label class="search-label"><?php _e( 'Advanced Search', 'crb' ); ?></label>

		<div class="search-controls">
			<select name="field-manufacturer" id="field-manufacturer" class="select">
				<option value="" selected="selected"><?php _e( 'Select a Manufacturer', 'crb' ); ?></option>
				<?php foreach ( $categories as $category ): ?>
					<option value="<?php echo $category->term_id; ?>" data-url="<?php echo get_term_link( $category ); ?>"><?php echo $category->name; ?></option>
				<?php endforeach; ?>
			</select>
		</div><!-- /.search-controls -->
		
		<div class="search-controls">
			<select name="field-category" id="field-category" class="select" disabled="disabled">
				<option value="" selected="selected"><?php _e( 'Category', 'crb' ); ?></option>
			</select>
		</div><!-- /.search-controls -->
		
		<div class="search-controls">
			<select name="field-subcategory" id="field-subcategory" class="select" disabled="disabled">
				<option value="" selected="selected"><?php _e( 'Subcategory', 'crb' ); ?></option>
			</select>
		</div><!-- /.search-controls -->

		<div class="search-controls">
			<select name="field-model" id="field-model" class="select" disabled="disabled">
				<option value="" selected="selected"><?php _e( 'Model', 'crb' ); ?></option>
			</select>
		</div><!-- /.search-controls -->
		
		<div class="search-foot">
			<div class="preloader"></div>

			<input type="submit" value="<?php _e( 'Search', 'crb' ); ?>" class="search-btn">
		</div><!-- /.search-foot -->
	</form>
</div><!-- /.search-advanced -->