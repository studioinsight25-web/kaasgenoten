<?php
/**
 * Aanbiedingen – navigatie, productquery en pagina-logica.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * URL naar de aanbiedingen-categorie.
 *
 * @return string
 */
function dkg_aanbieding_url() {
	return dkg_product_category_url( 'aanbieding', 'aanbieding' );
}

/**
 * Is dit de aanbiedingen-archiefpagina?
 *
 * @param WP_Term|null $term Optionele term.
 * @return bool
 */
function dkg_is_aanbieding_page( $term = null ) {
	if ( $term instanceof WP_Term ) {
		return 'aanbieding' === $term->slug;
	}

	return function_exists( 'is_product_category' ) && is_product_category( 'aanbieding' );
}

/**
 * Is de aanbiedingen-nav actief?
 *
 * @return bool
 */
function dkg_aanbieding_nav_is_active() {
	if ( dkg_is_aanbieding_page() ) {
		return true;
	}

	$queried_slug = get_query_var( 'product_cat' );

	return 'aanbieding' === sanitize_title( (string) $queried_slug );
}

/**
 * Verberg ongewenste items uit het hoofdmenu.
 *
 * - Aanbiedingen (staat al als aparte knop)
 * - WordPress-placeholder "Menu-item"
 *
 * @param array    $items Menu-items.
 * @param stdClass $args  Menu-args.
 * @return array
 */
function dkg_filter_primary_nav_items( $items, $args ) {
	if ( empty( $args->theme_location ) || 'primary' !== $args->theme_location ) {
		return $items;
	}

	$filtered = array();

	foreach ( $items as $item ) {
		if ( dkg_nav_item_is_aanbieding( $item ) || dkg_nav_item_is_placeholder( $item ) ) {
			continue;
		}

		$filtered[] = $item;
	}

	return $filtered;
}
add_filter( 'wp_nav_menu_objects', 'dkg_filter_primary_nav_items', 10, 2 );

/**
 * Bepaal of een menu-item een lege WordPress-placeholder is.
 *
 * @param WP_Post $item Menu-item.
 * @return bool
 */
function dkg_nav_item_is_placeholder( $item ) {
	if ( ! $item instanceof WP_Post ) {
		return false;
	}

	$title = trim( html_entity_decode( (string) $item->title, ENT_QUOTES, 'UTF-8' ) );

	if ( '' === $title ) {
		return true;
	}

	return (bool) preg_match( '/^menu[-\s]?item$/i', $title );
}

/**
 * Bepaal of een menu-item naar Aanbiedingen verwijst.
 *
 * @param WP_Post $item Menu-item.
 * @return bool
 */
function dkg_nav_item_is_aanbieding( $item ) {
	if ( ! $item instanceof WP_Post ) {
		return false;
	}

	if ( 'product_cat' === $item->object ) {
		$term = get_term( (int) $item->object_id, 'product_cat' );

		if ( $term instanceof WP_Term && 'aanbieding' === $term->slug ) {
			return true;
		}
	}

	$url = strtolower( untrailingslashit( (string) $item->url ) );

	if ( false !== strpos( $url, '/product-category/aanbieding' ) ) {
		return true;
	}

	if ( false !== strpos( $url, 'product_cat=aanbieding' ) ) {
		return true;
	}

	$path = strtolower( (string) wp_parse_url( $item->url, PHP_URL_PATH ) );

	if ( '/aanbieding' === untrailingslashit( $path ) || false !== strpos( $path, '/aanbieding/' ) ) {
		return true;
	}

	return false !== stripos( html_entity_decode( (string) $item->title, ENT_QUOTES, 'UTF-8' ), 'aanbieding' );
}

/**
 * Haal aanbiedingsproducten op.
 *
 * Alleen producten met de categorie "aanbieding" (geen automatische sale-prijs).
 *
 * @param int $limit Max. aantal (-1 = alles).
 * @return array<int, WC_Product>
 */
function dkg_aanbieding_products( $limit = -1 ) {
	if ( ! class_exists( 'WooCommerce' ) || ! get_term_by( 'slug', 'aanbieding', 'product_cat' ) ) {
		return array();
	}

	$products = wc_get_products(
		array(
			'status'   => 'publish',
			'limit'    => $limit > 0 ? (int) $limit : -1,
			'category' => array( 'aanbieding' ),
			'orderby'  => 'date',
			'order'    => 'DESC',
		)
	);

	if ( ! is_array( $products ) ) {
		return array();
	}

	if ( function_exists( 'dkg_sort_products_by_age' ) ) {
		$products = dkg_sort_products_by_age( $products );
	}

	return $products;
}

/**
 * Onderdruk het standaard WooCommerce-grid op de aanbiedingenpagina.
 *
 * @param WP_Query $query Query.
 */
function dkg_aanbieding_pre_get_posts( $query ) {
	if ( is_admin() || ! $query->is_main_query() || ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	if ( ! $query->is_post_type_archive( 'product' ) && ! $query->is_tax( 'product_cat' ) ) {
		return;
	}

	$term = null;

	if ( function_exists( 'dkg_brand_page_term_from_query' ) ) {
		$term = dkg_brand_page_term_from_query( $query );
	}

	if ( ! $term instanceof WP_Term || ! dkg_is_aanbieding_page( $term ) ) {
		return;
	}

	$query->set( 'post__in', array( 0 ) );
}
add_action( 'pre_get_posts', 'dkg_aanbieding_pre_get_posts', 30 );

/**
 * Laad aanbiedingen-paginastyles (nav-styles staan in theme.css).
 */
function dkg_enqueue_aanbieding_page_assets() {
	if ( ! function_exists( 'dkg_is_aanbieding_page' ) || ! dkg_is_aanbieding_page() ) {
		return;
	}

	wp_enqueue_style(
		'dkg-aanbieding-page',
		get_template_directory_uri() . '/assets/css/components/aanbieding-page.css',
		array( 'dkg-theme' ),
		DKG_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'dkg_enqueue_aanbieding_page_assets', 20 );
