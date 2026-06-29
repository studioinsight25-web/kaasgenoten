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
			<?php if ( $product->is_on_sale() ) : ?>
				<span class="dkg-sale-badge"><?php esc_html_e( 'Aanbieding', 'de-kaasgenoten' ); ?></span>
			<?php endif; ?>
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

	return is_array( $products ) ? dkg_sort_products_by_age( $products ) : array();
}

/**
 * Vaste volgorde voor kaasrijpheid (jong → oud, daarna kruiden).
 *
 * @return array<string, int>
 */
function dkg_cheese_age_rank_map() {
	return apply_filters(
		'dkg_cheese_age_rank_map',
		array(
			'jong'          => 10,
			'jong-belegen'  => 20,
			'belegen'       => 30,
			'extra-belegen' => 40,
			'oud'           => 50,
			'overjarig'     => 55,
		)
	);
}

/**
 * Bepaal of een product een kruidenkaas is.
 *
 * @param WC_Product $product Product.
 * @return bool
 */
function dkg_product_is_kruiden_cheese( $product ) {
	if ( ! $product instanceof WC_Product ) {
		return false;
	}

	$slugs = wp_get_post_terms( $product->get_id(), 'product_cat', array( 'fields' => 'slugs' ) );

	if ( ! is_wp_error( $slugs ) && ! empty( $slugs ) ) {
		if ( in_array( 'kruidenkaas', $slugs, true ) || in_array( 'kruiden', $slugs, true ) ) {
			return true;
		}
	}

	$name = strtolower( $product->get_name() );

	return ( false !== strpos( $name, 'kruiden' ) ) || ( false !== strpos( $name, 'kruid' ) );
}

/**
 * Rijpheidsrang voor sortering (lager = eerder in de lijst).
 *
 * @param WC_Product $product Product.
 * @return int
 */
function dkg_product_age_rank( $product ) {
	if ( ! $product instanceof WC_Product ) {
		return 60;
	}

	$ranks      = dkg_cheese_age_rank_map();
	$checkorder = array( 'extra-belegen', 'jong-belegen', 'jong', 'belegen', 'oud', 'overjarig' );
	$slugs      = wp_get_post_terms( $product->get_id(), 'product_cat', array( 'fields' => 'slugs' ) );

	if ( ! is_wp_error( $slugs ) && ! empty( $slugs ) ) {
		foreach ( $checkorder as $slug ) {
			if ( in_array( $slug, $slugs, true ) && isset( $ranks[ $slug ] ) ) {
				return (int) $ranks[ $slug ];
			}
		}
	}

	$name = strtolower( $product->get_name() );

	if ( false !== strpos( $name, 'extra belegen' ) ) {
		return 40;
	}

	if ( false !== strpos( $name, 'jong belegen' ) ) {
		return 20;
	}

	if ( preg_match( '/\bjong\b/u', $name ) ) {
		return 10;
	}

	if ( false !== strpos( $name, 'belegen' ) ) {
		return 30;
	}

	if ( false !== strpos( $name, 'overjarig' ) ) {
		return 55;
	}

	if ( preg_match( '/\boud\b/u', $name ) ) {
		return 50;
	}

	return 60;
}

/**
 * Sorteerscore: eerst jong→oud, daarna kruiden (ook binnen kruiden jong→oud).
 *
 * @param WC_Product $product Product.
 * @return int
 */
function dkg_product_sort_score( $product ) {
	$age = dkg_product_age_rank( $product );

	if ( dkg_product_is_kruiden_cheese( $product ) ) {
		return 1000 + $age;
	}

	return $age;
}

/**
 * Sorteer producten op vaste kaasvolgorde.
 *
 * @param array<int, WC_Product> $products Producten.
 * @return array<int, WC_Product>
 */
function dkg_sort_products_by_age( $products ) {
	if ( empty( $products ) || ! is_array( $products ) ) {
		return $products;
	}

	usort(
		$products,
		function ( $a, $b ) {
			$score_a = dkg_product_sort_score( $a );
			$score_b = dkg_product_sort_score( $b );

			if ( $score_a !== $score_b ) {
				return $score_a <=> $score_b;
			}

			return strcasecmp( $a->get_name(), $b->get_name() );
		}
	);

	return $products;
}

/**
 * Sorteer productarchieven in de hoofdquery op jong → oud → kruiden.
 *
 * @param array<int, WP_Post> $posts Posts.
 * @param WP_Query            $query Query.
 * @return array<int, WP_Post>
 */
function dkg_sort_product_archive_posts( $posts, $query ) {
	if ( is_admin() || ! $query->is_main_query() || empty( $posts ) || 'product' !== $query->get( 'post_type' ) ) {
		return $posts;
	}

	if ( ! $query->is_post_type_archive( 'product' ) && ! $query->is_tax( array( 'product_cat', 'product_tag' ) ) ) {
		return $posts;
	}

	if ( function_exists( 'dkg_brand_page_term_from_query' ) ) {
		$term = dkg_brand_page_term_from_query( $query );

		if ( $term instanceof WP_Term && function_exists( 'dkg_get_brand_page' ) && dkg_get_brand_page( $term->slug ) ) {
			return $posts;
		}
	}

	// Respecteer handmatige sortering via WooCommerce dropdown.
	$orderby = $query->get( 'orderby' );

	if ( $orderby && 'menu_order' !== $orderby && 'menu_order title' !== $orderby ) {
		return $posts;
	}

	// phpcs:ignore WordPress.Security.NonceVerification.Recommended
	if ( ! empty( $_GET['orderby'] ) ) {
		return $posts;
	}

	usort(
		$posts,
		function ( $a, $b ) {
			$product_a = wc_get_product( $a->ID );
			$product_b = wc_get_product( $b->ID );
			$score_a   = dkg_product_sort_score( $product_a );
			$score_b   = dkg_product_sort_score( $product_b );

			if ( $score_a !== $score_b ) {
				return $score_a <=> $score_b;
			}

			return strcasecmp( $a->post_title, $b->post_title );
		}
	);

	return $posts;
}

/**
 * Vaste merklogo's voor categoriekaarten (slug => bestand onder assets/images/).
 *
 * @return array<string, string>
 */
function dkg_brand_category_images() {
	return apply_filters(
		'dkg_brand_category_images',
		array(
			'bastiaansen'         => 'brands/brand-bastiaansen.png',
			'marienwaerdt'        => 'brands/brand-marienwaerdt.png',
			'mekkerstee'          => 'brands/brand-mekkerstee.png',
			'terschellinger'      => 'brands/brand-terschellinger.png',
			'terschellinger-kaas' => 'brands/brand-terschellinger.png',
		)
	);
}

/**
 * Merklogo-URL voor een productcategorie-slug.
 *
 * @param string $slug Categorie-slug.
 * @return string
 */
function dkg_get_brand_category_image( $slug ) {
	$slug   = sanitize_title( (string) $slug );
	$images = dkg_brand_category_images();

	if ( empty( $images[ $slug ] ) ) {
		return '';
	}

	return dkg_asset_uri( 'images/' . ltrim( $images[ $slug ], '/' ) );
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
		$image_url    = '';
		$is_brand_logo = false;
		$brand_image  = dkg_get_brand_category_image( $term->slug );

		if ( $brand_image ) {
			$image_url     = $brand_image;
			$is_brand_logo = true;
		} else {
			$thumb_id = get_term_meta( $term->term_id, 'thumbnail_id', true );

			if ( $thumb_id ) {
				$image_url = wp_get_attachment_image_url( $thumb_id, 'medium_large' );
			}
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
			'title'         => $term->name,
			'text'          => $text,
			'image_url'     => $image_url ? $image_url : '',
			'image'         => $fallbacks[ $i % count( $fallbacks ) ],
			'is_brand_logo' => $is_brand_logo,
			'url'           => is_wp_error( $link ) ? dkg_shop_url() : $link,
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
	add_filter( 'the_posts', 'dkg_sort_product_archive_posts', 20, 2 );
}
