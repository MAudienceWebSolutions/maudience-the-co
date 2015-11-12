<?php

Carbon_Container::factory('term_meta', 'Widgetized Filter Bar')
	->show_on_taxonomy('product_cat')
	->add_fields(array(
		Carbon_Field::factory('sidebar', 'crb_product_category_custom_sidebar', 'Widgetized Filter Bar')
			->set_default_value('Widgetized Filter Bar'),
	));