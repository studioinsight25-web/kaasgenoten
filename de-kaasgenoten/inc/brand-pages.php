<?php
/**
 * Merkpagina's – configuratie, query-filter en assets.
 *
 * Merkpagina's tonen filterkaarten in plaats van direct een productgrid.
 * Pas `?filter=slug` toe om producten in de bijbehorende merk-subcategorie
 * te tonen (bijv. bastiaansen-koekaas).
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Standaard kaasfilterkaarten (Bastiaansen en vergelijkbare merken).
 *
 * @return array<int, array<string, string>>
 */
function dkg_brand_default_cheese_filters() {
	return array(
		array( 'title' => __( 'Koekaas', 'de-kaasgenoten' ), 'text' => __( 'Romige biologische kazen van koemelk.', 'de-kaasgenoten' ), 'filter' => 'koekaas' ),
		array( 'title' => __( 'Geitenkaas', 'de-kaasgenoten' ), 'text' => __( 'Zachte en karaktervolle kazen van geitenmelk.', 'de-kaasgenoten' ), 'filter' => 'geitenkaas' ),
		array( 'title' => __( 'Schapenkaas', 'de-kaasgenoten' ), 'text' => __( 'Volle biologische kazen van schapenmelk.', 'de-kaasgenoten' ), 'filter' => 'schapenkaas' ),
		array( 'title' => __( 'Kruidenkaas', 'de-kaasgenoten' ), 'text' => __( 'Biologische kazen met verfijnde kruiden.', 'de-kaasgenoten' ), 'filter' => 'kruidenkaas' ),
		array( 'title' => __( 'Magere kaas', 'de-kaasgenoten' ), 'text' => __( 'Lichter van smaak, vol van kwaliteit.', 'de-kaasgenoten' ), 'filter' => 'magere-kaas' ),
		array( 'title' => __( 'Roodbacterie kaas', 'de-kaasgenoten' ), 'text' => __( 'Zacht, smeuïg en rijk van karakter.', 'de-kaasgenoten' ), 'filter' => 'roodbacterie-kaas' ),
		array( 'title' => __( 'Weidevogel kaas', 'de-kaasgenoten' ), 'text' => __( 'Biologische kaas met aandacht voor natuur en landschap.', 'de-kaasgenoten' ), 'filter' => 'weidevogel-kaas' ),
		array( 'title' => __( 'Blauwe kaas', 'de-kaasgenoten' ), 'text' => __( 'Krachtige biologische blauwaderkazen met een rijke, karaktervolle smaak.', 'de-kaasgenoten' ), 'filter' => 'blauwe-kaas' ),
	);
}

/**
 * Selecteer kaasfilters uit de standaardset.
 *
 * @param array<int, string> $filter_slugs Filter-slugs in gewenste volgorde.
 * @return array<int, array<string, string>>
 */
function dkg_brand_cheese_filters( $filter_slugs ) {
	$indexed = array();

	foreach ( dkg_brand_default_cheese_filters() as $filter ) {
		if ( ! empty( $filter['filter'] ) ) {
			$indexed[ $filter['filter'] ] = $filter;
		}
	}

	$selected = array();

	foreach ( $filter_slugs as $slug ) {
		if ( isset( $indexed[ $slug ] ) ) {
			$selected[] = $indexed[ $slug ];
		}
	}

	return $selected;
}

/**
 * Kaasfilters met merk-specifieke subcategorie-slugs.
 *
 * @param string                    $brand_slug   Merkcategorie-slug.
 * @param array<int, string>|null   $filter_slugs Optionele subset; anders alle standaardfilters.
 * @return array<int, array<string, string>>
 */
function dkg_brand_prefixed_cheese_filters( $brand_slug, $filter_slugs = null ) {
	$filters = $filter_slugs ? dkg_brand_cheese_filters( $filter_slugs ) : dkg_brand_default_cheese_filters();
	$prefixed = array();

	foreach ( $filters as $filter ) {
		if ( empty( $filter['filter'] ) ) {
			continue;
		}

		$filter['category'] = $brand_slug . '-' . $filter['filter'];
		$prefixed[]         = $filter;
	}

	return $prefixed;
}

/**
 * Configuratie per merk.
 *
 * Voeg een nieuw merk toe door een slug (product_cat) als sleutel te gebruiken.
 * Elk filter verwijst standaard naar een product_cat-slug; optioneel via
 * 'taxonomy' => 'pa_soort' een productattribuut instellen.
 *
 * @return array<string, array<string, mixed>>
 */
function dkg_brand_pages_config() {
	$config = array(
		'bastiaansen' => array(
			'eyebrow'          => __( 'Biologische kaas', 'de-kaasgenoten' ),
			'intro'            => __( 'Ambachtelijke biologische kazen van Bastiaansen — gemaakt met respect voor dier, natuur en smaak. Kies hieronder welk soort kaas je wilt ontdekken.', 'de-kaasgenoten' ),
			'lead'             => __( 'Bastiaansen staat bekend om hun biologische kazen van hoge kwaliteit. Bij De Kaasgenoten selecteren we per soort de mooiste stukken — van romige koekaas tot karaktervolle geitenkaas.', 'de-kaasgenoten' ),
			'hero_image'       => 'brands/brand-bastiaansen.png',
			'filters_heading'  => __( 'Welke soort kaas zoek je?', 'de-kaasgenoten' ),
			'hint'             => __( 'Kies hierboven een soort kaas om het assortiment te bekijken.', 'de-kaasgenoten' ),
			'filters'          => dkg_brand_prefixed_cheese_filters( 'bastiaansen' ),
		),
		'marienwaerdt' => array(
			'eyebrow'          => __( 'Biologische kaas', 'de-kaasgenoten' ),
			'intro'            => __( 'Ambachtelijke biologische kazen van Marienwaerdt — gemaakt op de landgoederen Marienwaerdt. Kies hieronder welk soort kaas je wilt ontdekken.', 'de-kaasgenoten' ),
			'lead'             => __( 'Marienwaerdt staat bekend om bijzondere biologische kazen met karakter. Ontdek ons assortiment koekaas, kruidenkaas en geitenkaas.', 'de-kaasgenoten' ),
			'hero_image'       => 'brands/brand-marienwaerdt.png',
			'filters_heading'  => __( 'Welke soort kaas zoek je?', 'de-kaasgenoten' ),
			'hint'             => __( 'Kies hierboven een soort kaas om het assortiment te bekijken.', 'de-kaasgenoten' ),
			'filters'          => dkg_brand_prefixed_cheese_filters( 'marienwaerdt', array( 'koekaas', 'kruidenkaas', 'geitenkaas' ) ),
		),
		'ravenswaard' => array(
			'eyebrow'          => __( 'Ambachtelijke kaas', 'de-kaasgenoten' ),
			'intro'            => __( 'Karaktervolle kazen van Ravenswaard — ambachtelijk gemaakt met aandacht voor smaak en kwaliteit. Kies hieronder tussen koekaas en kruidenkaas.', 'de-kaasgenoten' ),
			'lead'             => __( 'Ravenswaard levert bijzondere koekazen voor de echte liefhebber. Ontdek ons assortiment naturel en met kruiden.', 'de-kaasgenoten' ),
			'hero_image'       => 'boerenkaas-ravenswaard.png',
			'filters_heading'  => __( 'Welke soort kaas zoek je?', 'de-kaasgenoten' ),
			'hint'             => __( 'Kies hierboven een soort kaas om het assortiment te bekijken.', 'de-kaasgenoten' ),
			'filters'          => dkg_brand_prefixed_cheese_filters( 'ravenswaard', array( 'koekaas', 'kruidenkaas' ) ),
		),
		'mekkerstee' => array(
			'eyebrow'          => __( 'Biologische geitenkaas', 'de-kaasgenoten' ),
			'intro'            => __( 'Biologische geitenkazen van Mèkkerstee — eerlijk, puur en vol van smaak. Kies hieronder tussen naturel en kruiden.', 'de-kaasgenoten' ),
			'lead'             => __( 'Mèkkerstee maakt uitsluitend biologische geitenkaas met een eigen karakter. Ontdek het assortiment naturel of met kruiden.', 'de-kaasgenoten' ),
			'hero_image'       => 'brands/brand-mekkerstee.png',
			'filters_heading'  => __( 'Welke geitenkaas zoek je?', 'de-kaasgenoten' ),
			'hint'             => __( 'Kies hierboven een variant om het assortiment te bekijken.', 'de-kaasgenoten' ),
			'filters'          => array(
				array(
					'title'    => __( 'Geitenkaas', 'de-kaasgenoten' ),
					'text'     => __( 'Zachte en karaktervolle biologische geitenkaas.', 'de-kaasgenoten' ),
					'filter'   => 'geitenkaas',
					'category' => 'mekkerstee-geitenkaas',
				),
				array(
					'title'    => __( 'Geitenkaas kruiden', 'de-kaasgenoten' ),
					'text'     => __( 'Biologische geitenkaas met verfijnde kruiden.', 'de-kaasgenoten' ),
					'filter'   => 'geitenkaas-kruiden',
					'category' => 'mekkerstee-geitenkaas-kruiden',
				),
			),
		),
		'lutjewinkel' => array(
			'eyebrow'          => __( 'Ambachtelijke kaas', 'de-kaasgenoten' ),
			'intro'            => __( 'Karaktervolle koekazen van Lutjewinkel — traditioneel gemaakt met een eigen smaakprofiel.', 'de-kaasgenoten' ),
			'lead'             => __( 'Lutjewinkel levert bijzondere koekazen die zich onderscheiden door hun rijke smaak en ambachtelijke herkomst.', 'de-kaasgenoten' ),
			'hero_image'       => 'noord-hollandse-lutjewinkel.png',
			'direct_products'  => true,
			'filters'          => array(),
		),
		'beemster' => array(
			'eyebrow'          => __( 'Noord-Hollandse kaas', 'de-kaasgenoten' ),
			'intro'            => __( 'Wereldberoemde kaas uit de Beemster — rijk van smaak, gemaakt met vakmanschap sinds 1612.', 'de-kaasgenoten' ),
			'lead'             => __( 'Beemster staat voor karakter, kwaliteit en een herkenbare Noord-Hollandse smaak. Ontdek ons assortiment premium Beemster kazen.', 'de-kaasgenoten' ),
			'hero_image'       => 'noord-hollandse-beemster.png',
			'direct_products'  => true,
			'filters'          => array(),
		),
		'terschellinger' => array(
			'eyebrow'          => __( 'Eilandkaas', 'de-kaasgenoten' ),
			'intro'            => __( 'Bijzondere eilandkaas van Terschelling — uniek van smaak en herkomst. Kies hieronder tussen koekaas en kruidenkaas.', 'de-kaasgenoten' ),
			'lead'             => __( 'Terschellinger kaas brengt het karakter van het Waddeneiland naar uw tafel. Ontdek ons assortiment koekaas en kruidenkaas.', 'de-kaasgenoten' ),
			'hero_image'       => 'brands/brand-terschellinger.png',
			'filters_heading'  => __( 'Welke soort kaas zoek je?', 'de-kaasgenoten' ),
			'hint'             => __( 'Kies hierboven een soort kaas om het assortiment te bekijken.', 'de-kaasgenoten' ),
			'filters'          => dkg_brand_prefixed_cheese_filters( 'terschellinger', array( 'koekaas', 'kruidenkaas' ) ),
		),
	);

	return apply_filters( 'dkg_brand_pages', $config );
}

/**
 * Haal merkconfig op voor een productcategorie-slug.
 *
 * @param string $slug Productcategorie-slug.
 * @return array<string, mixed>|null
 */
function dkg_get_brand_page( $slug ) {
	if ( ! $slug ) {
		return null;
	}

	$pages = dkg_brand_pages_config();

	if ( ! isset( $pages[ $slug ] ) ) {
		return null;
	}

	$page = $pages[ $slug ];

	if ( empty( $page['filters'] ) && empty( $page['direct_products'] ) ) {
		return null;
	}

	return $page;
}

/**
 * Haal een product_cat-term op uit query-variabelen (werkt ook in pre_get_posts).
 *
 * @param WP_Query|null $query Query.
 * @return WP_Term|null
 */
function dkg_brand_page_term_from_query( $query ) {
	if ( ! $query instanceof WP_Query ) {
		return null;
	}

	$slug = '';

	if ( $query->is_tax( 'product_cat' ) ) {
		$term = $query->get_queried_object();

		if ( $term instanceof WP_Term ) {
			return $term;
		}

		$slug = $query->get( 'product_cat' );
	} elseif ( $query->is_post_type_archive( 'product' ) ) {
		$slug = $query->get( 'product_cat' );
	}

	if ( ! $slug ) {
		return null;
	}

	if ( is_numeric( $slug ) ) {
		$term = get_term( (int) $slug, 'product_cat' );
	} else {
		$term = get_term_by( 'slug', sanitize_title( $slug ), 'product_cat' );
	}

	return ( $term instanceof WP_Term ) ? $term : null;
}

/**
 * Bepaal de actieve productcategorie-term op archiefpagina's.
 *
 * @return WP_Term|null
 */
function dkg_brand_page_resolve_term() {
	if ( is_product_category() ) {
		$term = get_queried_object();

		if ( $term instanceof WP_Term ) {
			return $term;
		}
	}

	if ( class_exists( 'WooCommerce' ) && is_shop() ) {
		$queried_slug = get_query_var( 'product_cat' );

		if ( $queried_slug ) {
			$maybe_term = get_term_by( 'slug', sanitize_title( $queried_slug ), 'product_cat' );

			if ( $maybe_term instanceof WP_Term ) {
				return $maybe_term;
			}
		}
	}

	return null;
}

/**
 * Actieve filter-slug uit de URL (?filter=).
 *
 * @return string
 */
function dkg_brand_active_filter_slug() {
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended
	if ( empty( $_GET['filter'] ) ) {
		return '';
	}

	// phpcs:ignore WordPress.Security.NonceVerification.Recommended
	return sanitize_title( wp_unslash( $_GET['filter'] ) );
}

/**
 * Zoek een filterkaart-config op slug.
 *
 * @param array<string, mixed> $brand       Merkconfig.
 * @param string               $filter_slug Filter-slug.
 * @return array<string, string>|null
 */
function dkg_brand_filter_by_slug( $brand, $filter_slug ) {
	if ( ! $filter_slug || empty( $brand['filters'] ) ) {
		return null;
	}

	foreach ( $brand['filters'] as $filter ) {
		if ( ! empty( $filter['filter'] ) && $filter['filter'] === $filter_slug ) {
			return $filter;
		}
	}

	return null;
}

/**
 * URL naar een merkfilter.
 *
 * @param WP_Term $term        Merkcategorie.
 * @param string  $filter_slug Filter-slug.
 * @return string
 */
function dkg_brand_filter_url( $term, $filter_slug ) {
	$link = get_term_link( $term );

	if ( is_wp_error( $link ) ) {
		return '';
	}

	return add_query_arg( 'filter', $filter_slug, $link );
}

/**
 * Hero-achtergrond voor een merkpagina.
 *
 * @param array<string, mixed> $brand Merkconfig.
 * @param WP_Term              $term  Merkcategorie.
 * @return string
 */
function dkg_brand_hero_image_url( $brand, $term ) {
	$thumb_id = get_term_meta( $term->term_id, 'thumbnail_id', true );

	if ( $thumb_id ) {
		$url = wp_get_attachment_image_url( $thumb_id, 'dkg-hero' );

		if ( $url ) {
			return $url;
		}
	}

	if ( ! empty( $brand['hero_image'] ) ) {
		return dkg_asset_uri( 'images/' . $brand['hero_image'] );
	}

	return '';
}

/**
 * Zoek de WooCommerce-subcategorie voor een merkfilter.
 *
 * Volgorde: expliciete category-slug, {merk}-{filter}, legacy filter-slug.
 *
 * @param WP_Term              $brand_term Merkcategorie.
 * @param array<string, mixed> $filter     Filterconfig.
 * @return WP_Term|null
 */
function dkg_brand_resolve_filter_term( $brand_term, $filter ) {
	if ( ! $brand_term instanceof WP_Term || empty( $filter['filter'] ) ) {
		return null;
	}

	$taxonomy = ! empty( $filter['taxonomy'] ) ? $filter['taxonomy'] : 'product_cat';

	if ( 'product_cat' !== $taxonomy ) {
		return null;
	}

	$candidates = array();

	if ( ! empty( $filter['category'] ) ) {
		$candidates[] = $filter['category'];
	}

	$candidates[] = $brand_term->slug . '-' . $filter['filter'];
	$candidates[] = $filter['filter'];

	$candidates = array_values( array_unique( array_filter( array_map( 'sanitize_title', $candidates ) ) ) );

	foreach ( $candidates as $slug ) {
		$term = get_term_by( 'slug', $slug, 'product_cat' );

		if ( $term instanceof WP_Term ) {
			return $term;
		}
	}

	return null;
}

/**
 * Filters die een bestaande subcategorie in WooCommerce hebben.
 *
 * @param array<string, mixed> $brand      Merkconfig.
 * @param WP_Term              $brand_term Merkcategorie.
 * @return array<int, array<string, mixed>>
 */
function dkg_brand_visible_filters( $brand, $brand_term ) {
	if ( empty( $brand['filters'] ) || ! $brand_term instanceof WP_Term ) {
		return array();
	}

	$visible = array();

	foreach ( $brand['filters'] as $filter ) {
		if ( dkg_brand_resolve_filter_term( $brand_term, $filter ) instanceof WP_Term ) {
			$visible[] = $filter;
		}
	}

	return $visible;
}

/**
 * Producten ophalen uit de opgeloste merk-subcategorie.
 *
 * @param WP_Term              $brand_term Merkcategorie.
 * @param array<string, mixed> $filter     Filterconfig.
 * @param int                  $limit      Max. aantal producten (-1 = alles).
 * @return array<int, WC_Product>
 */
function dkg_brand_filtered_products( $brand_term, $filter, $limit = -1 ) {
	if ( ! class_exists( 'WooCommerce' ) || ! $brand_term instanceof WP_Term || empty( $filter['filter'] ) ) {
		return array();
	}

	$taxonomy    = ! empty( $filter['taxonomy'] ) ? $filter['taxonomy'] : 'product_cat';
	$filter_term = dkg_brand_resolve_filter_term( $brand_term, $filter );

	if ( ! $filter_term instanceof WP_Term ) {
		return array();
	}

	$products = wc_get_products(
		array(
			'status'    => 'publish',
			'limit'     => (int) $limit,
			'orderby'   => 'menu_order title',
			'order'     => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'term_id',
					'terms'    => array( $filter_term->term_id ),
				),
			),
		)
	);

	return is_array( $products ) ? dkg_sort_products_by_age( $products ) : array();
}

/**
 * Alle producten van een merk (zonder soortfilter).
 *
 * @param WP_Term $brand_term Merkcategorie.
 * @param int     $limit      Max. aantal producten (-1 = alles).
 * @return array<int, WC_Product>
 */
function dkg_brand_products( $brand_term, $limit = -1 ) {
	if ( ! class_exists( 'WooCommerce' ) || ! $brand_term instanceof WP_Term ) {
		return array();
	}

	$products = wc_get_products(
		array(
			'status'    => 'publish',
			'limit'     => (int) $limit,
			'orderby'   => 'menu_order title',
			'order'     => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy'         => 'product_cat',
					'field'            => 'term_id',
					'terms'            => array( $brand_term->term_id ),
					'include_children' => true,
				),
			),
		)
	);

	return is_array( $products ) ? dkg_sort_products_by_age( $products ) : array();
}

/**
 * Controleer of de WooCommerce-filtercategorie al bestaat.
 *
 * @param array<string, mixed> $filter     Filterconfig.
 * @param WP_Term|null         $brand_term Merkcategorie.
 * @return bool
 */
function dkg_brand_filter_term_exists( $filter, $brand_term = null ) {
	if ( empty( $filter['filter'] ) ) {
		return false;
	}

	$taxonomy = ! empty( $filter['taxonomy'] ) ? $filter['taxonomy'] : 'product_cat';

	if ( 'product_cat' !== $taxonomy ) {
		return taxonomy_exists( $taxonomy );
	}

	if ( $brand_term instanceof WP_Term ) {
		return dkg_brand_resolve_filter_term( $brand_term, $filter ) instanceof WP_Term;
	}

	$term = get_term_by( 'slug', $filter['filter'], 'product_cat' );

	return $term instanceof WP_Term;
}

/**
 * Pas de hoofdquery aan voor merkpagina's (geen grid zonder filter).
 *
 * @param WP_Query $query Query.
 */
function dkg_brand_page_pre_get_posts( $query ) {
	if ( is_admin() || ! $query->is_main_query() || ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	if ( ! $query->is_post_type_archive( 'product' ) && ! $query->is_tax( 'product_cat' ) ) {
		return;
	}

	$term = dkg_brand_page_term_from_query( $query );

	if ( ! $term instanceof WP_Term ) {
		return;
	}

	$brand = dkg_get_brand_page( $term->slug );

	if ( ! $brand ) {
		return;
	}

	// Merkpagina gebruikt een eigen productquery in de template; onderdruk het standaardgrid.
	$query->set( 'post__in', array( 0 ) );
}
add_action( 'pre_get_posts', 'dkg_brand_page_pre_get_posts', 30 );

/**
 * Laad merkpagina-styles op relevante archieven.
 */
function dkg_enqueue_brand_page_assets() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	$term = dkg_brand_page_resolve_term();

	if ( ! $term instanceof WP_Term || ! dkg_get_brand_page( $term->slug ) ) {
		return;
	}

	wp_enqueue_style(
		'dkg-brand-page',
		get_template_directory_uri() . '/assets/css/components/brand-page.css',
		array( 'dkg-theme' ),
		DKG_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'dkg_enqueue_brand_page_assets', 20 );
