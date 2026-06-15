<?php
/**
 * Front page template.
 *
 * @package De_Kaasgenoten
 */

get_header();

$categories = array(
	array( 'title' => 'Kaas', 'image' => 'cat-kaas.jpg', 'url' => '/product-category/kaas/' ),
	array( 'title' => 'Delicatessen', 'image' => 'cat-delicatessen.jpg', 'url' => '/product-category/delicatessen/' ),
	array( 'title' => 'Wijn & Dranken', 'image' => 'cat-wijn.jpg', 'url' => '/product-category/wijn-dranken/' ),
	array( 'title' => 'Noten & Olijven', 'image' => 'cat-noten.jpg', 'url' => '/product-category/noten-olijven/' ),
	array( 'title' => 'Pakketten & Geschenken', 'image' => 'cat-pakketten.jpg', 'url' => '/product-category/pakketten-geschenken/' ),
	array( 'title' => 'Zakelijk', 'image' => 'cat-zakelijk.jpg', 'url' => '/zakelijk/' ),
);
?>

<main id="primary" class="dkg-main">
	<section class="dkg-hero" style="background-image: linear-gradient(90deg, rgba(0,0,0,.78), rgba(0,0,0,.38) 48%, rgba(0,0,0,.1)), url('<?php echo dkg_asset_uri( 'images/hero.jpg' ); ?>');">
		<div class="dkg-container dkg-hero-inner">
			<p class="dkg-eyebrow"><?php esc_html_e( 'Kaas, delicatessen & geschenken', 'de-kaasgenoten' ); ?></p>
			<h1><?php esc_html_e( 'Voor elke gelegenheid het perfecte cadeau', 'de-kaasgenoten' ); ?></h1>
			<p><?php esc_html_e( 'Ambachtelijke kazen, heerlijke delicatessen en smaakvolle geschenkpakketten. Met zorg samengesteld, met liefde gegeven.', 'de-kaasgenoten' ); ?></p>
			<div class="dkg-hero-actions">
				<a class="dkg-button dkg-button-gold" href="<?php echo esc_url( home_url( '/product-category/pakketten-geschenken/' ) ); ?>"><?php esc_html_e( 'Bekijk cadeaupakketten', 'de-kaasgenoten' ); ?></a>
				<a class="dkg-button dkg-button-dark" href="<?php echo esc_url( home_url( '/product-category/kaas/' ) ); ?>"><?php esc_html_e( 'Bekijk ons kaasassortiment', 'de-kaasgenoten' ); ?></a>
			</div>
		</div>
	</section>

	<section class="dkg-section dkg-category-section">
		<div class="dkg-container dkg-category-grid">
			<?php foreach ( $categories as $category ) : ?>
				<a class="dkg-category-card" href="<?php echo esc_url( home_url( $category['url'] ) ); ?>">
					<img src="<?php echo dkg_asset_uri( 'images/' . $category['image'] ); ?>" alt="<?php echo esc_attr( $category['title'] ); ?>">
					<span><?php echo esc_html( $category['title'] ); ?></span>
				</a>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="dkg-section dkg-promo-section">
		<div class="dkg-container dkg-promo-grid">
			<article class="dkg-promo-card" style="background-image: linear-gradient(90deg, rgba(16,37,27,.94), rgba(16,37,27,.48)), url('<?php echo dkg_asset_uri( 'images/promo-pakketten.jpg' ); ?>');">
				<h2><?php esc_html_e( 'Cadeaupakketten voor elk moment', 'de-kaasgenoten' ); ?></h2>
				<p><?php esc_html_e( 'Van bedankje tot verjaardag of jubileum. Kant-en-klaar of volledig op maat.', 'de-kaasgenoten' ); ?></p>
				<a class="dkg-button dkg-button-gold" href="<?php echo esc_url( home_url( '/product-category/pakketten-geschenken/' ) ); ?>"><?php esc_html_e( 'Bekijk alle pakketten', 'de-kaasgenoten' ); ?> →</a>
			</article>
			<article class="dkg-promo-card" style="background-image: linear-gradient(90deg, rgba(16,37,27,.94), rgba(16,37,27,.42)), url('<?php echo dkg_asset_uri( 'images/promo-zakelijk.jpg' ); ?>');">
				<h2><?php esc_html_e( 'Zakelijk & relatiegeschenken', 'de-kaasgenoten' ); ?></h2>
				<p><?php esc_html_e( 'Maak indruk met een stijlvol geschenk. Voor klanten, medewerkers en zakelijke relaties.', 'de-kaasgenoten' ); ?></p>
				<a class="dkg-button dkg-button-outline" href="<?php echo esc_url( home_url( '/zakelijk/' ) ); ?>"><?php esc_html_e( 'Meer over zakelijk', 'de-kaasgenoten' ); ?> →</a>
			</article>
		</div>
	</section>

	<section class="dkg-section dkg-usp-section">
		<div class="dkg-container dkg-usp-grid">
			<div class="dkg-usp"><?php echo dkg_icon( 'award' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><div><strong><?php esc_html_e( 'Ambachtelijke kwaliteit', 'de-kaasgenoten' ); ?></strong><span><?php esc_html_e( 'Alle kazen met zorg geselecteerd.', 'de-kaasgenoten' ); ?></span></div></div>
			<div class="dkg-usp"><?php echo dkg_icon( 'truck' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><div><strong><?php esc_html_e( 'Snelle levering', 'de-kaasgenoten' ); ?></strong><span><?php esc_html_e( 'Voor 15:00 besteld, morgen in huis.', 'de-kaasgenoten' ); ?></span></div></div>
			<div class="dkg-usp"><?php echo dkg_icon( 'user' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><div><strong><?php esc_html_e( 'Persoonlijk advies', 'de-kaasgenoten' ); ?></strong><span><?php esc_html_e( 'Wij denken graag met je mee.', 'de-kaasgenoten' ); ?></span></div></div>
			<div class="dkg-usp"><?php echo dkg_icon( 'leaf' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><div><strong><?php esc_html_e( 'Duurzaam verpakt', 'de-kaasgenoten' ); ?></strong><span><?php esc_html_e( 'Met oog voor mens en milieu.', 'de-kaasgenoten' ); ?></span></div></div>
		</div>
	</section>

	<section class="dkg-section dkg-products-section">
		<div class="dkg-container">
			<div class="dkg-section-heading">
				<h2><?php esc_html_e( 'Populaire kazen', 'de-kaasgenoten' ); ?></h2>
				<a href="<?php echo esc_url( class_exists( 'WooCommerce' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/winkel/' ) ); ?>"><?php esc_html_e( 'Bekijk alle kazen', 'de-kaasgenoten' ); ?> →</a>
			</div>
			<div class="dkg-product-grid">
				<?php dkg_popular_products(); ?>
			</div>
		</div>
	</section>

	<section class="dkg-section dkg-trust-section">
		<div class="dkg-container dkg-trust-grid">
			<div class="dkg-rating"><strong><?php esc_html_e( 'Klanten beoordelen ons met een 4,9/5', 'de-kaasgenoten' ); ?></strong><span>★★★★★</span><small><?php esc_html_e( 'Gebaseerd op 500+ reviews', 'de-kaasgenoten' ); ?></small></div>
			<div class="dkg-trust-item"><?php echo dkg_icon( 'box' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><div><strong><?php esc_html_e( 'Veilig betalen', 'de-kaasgenoten' ); ?></strong><span><?php esc_html_e( 'iDEAL, Creditcard, Bancontact en meer', 'de-kaasgenoten' ); ?></span></div></div>
			<div class="dkg-trust-item"><?php echo dkg_icon( 'truck' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><div><strong><?php esc_html_e( 'Gratis verzending vanaf €75', 'de-kaasgenoten' ); ?></strong><span><?php esc_html_e( 'Binnen Nederland', 'de-kaasgenoten' ); ?></span></div></div>
			<div class="dkg-trust-item"><?php echo dkg_icon( 'heart' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><div><strong><?php esc_html_e( '14 dagen bedenktijd', 'de-kaasgenoten' ); ?></strong><span><?php esc_html_e( 'Niet tevreden? Geld terug.', 'de-kaasgenoten' ); ?></span></div></div>
		</div>
	</section>

	<section class="dkg-section dkg-bottom-panels">
		<div class="dkg-container dkg-bottom-grid">
			<article class="dkg-ai-panel">
				<div>
					<h2><?php esc_html_e( 'Hulp nodig bij kiezen?', 'de-kaasgenoten' ); ?></h2>
					<p><?php esc_html_e( 'Onze AI smaakadviseur helpt je het perfecte pakket of de juiste kaas te vinden.', 'de-kaasgenoten' ); ?></p>
					<a class="dkg-button dkg-button-gold" href="<?php echo esc_url( home_url( '/smaakadviseur/' ) ); ?>"><?php esc_html_e( 'Probeer de smaakadviseur', 'de-kaasgenoten' ); ?> →</a>
				</div>
				<span class="dkg-ai-icon" aria-hidden="true">?</span>
			</article>
			<article class="dkg-about-panel">
				<div class="dkg-about-copy">
					<h2><?php esc_html_e( 'Over De Kaasgenoten', 'de-kaasgenoten' ); ?></h2>
					<p><?php esc_html_e( 'Drie ondernemers met passie voor kaas en ambacht.', 'de-kaasgenoten' ); ?></p>
					<div class="dkg-partners">
						<strong>Kaas Plaza</strong>
						<strong>Rico’s <span>Biokazen</span></strong>
						<strong>Achie’s <span>Biokazen</span></strong>
					</div>
				</div>
				<img src="<?php echo dkg_asset_uri( 'images/about-founders.jpg' ); ?>" alt="<?php esc_attr_e( 'Ondernemers van De Kaasgenoten', 'de-kaasgenoten' ); ?>">
			</article>
		</div>
	</section>
</main>

<?php
get_footer();
