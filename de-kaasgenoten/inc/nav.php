<?php
/**
 * Navigatie-helpers en fallbacks.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Fallback hoofdmenu wanneer er geen menu is ingesteld.
 *
 * @return void
 */
function dkg_primary_menu_fallback() {
	$items = array(
		array( 'label' => __( 'Homepage', 'de-kaasgenoten' ), 'url' => home_url( '/' ) ),
		array( 'label' => __( 'Kaas', 'de-kaasgenoten' ), 'url' => dkg_product_category_url( 'kaas', 'kaas' ) ),
		array( 'label' => __( 'Delicatessen', 'de-kaasgenoten' ), 'url' => dkg_product_category_url( 'delicatessen', 'delicatessen' ) ),
		array( 'label' => __( 'Pakketten & Geschenken', 'de-kaasgenoten' ), 'url' => dkg_product_category_url( 'pakketten', 'pakketten' ) ),
		array( 'label' => __( 'Zakelijk', 'de-kaasgenoten' ), 'url' => dkg_product_category_url( 'geschenken', 'zakelijk' ) ),
		array( 'label' => __( 'Contact', 'de-kaasgenoten' ), 'url' => dkg_page_url( 'contact' ) ),
		array( 'label' => __( 'Over ons', 'de-kaasgenoten' ), 'url' => dkg_page_url( 'over-ons' ) ),
	);

	echo '<ul id="primary-menu" class="dkg-menu">';

	foreach ( $items as $item ) {
		printf(
			'<li><a href="%s">%s</a></li>',
			esc_url( $item['url'] ),
			esc_html( $item['label'] )
		);
	}

	echo '</ul>';
}

/**
 * Footer-informatielinks (WC-categorieën waar mogelijk).
 *
 * @return array<int, array<string, string>>
 */
function dkg_footer_info_links() {
	return array(
		array(
			'label' => __( 'Kaas & Delicatessen', 'de-kaasgenoten' ),
			'url'   => dkg_product_category_url( 'kaas', 'kaas-delicatessen' ),
		),
		array(
			'label' => __( 'Borrelpakketten', 'de-kaasgenoten' ),
			'url'   => dkg_product_category_url( 'borrelpakketten', 'borrelpakketten' ),
		),
		array(
			'label' => __( 'Kerstpakketten', 'de-kaasgenoten' ),
			'url'   => dkg_product_category_url( 'kerstpakketten', 'kerstpakketten' ),
		),
		array(
			'label' => __( 'Relatiegeschenken', 'de-kaasgenoten' ),
			'url'   => dkg_product_category_url( 'relatiegeschenken', 'relatiegeschenken' ),
		),
		array(
			'label' => __( 'Over ons', 'de-kaasgenoten' ),
			'url'   => dkg_page_url( 'over-ons' ),
		),
		array(
			'label' => __( 'Privacybeleid', 'de-kaasgenoten' ),
			'url'   => dkg_page_url( 'privacy-policy' ),
		),
	);
}
