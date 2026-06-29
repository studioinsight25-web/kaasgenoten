<?php
/**
 * Aanbiedingen – premium categoriepagina.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$term = isset( $args['term'] ) && $args['term'] instanceof WP_Term ? $args['term'] : null;
$luxe = isset( $args['luxe'] ) ? $args['luxe'] : array();

if ( ! $term || empty( $luxe ) ) {
	return;
}

$hero_image = ! empty( $luxe['image'] ) ? dkg_asset_uri( 'images/' . $luxe['image'] ) : '';
$intro      = ! empty( $luxe['intro'] ) ? $luxe['intro'] : term_description( $term );
$products   = dkg_aanbieding_products();
$hero_style = $hero_image
	? "background-image: linear-gradient(90deg, rgba(16,37,27,.94), rgba(16,37,27,.72) 42%, rgba(16,37,27,.2)), url('" . esc_url( $hero_image ) . "');"
	: '';
?>
<main id="primary" class="dkg-main dkg-woo dkg-aanbieding-page">
	<section class="dkg-aanbieding-hero"<?php echo $hero_style ? ' style="' . esc_attr( $hero_style ) . '"' : ''; ?>>
		<div class="dkg-container">
			<?php
			woocommerce_breadcrumb(
				array(
					'wrap_before' => '<nav class="dkg-woo-breadcrumb" aria-label="' . esc_attr__( 'Breadcrumb', 'de-kaasgenoten' ) . '">',
					'wrap_after'  => '</nav>',
				)
			);
			?>
			<span class="dkg-aanbieding-hero__badge"><?php esc_html_e( 'Tijdelijk voordelig', 'de-kaasgenoten' ); ?></span>
			<?php if ( ! empty( $luxe['eyebrow'] ) ) : ?>
				<p class="dkg-eyebrow"><?php echo esc_html( $luxe['eyebrow'] ); ?></p>
			<?php endif; ?>
			<h1><?php echo esc_html( $term->name ); ?></h1>
			<?php if ( $intro ) : ?>
				<p class="dkg-aanbieding-hero__intro"><?php echo esc_html( wp_strip_all_tags( $intro ) ); ?></p>
			<?php endif; ?>
			<?php if ( ! empty( $luxe['secondary']['label'] ) && ! empty( $luxe['secondary']['url'] ) ) : ?>
				<div class="dkg-aanbieding-hero__actions">
					<a class="dkg-button dkg-button-gold" href="<?php echo esc_url( $luxe['url'] ); ?>"><?php echo esc_html( $luxe['cta'] ); ?></a>
					<a class="dkg-button dkg-button-ghost" href="<?php echo esc_url( $luxe['secondary']['url'] ); ?>"><?php echo esc_html( $luxe['secondary']['label'] ); ?></a>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<?php dkg_luxe_render_lead( $luxe ); ?>

	<section class="dkg-aanbieding-highlights" aria-label="<?php esc_attr_e( 'Voordelen van onze aanbiedingen', 'de-kaasgenoten' ); ?>">
		<div class="dkg-container dkg-aanbieding-highlights__grid">
			<article>
				<strong><?php esc_html_e( 'Alleen geselecteerde producten', 'de-kaasgenoten' ); ?></strong>
				<p><?php esc_html_e( 'Alleen producten met de categorie Aanbieding staan hier — jij bepaalt wat in de actie staat.', 'de-kaasgenoten' ); ?></p>
			</article>
			<article>
				<strong><?php esc_html_e( 'Zelfde zorg', 'de-kaasgenoten' ); ?></strong>
				<p><?php esc_html_e( 'Dezelfde selectie als op onze marktkraam, tijdelijk scherper geprijsd.', 'de-kaasgenoten' ); ?></p>
			</article>
			<article>
				<strong><?php esc_html_e( 'Beperkte tijd', 'de-kaasgenoten' ); ?></strong>
				<p><?php esc_html_e( 'Grijp je kans — aanbod voor beperkte tijd.', 'de-kaasgenoten' ); ?></p>
			</article>
		</div>
	</section>

	<section class="dkg-aanbieding-products" aria-label="<?php esc_attr_e( 'Aanbiedingsproducten', 'de-kaasgenoten' ); ?>">
		<div class="dkg-container">
			<div class="dkg-aanbieding-products__heading">
				<h2><?php esc_html_e( 'Alle aanbiedingen', 'de-kaasgenoten' ); ?></h2>
				<p><?php esc_html_e( 'Gesorteerd van jong naar oud, kruidenkaas als laatste.', 'de-kaasgenoten' ); ?></p>
			</div>

			<?php woocommerce_output_all_notices(); ?>

			<?php if ( ! empty( $products ) ) : ?>
				<div class="dkg-product-grid">
					<?php foreach ( $products as $product ) : ?>
						<?php dkg_product_card_from_product( $product ); ?>
					<?php endforeach; ?>
				</div>
			<?php else : ?>
				<div class="dkg-aanbieding-empty">
					<h3><?php esc_html_e( 'Momenteel geen aanbiedingen', 'de-kaasgenoten' ); ?></h3>
					<p><?php esc_html_e( 'Koppel producten aan de categorie Aanbieding om ze hier te tonen.', 'de-kaasgenoten' ); ?></p>
					<a class="dkg-button dkg-button-gold" href="<?php echo esc_url( dkg_shop_url() ); ?>"><?php esc_html_e( 'Bekijk het volledige assortiment', 'de-kaasgenoten' ); ?></a>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<?php
	dkg_luxe_render_usps( $luxe );
	dkg_luxe_render_cta( $luxe );
	?>
</main>
