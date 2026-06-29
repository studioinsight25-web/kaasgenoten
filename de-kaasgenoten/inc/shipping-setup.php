<?php
/**
 * WooCommerce verzendmethoden en checkout-teksten.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Maak standaard verzendzone aan (alleen als nog niet geconfigureerd).
 */
function dkg_setup_default_shipping_zone() {
	if ( ! class_exists( 'WC_Shipping_Zones' ) ) {
		return;
	}

	if ( get_option( 'dkg_shipping_zone_setup' ) === DKG_VERSION ) {
		return;
	}

	$existing = WC_Shipping_Zones::get_zones();

	foreach ( $existing as $zone_data ) {
		$zone = new WC_Shipping_Zone( (int) $zone_data['zone_id'] );

		foreach ( $zone->get_shipping_methods( false ) as $method ) {
			$title = isset( $method->title ) ? (string) $method->title : '';

			if ( false !== stripos( $title, 'Verzending Nederland' ) || false !== stripos( $title, 'Afhalen op afspraak' ) ) {
				update_option( 'dkg_shipping_zone_setup', DKG_VERSION );
				return;
			}
		}
	}

	$zone = new WC_Shipping_Zone();
	$zone->set_zone_name( __( 'Nederland', 'de-kaasgenoten' ) );
	$zone->set_zone_order( 1 );
	$zone->save();
	$zone->add_location( 'NL', 'country' );

	$flat_id = $zone->add_shipping_method( 'flat_rate' );
	$pickup_id = $zone->add_shipping_method( 'local_pickup' );

	if ( $flat_id ) {
		update_option(
			'woocommerce_flat_rate_' . (int) $flat_id . '_settings',
			array(
				'title'      => __( 'Verzending Nederland', 'de-kaasgenoten' ),
				'tax_status' => 'taxable',
				'cost'       => '7.95',
			)
		);
	}

	if ( $pickup_id ) {
		update_option(
			'woocommerce_local_pickup_' . (int) $pickup_id . '_settings',
			array(
				'title'      => __( 'Afhalen op afspraak', 'de-kaasgenoten' ),
				'tax_status' => 'taxable',
				'cost'       => '0',
			)
		);
	}

	update_option( 'dkg_shipping_zone_setup', DKG_VERSION );
}
add_action( 'after_switch_theme', 'dkg_setup_default_shipping_zone', 25 );
add_action( 'init', 'dkg_setup_default_shipping_zone', 30 );

/**
 * Beschrijving onder verzendmethode in checkout.
 *
 * @param WC_Shipping_Rate $method Methode.
 * @param int              $index  Index.
 */
function dkg_shipping_rate_description( $method, $index ) {
	$method_id = $method->get_method_id();
	$label     = $method->get_label();

	if ( 'local_pickup' === $method_id || false !== stripos( $label, 'afhalen' ) ) {
		echo '<p class="dkg-shipping-rate-desc">' . esc_html__( 'Na uw bestelling nemen wij contact met u op om een geschikt afhaalmoment af te spreken op onze locatie in Opmeer.', 'de-kaasgenoten' ) . '</p>';
		return;
	}

	if ( 'flat_rate' === $method_id || false !== stripos( $label, 'verzending' ) ) {
		echo '<p class="dkg-shipping-rate-desc">' . esc_html__( 'Uw bestelling wordt met zorg verwerkt en zo snel mogelijk verzonden. U ontvangt bericht zodra uw pakket is verzonden.', 'de-kaasgenoten' ) . '</p>';
	}
}
add_action( 'woocommerce_after_shipping_rate', 'dkg_shipping_rate_description', 10, 2 );
