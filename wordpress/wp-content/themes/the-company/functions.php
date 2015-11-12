<?php
define('CRB_THEME_DIR', dirname(__FILE__) . DIRECTORY_SEPARATOR);

# Load the debug functions early so they're available for all theme code
include_once(CRB_THEME_DIR . 'lib/debug.php');

# Enqueue JS and CSS assets on the front-end
add_action('wp_enqueue_scripts', 'crb_wp_enqueue_scripts');
function crb_wp_enqueue_scripts() {
	$template_dir = get_template_directory_uri();

	# Enqueue jQuery
	wp_enqueue_script('jquery');

	# Enqueue Custom JS files
	# @crb_enqueue_script attributes -- id, location, dependencies, in_footer = false
	crb_enqueue_script( 'bxslider',        $template_dir . '/js/jquery.bxslider.min.js', array( 'jquery' ) );
	crb_enqueue_script( 'theme-cookie',    $template_dir . '/js/js.cookie.js',           array( 'jquery' ) );
	crb_enqueue_script( 'theme-functions', $template_dir . '/js/functions.js',           array( 'jquery' ) );

	wp_localize_script( 'theme-functions', 'ajax_url', admin_url( 'admin-ajax.php' ) );

	# Enqueue Custom CSS files
	# @crb_enqueue_style attributes -- id, location, dependencies, media = all
	crb_enqueue_style('google-lato', 'https://fonts.googleapis.com/css?family=Lato:400,900,700,300' );
	crb_enqueue_style('theme-styles', $template_dir . '/style.css');

	# Enqueue Comments JS file
	if (is_singular()) {
		wp_enqueue_script('comment-reply');
	}
}

# Enqueue JS and CSS assets on admin pages
add_action('admin_enqueue_scripts', 'crb_admin_enqueue_scripts');
function crb_admin_enqueue_scripts() {
	$template_dir = get_template_directory_uri();

	# Enqueue Scripts
	# @crb_enqueue_script attributes -- id, location, dependencies, in_footer = false
	# crb_enqueue_script('theme-admin-functions', $template_dir . '/js/admin-functions.js', array('jquery'));
	
	# Enqueue Styles
	# @crb_enqueue_style attributes -- id, location, dependencies, media = all
	# crb_enqueue_style('theme-admin-styles', $template_dir . '/css/admin-style.css');
}

# Attach Custom Post Types and Custom Taxonomies
add_action('init', 'crb_attach_post_types_and_taxonomies', 0);
function crb_attach_post_types_and_taxonomies() {
	# Attach Custom Post Types
	include_once(CRB_THEME_DIR . 'options/post-types.php');

	# Attach Custom Taxonomies
	include_once(CRB_THEME_DIR . 'options/taxonomies.php');
}

add_action('after_setup_theme', 'crb_setup_theme');

# To override theme setup process in a child theme, add your own crb_setup_theme() to your child theme's
# functions.php file.
if (!function_exists('crb_setup_theme')) {
	function crb_setup_theme() {
		# Make this theme available for translation.
		load_theme_textdomain( 'crb', get_template_directory() . '/languages' );

		# Common libraries
		include_once(CRB_THEME_DIR . 'lib/common.php');
		include_once(CRB_THEME_DIR . 'lib/carbon-fields/carbon-fields.php');
		include_once(CRB_THEME_DIR . 'lib/carbon-validator/carbon-validator.php');
		include_once(CRB_THEME_DIR . 'lib/admin-column-manager/carbon-admin-columns-manager.php');
		include_once(CRB_THEME_DIR . 'lib/carbon-pagination/carbon-pagination.php');

		# Additional libraries and includes
		include_once(CRB_THEME_DIR . 'includes/comments.php');
		include_once(CRB_THEME_DIR . 'includes/title.php');
		include_once(CRB_THEME_DIR . 'includes/gravity-forms.php');
		include_once(CRB_THEME_DIR . 'includes/wpthumb/wpthumb.php');
		include_once(CRB_THEME_DIR . 'includes/carbon-breadcrumbs/carbon-breadcrumbs.php');
		include_once(CRB_THEME_DIR . 'includes/actions.php');
		include_once(CRB_THEME_DIR . 'includes/filters.php');
		include_once(CRB_THEME_DIR . 'includes/helpers.php');
		
		# Theme supports
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'html5', array( 'gallery' ) );
		add_theme_support( 'menus' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'woocommerce' );

		# Register Theme Menu Locations		
		register_nav_menus( array(
			'top-menu'    => __( 'Top Menu', 'crb' ),
			'main-menu'   => __( 'Main Menu', 'crb' ),
			'footer-menu' => __( 'Footer Menu', 'crb' ),
		) );		
		
		# Attach custom columns
		include_once(CRB_THEME_DIR . 'options/admin-columns.php');

		# Attach custom shortcodes
		include_once(CRB_THEME_DIR . 'options/shortcodes.php');

		# Attach custom widgets
		include_once(CRB_THEME_DIR . 'options/widgets.php');

		# Attach custom walkers
		include_once(CRB_THEME_DIR . 'options/walkers.php');
		
		# Add Actions
		add_action('carbon_after_register_fields',          'crb_attach_theme_help');
		add_action('carbon_register_fields',                'crb_attach_theme_options');
		add_action('widgets_init',                          'crb_widgets_init');
		add_action('wp_ajax_get_product_categories',        'crb_get_product_categories');
		add_action('wp_ajax_nopriv_get_product_categories', 'crb_get_product_categories');

		# Add Filters
		add_filter('body_class',     'crb_body_class');
		add_filter('excerpt_more',   'crb_excerpt_more');
		add_filter('excerpt_length', 'crb_excerpt_length', 999);

		# WooCommerce actions and filters
		if ( class_exists('WooCommerce') ) {
			include_once(CRB_THEME_DIR . 'includes/woocommerce-wrappers.php');
			include_once(CRB_THEME_DIR . 'includes/woocommerce-archive.php');
			include_once(CRB_THEME_DIR . 'includes/woocommerce-single.php');
			include_once(CRB_THEME_DIR . 'includes/woocommerce.php');
		}
	}
}

# Register Sidebars
# Note: In a child theme with custom crb_setup_theme() this function is not hooked to widgets_init
function crb_widgets_init() {
	$sidebar_options = array_merge(crb_get_default_sidebar_options(), array(
		'name' => 'Default Sidebar',
		'id'   => 'default-sidebar',
	));
	
	register_sidebar($sidebar_options);

	$sidebar_options = array_merge(crb_get_default_sidebar_options(), array(
		'name' => 'Shop Sidebar',
		'id'   => 'shop-sidebar',
	));
	
	register_sidebar($sidebar_options);

	$sidebar_options = array_merge(crb_get_default_sidebar_options(), array(
		'name' => 'Single Product Sidebar',
		'id'   => 'single-product-sidebar',
	));
	
	register_sidebar($sidebar_options);

	$sidebar_options = array_merge(crb_get_default_sidebar_options(), array(
		'name' => 'Widgetized Filter Bar',
		'id'   => 'widgetized-filter-bar',
	));
	
	register_sidebar($sidebar_options);
}

# Sidebar Options
function crb_get_default_sidebar_options() {
	return array(
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
	);
}

function crb_attach_theme_options() {
	# Attach fields
	include_once(CRB_THEME_DIR . 'options/theme-options.php');
	include_once(CRB_THEME_DIR . 'options/custom-fields.php');
	include_once(CRB_THEME_DIR . 'options/term-meta.php');
}

function crb_attach_theme_help() {
	# Theme Help needs to be after options/theme-options.php
	include_once(CRB_THEME_DIR . 'lib/theme-help/theme-readme.php');
}

function crb_excerpt_more() {
	return '...';
}

function crb_excerpt_length() {
	return 55;
}

// Custom Header Links
add_filter( 'wp_nav_menu_items', 'crb_custom_login_logout_links', 10, 2 );
function crb_custom_login_logout_links( $items, $args ) {
	if ( $args->theme_location != 'top-menu' ) {
		return $items;
	}

	if (is_user_logged_in() ) {
		$items .= '<li class="menu-item"><a href="'. get_permalink(get_option('woocommerce_myaccount_page_id')) .'">My Account</a></li>';
		$items .= '<li class="ico ico-arrowright menu-item"><a href="'. wc_get_endpoint_url('customer-logout', '', wc_get_page_permalink('myaccount')) .'">Log Out</a></li>';
	} else {
		$items .= '<li class="ico ico-arrowright menu-item"><a href="'. get_permalink(get_option('woocommerce_myaccount_page_id')) .'">Log In</a></li>';
	}

	return $items;
}

/**
 * Modify the "search-advanced" class, depending on location
 * Used by filter crb_search_advanced_class
 */
function crb_search_advanced_alt_class($class) {
	$class = 'search-advanced-secondary';

	return $class;
}

// Use WooCommerce shop page meta values on WooCommerce archive pages
add_filter('crb_get_page_context', 'crb_get_page_context_extend');
function crb_get_page_context_extend($page_id) {
	if ( is_shop() || is_product_category() || is_product_tag() ) {
		$page_id = woocommerce_get_page_id('shop');
	} elseif ( is_singular('product') ) {
		$page_id = get_the_id();
	}

	return $page_id;
}

/**
 * Trace term meta from the current term, to the top level parent
 */
function crb_get_term_meta_hierarchically($args) {
	$args = wp_parse_args($args, array(
		'term_id' => 0,
		'field_name' => '',
		'taxonomy' => 'category',
		'complex' => null,
	));

	if ( empty($args['term_id']) || empty($args['field_name']) ) {
		return false;
	}

	$meta = carbon_get_term_meta($args['term_id'], $args['field_name'], $args['complex']);
	if ( !empty($meta) ) {
		return $meta;
	}
	
	$term = get_term($args['term_id'], $args['taxonomy']);
	$parent = $term->parent;
	if ( $parent !== 0 ) {
		return crb_get_term_meta_hierarchically(array(
			'term_id' => $parent,
			'field_name' => $args['field_name'],
			'taxonomy' => $args['taxonomy'],
			'complex' => $args['complex'],
		));
	}

	return false;
}

// Trace Post Meta to all parents, until meta value is found or a page with no parent is reached.
function crb_get_meta_from_parent_page($args) {
	$args = wp_parse_args($args, array(
		'current_meta_content' => '',
		'page_ID' => 0,
		'meta_name' => '',
		'default' => '',
		'complex' => '',
	));

	if ( empty($args['page_ID']) || empty($args['meta_name']) ) {
		return $args['current_meta_content'];
	}

	$parent_page_id = get_post_field( 'post_parent', $args['page_ID'] );

	$is_empty = empty($args['current_meta_content']);
	$is_default = $args['default'] === $args['current_meta_content'];
	$has_parent = $parent_page_id !== 0;

	if ( ($is_default || $is_empty) && $has_parent ) {
		if ( $args['complex'] === 'complex' ) {
			$args['current_meta_content'] = carbon_get_post_meta($parent_page_id, $args['meta_name'], 'complex');
		} else {
			$args['current_meta_content'] = carbon_get_post_meta($parent_page_id, $args['meta_name']);
		}

		$args['page_ID'] = $parent_page_id;
		$args['current_meta_content'] = crb_get_meta_from_parent_page($args);
	}

	return $args['current_meta_content'];
}
