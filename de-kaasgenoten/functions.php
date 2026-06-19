<?php
/**
 * Theme setup and helpers.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'DKG_VERSION', '1.4.3' );

function dkg_asset_uri( $path = '' ) {
	return esc_url( get_template_directory_uri() . '/assets/' . ltrim( $path, '/' ) );
}

function dkg_page_url( $path ) {
	$path = trim( $path, '/' );
	$page = get_page_by_path( $path );

	if ( $page instanceof WP_Post && 'publish' === $page->post_status ) {
		return get_permalink( $page );
	}

	return home_url( '/' . $path . '/' );
}

function dkg_shop_url() {
	if ( class_exists( 'WooCommerce' ) ) {
		return wc_get_page_permalink( 'shop' );
	}

	return dkg_page_url( 'winkel' );
}

function dkg_product_category_url( $slug, $fallback = '' ) {
	if ( class_exists( 'WooCommerce' ) && taxonomy_exists( 'product_cat' ) ) {
		$term = get_term_by( 'slug', $slug, 'product_cat' );

		if ( $term && ! is_wp_error( $term ) ) {
			$link = get_term_link( $term );

			if ( ! is_wp_error( $link ) ) {
				return $link;
			}
		}
	}

	return $fallback ? dkg_page_url( $fallback ) : dkg_shop_url();
}

function dkg_flush_rewrites_on_switch() {
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'dkg_flush_rewrites_on_switch' );

function dkg_maybe_flush_rewrites_after_update() {
	if ( get_option( 'dkg_theme_version' ) === DKG_VERSION ) {
		return;
	}

	flush_rewrite_rules();
	update_option( 'dkg_theme_version', DKG_VERSION );
}
add_action( 'init', 'dkg_maybe_flush_rewrites_after_update', 20 );

function dkg_setup() {
	load_theme_textdomain( 'de-kaasgenoten', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array(
		'height'      => 120,
		'width'       => 320,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	add_image_size( 'dkg-card', 720, 475, true );
	add_image_size( 'dkg-hero', 1728, 910, true );

	register_nav_menus( array(
		'primary' => __( 'Hoofdmenu', 'de-kaasgenoten' ),
		'footer'  => __( 'Footermenu', 'de-kaasgenoten' ),
	) );
}
add_action( 'after_setup_theme', 'dkg_setup' );

function dkg_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer nieuwsbrief', 'de-kaasgenoten' ),
			'id'            => 'footer-newsletter',
			'description'   => __( 'Plaats hier bijvoorbeeld het MailPoet inschrijfformulier.', 'de-kaasgenoten' ),
			'before_widget' => '<div id="%1$s" class="dkg-newsletter-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'dkg_widgets_init' );

function dkg_enqueue_assets() {
	wp_enqueue_style( 'dkg-theme', get_template_directory_uri() . '/assets/css/theme.css', array(), DKG_VERSION );
	wp_enqueue_script( 'dkg-theme', get_template_directory_uri() . '/assets/js/theme.js', array(), DKG_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'dkg_enqueue_assets' );

function dkg_icon( $name ) {
	$icons = array(
		'search' => '<svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7"></circle><path d="m20 20-4.2-4.2"></path></svg>',
		'user'   => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20 21a8 8 0 0 0-16 0"></path><circle cx="12" cy="7" r="4"></circle></svg>',
		'cart'   => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 6h15l-2 9H8L6 3H3"></path><circle cx="9" cy="20" r="1.5"></circle><circle cx="18" cy="20" r="1.5"></circle></svg>',
		'heart'  => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1-1.1a5.5 5.5 0 0 0-7.8 7.8L12 21l8.8-8.6a5.5 5.5 0 0 0 0-7.8Z"></path></svg>',
		'truck'  => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 7h11v10H3z"></path><path d="M14 10h4l3 3v4h-7z"></path><circle cx="7" cy="19" r="2"></circle><circle cx="18" cy="19" r="2"></circle></svg>',
		'award'  => '<svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="8" r="5"></circle><path d="m8.5 13-2 8 5.5-3 5.5 3-2-8"></path></svg>',
		'leaf'   => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20 4C9 5 4 10 4 20c10 0 15-5 16-16Z"></path><path d="M4 20 15 9"></path></svg>',
		'gift'   => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20 12v9H4v-9"></path><path d="M2 7h20v5H2z"></path><path d="M12 7v14"></path><path d="M12 7H8a2 2 0 1 1 2-2c0 2 2 2 2 2Zm0 0h4a2 2 0 1 0-2-2c0 2-2 2-2 2Z"></path></svg>',
		'box'    => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="m3 7 9-4 9 4-9 4Z"></path><path d="M3 7v10l9 4 9-4V7"></path><path d="M12 11v10"></path></svg>',
		'cheese' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 14 12 4l8 10H4Z"></path><circle cx="9" cy="13" r="1.2"></circle><circle cx="14" cy="11" r="1.2"></circle></svg>',
		'farm'   => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 20V10l9-6 9 6v10"></path><path d="M9 20v-6h6v6"></path><path d="M3 10h18"></path></svg>',
		'knife'  => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="m4 20 16-16"></path><path d="m14 4 6 6"></path><path d="M4 20h4"></path></svg>',
		'hand'   => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 11V7a2 2 0 1 1 4 0v4"></path><path d="M11 11V6a2 2 0 1 1 4 0v7"></path><path d="M15 10V8a2 2 0 1 1 4 0v9a5 5 0 0 1-5 5H9a4 4 0 0 1-4-4v-3a2 2 0 1 1 4 0"></path></svg>',
		'service'=> '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 5h16v10H8l-4 4V5Z"></path><path d="M8 10h8M8 13h5"></path></svg>',
		'star'   => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="m12 3 2.4 5.8 6.3.5-4.8 4.1 1.5 6.1L12 16.8 6.6 19.5l1.5-6.1L3.3 9.3l6.3-.5L12 3Z"></path></svg>',
		'shield' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3 5 6v6c0 4.4 3 8.5 7 9 4-.5 7-4.6 7-9V6l-7-3Z"></path><path d="m9.5 12 2 2 4-4"></path></svg>',
		'pin'    => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 21s7-5.5 7-11a7 7 0 1 0-14 0c0 5.5 7 11 7 11Z"></path><circle cx="12" cy="10" r="2.6"></circle></svg>',
		'phone'  => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 3h3l2 5-2.5 1.5a11 11 0 0 0 5 5L21 13l-1 5a2 2 0 0 1-2 1.6A15 15 0 0 1 4.4 6 2 2 0 0 1 6 3Z"></path></svg>',
		'mail'   => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 6h18v12H3z"></path><path d="m3 7 9 6 9-6"></path></svg>',
		'clock'  => '<svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="8.5"></circle><path d="M12 7v5l3.5 2"></path></svg>',
		'facebook'  => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14 8.5h2.5V5.5H14c-2 0-3.3 1.4-3.3 3.4v1.6H8.5v3h2.2V21h3v-7.5h2.3l.5-3h-2.8V9.2c0-.5.3-.7.8-.7Z"></path></svg>',
		'instagram' => '<svg viewBox="0 0 24 24" aria-hidden="true"><rect x="4" y="4" width="16" height="16" rx="4.5"></rect><circle cx="12" cy="12" r="3.6"></circle><circle cx="16.6" cy="7.4" r="1"></circle></svg>',
		'pinterest' => '<svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9"></circle><path d="M12 7.5c-2.2 0-3.7 1.5-3.7 3.4 0 1 .5 2 1.4 2.3.2.1.3 0 .3-.2l.1-.6c0-.2 0-.3-.1-.4-.3-.3-.4-.7-.4-1.2 0-1.4 1.1-2.5 2.7-2.5 1.5 0 2.3.9 2.3 2.1 0 1.6-.7 2.9-1.7 2.9-.6 0-1-.5-.9-1.1.2-.7.5-1.4.5-1.9 0-.4-.2-.8-.7-.8-.6 0-1 .6-1 1.4 0 .5.2.8.2.8L10.5 17c-.2 1 0 2.1 0 2.2l.1.1.1-.1c.2-.2.8-1.2 1-2l.4-1.4c.3.5.9.8 1.6.8 2 0 3.5-1.9 3.5-4.4 0-1.9-1.6-3.7-4.2-3.7Z"></path></svg>',
	);

	return isset( $icons[ $name ] ) ? $icons[ $name ] : '';
}

/**
 * Beoordeling/reviews voor de homepage.
 *
 * Vul 'score' en 'count' alleen met verifieerbare cijfers (geen misleidende
 * claims). Aanpasbaar via de filter 'dkg_trust_rating' of een child-thema.
 *
 * @return array<string, mixed>
 */
function dkg_trust_rating() {
	return apply_filters(
		'dkg_trust_rating',
		array(
			'show'  => true,
			'score' => '', // bijvoorbeeld '4,9/5'
			'count' => '', // bijvoorbeeld '500+ reviews'
		)
	);
}

require get_template_directory() . '/inc/woocommerce.php';
require get_template_directory() . '/inc/luxe-pages.php';
require get_template_directory() . '/inc/about-page.php';
require get_template_directory() . '/inc/contact-page.php';
require get_template_directory() . '/inc/legal-pages.php';
require get_template_directory() . '/inc/page-setup.php';

if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/variation-order.php';
}
