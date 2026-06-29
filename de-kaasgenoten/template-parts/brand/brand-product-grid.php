<?php
/**
 * Merkpagina – productgrid zonder soortfilter.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$brand = isset( $args['brand'] ) ? $args['brand'] : array();
$term  = isset( $args['term'] ) && $args['term'] instanceof WP_Term ? $args['term'] : null;

if ( ! $term ) {
	return;
}

$section_title = ! empty( $brand['products_heading'] )
	? $brand['products_heading']
	/* translators: %s: merknaam */
	: sprintf( __( '%s assortiment', 'de-kaasgenoten' ), $term->name );
?>
<section class="dkg-brand-products">
	<div class="dkg-container">
		<div class="dkg-brand-products__heading">
			<h2><?php echo esc_html( $section_title ); ?></h2>
		</div>

		<?php woocommerce_output_all_notices(); ?>

		<?php $products = dkg_brand_products( $term ); ?>

		<?php if ( ! empty( $products ) ) : ?>
			<div class="dkg-product-grid">
				<?php foreach ( $products as $product ) : ?>
					<?php dkg_product_card_from_product( $product ); ?>
				<?php endforeach; ?>
			</div>
		<?php else : ?>
			<p class="dkg-brand-empty"><?php esc_html_e( 'Er staan nog geen producten in dit assortiment. Koppel producten aan deze merkcategorie in WooCommerce.', 'de-kaasgenoten' ); ?></p>
		<?php endif; ?>
	</div>
</section>
