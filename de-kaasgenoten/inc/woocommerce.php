<?php
/**
 * WooCommerce helpers.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function dkg_cart_count() {
	if ( ! class_exists( 'WooCommerce' ) || ! WC()->cart ) {
		return 0;
	}

	return (int) WC()->cart->get_cart_contents_count();
}

function dkg_cart_count_fragment( $fragments ) {
	ob_start();
	?>
	<span class="dkg-cart-count"><?php echo esc_html( dkg_cart_count() ); ?></span>
	<?php
	$fragments['span.dkg-cart-count'] = ob_get_clean();
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'dkg_cart_count_fragment' );

function dkg_fallback_products() {
	return array(
		array( 'name' => 'Oude Hollandse Kaas', 'weight' => '500 gram', 'price' => '€ 8,95', 'image' => 'product-oude.jpg' ),
		array( 'name' => 'Extra Belegen Kaas', 'weight' => '500 gram', 'price' => '€ 7,95', 'image' => 'product-extra.jpg' ),
		array( 'name' => 'Jonge Belegen Kaas', 'weight' => '500 gram', 'price' => '€ 6,95', 'image' => 'product-jonge.jpg' ),
		array( 'name' => 'Boerenkaas Overjarig', 'weight' => '500 gram', 'price' => '€ 9,95', 'image' => 'product-boeren.jpg' ),
		array( 'name' => 'Truffelkaas', 'weight' => '500 gram', 'price' => '€ 10,95', 'image' => 'product-truffel.jpg' ),
		array( 'name' => 'Geitenkaas Naturel', 'weight' => '500 gram', 'price' => '€ 7,95', 'image' => 'product-geiten.jpg' ),
	);
}

function dkg_product_card_from_product( $product ) {
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
	<article class="dkg-product-card">
		<a class="dkg-product-image" href="<?php echo esc_url( get_permalink( $product_id ) ); ?>">
			<?php echo $product->get_image( 'woocommerce_thumbnail' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</a>
		<div class="dkg-product-body">
			<h3><a href="<?php echo esc_url( get_permalink( $product_id ) ); ?>"><?php echo esc_html( $product->get_name() ); ?></a></h3>
			<?php if ( $product->get_weight() ) : ?>
				<p><?php echo esc_html( wc_format_weight( $product->get_weight() ) ); ?></p>
			<?php endif; ?>
			<div class="dkg-product-price"><?php echo wp_kses_post( $product->get_price_html() ); ?></div>
			<div class="dkg-product-actions">
				<a class="<?php echo esc_attr( $classes ); ?>" href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" data-quantity="1" data-product_id="<?php echo esc_attr( $product_id ); ?>" data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>" aria-label="<?php echo esc_attr( $product->add_to_cart_description() ); ?>" rel="nofollow">
					<?php esc_html_e( 'In winkelwagen', 'de-kaasgenoten' ); ?>
				</a>
				<span class="dkg-wishlist" aria-hidden="true"><?php echo dkg_icon( 'heart' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
			</div>
		</div>
	</article>
	<?php
}

function dkg_product_card_from_fallback( $product ) {
	?>
	<article class="dkg-product-card">
		<a class="dkg-product-image" href="<?php echo esc_url( dkg_shop_url() ); ?>">
			<img src="<?php echo dkg_asset_uri( 'images/' . $product['image'] ); ?>" alt="<?php echo esc_attr( $product['name'] ); ?>">
		</a>
		<div class="dkg-product-body">
			<h3><a href="<?php echo esc_url( dkg_shop_url() ); ?>"><?php echo esc_html( $product['name'] ); ?></a></h3>
			<p><?php echo esc_html( $product['weight'] ); ?></p>
			<div class="dkg-product-price"><?php echo esc_html( $product['price'] ); ?></div>
			<div class="dkg-product-actions">
				<a class="button dkg-add-to-cart" href="<?php echo esc_url( dkg_shop_url() ); ?>"><?php esc_html_e( 'Bekijk product', 'de-kaasgenoten' ); ?></a>
				<span class="dkg-wishlist" aria-hidden="true"><?php echo dkg_icon( 'heart' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
			</div>
		</div>
	</article>
	<?php
}

function dkg_popular_products() {
	if ( class_exists( 'WooCommerce' ) ) {
		$products = wc_get_products(
			array(
				'status'  => 'publish',
				'limit'   => 6,
				'orderby' => 'popularity',
				'order'   => 'DESC',
			)
		);

		if ( ! empty( $products ) ) {
			foreach ( $products as $product ) {
				dkg_product_card_from_product( $product );
			}
			return;
		}
	}

	foreach ( dkg_fallback_products() as $product ) {
		dkg_product_card_from_fallback( $product );
	}
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
