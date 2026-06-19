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

if ( class_exists( 'WooCommerce' ) ) {
	add_filter( 'woocommerce_add_to_cart_fragments', 'dkg_cart_count_fragment' );
}

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
			<img src="<?php echo dkg_asset_uri( 'images/' . $product['image'] ); ?>" alt="<?php echo esc_attr( $product['name'] ); ?>" loading="lazy" decoding="async">
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

/**
 * Haal producten op uit een specifieke productcategorie.
 *
 * Geeft een lege array terug wanneer WooCommerce inactief is of de
 * categorie (nog) geen producten bevat, zodat de aanroepende template
 * de sectie netjes kan verbergen.
 *
 * @param string $slug  Slug van de productcategorie.
 * @param int    $limit Maximaal aantal producten.
 * @return array<int, WC_Product>
 */
function dkg_category_products( $slug, $limit = 4 ) {
	if ( ! class_exists( 'WooCommerce' ) || ! $slug || ! taxonomy_exists( 'product_cat' ) ) {
		return array();
	}

	if ( ! get_term_by( 'slug', $slug, 'product_cat' ) ) {
		return array();
	}

	$products = wc_get_products(
		array(
			'status'   => 'publish',
			'limit'    => max( 1, (int) $limit ),
			'category' => array( $slug ),
			'orderby'  => 'popularity',
			'order'    => 'DESC',
		)
	);

	return is_array( $products ) ? $products : array();
}

/**
 * Bouw collectie-kaarten uit de echte subcategorieën van een term.
 *
 * Hiermee koppelt de landingspagina zich automatisch aan de WooCommerce
 * categoriestructuur: subcategorieën worden als nette kaarten getoond,
 * met hun eigen afbeelding (indien ingesteld) of een passend themabeeld.
 *
 * @param int $parent_id Term-ID van de hoofdcategorie.
 * @param int $limit     Maximaal aantal kaarten.
 * @return array<int, array<string, string>>
 */
function dkg_category_collection_cards( $parent_id, $limit = 8 ) {
	if ( ! class_exists( 'WooCommerce' ) || ! taxonomy_exists( 'product_cat' ) || ! $parent_id ) {
		return array();
	}

	$terms = get_terms(
		array(
			'taxonomy'   => 'product_cat',
			'parent'     => (int) $parent_id,
			'hide_empty' => false,
			'number'     => max( 1, (int) $limit ),
			'orderby'    => 'name',
		)
	);

	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		return array();
	}

	$fallbacks = array( 'product-boeren.jpg', 'product-jonge.jpg', 'product-geiten.jpg', 'product-oude.jpg', 'product-truffel.jpg', 'product-extra.jpg' );
	$cards     = array();
	$i         = 0;

	foreach ( $terms as $term ) {
		$image_url = '';
		$thumb_id  = get_term_meta( $term->term_id, 'thumbnail_id', true );

		if ( $thumb_id ) {
			$image_url = wp_get_attachment_image_url( $thumb_id, 'medium_large' );
		}

		$text = $term->description ? wp_trim_words( wp_strip_all_tags( $term->description ), 14 ) : '';

		if ( ! $text ) {
			$text = $term->count > 0
				/* translators: %d aantal producten. */
				? sprintf( _n( '%d product', '%d producten', $term->count, 'de-kaasgenoten' ), $term->count )
				: __( 'Bekijk deze collectie', 'de-kaasgenoten' );
		}

		$link = get_term_link( $term );

		$cards[] = array(
			'title'     => $term->name,
			'text'      => $text,
			'image_url' => $image_url ? $image_url : '',
			'image'     => $fallbacks[ $i % count( $fallbacks ) ],
			'url'       => is_wp_error( $link ) ? dkg_shop_url() : $link,
		);

		$i++;
	}

	return $cards;
}

function dkg_product_archive_filter_terms() {
	if ( ! is_product_category() ) {
		return array();
	}

	$term = get_queried_object();

	if ( ! $term instanceof WP_Term ) {
		return array();
	}

	$terms = get_terms(
		array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => true,
			'parent'     => $term->term_id,
		)
	);

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		return $terms;
	}

	if ( 'kaas' !== $term->slug ) {
		return array();
	}

	$age_slugs = array( 'jong', 'jong-belegen', 'belegen', 'extra-belegen', 'oud' );
	$terms     = array();

	foreach ( $age_slugs as $slug ) {
		$age_term = get_term_by( 'slug', $slug, 'product_cat' );

		if ( $age_term instanceof WP_Term ) {
			$terms[] = $age_term;
		}
	}

	return $terms;
}

function dkg_product_excerpt( $product ) {
	$text = $product->get_short_description();

	if ( ! $text ) {
		$text = $product->get_description();
	}

	return wp_trim_words( wp_strip_all_tags( $text ), 16 );
}

if ( class_exists( 'WooCommerce' ) ) {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
}
