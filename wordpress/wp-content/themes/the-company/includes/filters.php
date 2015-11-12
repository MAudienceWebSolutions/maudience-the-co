<?php

function crb_body_class( $classes ) {
	if ( function_exists( 'is_woocommerce' ) && is_woocommerce() && ! is_single() ) {
		$classes[] = 'shop';
	}

	return $classes;
}