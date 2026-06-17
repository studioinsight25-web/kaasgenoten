<?php
/**
 * 404 template.
 *
 * @package De_Kaasgenoten
 */

get_header();
?>
<main id="primary" class="dkg-main dkg-content-page">
	<div class="dkg-container dkg-content-wrap">
		<article>
			<p class="dkg-eyebrow"><?php esc_html_e( 'Pagina niet gevonden', 'de-kaasgenoten' ); ?></p>
			<h1><?php esc_html_e( 'Deze pagina bestaat niet meer', 'de-kaasgenoten' ); ?></h1>
			<div class="dkg-entry-content">
				<p><?php esc_html_e( 'De link is mogelijk verplaatst. Ga terug naar de winkel of gebruik de zoekfunctie.', 'de-kaasgenoten' ); ?></p>
				<p>
					<a class="dkg-button dkg-button-gold" href="<?php echo esc_url( dkg_shop_url() ); ?>"><?php esc_html_e( 'Naar de winkel', 'de-kaasgenoten' ); ?></a>
				</p>
				<?php get_search_form(); ?>
			</div>
		</article>
	</div>
</main>
<?php
get_footer();
