<?php
$working_hours = carbon_get_theme_option( 'crb_working_hours', 'complex' );

if ( ! $working_hours ) {
	return;
}

$hours_title = carbon_get_theme_option( 'crb_hours_title' );
?>
<li class="widget widget-worktime">
	<?php if ( $hours_title ): ?>
		<h4><?php echo $hours_title; ?></h4>
	<?php endif;

	$day_letters = array(
		_x('M', 'Monday', 'crb'),
		_x('T', 'Tuesday', 'crb'),
		_x('W', 'Wednesday', 'crb'),
		_x('T', 'Thursday', 'crb'),
		_x('F', 'Friday', 'crb'),
		_x('S', 'Saturday', 'crb'),
		_x('S', 'Sunday', 'crb'),
	);
	?>
	<ul>
		<?php
			foreach ( $working_hours as $index => $working_hour ):
				$hours = $working_hour['crb_day_hours'];

				if ( ! $hours ) {
					continue;
				} ?>
				<li><span><?php echo $day_letters[$index]; ?></span> <?php echo $hours; ?></li>
			<?php endforeach;
		?>
	</ul>
</li><!-- /.widget widget-worktime -->