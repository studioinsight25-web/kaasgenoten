<?php
/**
 * Thema-instellingen via de Customizer.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme mod ophalen met fallback.
 *
 * @param string $key     Mod-sleutel.
 * @param string $default Standaardwaarde.
 * @return string
 */
function dkg_get_mod( $key, $default = '' ) {
	$value = get_theme_mod( $key, $default );

	return is_string( $value ) ? $value : (string) $default;
}

/**
 * Vul bedrijfsgegevens aan vanuit Customizer.
 *
 * @param array<string, string> $details Bestaande details.
 * @return array<string, string>
 */
function dkg_company_details_from_customizer( $details ) {
	$map = array(
		'name'       => 'dkg_company_name',
		'legal_name' => 'dkg_company_legal_name',
		'street'     => 'dkg_company_street',
		'postal'     => 'dkg_company_postal',
		'city'       => 'dkg_company_city',
		'country'    => 'dkg_company_country',
		'email'      => 'dkg_company_email',
		'phone'      => 'dkg_company_phone',
		'phone_href' => 'dkg_company_phone_href',
		'kvk'        => 'dkg_company_kvk',
		'btw'        => 'dkg_company_btw',
		'iban'       => 'dkg_company_iban',
	);

	foreach ( $map as $field => $mod_key ) {
		$value = dkg_get_mod( $mod_key );

		if ( '' !== $value ) {
			$details[ $field ] = $value;
		}
	}

	return $details;
}
add_filter( 'dkg_company_details', 'dkg_company_details_from_customizer' );

/**
 * Social media links.
 *
 * @return array<int, array<string, string>>
 */
function dkg_social_links() {
	$links = array(
		array(
			'icon'  => 'facebook',
			'label' => 'Facebook',
			'url'   => dkg_get_mod( 'dkg_social_facebook' ),
		),
		array(
			'icon'  => 'instagram',
			'label' => 'Instagram',
			'url'   => dkg_get_mod( 'dkg_social_instagram' ),
		),
		array(
			'icon'  => 'pinterest',
			'label' => 'Pinterest',
			'url'   => dkg_get_mod( 'dkg_social_pinterest' ),
		),
	);

	$filtered = array();

	foreach ( $links as $link ) {
		if ( ! empty( $link['url'] ) ) {
			$filtered[] = $link;
		}
	}

	return apply_filters( 'dkg_social_links', $filtered );
}

/**
 * Topbar-berichten.
 *
 * @return array<int, string>
 */
function dkg_topbar_messages() {
	$messages = array(
		dkg_get_mod( 'dkg_topbar_1', __( 'Vers afgesneden op bestelling', 'de-kaasgenoten' ) ),
		dkg_get_mod( 'dkg_topbar_2', __( 'Zorgvuldig verpakt en verzonden', 'de-kaasgenoten' ) ),
		dkg_get_mod( 'dkg_topbar_3', __( 'Afhalen op afspraak mogelijk', 'de-kaasgenoten' ) ),
	);

	return array_values(
		array_filter(
			apply_filters( 'dkg_topbar_messages', $messages ),
			static function ( $message ) {
				return '' !== trim( (string) $message );
			}
		)
	);
}

/**
 * Trust rating vanuit Customizer.
 *
 * @param array<string, mixed> $rating Bestaande rating.
 * @return array<string, mixed>
 */
function dkg_trust_rating_from_customizer( $rating ) {
	$score = dkg_get_mod( 'dkg_trust_score' );
	$count = dkg_get_mod( 'dkg_trust_count' );

	if ( $score ) {
		$rating['score'] = $score;
	}

	if ( $count ) {
		$rating['count'] = $count;
	}

	return $rating;
}
add_filter( 'dkg_trust_rating', 'dkg_trust_rating_from_customizer' );

/**
 * Homepage hero-teksten.
 *
 * @return array<string, string>
 */
function dkg_homepage_hero() {
	return array(
		'eyebrow'    => dkg_get_mod( 'dkg_home_eyebrow', __( 'Kaas, delicatessen & geschenken', 'de-kaasgenoten' ) ),
		'title'      => dkg_get_mod( 'dkg_home_title', __( 'Voor elke gelegenheid het perfecte cadeau', 'de-kaasgenoten' ) ),
		'text'       => dkg_get_mod( 'dkg_home_text', __( 'Ambachtelijke kazen van onze marktkraam, heerlijke delicatessen en smaakvolle geschenkpakketten. Met zorg samengesteld, met liefde gegeven.', 'de-kaasgenoten' ) ),
		'cta_primary'   => dkg_get_mod( 'dkg_home_cta_primary', __( 'Bekijk cadeaupakketten', 'de-kaasgenoten' ) ),
		'cta_secondary' => dkg_get_mod( 'dkg_home_cta_secondary', __( 'Bekijk ons kaasassortiment', 'de-kaasgenoten' ) ),
	);
}

/**
 * Customizer-secties registreren.
 *
 * @param WP_Customize_Manager $wp_customize Manager.
 */
function dkg_customize_register( $wp_customize ) {
	$wp_customize->add_panel(
		'dkg_theme_options',
		array(
			'title'    => __( 'De Kaasgenoten', 'de-kaasgenoten' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_section(
		'dkg_company',
		array(
			'title' => __( 'Bedrijfsgegevens', 'de-kaasgenoten' ),
			'panel' => 'dkg_theme_options',
		)
	);

	$company_fields = array(
		'dkg_company_name'       => __( 'Naam', 'de-kaasgenoten' ),
		'dkg_company_legal_name' => __( 'Juridische naam', 'de-kaasgenoten' ),
		'dkg_company_street'     => __( 'Straat + huisnummer', 'de-kaasgenoten' ),
		'dkg_company_postal'     => __( 'Postcode', 'de-kaasgenoten' ),
		'dkg_company_city'       => __( 'Plaats', 'de-kaasgenoten' ),
		'dkg_company_country'    => __( 'Land', 'de-kaasgenoten' ),
		'dkg_company_email'      => __( 'E-mail', 'de-kaasgenoten' ),
		'dkg_company_phone'      => __( 'Telefoon (weergave)', 'de-kaasgenoten' ),
		'dkg_company_phone_href' => __( 'Telefoon (link, bijv. +31416123456)', 'de-kaasgenoten' ),
		'dkg_company_kvk'        => __( 'KvK-nummer', 'de-kaasgenoten' ),
		'dkg_company_btw'        => __( 'BTW-nummer', 'de-kaasgenoten' ),
		'dkg_company_iban'       => __( 'IBAN', 'de-kaasgenoten' ),
	);

	foreach ( $company_fields as $id => $label ) {
		$wp_customize->add_setting( $id, array( 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_control( $id, array( 'label' => $label, 'section' => 'dkg_company', 'type' => 'text' ) );
	}

	$wp_customize->add_section(
		'dkg_social',
		array(
			'title' => __( 'Social media', 'de-kaasgenoten' ),
			'panel' => 'dkg_theme_options',
		)
	);

	foreach ( array( 'facebook', 'instagram', 'pinterest' ) as $network ) {
		$id = 'dkg_social_' . $network;
		$wp_customize->add_setting( $id, array( 'sanitize_callback' => 'esc_url_raw' ) );
		$wp_customize->add_control( $id, array( 'label' => ucfirst( $network ), 'section' => 'dkg_social', 'type' => 'url' ) );
	}

	$wp_customize->add_section(
		'dkg_topbar',
		array(
			'title' => __( 'Topbar', 'de-kaasgenoten' ),
			'panel' => 'dkg_theme_options',
		)
	);

	for ( $i = 1; $i <= 3; $i++ ) {
		$id = 'dkg_topbar_' . $i;
		$wp_customize->add_setting( $id, array( 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_control( $id, array( 'label' => sprintf( __( 'Regel %d', 'de-kaasgenoten' ), $i ), 'section' => 'dkg_topbar', 'type' => 'text' ) );
	}

	$wp_customize->add_section(
		'dkg_trust',
		array(
			'title' => __( 'Reviews / vertrouwen', 'de-kaasgenoten' ),
			'panel' => 'dkg_theme_options',
		)
	);

	$wp_customize->add_setting( 'dkg_trust_score', array( 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'dkg_trust_score', array( 'label' => __( 'Score (bijv. 4,9/5)', 'de-kaasgenoten' ), 'section' => 'dkg_trust', 'type' => 'text' ) );

	$wp_customize->add_setting( 'dkg_trust_count', array( 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'dkg_trust_count', array( 'label' => __( 'Aantal reviews (bijv. 500+ reviews)', 'de-kaasgenoten' ), 'section' => 'dkg_trust', 'type' => 'text' ) );

	$wp_customize->add_section(
		'dkg_homepage',
		array(
			'title' => __( 'Homepage', 'de-kaasgenoten' ),
			'panel' => 'dkg_theme_options',
		)
	);

	$homepage_fields = array(
		'dkg_home_eyebrow'    => __( 'Hero eyebrow', 'de-kaasgenoten' ),
		'dkg_home_title'      => __( 'Hero titel', 'de-kaasgenoten' ),
		'dkg_home_text'       => __( 'Hero tekst', 'de-kaasgenoten' ),
		'dkg_home_cta_primary'   => __( 'Primaire knoptekst', 'de-kaasgenoten' ),
		'dkg_home_cta_secondary' => __( 'Secundaire knoptekst', 'de-kaasgenoten' ),
	);

	foreach ( $homepage_fields as $id => $label ) {
		$wp_customize->add_setting( $id, array( 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_control( $id, array( 'label' => $label, 'section' => 'dkg_homepage', 'type' => 'text' ) );
	}
}
add_action( 'customize_register', 'dkg_customize_register' );
