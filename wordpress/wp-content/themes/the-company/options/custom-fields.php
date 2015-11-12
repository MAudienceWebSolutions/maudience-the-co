<?php

/* ==========================================================================
	# Home - Template
========================================================================== */
Carbon_Container::factory( 'custom_fields', __('Home Settings', 'crb') )
	->show_on_post_type( 'page' )
	->show_on_template( 'templates/homepage.php' )
	->add_tab( __('Intro', 'crb'), array(
		Carbon_Field::factory( 'attachment', 'crb_intro_image_left', __('Intro Image (Left)', 'crb') )
			->help_text( __('Recommended image size: 390x514 pixels.', 'crb') )
			->set_width( 50 ),
		Carbon_Field::factory( 'attachment', 'crb_intro_image_right', __('Intro Image (Right)', 'crb') )
			->help_text( __('Recommended image size: 905x514 pixels', 'crb') )
			->set_width( 50 ),
		Carbon_Field::factory( 'select', 'crb_intro_primary_menu', __('Primary Menu', 'crb') )
			->add_options( 'crb_menus_list' )
			->set_width( 50 ),
		Carbon_Field::factory( 'select', 'crb_intro_secondary_menu', __('Secondary Menu', 'crb') )
			->add_options( 'crb_menus_list' )
			->set_width( 50 ),
		Carbon_Field::factory( 'rich_text', 'crb_intro_text', __('Intro Text', 'crb') ),
		Carbon_Field::factory( 'text', 'crb_intro_button_text', __('Intro Button Text', 'crb') )
			->set_width( 50 ),
		Carbon_Field::factory( 'text', 'crb_intro_button_link', __('Intro Button Link', 'crb') )
			->set_width( 50 ),
	))

	->add_tab( __('Services', 'crb'), array(
		Carbon_Field::factory( 'attachment', 'crb_services_image', __('Services Image', 'crb') )
			->help_text( __('Recommened image size: 390x514 pixels.', 'crb') ),
		Carbon_Field::factory( 'rich_text', 'crb_services_text', __('Services Text', 'crb') ),
		Carbon_Field::factory( 'text', 'crb_services_button_text', __('Services Button Text', 'crb') ),
		Carbon_Field::factory( 'text', 'crb_services_button_link', __('Services Button Link', 'crb') ),
		Carbon_Field::factory( 'complex', 'crb_services_images', __('Services Images', 'crb') )
			->add_fields( array(
				Carbon_Field::factory( 'attachment', 'crb_service_image', __('Service Image', 'crb') )
					->set_required(true)
					->help_text( __('Recommended image size: 420x270 pixels.', 'crb') ),
			))
			->set_max(4)
			->setup_labels(array(
				'singular_name' => __('Image', 'crb'),
				'plural_name'   => __('Images', 'crb'),
			)),
	))

	->add_tab( __('Features', 'crb'), array(
		Carbon_Field::factory( 'complex', 'crb_features_list', __('Features List', 'crb') )
			->add_fields( array(
				Carbon_Field::factory( 'attachment', 'crb_feature_image', __('Feature Image', 'crb') )
					->help_text( __('Recommended image size: 309x118 pixels.', 'crb') ),
				Carbon_Field::factory( 'text', 'crb_feature_title', __('Feature Title', 'crb') ),
				Carbon_Field::factory( 'textarea', 'crb_feature_description', __('Featured Description', 'crb') )
					->set_height( 50 ),
				Carbon_Field::factory( 'text', 'crb_feature_button_text', __('Feature Button Text', 'crb') ),
				Carbon_Field::factory( 'text', 'crb_feature_button_url', __('Feature Button URL', 'crb') ),
			))
			->set_max(3)
			->setup_labels(array(
				'singular_name' => __('Feature', 'crb'),
				'plural_name'   => __('Features', 'crb'),
			)),
	))

	->add_tab( __('Logos', 'crb'), array(
		Carbon_Field::factory( 'text', 'crb_logos_title', __('Logos Title', 'crb') ),
		Carbon_Field::factory( 'complex', 'crb_logos', __('Logos', 'crb') )
			->add_fields( array(
				Carbon_Field::factory( 'attachment', 'crb_logo_image', __('Logo Image', 'crb') )
					->set_required(true),
				Carbon_Field::factory( 'text', 'crb_logo_link', __('Logo Link', 'crb') ),
			))
			->setup_labels(array(
				'singular_name' => __('Logo', 'crb'),
				'plural_name'   => __('Logos', 'crb'),
			)),
	));

/* ==========================================================================
	# Page
========================================================================== */
Carbon_Container::factory('custom_fields', __('Sidebar Settings', 'crb'))
	->show_on_post_type('page')
	->add_fields(array(
		Carbon_Field::factory('sidebar', 'crb_custom_sidebar', 'Sidebar')
			->help_text('Select which sidebar to show in this page, or click "Add New" to create a new one'),
	));