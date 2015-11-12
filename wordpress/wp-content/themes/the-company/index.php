<?php get_header(); ?>

<section class="section-inner">
	<header class="section-head">
		<div class="shell">
			<?php crb_the_title('<h2 class="pagetitle">', '</h2>'); ?>
		</div><!-- /.shell -->
	</header><!-- /.section-head -->

	<div class="section-body">
		<div class="shell">
			<div class="section-content">
				<?php
				if ( is_single() ) {
					get_template_part( 'loop', 'single' );
				} else {
					get_template_part( 'loop' ); 
				}
				?>
			</div><!-- /.section-content -->

			<aside class="section-aside">
				<?php get_sidebar(); ?>
			</aside><!-- /.section-aside -->
		</div><!-- /.shell -->
	</div><!-- /.section-body -->
</section><!-- /.section-inner -->

<?php get_footer(); ?>