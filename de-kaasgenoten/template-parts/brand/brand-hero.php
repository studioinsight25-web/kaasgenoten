<?php
/**
 * Merkpagina – hero.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$brand = isset( $args['brand'] ) ? $args['brand'] : array();
$term  = isset( $args['term'] ) && $args['term'] instanceof WP_Term ? $args['term'] : null;

if ( ! $term ) {
	return;
}

$hero_url = dkg_brand_hero_image_url( $brand, $term );
$eyebrow  = ! empty( $brand['eyebrow'] ) ? $brand['eyebrow'] : '';
$intro    = ! empty( $brand['intro'] ) ? $brand['intro'] : term_description( $term );
$style    = $hero_url ? ' style="background-image: url(\'' . esc_url( $hero_url ) . '\');"' : '';
?>
<section class="dkg-brand-hero"<?php echo $style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="dkg-container">
		<?php
		woocommerce_breadcrumb(
			array(
				'wrap_before' => '<nav class="dkg-woo-breadcrumb" aria-label="' . esc_attr__( 'Breadcrumb', 'de-kaasgenoten' ) . '">',
				'wrap_after'  => '</nav>',
			)
		);
		?>
		<?php if ( $eyebrow ) : ?>
			<p class="dkg-eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
		<?php endif; ?>
		<h1><?php echo esc_html( $term->name ); ?></h1>
		<?php if ( $intro ) : ?>
			<p class="dkg-brand-intro"><?php echo esc_html( wp_strip_all_tags( $intro ) ); ?></p>
		<?php endif; ?>
	</div>
</section>
