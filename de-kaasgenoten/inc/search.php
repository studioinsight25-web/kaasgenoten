<?php
/**
 * Productzoekfunctie.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * URL voor productzoeken.
 *
 * @return string
 */
function dkg_product_search_url() {
	return add_query_arg(
		array(
			'post_type' => 'product',
			's'         => '',
		),
		home_url( '/' )
	);
}

/**
 * Beperk zoekresultaten tot producten op de frontend.
 *
 * @param WP_Query $query Query.
 */
function dkg_product_search_query( $query ) {
	if ( is_admin() || ! $query->is_main_query() || ! $query->is_search() ) {
		return;
	}

	$post_type = $query->get( 'post_type' );

	if ( 'product' === $post_type || ( is_array( $post_type ) && in_array( 'product', $post_type, true ) ) ) {
		$query->set( 'post_type', 'product' );
	}
}
add_action( 'pre_get_posts', 'dkg_product_search_query' );

/**
 * Sorteer productzoekresultaten op kaasvolgorde.
 *
 * @param array<int, WP_Post> $posts Posts.
 * @param WP_Query            $query Query.
 * @return array<int, WP_Post>
 */
function dkg_sort_product_search_posts( $posts, $query ) {
	if ( is_admin() || ! $query->is_main_query() || ! $query->is_search() || 'product' !== $query->get( 'post_type' ) ) {
		return $posts;
	}

	if ( ! function_exists( 'dkg_sort_products_by_age' ) || empty( $posts ) ) {
		return $posts;
	}

	$products = array();

	foreach ( $posts as $post ) {
		$product = wc_get_product( $post->ID );

		if ( $product ) {
			$products[] = $product;
		}
	}

	$products = dkg_sort_products_by_age( $products );
	$sorted   = array();

	foreach ( $products as $product ) {
		$sorted[] = get_post( $product->get_id() );
	}

	return $sorted;
}
add_filter( 'the_posts', 'dkg_sort_product_search_posts', 25, 2 );
