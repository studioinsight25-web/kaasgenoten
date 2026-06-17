<?php
/**
 * Search results template.
 *
 * @package De_Kaasgenoten
 */

get_header();
?>
<main id="primary" class="dkg-main dkg-content-page">
	<div class="dkg-container dkg-content-wrap">
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
		</header>
		<div class="dkg-post-list">
			<?php if ( have_posts() ) : ?>
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
			<?php else : ?>
				<p><?php esc_html_e( 'Geen resultaten gevonden. Probeer een andere zoekterm of bekijk onze winkel.', 'de-kaasgenoten' ); ?></p>
				<a class="dkg-button dkg-button-gold" href="<?php echo esc_url( dkg_shop_url() ); ?>"><?php esc_html_e( 'Naar de winkel', 'de-kaasgenoten' ); ?></a>
			<?php endif; ?>
		</div>
	</div>
</main>
<?php
get_footer();
