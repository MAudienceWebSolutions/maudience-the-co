<div class="breadcrumbs">
	<div class="shell">
		<?php
		$home = false;
		if ( is_product_category() || is_product_tag() || is_single() ) {
			add_filter('woocommerce_breadcrumb_home_url', 'crb_woocommerce_breadcrumb_home_url');
			$home = __('Shop', 'crb');
		}

		woocommerce_breadcrumb(array(
			'delimiter' => ' <span>&gt;</span> ',
			'wrap_before' => '<p>',
			'wrap_after' => '</p>',
			'home' => $home,
		));
		?>
	</div><!-- /.shell -->
</div><!-- /.breadcrumbs -->