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
$luxe                = null;
$hero_image          = '';
$child_cards         = array();

$term = null;

if ( is_product_category() ) {
	$queried = get_queried_object();

	if ( $queried instanceof WP_Term ) {
		$term = $queried;
	}
} elseif ( taxonomy_exists( 'product_cat' ) ) {
	// Ondersteun ook de gefilterde winkel-URL (/winkel/?product_cat=slug),
	// zodat menu-items met die link óók de premium categorie-opmaak krijgen.
	$queried_slug = get_query_var( 'product_cat' );

	if ( $queried_slug ) {
		$maybe_term = get_term_by( 'slug', sanitize_title( $queried_slug ), 'product_cat' );

		if ( $maybe_term instanceof WP_Term ) {
			$term = $maybe_term;
		}
	}
}

if ( $term instanceof WP_Term ) {
	$archive_title       = $term->name;
	$archive_description = term_description( $term );

	if ( function_exists( 'dkg_luxe_data_for_term' ) ) {
		$luxe = dkg_luxe_data_for_term( $term->slug );
	}

	if ( function_exists( 'dkg_category_collection_cards' ) ) {
		$child_cards = dkg_category_collection_cards( $term->term_id );
	}
}

if ( $luxe ) {
	if ( ! $archive_description ) {
		$archive_description = $luxe['intro'];
	}
	$hero_image = dkg_asset_uri( 'images/' . $luxe['image'] );
}

if ( ! $archive_description ) {
	$archive_description = __( 'Ontdek ons assortiment ambachtelijke kazen, delicatessen en smaakvolle geschenken.', 'de-kaasgenoten' );
}

$has_products = woocommerce_product_loop();
$hero_classes = 'dkg-shop-hero';
$hero_style   = '';

if ( $hero_image ) {
	$hero_classes .= ' dkg-shop-hero--image';
	$hero_style    = "background-image: linear-gradient(90deg, rgba(16,37,27,.94), rgba(16,37,27,.68) 42%, rgba(16,37,27,.15)), url('" . esc_url( $hero_image ) . "');";
}
?>
<main id="primary" class="dkg-main dkg-woo<?php echo $luxe ? ' dkg-cat-page' : ''; ?>">
	<section class="<?php echo esc_attr( $hero_classes ); ?>"<?php echo $hero_style ? ' style="' . esc_attr( $hero_style ) . '"' : ''; ?>>
		<div class="dkg-container">
			<?php woocommerce_breadcrumb( array( 'wrap_before' => '<nav class="dkg-woo-breadcrumb" aria-label="' . esc_attr__( 'Breadcrumb', 'de-kaasgenoten' ) . '">', 'wrap_after' => '</nav>' ) ); ?>
			<p class="dkg-eyebrow"><?php echo esc_html( $luxe ? $luxe['eyebrow'] : __( 'Assortiment', 'de-kaasgenoten' ) ); ?></p>
			<h1><?php echo esc_html( $archive_title ); ?></h1>
			<div class="dkg-shop-hero-text"><?php echo wp_kses_post( wpautop( $archive_description ) ); ?></div>
			<?php if ( $luxe ) : ?>
				<div class="dkg-cat-hero-actions">
					<a class="dkg-button dkg-button-gold" href="<?php echo esc_url( $luxe['url'] ); ?>"><?php echo esc_html( $luxe['cta'] ); ?></a>
					<?php if ( ! empty( $luxe['secondary']['label'] ) ) : ?>
						<a class="dkg-button dkg-button-ghost" href="<?php echo esc_url( $luxe['secondary']['url'] ); ?>"><?php echo esc_html( $luxe['secondary']['label'] ); ?></a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<?php
	if ( $luxe ) {
		dkg_luxe_render_lead( $luxe );
	}
	?>

	<?php if ( $has_products ) : ?>
		<?php if ( $luxe && ! empty( $child_cards ) ) : ?>
			<?php dkg_luxe_render_collections( $luxe, __( 'Shop per categorie', 'de-kaasgenoten' ), $child_cards ); ?>
		<?php endif; ?>

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
			</section>
		</div>

	<?php elseif ( $luxe ) : ?>
		<?php
		// Lege categorie met landingsdata: rijke landingsinhoud zonder dode kaarten.
		if ( ! empty( $child_cards ) ) {
			dkg_luxe_render_collections( $luxe, '', $child_cards );
		}
		?>

	<?php else : ?>
		<div class="dkg-container dkg-shop-layout">
			<aside class="dkg-shop-filters" aria-label="<?php esc_attr_e( 'Productfilters', 'de-kaasgenoten' ); ?>">
				<h2><?php esc_html_e( 'Filters', 'de-kaasgenoten' ); ?></h2>
				<p><?php esc_html_e( 'Gebruik de productcategorieën om gericht te filteren.', 'de-kaasgenoten' ); ?></p>
			</aside>
			<section class="dkg-shop-products" aria-label="<?php esc_attr_e( 'Producten', 'de-kaasgenoten' ); ?>">
				<?php woocommerce_output_all_notices(); ?>
				<?php do_action( 'woocommerce_no_products_found' ); ?>
			</section>
		</div>
	<?php endif; ?>

	<?php if ( $luxe ) : ?>
		<?php
		dkg_luxe_render_usps( $luxe );
		dkg_luxe_render_cta( $luxe );
		?>
	<?php endif; ?>
</main>
<?php
get_footer( 'shop' );
