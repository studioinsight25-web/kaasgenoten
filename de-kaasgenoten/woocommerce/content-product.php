<?php
/**
 * Custom product card for loops.
 *
 * @package De_Kaasgenoten
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$product_id = $product->get_id();
$classes    = implode(
	' ',
	array_filter(
		array(
			'button',
			'dkg-add-to-cart',
			'add_to_cart_button',
			$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
			'product_type_' . $product->get_type(),
		)
	)
);
?>
<li <?php wc_product_class( 'dkg-shop-card', $product ); ?>>
	<a class="dkg-shop-card-image" href="<?php echo esc_url( get_permalink( $product_id ) ); ?>">
		<?php echo $product->get_image( 'woocommerce_thumbnail' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</a>
	<div class="dkg-shop-card-body">
		<h2><a href="<?php echo esc_url( get_permalink( $product_id ) ); ?>"><?php echo esc_html( $product->get_name() ); ?></a></h2>
		<?php if ( dkg_product_excerpt( $product ) ) : ?>
			<p><?php echo esc_html( dkg_product_excerpt( $product ) ); ?></p>
		<?php endif; ?>
		<div class="dkg-shop-card-meta">
			<?php if ( $product->get_average_rating() ) : ?>
				<?php echo wc_get_rating_html( $product->get_average_rating() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php else : ?>
				<span class="dkg-star-placeholder" aria-hidden="true">★★★★★</span>
			<?php endif; ?>
			<span class="dkg-shop-card-price"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
		</div>
		<a class="<?php echo esc_attr( $classes ); ?>" href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" data-quantity="1" data-product_id="<?php echo esc_attr( $product_id ); ?>" data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>" aria-label="<?php echo esc_attr( $product->add_to_cart_description() ); ?>" rel="nofollow">
			<?php echo esc_html( $product->add_to_cart_text() ); ?>
		</a>
	</div>
</li>
