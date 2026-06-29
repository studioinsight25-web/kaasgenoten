<?php
/**
 * Single product content.
 *
 * @package De_Kaasgenoten
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product instanceof WC_Product ) {
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'dkg-single-product', $product ); ?>>
	<div class="dkg-single-product__grid">
		<div class="dkg-single-product__gallery">
			<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
		</div>
		<div class="dkg-single-product__summary" id="product-add-to-cart">
			<?php do_action( 'woocommerce_single_product_summary' ); ?>
			<div class="dkg-single-product__trust">
			<span><?php esc_html_e( 'Vers afgesneden op bestelling', 'de-kaasgenoten' ); ?></span>
				<span><?php esc_html_e( 'Zorgvuldig verpakt', 'de-kaasgenoten' ); ?></span>
				<span><?php esc_html_e( 'Zoals van onze marktkraam', 'de-kaasgenoten' ); ?></span>
			</div>
		</div>
	</div>
	<?php do_action( 'woocommerce_after_single_product_summary' ); ?>
</div>
