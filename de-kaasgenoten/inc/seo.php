<?php
/**
 * SEO structured data.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Organization schema in footer.
 */
function dkg_output_organization_schema() {
	if ( is_admin() ) {
		return;
	}

	$c = dkg_company_details();

	$schema = array(
		'@context' => 'https://schema.org',
		'@type'    => 'Organization',
		'name'     => $c['name'],
		'url'      => home_url( '/' ),
		'email'    => $c['email'],
		'telephone'=> $c['phone'],
		'address'  => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => $c['street'],
			'postalCode'      => $c['postal'],
			'addressLocality' => $c['city'],
			'addressCountry'  => $c['country'],
		),
	);

	$socials = dkg_social_links();

	if ( ! empty( $socials ) ) {
		$schema['sameAs'] = wp_list_pluck( $socials, 'url' );
	}

	printf(
		'<script type="application/ld+json">%s</script>',
		wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
	);
}
add_action( 'wp_footer', 'dkg_output_organization_schema', 99 );

/**
 * Canonical voor merkfilters zonder query-param duplicatie.
 */
function dkg_brand_filter_canonical() {
	if ( ! is_product_category() || empty( $_GET['filter'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		return;
	}

	$term = get_queried_object();

	if ( ! $term instanceof WP_Term ) {
		return;
	}

	$filter = sanitize_title( wp_unslash( $_GET['filter'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$url    = add_query_arg( 'filter', $filter, get_term_link( $term ) );

	if ( ! is_wp_error( $url ) ) {
		echo '<link rel="canonical" href="' . esc_url( $url ) . '" />' . "\n";
	}
}
add_action( 'wp_head', 'dkg_brand_filter_canonical', 1 );
