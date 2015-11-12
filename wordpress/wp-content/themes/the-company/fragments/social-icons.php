<?php

$social_icons = carbon_get_theme_option( 'crb_social_icons', 'complex' );

if ( ! $social_icons ) {
	return;
}

?>
<li class="widget widget-socials">
	<ul>
		<?php
			foreach ( $social_icons as $icon ):
				$image = $icon['crb_icon_image'];
				$link  = $icon['crb_icon_link'];

				if ( ! $image || ! $link ) {
					continue;
				} ?>
				<li>
					<a href="<?php echo $link; ?>" target="_blank">
						<?php crb_wpthumb( $image, 50, 50 ); ?>
					</a>
				</li>
			<?php endforeach;
		?>
	</ul>
</li><!-- /.widget widget-socials -->