<?php
/**
 * Variation attribute ordering.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return the fixed display order for the global Gewicht attribute.
 *
 * WooCommerce normally follows the term order for taxonomy attributes. This
 * filter keeps the storefront resilient when generated variations or term data
 * are returned in another order.
 *
 * @return string[]
 */
function dkg_weight_variation_order() {
	return array(
		'250 gram',
		'500 gram',
		'1000 gram',
		'2000 gram',
	);
}

/**
 * Normalize a weight label, slug, or raw option value for ordering.
 *
 * @param string $value Option label, slug, or attribute value.
 * @return string
 */
function dkg_normalize_weight_option( $value ) {
	$value = strtolower( sanitize_text_field( wp_unslash( (string) $value ) ) );
	$value = str_replace( array( '-', '_' ), ' ', $value );
	$value = preg_replace( '/\s+/', ' ', $value );

	return trim( $value );
}

/**
 * Build lookup data for available weight options.
 *
 * @param string[] $options   Current dropdown options.
 * @param string   $attribute Attribute taxonomy name.
 * @return array<string,string>
 */
function dkg_weight_option_lookup( $options, $attribute ) {
	$lookup = array();

	foreach ( $options as $option ) {
		$lookup[ dkg_normalize_weight_option( $option ) ] = $option;
	}

	if ( taxonomy_exists( $attribute ) ) {
		$terms = get_terms(
			array(
				'taxonomy'   => $attribute,
				'hide_empty' => false,
			)
		);

		if ( ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				if ( in_array( $term->slug, $options, true ) ) {
					$lookup[ dkg_normalize_weight_option( $term->slug ) ] = $term->slug;
					$lookup[ dkg_normalize_weight_option( $term->name ) ] = $term->slug;
				}
			}
		}
	}

	return $lookup;
}

/**
 * Sort weight option values in the desired storefront order.
 *
 * @param string[] $options   Current dropdown options.
 * @param string   $attribute Attribute taxonomy name.
 * @return string[]
 */
function dkg_sort_weight_options( $options, $attribute ) {
	$options = array_values( $options );
	$lookup  = dkg_weight_option_lookup( $options, $attribute );
	$sorted  = array();

	foreach ( dkg_weight_variation_order() as $weight ) {
		$key = dkg_normalize_weight_option( $weight );

		if ( isset( $lookup[ $key ] ) && in_array( $lookup[ $key ], $options, true ) ) {
			$sorted[] = $lookup[ $key ];
		}
	}

	foreach ( $options as $option ) {
		if ( ! in_array( $option, $sorted, true ) ) {
			$sorted[] = $option;
		}
	}

	return $sorted;
}

/**
 * Sort the Gewicht variation dropdown args in the desired storefront order.
 *
 * @param array $args Dropdown arguments passed to wc_dropdown_variation_attribute_options().
 * @return array
 */
function dkg_sort_weight_variation_dropdown_options( $args ) {
	if ( empty( $args['attribute'] ) || 'pa_gewicht' !== $args['attribute'] || empty( $args['options'] ) || ! is_array( $args['options'] ) ) {
		return $args;
	}

	$args['options'] = dkg_sort_weight_options( $args['options'], $args['attribute'] );

	return $args;
}
add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'dkg_sort_weight_variation_dropdown_options', 20 );

/**
 * Return the display label for a variation option.
 *
 * @param string     $option    Option value.
 * @param string     $attribute Attribute taxonomy name.
 * @param WC_Product $product   Product object.
 * @return string
 */
function dkg_get_variation_option_label( $option, $attribute, $product ) {
	$label = $option;
	$term  = taxonomy_exists( $attribute ) ? get_term_by( 'slug', $option, $attribute ) : false;

	if ( $term instanceof WP_Term ) {
		$label = $term->name;
	}

	return apply_filters( 'woocommerce_variation_option_name', $label, $term, $attribute, $product );
}

/**
 * Rebuild only the Gewicht variation dropdown HTML to enforce option order.
 *
 * WooCommerce uses term menu_order for global attributes, but generated
 * variations can still surface in an unexpected order. Rebuilding the select
 * for this one attribute preserves the standard variation form contract while
 * making the display order deterministic.
 *
 * @param string $html Existing dropdown HTML.
 * @param array  $args Dropdown arguments.
 * @return string
 */
function dkg_weight_variation_dropdown_html( $html, $args ) {
	if ( empty( $args['attribute'] ) || 'pa_gewicht' !== $args['attribute'] || empty( $args['options'] ) || ! is_array( $args['options'] ) ) {
		return $html;
	}

	$product = ! empty( $args['product'] ) && $args['product'] instanceof WC_Product ? $args['product'] : false;

	if ( ! $product ) {
		return $html;
	}

	$attribute            = $args['attribute'];
	$options              = dkg_sort_weight_options( $args['options'], $attribute );
	$name                 = ! empty( $args['name'] ) ? $args['name'] : 'attribute_' . sanitize_title( $attribute );
	$id                   = ! empty( $args['id'] ) ? $args['id'] : sanitize_title( $attribute );
	$class                = ! empty( $args['class'] ) ? $args['class'] : '';
	$selected             = isset( $args['selected'] ) ? $args['selected'] : $product->get_variation_default_attribute( $attribute );
	$show_option_none     = isset( $args['show_option_none'] ) ? $args['show_option_none'] : __( 'Choose an option', 'woocommerce' );
	$show_option_none_txt = true === $show_option_none ? __( 'Choose an option', 'woocommerce' ) : $show_option_none;

	$dropdown  = '<select id="' . esc_attr( $id ) . '" class="' . esc_attr( $class ) . '" name="' . esc_attr( $name ) . '" data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute ) ) . '" data-show_option_none="' . ( $show_option_none ? 'yes' : 'no' ) . '">';
	$dropdown .= '<option value="">' . esc_html( $show_option_none_txt ) . '</option>';

	foreach ( $options as $option ) {
		$dropdown .= '<option value="' . esc_attr( $option ) . '" ' . selected( sanitize_title( $selected ), sanitize_title( $option ), false ) . '>' . esc_html( dkg_get_variation_option_label( $option, $attribute, $product ) ) . '</option>';
	}

	$dropdown .= '</select>';

	return $dropdown;
}
add_filter( 'woocommerce_dropdown_variation_attribute_options_html', 'dkg_weight_variation_dropdown_html', 20, 2 );
