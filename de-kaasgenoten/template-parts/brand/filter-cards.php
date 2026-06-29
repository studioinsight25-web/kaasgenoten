<?php
/**
 * Merkpagina – filterkaarten.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$brand         = isset( $args['brand'] ) ? $args['brand'] : array();
$term          = isset( $args['term'] ) && $args['term'] instanceof WP_Term ? $args['term'] : null;
$active_filter = isset( $args['active_filter'] ) ? $args['active_filter'] : '';
$filters       = $term ? dkg_brand_visible_filters( $brand, $term ) : array();
$heading       = ! empty( $brand['filters_heading'] ) ? $brand['filters_heading'] : __( 'Kies een collectie', 'de-kaasgenoten' );

if ( ! $term || empty( $filters ) ) {
	return;
}
?>
<section class="dkg-brand-filters" aria-label="<?php esc_attr_e( 'Kies een soort kaas', 'de-kaasgenoten' ); ?>">
	<div class="dkg-container">
		<h2 class="dkg-brand-filters__heading"><?php echo esc_html( $heading ); ?></h2>
		<div class="dkg-brand-filter-grid">
			<?php foreach ( $filters as $filter ) : ?>
				<?php
				if ( empty( $filter['filter'] ) || empty( $filter['title'] ) ) {
					continue;
				}

				$filter_term = dkg_brand_resolve_filter_term( $term, $filter );

				if ( ! $filter_term instanceof WP_Term ) {
					continue;
				}

				$is_active = $active_filter === $filter['filter'];
				$url       = dkg_brand_filter_url( $term, $filter['filter'] );
				$classes   = 'dkg-brand-filter-card' . ( $is_active ? ' is-active' : '' );
				?>
				<a href="<?php echo esc_url( $url ); ?>" class="<?php echo esc_attr( $classes ); ?>">
					<span class="dkg-brand-filter-card__icon" aria-hidden="true">◎</span>
					<h3><?php echo esc_html( $filter['title'] ); ?></h3>
					<?php if ( ! empty( $filter['text'] ) ) : ?>
						<p><?php echo esc_html( $filter['text'] ); ?></p>
					<?php endif; ?>
					<?php if ( $filter_term->count > 0 ) : ?>
						<span class="dkg-brand-filter-card__count">
							<?php
							printf(
								/* translators: %d: aantal producten */
								esc_html( _n( '%d product', '%d producten', (int) $filter_term->count, 'de-kaasgenoten' ) ),
								(int) $filter_term->count
							);
							?>
						</span>
					<?php endif; ?>
					<span class="dkg-brand-filter-card__arrow"><?php esc_html_e( 'Bekijk assortiment →', 'de-kaasgenoten' ); ?></span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
