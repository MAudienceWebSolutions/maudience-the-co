<?php
$image       = carbon_get_post_meta( get_the_id(), 'crb_services_image' );
$text        = carbon_get_post_meta( get_the_id(), 'crb_services_text' );
$button_text = carbon_get_post_meta( get_the_id(), 'crb_services_button_text' );
$button_link = carbon_get_post_meta( get_the_id(), 'crb_services_button_link' );
$images      = carbon_get_post_meta( get_the_id(), 'crb_services_images', 'complex' ); ?>
<section class="section-restoration">
	<?php if ( $image ): ?>
		<div class="section-image" style="background-image: url(<?php echo crb_wpthumb( $image, 390, 514, true ); ?>); "></div><!-- /.section-image -->
	<?php endif; ?>
	<div class="shell">
		<?php if ( $text ): ?>
			<div class="section-content">
				<?php
					echo wpautop( $text );

					if ( $button_text && $button_link ): ?>				
						<a href="<?php echo $button_link; ?>" class="btn btn-red"><?php echo $button_text; ?></a>
					<?php endif;
				?>
			</div><!-- /.section-content -->
		<?php endif;

		if ( $images ): ?>
			<div class="slider">
				<div class="slider-clip">
					<ul class="slides">
						<?php
							foreach ( $images as $image ):
								$image_id = $image['crb_service_image'];

								if ( ! $image_id ) {
									continue;
								} ?>
								<li class="slide">
									<?php crb_wpthumb( $image_id, 420, 270 ); ?>
								</li><!-- /.slide -->
							<?php endforeach;
						?>
					</ul><!-- /.slides -->
				</div><!-- /.slider-clip -->
			</div><!-- /.slider -->
		<?php endif; ?>
	</div><!-- /.shell -->
</section><!-- /.section-restoration -->