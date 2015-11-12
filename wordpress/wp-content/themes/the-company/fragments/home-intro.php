<div class="intro">
	<div class="intro-images">
		<?php
		$intro_images = array(
			'left'  => array( 390, 514 ),
			'right' => array( 905, 514 ),
		);

		foreach ( $intro_images as $position => $sizes ):
			$image = carbon_get_post_meta( get_the_id(), "crb_intro_image_{$position}" );
			if ( ! $image ) {
				continue;
			}
			?>
			<div class="intro-<?php echo $position; ?>" style="background-image: url( <?php echo crb_wpthumb( $image, $sizes[0], $sizes[1], true ); ?>); "></div>
		<?php endforeach; ?>
	</div><!-- /.intro-images -->
	
	<div class="intro-content">
		<div class="shell clearfix">
			<div class="intro-left">
				<?php get_sidebar(); ?>
			</div><!-- /.intro-left -->
			
			<div class="intro-right">
				<?php
				$intro_text        = carbon_get_post_meta( get_the_id(), 'crb_intro_text' );
				$intro_button_text = carbon_get_post_meta( get_the_id(), 'crb_intro_button_text' );
				$intro_button_link = carbon_get_post_meta( get_the_id(), 'crb_intro_button_link' );
				if ( $intro_text ): ?>
					<div class="intro-entry">
						<?php echo apply_filters( 'the_content', $intro_text ); ?>

						<?php if ( $intro_button_text && $intro_button_link ): ?>
							<a href="<?php echo $intro_button_link; ?>" class="btn btn-white"><?php echo $intro_button_text; ?></a>
						<?php endif; ?>
					</div><!-- /.intro-entry -->
				<?php endif; ?>

				<?php get_template_part( 'fragments/advanced-search' ); ?>
			</div><!-- /.intro-right -->
		</div><!-- /.shell -->
	</div><!-- /.intro-content -->
</div><!-- /.intro -->