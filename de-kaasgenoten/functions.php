<?php
/**
 * Theme setup and helpers.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'DKG_VERSION', '1.0.0' );

function dkg_asset_uri( $path = '' ) {
	return esc_url( get_template_directory_uri() . '/assets/' . ltrim( $path, '/' ) );
}

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

	register_nav_menus( array(
		'primary' => __( 'Hoofdmenu', 'de-kaasgenoten' ),
		'footer'  => __( 'Footermenu', 'de-kaasgenoten' ),
	) );
}
add_action( 'after_setup_theme', 'dkg_setup' );

function dkg_enqueue_assets() {
	wp_enqueue_style( 'dkg-theme', get_template_directory_uri() . '/assets/css/theme.css', array(), DKG_VERSION );
	wp_enqueue_script( 'dkg-theme', get_template_directory_uri() . '/assets/js/theme.js', array(), DKG_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'dkg_enqueue_assets' );

function dkg_menu_fallback() {
	$items = array(
		'Kaas'                  => '/product-category/kaas/',
		'Delicatessen'          => '/product-category/delicatessen/',
		'Pakketten & Geschenken' => '/product-category/pakketten-geschenken/',
		'Zakelijk'              => '/zakelijk/',
		'Over ons'              => '/over-ons/',
		'Contact'               => '/contact/',
	);

	echo '<ul id="primary-menu" class="dkg-menu">';
	foreach ( $items as $label => $url ) {
		printf(
			'<li><a href="%s">%s</a></li>',
			esc_url( home_url( $url ) ),
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

function dkg_cart_count() {
	if ( ! class_exists( 'WooCommerce' ) || ! WC()->cart ) {
		return 0;
	}

	return (int) WC()->cart->get_cart_contents_count();
}

function dkg_cart_count_fragment( $fragments ) {
	ob_start();
	?>
	<span class="dkg-cart-count"><?php echo esc_html( dkg_cart_count() ); ?></span>
	<?php
	$fragments['span.dkg-cart-count'] = ob_get_clean();
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'dkg_cart_count_fragment' );

function dkg_fallback_products() {
	return array(
		array( 'name' => 'Oude Hollandse Kaas', 'weight' => '500 gram', 'price' => '€ 8,95', 'image' => 'product-oude.jpg' ),
		array( 'name' => 'Extra Belegen Kaas', 'weight' => '500 gram', 'price' => '€ 7,95', 'image' => 'product-extra.jpg' ),
		array( 'name' => 'Jonge Belegen Kaas', 'weight' => '500 gram', 'price' => '€ 6,95', 'image' => 'product-jonge.jpg' ),
		array( 'name' => 'Boerenkaas Overjarig', 'weight' => '500 gram', 'price' => '€ 9,95', 'image' => 'product-boeren.jpg' ),
		array( 'name' => 'Truffelkaas', 'weight' => '500 gram', 'price' => '€ 10,95', 'image' => 'product-truffel.jpg' ),
		array( 'name' => 'Geitenkaas Naturel', 'weight' => '500 gram', 'price' => '€ 7,95', 'image' => 'product-geiten.jpg' ),
	);
}

function dkg_product_card_from_product( $product ) {
	$product_id = $product->get_id();
	?>
	<article class="dkg-product-card">
		<a class="dkg-product-image" href="<?php echo esc_url( get_permalink( $product_id ) ); ?>">
			<?php echo $product->get_image( 'woocommerce_thumbnail' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</a>
		<div class="dkg-product-body">
			<h3><a href="<?php echo esc_url( get_permalink( $product_id ) ); ?>"><?php echo esc_html( $product->get_name() ); ?></a></h3>
			<?php if ( $product->get_weight() ) : ?>
				<p><?php echo esc_html( wc_format_weight( $product->get_weight() ) ); ?></p>
			<?php endif; ?>
			<div class="dkg-product-price"><?php echo wp_kses_post( $product->get_price_html() ); ?></div>
			<div class="dkg-product-actions">
				<a class="button dkg-add-to-cart" href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" data-quantity="1" data-product_id="<?php echo esc_attr( $product_id ); ?>" data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>" aria-label="<?php echo esc_attr( $product->add_to_cart_description() ); ?>" rel="nofollow">
					<?php esc_html_e( 'In winkelwagen', 'de-kaasgenoten' ); ?>
				</a>
				<span class="dkg-wishlist" aria-hidden="true"><?php echo dkg_icon( 'heart' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
			</div>
		</div>
	</article>
	<?php
}

function dkg_product_card_from_fallback( $product ) {
	?>
	<article class="dkg-product-card">
		<a class="dkg-product-image" href="<?php echo esc_url( home_url( '/winkel/' ) ); ?>">
			<img src="<?php echo dkg_asset_uri( 'images/' . $product['image'] ); ?>" alt="<?php echo esc_attr( $product['name'] ); ?>">
		</a>
		<div class="dkg-product-body">
			<h3><a href="<?php echo esc_url( home_url( '/winkel/' ) ); ?>"><?php echo esc_html( $product['name'] ); ?></a></h3>
			<p><?php echo esc_html( $product['weight'] ); ?></p>
			<div class="dkg-product-price"><?php echo esc_html( $product['price'] ); ?></div>
			<div class="dkg-product-actions">
				<a class="button dkg-add-to-cart" href="<?php echo esc_url( home_url( '/winkel/' ) ); ?>"><?php esc_html_e( 'In winkelwagen', 'de-kaasgenoten' ); ?></a>
				<span class="dkg-wishlist" aria-hidden="true"><?php echo dkg_icon( 'heart' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
			</div>
		</div>
	</article>
	<?php
}

function dkg_popular_products() {
	if ( class_exists( 'WooCommerce' ) ) {
		$products = wc_get_products( array(
			'status'  => 'publish',
			'limit'   => 6,
			'orderby' => 'popularity',
			'order'   => 'DESC',
		) );

		if ( ! empty( $products ) ) {
			foreach ( $products as $product ) {
				dkg_product_card_from_product( $product );
			}
			return;
		}
	}

	foreach ( dkg_fallback_products() as $product ) {
		dkg_product_card_from_fallback( $product );
	}
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
