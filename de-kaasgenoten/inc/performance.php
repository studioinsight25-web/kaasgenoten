<?php

/**

 * Performance-optimalisaties.

 *

 * @package De_Kaasgenoten

 */



if ( ! defined( 'ABSPATH' ) ) {

	exit;

}



/**

 * Dequeue WooCommerce styles op niet-shop pagina's.

 */

function dkg_optimize_wc_assets() {

	if ( ! class_exists( 'WooCommerce' ) ) {

		return;

	}



	if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) {

		return;

	}



	wp_dequeue_style( 'woocommerce-general' );

	wp_dequeue_style( 'woocommerce-layout' );

	wp_dequeue_style( 'woocommerce-smallscreen' );

}

add_action( 'wp_enqueue_scripts', 'dkg_optimize_wc_assets', 99 );



/**

 * Voeg WebP/AVIF mime-types toe voor uploads.

 *

 * @param array<string, string> $mimes Mime-types.

 * @return array<string, string>

 */

function dkg_allow_modern_image_mimes( $mimes ) {

	$mimes['webp'] = 'image/webp';

	$mimes['avif'] = 'image/avif';



	return $mimes;

}

add_filter( 'upload_mimes', 'dkg_allow_modern_image_mimes' );



/**

 * Lazy load below-fold afbeeldingen in productkaarten (fallback).

 *

 * @param string $html    Afbeelding HTML.

 * @param int    $post_id Post-ID.

 * @return string

 */

function dkg_lazy_load_product_images( $html, $post_id ) {

	if ( is_admin() || ! $html || 'product' !== get_post_type( $post_id ) ) {

		return $html;

	}



	if ( false !== strpos( $html, 'loading=' ) ) {

		return $html;

	}



	return str_replace( '<img ', '<img loading="lazy" decoding="async" ', $html );

}

add_filter( 'post_thumbnail_html', 'dkg_lazy_load_product_images', 10, 2 );


