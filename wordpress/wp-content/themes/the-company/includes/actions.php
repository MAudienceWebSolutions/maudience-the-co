<?php

function crb_get_product_categories() {
	$list   = [];
	$parent = $_GET['parent'];

	$categories = get_terms( 'product_cat', array(
		'hide_empty' => false,
		'parent'     => $parent,
	) );	

	foreach ( $categories as $category ) {
		$list[$category->term_id] = array(
			'name' => $category->name,
			'url'  => get_term_link($category),
		);
	}

	echo json_encode( (array) $list );
	exit;
}