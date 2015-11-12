<?php if (have_posts()) : ?>
	<ol class="articles">
		<?php while (have_posts()) : the_post(); ?>

			<li <?php post_class('article') ?>>
				<header class="article-head">
					<h2 class="article-title">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __('Permanent Link to %s', 'crb'), get_the_title() ) ); ?>">
							<?php the_title(); ?>
						</a>
					</h2><!-- /.article-title -->

					<?php get_template_part('fragments/post-meta'); ?>
				</header><!-- /.article-head -->

				<div class="article-body">
					<div class="article-entry">
						<?php
						if ( is_search() ) {
							the_excerpt();
						} else {
							the_content(__('Read the rest of this entry &raquo;', 'crb'));
						}
						?>
					</div><!-- /.article-entry -->
				</div><!-- /.article-body -->
			</li><!-- /.article -->

		<?php endwhile; ?>
	 </ol><!-- /.articles -->

	<?php carbon_pagination('posts'); ?>
	
<?php else : ?>
	<ol class="articles">
		<li class="article post error404 not-found">
			<div class="article-body">
				<div class="article-entry">
					<p>
						<?php
						if ( is_404() ) { // If this is a 404
							printf(__('Please check the URL for proper spelling and capitalization.<br />If you\'re having trouble locating a destination, try visiting the <a href="%1$s">home page</a>.', 'crb'), home_url('/'));
						} else if ( is_category() ) { // If this is a category archive
							printf( __("Sorry, but there aren't any posts in the %s category yet.", 'crb'), single_cat_title('',false) );
						} else if ( is_date() ) { // If this is a date archive
							_e("Sorry, but there aren't any posts with this date.", 'crb');
						} else if ( is_author() ) { // If this is a category archive
							$userdata = get_user_by('id', get_queried_object_id());
							printf( __("Sorry, but there aren't any posts by %s yet.", 'crb'), $userdata->display_name );
						} else if ( is_search() ) { // If this is a search
							_e('No posts found. Try a different search?', 'crb');
						} else {
							_e('No posts found.', 'crb');
						} ?>
					</p>
					
					<?php get_search_form(); ?>
				</div><!-- /.article-entry -->
			</div><!-- /.article-body -->
		</li><!-- /.article -->
	</ol><!-- /.articles -->
<?php endif; ?>