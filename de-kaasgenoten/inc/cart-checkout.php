<?php
/**
 * Winkelwagen, checkout en mini-cart.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Checkout/cart-styles.
 */
function dkg_enqueue_checkout_assets() {
	if ( ! function_exists( 'is_cart' ) ) {
		return;
	}

	if ( is_cart() || is_checkout() || is_account_page() ) {
		wp_enqueue_style(
			'dkg-checkout',
			get_template_directory_uri() . '/assets/css/components/checkout.css',
			array( 'dkg-theme' ),
			DKG_VERSION
		);
	}
}
add_action( 'wp_enqueue_scripts', 'dkg_enqueue_checkout_assets', 25 );

/**
 * Mini-cart HTML ophalen.
 *
 * @return string
 */
function dkg_get_mini_cart_html() {
	if ( ! class_exists( 'WooCommerce' ) || ! WC()->cart ) {
		return '';
	}

	ob_start();
	?>
	<div class="dkg-mini-cart" id="dkg-mini-cart" hidden>
		<div class="dkg-mini-cart__backdrop" data-dkg-mini-cart-close></div>
		<div class="dkg-mini-cart__panel" role="dialog" aria-label="<?php esc_attr_e( 'Winkelwagen', 'de-kaasgenoten' ); ?>">
			<div class="dkg-mini-cart__header">
				<h2><?php esc_html_e( 'Winkelwagen', 'de-kaasgenoten' ); ?></h2>
				<button type="button" class="dkg-mini-cart__close" data-dkg-mini-cart-close aria-label="<?php esc_attr_e( 'Sluiten', 'de-kaasgenoten' ); ?>">×</button>
			</div>
			<div class="dkg-mini-cart__body">
				<?php if ( WC()->cart->is_empty() ) : ?>
					<p><?php esc_html_e( 'Je winkelwagen is nog leeg.', 'de-kaasgenoten' ); ?></p>
				<?php else : ?>
					<ul class="dkg-mini-cart__items">
						<?php foreach ( WC()->cart->get_cart() as $item ) : ?>
							<?php
							$product = $item['data'];

							if ( ! $product instanceof WC_Product ) {
								continue;
							}
							?>
							<li>
								<a href="<?php echo esc_url( $product->get_permalink() ); ?>"><?php echo esc_html( $product->get_name() ); ?></a>
								<span><?php echo esc_html( $item['quantity'] ); ?> × <?php echo wp_kses_post( WC()->cart->get_product_price( $product ) ); ?></span>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
			<?php if ( ! WC()->cart->is_empty() ) : ?>
				<div class="dkg-mini-cart__footer">
					<p class="dkg-mini-cart__subtotal">
						<span><?php esc_html_e( 'Subtotaal', 'de-kaasgenoten' ); ?></span>
						<strong><?php echo wp_kses_post( WC()->cart->get_cart_subtotal() ); ?></strong>
					</p>
					<a class="dkg-button dkg-button-gold dkg-mini-cart__checkout" href="<?php echo esc_url( wc_get_checkout_url() ); ?>"><?php esc_html_e( 'Afrekenen', 'de-kaasgenoten' ); ?></a>
					<a class="dkg-mini-cart__view-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>"><?php esc_html_e( 'Bekijk winkelwagen', 'de-kaasgenoten' ); ?></a>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<?php
	return ob_get_clean();
}

/**
 * Cart fragments uitbreiden.
 *
 * @param array<string, string> $fragments Fragments.
 * @return array<string, string>
 */
function dkg_cart_fragments( $fragments ) {
	$fragments['#dkg-mini-cart'] = dkg_get_mini_cart_html();

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'dkg_cart_fragments' );

/**
 * Mini-cart in footer outputten.
 */
function dkg_output_mini_cart() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	echo dkg_get_mini_cart_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
add_action( 'wp_footer', 'dkg_output_mini_cart', 5 );

/**
 * Vertrouwenssignalen boven checkout.
 */
function dkg_checkout_trust_bar() {
	if ( ! is_checkout() || is_wc_endpoint_url( 'order-received' ) ) {
		return;
	}
	?>
	<div class="dkg-checkout-trust">
		<span><?php esc_html_e( 'Zorgvuldig verpakt', 'de-kaasgenoten' ); ?></span>
		<span><?php esc_html_e( 'Zo snel mogelijk verzonden', 'de-kaasgenoten' ); ?></span>
		<span><?php esc_html_e( 'Veilig betalen met iDEAL', 'de-kaasgenoten' ); ?></span>
	</div>
	<?php
}
add_action( 'woocommerce_before_checkout_form', 'dkg_checkout_trust_bar', 5 );
