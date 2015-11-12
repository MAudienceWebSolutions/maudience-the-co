<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, maximum-scale=1">
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="wrapper">
		<header class="header">
			<div class="shell clearfix">
				<a href="<?php echo home_url( '/' ); ?>" class="logo"><?php bloginfo('name'); ?></a>

				<div class="header-inner">
					<?php
					wp_nav_menu(array(
						'theme_location'  => 'top-menu',
						'container'       => 'nav',
						'container_class' => 'nav-secondary',
						'fallback_cb'     => false,
						'depth'           => 1,
					));
					?>

					<a href="#" class="btn-menu"><span></span></a>

					<nav class="nav">
						<?php
						wp_nav_menu(array(
							'theme_location' => 'main-menu',
							'container'      => false,
							'menu_class'     => false,
							'fallback_cb'    => false,
							'depth'          => 1,
						));
						?>

						<?php get_search_form(); ?>
					</nav><!-- /.nav -->

					<?php if ( !is_page_template('templates/homepage.php') ): ?>
						<a href="#" class="link-advanced"><?php _e( 'Advanced Search', 'crb' ); ?></a>

						<div class="advanced-search-dropdown">
							<?php get_template_part( 'fragments/advanced-search' ); ?>
						</div>
					<?php endif; ?>
				</div><!-- /.header-inner -->
			</div><!-- /.shell -->
		</header><!-- /.header -->