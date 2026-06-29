<?php
/**
 * Single product (PDP) aanpassingen.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * PDP-styles laden.
 */
function dkg_enqueue_single_product_assets() {
	if ( ! is_product() ) {
		return;
	}

	wp_enqueue_style(
		'dkg-single-product',
		get_template_directory_uri() . '/assets/css/components/single-product.css',
		array( 'dkg-theme' ),
		DKG_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'dkg_enqueue_single_product_assets', 25 );

/**
 * Extra producttabs voor kaas.
 *
 * @param array<string, array<string, mixed>> $tabs Tabs.
 * @return array<string, array<string, mixed>>
 */
function dkg_product_tabs( $tabs ) {
	global $product;

	if ( ! $product instanceof WC_Product ) {
		return $tabs;
	}

	$storage = get_post_meta( $product->get_id(), '_dkg_storage', true );
	$origin  = get_post_meta( $product->get_id(), '_dkg_origin', true );
	$allergy = get_post_meta( $product->get_id(), '_dkg_allergens', true );

	if ( $origin ) {
		$tabs['dkg_origin'] = array(
			'title'    => __( 'Herkomst', 'de-kaasgenoten' ),
			'priority' => 15,
			'callback' => static function () use ( $origin ) {
				echo wp_kses_post( wpautop( $origin ) );
			},
		);
	}

	if ( $storage ) {
		$tabs['dkg_storage'] = array(
			'title'    => __( 'Bewaren', 'de-kaasgenoten' ),
			'priority' => 20,
			'callback' => static function () use ( $storage ) {
				echo wp_kses_post( wpautop( $storage ) );
			},
		);
	}

	if ( $allergy ) {
		$tabs['dkg_allergens'] = array(
			'title'    => __( 'Allergenen', 'de-kaasgenoten' ),
			'priority' => 25,
			'callback' => static function () use ( $allergy ) {
				echo wp_kses_post( wpautop( $allergy ) );
			},
		);
	} else {
		$tabs['dkg_allergens'] = array(
			'title'    => __( 'Allergenen', 'de-kaasgenoten' ),
			'priority' => 25,
			'callback' => static function () {
				echo '<p>' . esc_html__( 'Bevat melk. Kan sporen van noten bevatten. Zie het etiket voor de volledige allergeneninformatie.', 'de-kaasgenoten' ) . '</p>';
			},
		);
	}

	$tabs['dkg_serving'] = array(
		'title'    => __( 'Serveertips', 'de-kaasgenoten' ),
		'priority' => 30,
		'callback' => 'dkg_render_serving_tab',
	);

	return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'dkg_product_tabs' );

/**
 * Serveertips-tab.
 */
function dkg_render_serving_tab() {
	echo '<p>' . esc_html__( 'Laat de kaas op kamertemperatuur komen voor de beste smaak. Combineer met fruit, noten of een passende wijn voor een complete beleving.', 'de-kaasgenoten' ) . '</p>';
}

/**
 * Gerelateerde producten in thema-grid.
 *
 * @param array<string, mixed> $args Args.
 * @return array<string, mixed>
 */
function dkg_related_products_args( $args ) {
	$args['posts_per_page'] = 4;
	$args['columns']        = 4;

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'dkg_related_products_args' );

/**
 * Sticky add-to-cart op mobiel.
 */
function dkg_sticky_add_to_cart_bar() {
	global $product;

	if ( ! $product instanceof WC_Product || ! $product->is_purchasable() || ! $product->is_in_stock() ) {
		return;
	}
	?>
	<div class="dkg-sticky-atc" id="dkg-sticky-atc" hidden>
		<div class="dkg-container dkg-sticky-atc__inner">
			<div class="dkg-sticky-atc__info">
				<strong><?php echo esc_html( $product->get_name() ); ?></strong>
				<span><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
			</div>
			<a class="dkg-button dkg-button-gold" href="#product-add-to-cart">
				<?php echo esc_html( $product->is_type( 'variable' ) ? __( 'Kies gewicht', 'de-kaasgenoten' ) : __( 'In winkelwagen', 'de-kaasgenoten' ) ); ?>
			</a>
		</div>
	</div>
	<?php
}
add_action( 'woocommerce_after_single_product', 'dkg_sticky_add_to_cart_bar', 5 );

/**
 * Variabele producten: duidelijke knoptekst in loops.
 *
 * @param string     $text    Tekst.
 * @param WC_Product $product Product.
 * @return string
 */
function dkg_loop_add_to_cart_text( $text, $product ) {
	if ( $product instanceof WC_Product && $product->is_type( 'variable' ) ) {
		return __( 'Kies gewicht', 'de-kaasgenoten' );
	}

	return $text;
}
add_filter( 'woocommerce_product_add_to_cart_text', 'dkg_loop_add_to_cart_text', 10, 2 );

/**
 * Product meta-velden in admin (herkomst, bewaren, allergenen).
 */
function dkg_register_product_meta_boxes() {
	add_meta_box(
		'dkg_product_details',
		__( 'Kaasgegevens', 'de-kaasgenoten' ),
		'dkg_render_product_meta_box',
		'product',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'dkg_register_product_meta_boxes' );

/**
 * Meta box renderen.
 *
 * @param WP_Post $post Post.
 */
function dkg_render_product_meta_box( $post ) {
	wp_nonce_field( 'dkg_save_product_meta', 'dkg_product_meta_nonce' );

	$fields = array(
		'_dkg_origin'    => __( 'Herkomst', 'de-kaasgenoten' ),
		'_dkg_storage'   => __( 'Bewaren', 'de-kaasgenoten' ),
		'_dkg_allergens' => __( 'Allergenen', 'de-kaasgenoten' ),
	);

	foreach ( $fields as $key => $label ) {
		$value = get_post_meta( $post->ID, $key, true );
		echo '<p><label for="' . esc_attr( $key ) . '"><strong>' . esc_html( $label ) . '</strong></label></p>';
		echo '<textarea class="widefat" rows="3" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '">' . esc_textarea( $value ) . '</textarea>';
	}
}

/**
 * Meta box opslaan.
 *
 * @param int $post_id Post-ID.
 */
function dkg_save_product_meta( $post_id ) {
	if ( ! isset( $_POST['dkg_product_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['dkg_product_meta_nonce'] ) ), 'dkg_save_product_meta' ) ) {
		return;
	}

	foreach ( array( '_dkg_origin', '_dkg_storage', '_dkg_allergens' ) as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_textarea_field( wp_unslash( $_POST[ $key ] ) ) );
		}
	}
}
add_action( 'save_post_product', 'dkg_save_product_meta' );
