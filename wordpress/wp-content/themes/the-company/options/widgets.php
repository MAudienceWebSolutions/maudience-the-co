<?php
/**
 * Register the new widget classes here so that they show up in the widget list. 
 */
function crb_register_widgets() {
	register_widget('ThemeWidgetRichText');
	register_widget('CrbContactWidget');
	register_widget('CrbAdvanceSearchWidget');
	// register_widget('CrbLatestTweetsWidget');
	// register_widget('ThemeWidgetExample');
}
add_action('widgets_init', 'crb_register_widgets');

/**
 * Displays a block with a title and WYSIWYG rich text content
 */
class ThemeWidgetRichText extends Carbon_Widget {
	function __construct() {
		$this->setup(__('Rich Text', 'crb'), __('Displays a block with title and WYSIWYG content.', 'crb'), array(
			Carbon_Field::factory('text', 'title', __('Title', 'crb')),
			Carbon_Field::factory('rich_text', 'content', __('Content', 'crb')),
		));
	}
	
	function front_end($args, $instance) {
		if ($instance['title']) {
			$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

			echo $args['before_title'] . $title . $args['after_title'];
		}
		
		echo apply_filters('the_content', $instance['content']);
	}
}

/**
 * Displays a block with latest tweets from particular user
 */
class CrbLatestTweetsWidget extends Carbon_Widget {
	protected $form_options = array(
		'width' => 300
	);

	function __construct() {
		$this->setup(__('Latest Tweets', 'crb'), __('Displays a block with your latest tweets', 'crb'), array(
			Carbon_Field::factory('text', 'title', __('Title', 'crb')),
			Carbon_Field::factory('text', 'username', __('Username', 'crb')),
			Carbon_Field::factory('text', 'count', __('Number of Tweets to show', 'crb'))->set_default_value('5'),
		));
	}

	function front_end($args, $instance) {
		if ( !carbon_twitter_is_configured() ) {
			return; //twitter settings are not configured
		}

		$tweets = TwitterHelper::get_tweets($instance['username'], $instance['count']);
		if (empty($tweets)) {
			return; //no tweets, or error while retrieving
		}

		if ($instance['title']) {
			$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>
		<ul>
			<?php foreach ($tweets as $tweet): ?>
				<li><?php echo $tweet->tweet_text; ?> - <span><?php printf(__('%1$s ago', 'crb'), $tweet->time_distance); ?></span></li>
			<?php endforeach ?>
		</ul>
		<?php
	}
}

class CrbContactWidget extends Carbon_Widget {
	function __construct() {
		$this->setup( __( 'Theme Widget - Contact', 'crb' ), __( 'Displays a widget with contact information', 'crb' ), array(
			Carbon_Field::factory( 'text', 'crb_title', __( 'Title', 'crb' ) ),
			Carbon_Field::factory( 'complex', 'crb_contacts', __( 'Contacts', 'crb' ) )
				->add_fields( array(
					Carbon_Field::factory( 'text', 'crb_contact_type', __( 'Contact Type', 'crb' ) )
						->set_required( true ),
					Carbon_Field::factory( 'text', 'crb_contact_value', __( 'Contact Value', 'crb' ) )
						->set_required( true ),
				) ),
		), 'widget-address widget-address-alt' );
	}

	function front_end($args, $instance) {
		$title    = $instance['crb_title'];
		$contacts = $instance['crb_contacts'];

		if ( ! $contacts ) {
			return;
		}

		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		foreach ( $contacts as $contact ):
			$type  = strtoupper( $contact['crb_contact_type'] );
			$value = $contact['crb_contact_value'];

			if ( ! $type || ! $value ) {
				continue;
			} ?>

			<p><span><?php echo "{$type}:" ?></span> <?php echo $value; ?></p>

		<?php endforeach;
	}
}

/**
 * Advanced Search widget
 */
class CrbAdvanceSearchWidget extends Carbon_Widget {
	/**
	 * Register widget function.
	 */
	function __construct() {
		$this->setup(__('Theme Widget - Advanced Search', 'crb'), __('Displays a block with title/advanced search', 'crb'), array(
			Carbon_Field::factory('text', 'title', __('Title', 'crb')),
		));
	}
	
	/**
	 * Called when rendering the widget in the front-end
	 */
	function front_end($args, $instance) {
		if ($instance['title']) {
			$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

			echo $args['before_title'] . $title . $args['after_title'];
		}

		add_filter('crb_search_advanced_class', 'crb_search_advanced_alt_class');
		get_template_part('fragments/advanced-search');
		remove_filter('crb_search_advanced_class', 'crb_search_advanced_alt_class');
	}
}