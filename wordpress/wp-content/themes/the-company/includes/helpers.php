<?php

function crb_menus_list() {
	$list  = array();
	$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

	foreach ( $menus as $menu ) {
		$list[$menu->term_id] = $menu->name;
	}

	return $list;
}

function crb_wpthumb( $id, $width = 0, $height = 0, $src = false, $retina = true, $crop = true, $classes = '', $echo = true ) {

	$modifier = $retina ? 2 : 1;

	$size = array( 
		'width'  => intval( $width ) * $modifier,
		'height' => intval( $height ) * $modifier,
		'crop'   => $crop, 
	);
	
	$attr = array(
		'class' => $classes,
	);

	if ( $src ) {
		$image_src = wp_get_attachment_image_src( $id, $size, false, $attr );
		return $image_src[0];
	}
	
	if ( ! $echo ) {
		return wp_get_attachment_image( $id, $size, false, $attr );
	}

	echo wp_get_attachment_image( $id, $size, false, $attr );
}