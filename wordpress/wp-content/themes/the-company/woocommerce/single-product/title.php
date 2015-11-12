<?php
/**
 * Single Product title
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
$sku = $product->get_sku()

?>
<h1 itemprop="name" class="product_title entry-title">
	<?php the_title(); ?>

	<?php if ( !empty($sku) ): ?>
		<small>Item #: <?php echo $sku; ?></small>
	<?php endif; ?>
</h1>