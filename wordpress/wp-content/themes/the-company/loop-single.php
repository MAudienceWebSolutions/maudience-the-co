<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		
		<article <?php post_class('article article-single') ?>>
			<header class="article-head">
				<h2 class="article-title">
					<?php the_title(); ?>
				</h2><!-- /.article-title -->

				<?php get_template_part('fragments/post-meta'); ?>
			</header><!-- /.article-head -->

			<div class="article-body">
				<div class="article-entry">
					<?php the_content(); ?>

					<?php carbon_pagination('custom'); ?>
				</div><!-- /.article-entry -->
			</div><!-- /.article-body -->
		</article><!-- /.article -->

		<?php carbon_pagination('post'); ?>

	<?php endwhile; ?>
<?php endif; ?>