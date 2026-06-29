<?php
/**
 * Merkpagina – productgrid met actief filter.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$brand  = isset( $args['brand'] ) ? $args['brand'] : array();
$term   = isset( $args['term'] ) && $args['term'] instanceof WP_Term ? $args['term'] : null;
$filter = isset( $args['filter'] ) ? $args['filter'] : array();

if ( ! $term || empty( $filter['title'] ) ) {
	return;
}

$filter_term   = dkg_brand_resolve_filter_term( $term, $filter );
$section_title = trim( $term->name . ' ' . $filter['title'] );
$clear_url     = get_term_link( $term );

if ( is_wp_error( $clear_url ) ) {
	$clear_url = '';
}
?>
<section class="dkg-brand-products">
	<div class="dkg-container">
		<div class="dkg-brand-products__heading">
			<h2><?php echo esc_html( $section_title ); ?></h2>
			<?php if ( $clear_url ) : ?>
				<a href="<?php echo esc_url( $clear_url ); ?>"><?php esc_html_e( 'Alle soorten tonen', 'de-kaasgenoten' ); ?></a>
			<?php endif; ?>
		</div>

		<?php woocommerce_output_all_notices(); ?>

		<?php
		$products      = dkg_brand_filtered_products( $term, $filter );
		$filter_exists = dkg_brand_filter_term_exists( $filter, $term );
		$category_slug = $filter_term instanceof WP_Term ? $filter_term->slug : ( ! empty( $filter['category'] ) ? $filter['category'] : $term->slug . '-' . $filter['filter'] );
		?>

		<?php if ( ! $filter_exists ) : ?>
			<p class="dkg-brand-empty">
				<?php
				printf(
					/* translators: %s: subcategorie-slug */
					esc_html__( 'De subcategorie "%s" bestaat nog niet in WooCommerce. Maak deze productcategorie aan onder het merk en koppel producten eraan.', 'de-kaasgenoten' ),
					esc_html( $category_slug )
				);
				?>
			</p>
		<?php elseif ( ! empty( $products ) ) : ?>
			<div class="dkg-product-grid">
				<?php foreach ( $products as $product ) : ?>
					<?php dkg_product_card_from_product( $product ); ?>
				<?php endforeach; ?>
			</div>
		<?php else : ?>
			<p class="dkg-brand-empty">
				<?php
				printf(
					/* translators: %s: subcategorie-slug */
					esc_html__( 'Geen producten gevonden in de subcategorie "%s". Koppel producten aan deze categorie in WooCommerce.', 'de-kaasgenoten' ),
					esc_html( $category_slug )
				);
				?>
			</p>
		<?php endif; ?>
	</div>
</section>
