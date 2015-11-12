<?php

/* ==========================================================================
	# Hooks in this file:
		* woocommerce_single_product_summary
		* woocommerce_after_single_product_summary
		* gettext
		* woocommerce_get_price_html
========================================================================== */

/**
 | woocommerce_single_product_summary hook
 |
 | woocommerce_template_single_title - 5
 | woocommerce_template_single_rating - 10
 | woocommerce_template_single_price - 10
 | woocommerce_template_single_excerpt - 20
 | woocommerce_template_single_add_to_cart - 30
 | woocommerce_template_single_meta - 40
 | woocommerce_template_single_sharing - 50
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

/**
 | woocommerce_after_single_product_summary hook
 |
 | @hooked woocommerce_output_product_data_tabs - 10
 | @hooked woocommerce_upsell_display - 15
 | @hooked woocommerce_output_related_products - 20
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

add_action( 'woocommerce_after_single_product_summary', 'crb_woocommerce_after_single_product_summary', 10 );
function crb_woocommerce_after_single_product_summary() {
	?>

	<div class="clearfix"></div><!-- /.clearfix -->

		<div class="product-accordion">
			<div class="accordion-section accordion-expanded">
				<div class="accordion-head">
					<h3><?php _e('Item Details', 'crb'); ?></h3>
				</div><!-- /.accordion-head -->
				
				<div class="accordion-body">
					<?php the_content(); ?>
				</div><!-- /.accordion-body -->
			</div><!-- /.accordion-section -->
			
			<?php
			$crb_single_product_additional_information = carbon_get_theme_option('crb_single_product_additional_information', 'complex');
			if ( !empty($crb_single_product_additional_information) ): ?>
				<?php foreach ($crb_single_product_additional_information as $information): ?>
					
				<?php endforeach; ?>
				<div class="accordion-section">
					<div class="accordion-head">
						<h3><?php echo apply_filters('the_title', $information['title']); ?></h3>
					</div><!-- /.accordion-head -->
					
					<div class="accordion-body">
						<?php echo apply_filters('the_content', $information['content']); ?>
					</div><!-- /.accordion-body -->
				</div><!-- /.accordion-section -->
			<?php endif; ?>
		</div><!-- /.product-accordion -->					
	
	<?php
}

/**
 | Helpers
 */

/**
 | Add price prefix
 */
add_filter('woocommerce_get_price_html', 'crb_woocommerce_get_price_html');
function crb_woocommerce_get_price_html($title_html) {
	if ( is_singular('product') ) {
		$title_html = 'Price: ' . $title_html;
	}

	return $title_html;
}

/**
 | Override the "Related Products" title
 */
add_filter('gettext', 'crb_gettext_override_related_title', 10, 3);
function crb_gettext_override_related_title($translations, $text, $domain) {
	if ( $text == 'Related Products' && $domain == 'woocommerce' ) {
		$translations = get_translations_for_domain( $domain );
		$translations = $translations->translate( 'Items You May Also Like...' );
	}

	return $translations;
}