<?php
/**
 * Maakt automatisch de benodigde pagina's aan bij thema-activatie,
 * zodat de links in de footer en het thema nooit op een 404 uitkomen.
 *
 * Bestaande pagina's worden nooit overschreven of verwijderd.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Lijst met pagina's die het thema verwacht.
 *
 * slug => array( title, template ). Template is leeg wanneer de
 * slug automatisch matcht met een page-{slug}.php bestand.
 *
 * @return array<string, array<string, string>>
 */
function dkg_required_pages() {
	return array(
		'over-ons'                            => array(
			'title'    => __( 'Over ons', 'de-kaasgenoten' ),
			'template' => 'page-over-ons.php',
		),
		'contact'                             => array(
			'title'    => __( 'Contact', 'de-kaasgenoten' ),
			'template' => 'page-contact.php',
		),
		'veelgestelde-vragen'                 => array(
			'title'    => __( 'Veelgestelde vragen', 'de-kaasgenoten' ),
			'template' => 'page-veelgestelde-vragen.php',
		),
		'levering-verzending'                 => array(
			'title'    => __( 'Levering & verzending', 'de-kaasgenoten' ),
			'template' => 'page-levering-verzending.php',
		),
		'terugbetaal-en-retourneringsbeleid'  => array(
			'title'    => __( 'Retour- en terugbetaalbeleid', 'de-kaasgenoten' ),
			'template' => 'page-terugbetaal-en-retourneringsbeleid.php',
		),
		'privacy-policy'                      => array(
			'title'    => __( 'Privacybeleid', 'de-kaasgenoten' ),
			'template' => 'page-privacy-policy.php',
		),
		'algemene-voorwaarden'                => array(
			'title'    => __( 'Algemene voorwaarden', 'de-kaasgenoten' ),
			'template' => 'page-algemene-voorwaarden.php',
		),
		'cookiebeleid'                        => array(
			'title'    => __( 'Cookiebeleid', 'de-kaasgenoten' ),
			'template' => 'page-cookiebeleid.php',
		),
		'disclaimer'                          => array(
			'title'    => __( 'Disclaimer', 'de-kaasgenoten' ),
			'template' => 'page-disclaimer.php',
		),
	);
}

/**
 * Maak ontbrekende pagina's aan.
 */
function dkg_create_required_pages() {
	foreach ( dkg_required_pages() as $slug => $page ) {
		$existing = get_page_by_path( $slug );

		// Pagina bestaat al: zorg alleen dat het juiste template gekoppeld is.
		if ( $existing instanceof WP_Post ) {
			if ( ! empty( $page['template'] ) ) {
				$current = get_post_meta( $existing->ID, '_wp_page_template', true );

				if ( '' === $current || 'default' === $current ) {
					update_post_meta( $existing->ID, '_wp_page_template', $page['template'] );
				}
			}
			continue;
		}

		$page_id = wp_insert_post(
			array(
				'post_title'   => $page['title'],
				'post_name'    => $slug,
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_content' => '',
				'post_author'  => get_current_user_id() ? get_current_user_id() : 1,
			)
		);

		if ( $page_id && ! is_wp_error( $page_id ) && ! empty( $page['template'] ) ) {
			update_post_meta( $page_id, '_wp_page_template', $page['template'] );
		}
	}
}
add_action( 'after_switch_theme', 'dkg_create_required_pages' );
