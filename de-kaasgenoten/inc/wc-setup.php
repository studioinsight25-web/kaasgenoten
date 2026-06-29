<?php
/**
 * WooCommerce categorie- en attribuut-setup.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Vereiste productcategorieën (slug => parent slug of leeg).
 *
 * @return array<string, string>
 */
function dkg_required_product_categories() {
	$categories = array(
		'kaas'              => '',
		'delicatessen'      => '',
		'pakketten'         => '',
		'geschenken'        => '',
		'aanbieding'        => '',
		'biologische-kaas'  => 'kaas',
		'boerenkaas'        => 'kaas',
		'jong'              => 'kaas',
		'jong-belegen'      => 'kaas',
		'belegen'           => 'kaas',
		'extra-belegen'     => 'kaas',
		'oud'               => 'kaas',
		'bastiaansen'       => 'biologische-kaas',
		'marienwaerdt'      => 'biologische-kaas',
		'ravenswaard'       => 'kaas',
		'mekkerstee'        => 'kaas',
		'noord-hollandse-kaas' => 'kaas',
		'beemster'             => 'kaas',
		'koekaas'           => 'bastiaansen',
		'geitenkaas'        => 'bastiaansen',
		'schapenkaas'       => 'bastiaansen',
		'kruidenkaas'       => 'bastiaansen',
		'magere-kaas'       => 'bastiaansen',
		'roodbacterie-kaas' => 'bastiaansen',
		'weidevogel-kaas'   => 'bastiaansen',
		'blauwe-kaas'       => 'bastiaansen',
		'borrelpakketten'   => 'pakketten',
		'kerstpakketten'    => 'pakketten',
		'relatiegeschenken' => 'geschenken',
	);

	return apply_filters( 'dkg_required_product_categories', $categories );
}

/**
 * Maak ontbrekende productcategorieën aan.
 */
function dkg_create_required_product_categories() {
	if ( ! class_exists( 'WooCommerce' ) || ! taxonomy_exists( 'product_cat' ) ) {
		return;
	}

	$created = array();

	foreach ( dkg_required_product_categories() as $slug => $parent_slug ) {
		if ( get_term_by( 'slug', $slug, 'product_cat' ) ) {
			$created[ $slug ] = 0;
			continue;
		}

		$parent_id = 0;

		if ( $parent_slug && isset( $created[ $parent_slug ] ) ) {
			$parent_id = (int) $created[ $parent_slug ];
		} elseif ( $parent_slug ) {
			$parent = get_term_by( 'slug', $parent_slug, 'product_cat' );
			$parent_id = $parent instanceof WP_Term ? (int) $parent->term_id : 0;
		}

		$result = wp_insert_term(
			ucwords( str_replace( '-', ' ', $slug ) ),
			'product_cat',
			array(
				'slug'   => $slug,
				'parent' => $parent_id,
			)
		);

		if ( ! is_wp_error( $result ) ) {
			$created[ $slug ] = (int) $result['term_id'];
		}
	}
}

/**
 * Zorg dat het gewicht-attribuut bestaat.
 */
function dkg_create_weight_attribute() {
	if ( ! class_exists( 'WooCommerce' ) || ! function_exists( 'wc_create_attribute' ) ) {
		return;
	}

	if ( taxonomy_exists( 'pa_gewicht' ) ) {
		return;
	}

	$attribute_id = wc_create_attribute(
		array(
			'name'         => 'Gewicht',
			'slug'         => 'gewicht',
			'type'         => 'select',
			'order_by'     => 'menu_order',
			'has_archives' => false,
		)
	);

	if ( is_wp_error( $attribute_id ) ) {
		return;
	}

	register_taxonomy(
		'pa_gewicht',
		'product',
		array(
			'label'        => 'Gewicht',
			'hierarchical' => false,
		)
	);

	$weights = array( '250 gram', '500 gram', '1000 gram', '2000 gram' );

	foreach ( $weights as $weight ) {
		if ( ! term_exists( $weight, 'pa_gewicht' ) ) {
			wp_insert_term( $weight, 'pa_gewicht', array( 'slug' => sanitize_title( $weight ) ) );
		}
	}
}

/**
 * Setup bij thema-activatie.
 */
function dkg_wc_setup_on_activation() {
	dkg_create_required_product_categories();
	dkg_create_weight_attribute();
}
add_action( 'after_switch_theme', 'dkg_wc_setup_on_activation', 20 );
