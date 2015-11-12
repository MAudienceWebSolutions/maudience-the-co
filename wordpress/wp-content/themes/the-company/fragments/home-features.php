<?php
$features_list = carbon_get_post_meta( get_the_id(), 'crb_features_list', 'complex' );

if ( ! $features_list ) {
	return;
}
?>
<section class="section-services">
	<div class="shell clearfix">
		<?php
			foreach ( $features_list as $feature ):
				$image       = $feature['crb_feature_image'];
				$title       = $feature['crb_feature_title'];
				$description = $feature['crb_feature_description'];
				$button_text = $feature['crb_feature_button_text'];
				$button_url  = $feature['crb_feature_button_url']; ?>
				<div class="service">
					<?php
						crb_wpthumb( $image, 309, 118 );

						if ( $title ): ?>					
							<h3><?php echo $title; ?></h3>
						<?php endif;

						if ( $description ) {
							echo wpautop( $description );
						}

						if ( $button_url && $button_text ): ?>					
							<a href="<?php echo $button_url; ?>" class="btn btn-red"><?php echo $button_text; ?></a>
						<?php endif;
					?>
				</div><!-- /.service -->
			<?php endforeach;
		?>
	</div><!-- /.shell -->
</section><!-- /.section-services -->