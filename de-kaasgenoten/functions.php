<?php
/**
 * Theme setup and helpers.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'DKG_VERSION', '1.0.1' );

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

function dkg_menu_fallback() {
	$items = array(
		'Kaas & Delicatessen' => 'kaas-delicatessen',
		'Borrelpakketten'     => 'borrelpakketten',
		'Kerstpakketten'      => 'kerstpakketten',
		'Relatiegeschenken'   => 'relatiegeschenken',
		'Zakelijk'            => 'zakelijk',
		'Contact'             => 'contact',
	);

	echo '<ul id="primary-menu" class="dkg-menu">';
	foreach ( $items as $label => $url ) {
		printf(
			'<li><a href="%s">%s</a></li>',
			esc_url( dkg_page_url( $url ) ),
			esc_html( $label )
		);
	}
	echo '</ul>';
}

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
	);

	return isset( $icons[ $name ] ) ? $icons[ $name ] : '';
}

require get_template_directory() . '/inc/woocommerce.php';
require get_template_directory() . '/inc/luxe-pages.php';
