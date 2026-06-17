<?php
/**
 * Product archive template.
 *
 * @package De_Kaasgenoten
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

$archive_title       = woocommerce_page_title( false );
$archive_description = '';
$filter_terms        = dkg_product_archive_filter_terms();

if ( is_product_category() ) {
	$term = get_queried_object();

	if ( $term instanceof WP_Term ) {
		$archive_title       = $term->name;
		$archive_description = term_description( $term );
	}
}

if ( ! $archive_description ) {
	$archive_description = __( 'Ontdek ons assortiment ambachtelijke kazen, delicatessen en smaakvolle geschenken.', 'de-kaasgenoten' );
}
?>
<main id="primary" class="dkg-main dkg-woo">
	<section class="dkg-shop-hero">
		<div class="dkg-container">
			<?php woocommerce_breadcrumb( array( 'wrap_before' => '<nav class="dkg-woo-breadcrumb" aria-label="' . esc_attr__( 'Breadcrumb', 'de-kaasgenoten' ) . '">', 'wrap_after' => '</nav>' ) ); ?>
			<p class="dkg-eyebrow"><?php esc_html_e( 'Assortiment', 'de-kaasgenoten' ); ?></p>
			<h1><?php echo esc_html( $archive_title ); ?></h1>
			<div class="dkg-shop-hero-text"><?php echo wp_kses_post( wpautop( $archive_description ) ); ?></div>
		</div>
	</section>

	<div class="dkg-container dkg-shop-layout">
		<aside class="dkg-shop-filters" aria-label="<?php esc_attr_e( 'Productfilters', 'de-kaasgenoten' ); ?>">
			<h2><?php esc_html_e( 'Filters', 'de-kaasgenoten' ); ?></h2>
			<?php if ( ! empty( $filter_terms ) ) : ?>
				<ul>
					<?php foreach ( $filter_terms as $filter_term ) : ?>
						<li>
							<a href="<?php echo esc_url( get_term_link( $filter_term ) ); ?>">
								<span aria-hidden="true"></span>
								<?php echo esc_html( $filter_term->name ); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php else : ?>
				<p><?php esc_html_e( 'Gebruik de productcategorieën om gericht te filteren.', 'de-kaasgenoten' ); ?></p>
			<?php endif; ?>
		</aside>

		<section class="dkg-shop-products" aria-label="<?php esc_attr_e( 'Producten', 'de-kaasgenoten' ); ?>">
			<?php woocommerce_output_all_notices(); ?>

			<?php if ( woocommerce_product_loop() ) : ?>
				<div class="dkg-shop-toolbar">
					<?php woocommerce_result_count(); ?>
					<div class="dkg-shop-sorting">
						<span><?php esc_html_e( 'Sorteren', 'de-kaasgenoten' ); ?></span>
						<?php woocommerce_catalog_ordering(); ?>
					</div>
				</div>

				<?php woocommerce_product_loop_start(); ?>

				<?php if ( wc_get_loop_prop( 'total' ) ) : ?>
					<?php while ( have_posts() ) : ?>
						<?php
						the_post();
						do_action( 'woocommerce_shop_loop' );
						wc_get_template_part( 'content', 'product' );
						?>
					<?php endwhile; ?>
				<?php endif; ?>

				<?php woocommerce_product_loop_end(); ?>

				<?php woocommerce_pagination(); ?>
			<?php else : ?>
				<?php do_action( 'woocommerce_no_products_found' ); ?>
			<?php endif; ?>
		</section>
	</div>
</main>
<?php
get_footer( 'shop' );
