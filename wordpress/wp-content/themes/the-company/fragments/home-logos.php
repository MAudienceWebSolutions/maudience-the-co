<?php
$logos_title = carbon_get_post_meta( get_the_id(), 'crb_logos_title' );
$logos       = carbon_get_post_meta( get_the_id(), 'crb_logos', 'complex' );

if ( ! $logos ) {
	return;
}
?>
<div class="slider-logos">
	<div class="shell">
		<?php if ( $logos_title ): ?>
			<h2><?php echo $logos_title; ?></h2>
		<?php endif; ?>
	
		<div class="slider-clip">
			<ul class="slides">
				<?php
					foreach ( $logos as $logo ):
						$image = $logo['crb_logo_image'];
						$link  = $logo['crb_logo_link'];

						if ( ! $image ) {
							continue;
						}

						$template = '{{value}}';

						if ( $link ) {
							$template = '<a href="' . $link . '" target="_blank">{{value}}</a>';
						}

						ob_start();
						crb_wpthumb( $image, 142, 79, false, false );
						$image_html = ob_get_clean(); ?>

						<li class="slide">
							<?php echo str_replace( '{{value}}', $image_html, $template ); ?>
						</li><!-- /.slide -->

					<?php endforeach;
				?>
			</ul><!-- /.slides -->
		</div><!-- /.slider-clip -->
	</div><!-- /.shell -->
</div><!-- /.slider-logos -->