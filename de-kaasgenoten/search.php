<?php
/**
 * Search results template.
 *
 * @package De_Kaasgenoten
 */

get_header();

$is_product_search = 'product' === get_query_var( 'post_type' ) || ( isset( $_GET['post_type'] ) && 'product' === $_GET['post_type'] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
?>
<main id="primary" class="dkg-main dkg-woo<?php echo $is_product_search ? ' dkg-search-products' : ' dkg-content-page'; ?>">
	<div class="dkg-container<?php echo $is_product_search ? '' : ' dkg-content-wrap'; ?>">
		<header class="dkg-archive-header">
			<p class="dkg-eyebrow"><?php esc_html_e( 'Zoeken', 'de-kaasgenoten' ); ?></p>
			<h1>
				<?php
				printf(
					/* translators: %s: search query. */
					esc_html__( 'Zoekresultaten voor “%s”', 'de-kaasgenoten' ),
					esc_html( get_search_query() )
				);
				?>
			</h1>
			<?php if ( $is_product_search ) : ?>
				<p><?php esc_html_e( 'Producten in ons assortiment', 'de-kaasgenoten' ); ?></p>
			<?php endif; ?>
		</header>

		<?php if ( have_posts() ) : ?>
			<?php if ( $is_product_search && class_exists( 'WooCommerce' ) ) : ?>
				<div class="dkg-product-grid">
					<?php
					while ( have_posts() ) :
						the_post();
						$product = wc_get_product( get_the_ID() );

						if ( $product ) {
							dkg_product_card_from_product( $product );
						}
					endwhile;
					?>
				</div>
				<?php the_posts_pagination(); ?>
			<?php else : ?>
				<div class="dkg-post-list">
					<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>
						<article <?php post_class( 'dkg-post-card' ); ?>>
							<?php if ( has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink(); ?>" class="dkg-post-thumb"><?php the_post_thumbnail( 'medium_large' ); ?></a>
							<?php endif; ?>
							<div>
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 28 ) ); ?></p>
								<a class="dkg-read-more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Bekijk resultaat', 'de-kaasgenoten' ); ?> →</a>
							</div>
						</article>
					<?php endwhile; ?>
					<?php the_posts_pagination(); ?>
				</div>
			<?php endif; ?>
		<?php else : ?>
			<p><?php esc_html_e( 'Geen resultaten gevonden. Probeer een andere zoekterm of bekijk onze winkel.', 'de-kaasgenoten' ); ?></p>
			<a class="dkg-button dkg-button-gold" href="<?php echo esc_url( dkg_shop_url() ); ?>"><?php esc_html_e( 'Naar de winkel', 'de-kaasgenoten' ); ?></a>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
