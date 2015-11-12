<?php

/* ==========================================================================
	# Page - Post type
========================================================================== */
Carbon_Admin_Columns_Manager::modify_columns('post', array('page') )
	->add( array(
		Carbon_Admin_Column::create('Sidebar')
			->set_name( 'crb-sidebar-column' )
			->set_field('_crb_custom_sidebar'),
));

/* ==========================================================================
	# Product Category - Taxonomy
========================================================================== */
Carbon_Admin_Columns_Manager::modify_columns('taxonomy', array('product_cat') )
	->remove(array('description'))
	->sort(array('cb', 'thumb', 'name',  'slug', 'crb-product_cat-sidebar') )
	->add(array(
			Carbon_Admin_Column::create('Sidebar')
				->set_name('crb-product_cat-sidebar')
				->set_field('crb_product_category_custom_sidebar'),
		));