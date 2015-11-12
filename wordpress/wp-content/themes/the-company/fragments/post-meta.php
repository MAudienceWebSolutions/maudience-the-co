<?php
/**
 * Displays the post date/time, author, tags, categories and comments link.
 * 
 * Should be called only within The Loop.
 * 
 * It will be displayed only for post type "post".
 */

if (empty($post) || get_post_type() != 'post') {
	return;
}
?>

<div class="article-meta">
	<p><?php the_time('F jS, Y '); printf(__('by %s', 'crb'), get_the_author()); ?></p>

	<p>
		<?php _e('Posted in ', 'crb'); the_category(', '); ?>
	</p>

	<?php the_tags( '<p>' . __('Tags:', 'crb') . ' ', ', ', '</p>'); ?>
</div><!-- /.article-meta -->