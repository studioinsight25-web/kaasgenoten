<?php
/**
 * Front page template.
 *
 * @package De_Kaasgenoten
 */

get_header();

// 'cat' = WooCommerce productcategorie-slug (gebruikt indien aanwezig),
// 'fallback' = paginaslug wanneer de categorie niet bestaat.
$categories = array(
	array( 'title' => 'Kaas', 'image' => 'cat-kaas.jpg', 'cat' => 'kaas', 'fallback' => 'kaas-delicatessen' ),
	array( 'title' => 'Delicatessen', 'image' => 'cat-delicatessen.jpg', 'cat' => 'delicatessen', 'fallback' => 'kaas-delicatessen' ),
	array( 'title' => 'Wijn & Dranken', 'image' => 'cat-wijn.jpg', 'cat' => 'wijn-dranken', 'fallback' => 'kaas-delicatessen' ),
	array( 'title' => 'Noten & Olijven', 'image' => 'cat-noten.jpg', 'cat' => 'noten-olijven', 'fallback' => 'borrelpakketten' ),
	array( 'title' => 'Pakketten & Geschenken', 'image' => 'cat-pakketten.jpg', 'cat' => 'borrelpakketten', 'fallback' => 'borrelpakketten' ),
	array( 'title' => 'Zakelijk', 'image' => 'cat-zakelijk.jpg', 'cat' => '', 'fallback' => 'zakelijk' ),
);

$dkg_hero = dkg_homepage_hero();
?>

<main id="primary" class="dkg-main">
	<section class="dkg-hero dkg-hero-luxe" style="background-image: linear-gradient(90deg, rgba(0,0,0,.88) 0%, rgba(0,0,0,.64) 36%, rgba(0,0,0,.12) 72%), url('<?php echo dkg_asset_uri( 'images/hero-clean.jpg' ); ?>');" aria-label="<?php echo esc_attr( $dkg_hero['title'] ); ?>">
		<div class="dkg-container dkg-hero-inner">
			<p class="dkg-eyebrow"><?php echo esc_html( $dkg_hero['eyebrow'] ); ?></p>
			<h1><?php echo esc_html( $dkg_hero['title'] ); ?></h1>
			<p><?php echo esc_html( $dkg_hero['text'] ); ?></p>
			<div class="dkg-hero-actions">
				<a class="dkg-button dkg-button-gold" href="<?php echo esc_url( dkg_product_category_url( 'borrelpakketten', 'borrelpakketten' ) ); ?>"><?php echo esc_html( $dkg_hero['cta_primary'] ); ?></a>
				<a class="dkg-button dkg-button-dark" href="<?php echo esc_url( dkg_product_category_url( 'kaas', 'kaas-delicatessen' ) ); ?>"><?php echo esc_html( $dkg_hero['cta_secondary'] ); ?></a>
			</div>
		</div>
	</section>

	<section class="dkg-section dkg-category-section">
		<div class="dkg-container dkg-category-grid">
			<?php
			foreach ( $categories as $category ) :
				$category_url = ! empty( $category['cat'] )
					? dkg_product_category_url( $category['cat'], $category['fallback'] )
					: dkg_page_url( $category['fallback'] );
				?>
				<a class="dkg-category-card" href="<?php echo esc_url( $category_url ); ?>">
					<img src="<?php echo dkg_asset_uri( 'images/' . $category['image'] ); ?>" alt="<?php echo esc_attr( $category['title'] ); ?>" loading="lazy" decoding="async">
					<span><?php echo esc_html( $category['title'] ); ?></span>
				</a>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="dkg-section dkg-promo-section">
		<div class="dkg-container dkg-promo-grid">
			<a class="dkg-promo-card" href="<?php echo esc_url( dkg_product_category_url( 'borrelpakketten', 'borrelpakketten' ) ); ?>" style="background-image: linear-gradient(90deg, rgba(16,37,27,.9) 0%, rgba(16,37,27,.64) 36%, rgba(16,37,27,.12) 72%), url('<?php echo dkg_asset_uri( 'images/promo-pakketten.jpg' ); ?>');">
				<h2><?php esc_html_e( 'Cadeaupakketten voor elk moment', 'de-kaasgenoten' ); ?></h2>
				<p><?php esc_html_e( 'Van bedankje tot verjaardag of jubileum. Kant-en-klaar of volledig op maat.', 'de-kaasgenoten' ); ?></p>
				<span class="dkg-button dkg-button-gold"><?php esc_html_e( 'Bekijk alle pakketten', 'de-kaasgenoten' ); ?> →</span>
			</a>
			<a class="dkg-promo-card" href="<?php echo esc_url( dkg_page_url( 'zakelijk' ) ); ?>" style="background-image: linear-gradient(90deg, rgba(16,37,27,.9) 0%, rgba(16,37,27,.64) 36%, rgba(16,37,27,.12) 72%), url('<?php echo dkg_asset_uri( 'images/promo-zakelijk.jpg' ); ?>');">
				<h2><?php esc_html_e( 'Zakelijk & relatiegeschenken', 'de-kaasgenoten' ); ?></h2>
				<p><?php esc_html_e( 'Maak indruk met een stijlvol geschenk. Voor klanten, medewerkers en zakelijke relaties.', 'de-kaasgenoten' ); ?></p>
				<span class="dkg-button dkg-button-outline"><?php esc_html_e( 'Meer over zakelijk', 'de-kaasgenoten' ); ?> →</span>
			</a>
		</div>
	</section>

	<section class="dkg-section dkg-usp-section">
		<div class="dkg-container dkg-usp-grid">
			<div class="dkg-usp"><?php echo dkg_icon( 'award' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><div><strong><?php esc_html_e( 'Ambachtelijke kwaliteit', 'de-kaasgenoten' ); ?></strong><span><?php esc_html_e( 'Alle kazen met zorg geselecteerd.', 'de-kaasgenoten' ); ?></span></div></div>
			<div class="dkg-usp"><?php echo dkg_icon( 'truck' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><div><strong><?php esc_html_e( 'Zorgvuldig verzonden', 'de-kaasgenoten' ); ?></strong><span><?php esc_html_e( 'Zo snel mogelijk, met zorg verwerkt', 'de-kaasgenoten' ); ?></span></div></div>
			<div class="dkg-usp"><?php echo dkg_icon( 'user' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><div><strong><?php esc_html_e( 'Persoonlijk advies', 'de-kaasgenoten' ); ?></strong><span><?php esc_html_e( 'Wij denken graag met je mee.', 'de-kaasgenoten' ); ?></span></div></div>
			<div class="dkg-usp"><?php echo dkg_icon( 'leaf' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><div><strong><?php esc_html_e( 'Duurzaam verpakt', 'de-kaasgenoten' ); ?></strong><span><?php esc_html_e( 'Met oog voor mens en milieu.', 'de-kaasgenoten' ); ?></span></div></div>
		</div>
	</section>

	<section class="dkg-section dkg-products-section">
		<div class="dkg-container">
			<div class="dkg-section-heading">
				<h2><?php esc_html_e( 'Populaire kazen', 'de-kaasgenoten' ); ?></h2>
				<a href="<?php echo esc_url( dkg_product_category_url( 'kaas', 'kaas-delicatessen' ) ); ?>"><?php esc_html_e( 'Bekijk alle kazen', 'de-kaasgenoten' ); ?> →</a>
			</div>
			<div class="dkg-product-grid">
				<?php dkg_popular_products(); ?>
			</div>
		</div>
	</section>

	<section class="dkg-section dkg-trust-section">
		<div class="dkg-container dkg-trust-grid">
			<?php
			$dkg_rating = dkg_trust_rating();
			if ( ! empty( $dkg_rating['show'] ) ) :
				?>
				<div class="dkg-rating">
					<?php if ( ! empty( $dkg_rating['score'] ) ) : ?>
						<strong><?php printf( esc_html__( 'Klanten beoordelen ons met een %s', 'de-kaasgenoten' ), esc_html( $dkg_rating['score'] ) ); ?></strong>
						<span>★★★★★</span>
						<?php if ( ! empty( $dkg_rating['count'] ) ) : ?>
							<small><?php printf( esc_html__( 'Gebaseerd op %s', 'de-kaasgenoten' ), esc_html( $dkg_rating['count'] ) ); ?></small>
						<?php endif; ?>
					<?php else : ?>
						<strong><?php esc_html_e( 'Gewaardeerd om kwaliteit en service', 'de-kaasgenoten' ); ?></strong>
						<small><?php esc_html_e( 'Met zorg geselecteerd assortiment', 'de-kaasgenoten' ); ?></small>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<div class="dkg-trust-item"><?php echo dkg_icon( 'box' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><div><strong><?php esc_html_e( 'Veilig betalen', 'de-kaasgenoten' ); ?></strong><span><?php esc_html_e( 'iDEAL, Creditcard, Bancontact en meer', 'de-kaasgenoten' ); ?></span></div></div>
			<div class="dkg-trust-item"><?php echo dkg_icon( 'box' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><div><strong><?php esc_html_e( 'Zorgvuldig verpakt', 'de-kaasgenoten' ); ?></strong><span><?php esc_html_e( 'Vers afgesneden en professioneel verpakt', 'de-kaasgenoten' ); ?></span></div></div>
			<div class="dkg-trust-item"><?php echo dkg_icon( 'heart' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><div><strong><?php esc_html_e( '14 dagen bedenktijd', 'de-kaasgenoten' ); ?></strong><span><?php esc_html_e( 'Niet tevreden? Geld terug.', 'de-kaasgenoten' ); ?></span></div></div>
		</div>
	</section>

	<section class="dkg-section dkg-bottom-panels">
		<div class="dkg-container dkg-bottom-grid">
			<article class="dkg-ai-panel">
				<div>
					<h2><?php esc_html_e( 'Hulp nodig bij kiezen?', 'de-kaasgenoten' ); ?></h2>
					<p><?php esc_html_e( 'Wij helpen u graag het perfecte pakket of de juiste kaas te vinden — met hetzelfde persoonlijke advies als op onze marktkraam.', 'de-kaasgenoten' ); ?></p>
					<a class="dkg-button dkg-button-gold" href="<?php echo esc_url( dkg_page_url( 'contact' ) ); ?>"><?php esc_html_e( 'Vraag persoonlijk advies', 'de-kaasgenoten' ); ?> →</a>
				</div>
				<span class="dkg-ai-icon" aria-hidden="true">?</span>
			</article>
			<div class="dkg-about-panel">
				<div class="dkg-about-copy">
					<h2><a href="<?php echo esc_url( dkg_page_url( 'over-ons' ) ); ?>"><?php esc_html_e( 'Over De Kaasgenoten', 'de-kaasgenoten' ); ?></a></h2>
					<p><?php esc_html_e( 'Drie ondernemers met passie voor kaas — vanaf de marktkraam en online.', 'de-kaasgenoten' ); ?></p>
					<div class="dkg-partners">
						<a class="dkg-partner-link" href="https://kaas-plaza.nl/" target="_blank" rel="noopener noreferrer">
							<strong>Kaas Plaza</strong>
						</a>
						<a class="dkg-partner-link" href="https://www.ricosbiokazen.nl/" target="_blank" rel="noopener noreferrer">
							<strong>Rico’s <span>Biokazen</span></strong>
						</a>
						<a class="dkg-partner-link" href="https://www.biokazen.com/" target="_blank" rel="noopener noreferrer">
							<strong>Achie’s <span>Biokazen</span></strong>
						</a>
					</div>
				</div>
				<img src="<?php echo dkg_asset_uri( 'images/about-founders.jpg' ); ?>" alt="<?php esc_attr_e( 'Ondernemers van De Kaasgenoten', 'de-kaasgenoten' ); ?>" loading="lazy" decoding="async">
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
