<?php get_header(); ?>

<section class="section-inner">
	<header class="section-head">
		<div class="shell">
			<?php the_title( '<h2>', '</h2>' ); ?>
		</div><!-- /.shell -->
	</header><!-- /.section-head -->

	<div class="section-body">
		<div class="shell">
			<?php if ( have_posts() ): ?>
				<?php while ( have_posts() ): the_post(); ?>
					<div class="section-content">
						<?php the_content(); ?>
					</div><!-- /.section-content -->
				<?php endwhile; ?>
			<?php endif; ?>

			<aside class="section-aside">
				<?php get_sidebar(); ?>
			</aside><!-- /.section-aside -->
		</div><!-- /.shell -->
	</div><!-- /.section-body -->
</section><!-- /.section-inner -->

<?php get_footer(); ?>