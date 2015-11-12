<div class="shop-showing">
	<form id="products_per_page" action="" method="post">
		<?php
		$paged    = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		$count    = wp_count_posts( 'product' );
		$total    = $count->publish;
		$per_page = ( $total > get_query_var( 'posts_per_page' ) ) ? get_query_var( 'posts_per_page' ) : $total;
		$min      = ( ( $paged * $per_page ) - $per_page + 1 );
		$max      = ( $paged * $per_page < $total ) ? $paged * $per_page : $total;
		?>
		<label for="field-display" class="form-label"><?php printf( __( 'Showing %d - %d of %d', 'crb' ), $min, $max, $total ); ?></label>
		
		<div class="form-controls">
			<select name="products_per_page" id="field-display" class="select">
				<?php
				$per_page_options = array(12, 24);
				$products_per_page = crb_wc_get_products_per_page();
				foreach ( $per_page_options as $option ):
					$selected = ($products_per_page == $option ) ? 'selected="selected"' : '';
					?>
					<option <?php echo $selected; ?> value="<?php echo $option; ?>" select="selected"><?php printf( __( 'Display %d', 'crb' ), $option ); ?></option>
				<?php endforeach; ?>
			</select>
		</div><!-- /.form-controls -->
	</form>
</div><!-- /.shop-showing -->