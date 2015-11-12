<?php

$contact_info = carbon_get_theme_option( 'crb_contact_info', 'complex' );
$contact_title = carbon_get_theme_option( 'crb_contact_title' );

if ( ! $contact_info ) {
	return;
}

?>
<li class="widget widget-address">
	<?php if ( $contact_title ): ?>
		<h4><?php echo $contact_title; ?></h4>
	<?php endif; ?>

	<ul>
		<?php
			foreach ( $contact_info as $contact ):
				$type      = $contact['crb_contact_type'];
				$value     = $contact['crb_contact_value'];
				$link      = $contact['crb_contact_link'];
				$link_type = $contact['crb_contact_link_type'];

				if ( ! $type || ! $value ) {
					continue;
				}

				$template = '{{value}}';

				if ( $link === 'yes' && $link_type ) {
					$prefix   = ( $link_type === 'email' ) ? 'mailto:' : 'tel:';
					$href     = ( $link_type === 'email' ) ? $value : preg_replace( '~[^\d]~', '', $value );
					$template = '<a href="' . $prefix . $href . '">{{value}}</a>';
				} ?>
				<li><span><?php echo $type; ?></span> <?php echo str_replace( '{{value}}', $value, $template ); ?></li>
			<?php endforeach;
		?>
	</ul>
</li><!-- /.widget widget-address -->