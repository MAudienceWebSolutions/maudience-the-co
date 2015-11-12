<?php

Carbon_Container::factory('theme_options', __('Theme Options', 'crb'))
	->add_fields(array(
		Carbon_Field::factory('header_scripts', 'crb_header_script', __('Header Script', 'crb')),
		Carbon_Field::factory('footer_scripts', 'crb_footer_script', __('Footer Script', 'crb')),
	));

Carbon_Container::factory('theme_options', __('Shop', 'crb'))
	->set_page_parent(__('Theme Options', 'crb'))
	->add_fields(array(
		Carbon_Field::factory('text', 'crb_shop_default_filter_title', __('Widgetized Filter Bar Title', 'crb'))
			->set_default_value('Filter by:'),
		Carbon_Field::factory('complex', 'crb_single_product_additional_information', __('Single Product Additional Information', 'crb'))
			->add_fields(array(
				Carbon_Field::factory('text', 'Title', __('Title', 'crb'))
					->set_required(true)
					->set_width(30),
				Carbon_Field::factory('rich_text', 'Content', __('Content', 'crb'))
					->set_required(true)
					->set_width(70),
			)),
	));

Carbon_Container::factory('theme_options', __('Social Icons', 'crb'))
	->set_page_parent(__('Theme Options', 'crb'))
	->add_fields(array(
		Carbon_Field::factory('complex', 'crb_social_icons', __('Social Icons', 'crb'))
			->add_fields(array(
				Carbon_Field::factory('attachment', 'crb_icon_image', __('Icon Image', 'crb'))
					->set_required(true)
					->help_text(__('Recommended image size: 100x100 pixels.'))
					->set_width(50),
				Carbon_Field::factory('text', 'crb_icon_link', __('Icon Link', 'crb'))
					->set_required(true)
					->set_width(50),
			))
			->setup_labels(array(
				'singular_name' => __('Icon', 'crb'),
				'plural_name'   => __('Icons', 'crb'),
			)),

		));

Carbon_Container::factory('theme_options', __('Contact Info', 'crb'))
	->set_page_parent(__('Theme Options', 'crb'))
	->add_fields(array(
		Carbon_Field::factory('text', 'crb_contact_title', __('Contact Info Title', 'crb')),
		Carbon_Field::factory('complex', 'crb_contact_info', __('Contact Info', 'crb'))
			->add_fields(array(
				Carbon_Field::factory('text', 'crb_contact_type', __('Contact Type', 'crb'))
					->set_required(true)
					->set_width(50),
				Carbon_Field::factory('text', 'crb_contact_value', __('Contact Value', 'crb'))
					->set_required(true)
					->set_width(50),
				Carbon_Field::factory('checkbox', 'crb_contact_link', __('Contact Link', 'crb'))
					->set_width(50),
				Carbon_Field::factory('select', 'crb_contact_link_type', __('Link Type', 'crb'))
					->add_options(array(
						'email' => __('E-mail', 'crb'),
						'phone' => __('Phone', 'crb'),
					))
					->set_width(50)
					->set_conditional_logic(array(
						array(
							'field'   => 'crb_contact_link',
							'value'   => 'yes',
							'compare' => '=',
						),
					)),
			))
			->setup_labels(array(
				'singular_name' => __('Contact', 'crb'),
				'plural_name'   => __('Contacts', 'crb'),
			)),
		));

Carbon_Container::factory('theme_options', __('Contact Hours', 'crb'))
	->set_page_parent(__('Theme Options', 'crb'))
	->add_fields(array(
		Carbon_Field::factory('text', 'crb_hours_title', __('Contact Hours Title', 'crb')),
		Carbon_Field::factory('complex', 'crb_working_hours', __('Working Hours', 'crb'))
			->add_fields(array(
				Carbon_Field::factory('text', 'crb_day_hours', __('Day Hours')),
			))
			->set_max(7)
			->setup_labels(array(
				'singular_name' => __('Day', 'crb'),
				'plural_name'   => __('Days', 'crb'),
			))
			->help_text(__('Each entry represents a day of the week (to a maximum of 7).', 'crb')),
		));

Carbon_Container::factory('theme_options', __('Copyright', 'crb'))
	->set_page_parent(__('Theme Options', 'crb'))
	->add_fields(array(
		Carbon_Field::factory('text', 'crb_copyright_text', __('Copyright Text', 'crb'))
			->help_text(__('Use [year] to display the current year.', 'crb')),
	));

if ( carbon_twitter_widget_registered() ) {
	Carbon_Container::factory('theme_options', 'Twitter Settings')
		->set_page_parent(__('Theme Options', 'crb'))
		->add_fields(array(
			Carbon_Field::factory('html', 'crb_twitter_settings_html')
				->set_html('
					<div style="position: relative; background: #fff; border: 1px solid #ccc; padding: 10px;">
						<h4><strong>' . __('Twitter API requires a Twitter application for communication with 3rd party sites. Here are the steps for creating and setting up a Twitter application:', 'crb') . '</strong></h4>
						<ol style="font-weight: normal;">
							<li>' . sprintf(__('Go to <a href="%1$s" target="_blank">%1$s</a> and log in, if necessary.', 'crb'), 'https://dev.twitter.com/apps/new') . '</li>
							<li>' . __('Supply the necessary required fields and accept the <strong>Terms of Service</strong>. <strong>Callback URL</strong> field may be left empty.', 'crb') . '</li>
							<li>' . __('Submit the form.', 'crb') . '</li>
							<li>' . __('On the next screen, click on the <strong>Keys and Access Tokens</strong> tab.', 'crb') . '</li>
							<li>' . __('Scroll down to <strong>Your access token</strong> section and click the <strong>Create my access token</strong> button.', 'crb') . '</li>
							<li>' . __('Copy the following fields: <strong>Consumer Key, Consumer Secret, Access Token, Access Token Secret</strong> to the below fields.', 'crb') . '</li>
						</ol>
					</div>
				'),
			Carbon_Field::factory('text', 'crb_twitter_consumer_key', __('Consumer Key', 'crb'))
				->set_default_value(''),
			Carbon_Field::factory('text', 'crb_twitter_consumer_secret', __('Consumer Secret', 'crb'))
				->set_default_value(''),
			Carbon_Field::factory('text', 'crb_twitter_oauth_access_token', __('Access Token', 'crb'))
				->set_default_value(''),
			Carbon_Field::factory('text', 'crb_twitter_oauth_access_token_secret', __('Access Token Secret', 'crb'))
				->set_default_value(''),
		));
}