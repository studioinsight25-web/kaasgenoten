<?php
/**
 * Reusable luxury page templates.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function dkg_luxe_page_data( $key ) {
	$pages = array(
		'kaas-delicatessen' => array(
			'eyebrow' => __( 'Ambachtelijk geselecteerd', 'de-kaasgenoten' ),
			'title'   => __( 'Kaas & Delicatessen', 'de-kaasgenoten' ),
			'intro'   => __( 'Ontdek smaakvolle kazen, verfijnde delicatessen en borrelproducten die elke tafel bijzonder maken.', 'de-kaasgenoten' ),
			'image'   => 'cat-delicatessen.jpg',
			'cta'     => __( 'Bekijk kaas & delicatessen', 'de-kaasgenoten' ),
			'url'     => dkg_product_category_url( 'kaas-delicatessen', 'kaas-delicatessen' ),
			'cards'   => array(
				array( 'title' => __( 'Kazen met karakter', 'de-kaasgenoten' ), 'text' => __( 'Van jong belegen tot uitgesproken specialiteiten.', 'de-kaasgenoten' ) ),
				array( 'title' => __( 'Delicatessen voor erbij', 'de-kaasgenoten' ), 'text' => __( 'Olijven, noten, chutneys en ambachtelijke smaakmakers.', 'de-kaasgenoten' ) ),
				array( 'title' => __( 'Perfect voor borrel en diner', 'de-kaasgenoten' ), 'text' => __( 'Makkelijk te combineren en mooi om te serveren.', 'de-kaasgenoten' ) ),
			),
		),
		'borrelpakketten' => array(
			'eyebrow' => __( 'Kant-en-klaar genieten', 'de-kaasgenoten' ),
			'title'   => __( 'Borrelpakketten', 'de-kaasgenoten' ),
			'intro'   => __( 'Rijk gevulde pakketten met kaas, delicatessen en smaakvolle extra’s voor elk gezelschap.', 'de-kaasgenoten' ),
			'image'   => 'promo-pakketten.jpg',
			'cta'     => __( 'Bekijk borrelpakketten', 'de-kaasgenoten' ),
			'url'     => dkg_product_category_url( 'borrelpakketten', 'borrelpakketten' ),
			'cards'   => array(
				array( 'title' => __( 'Voor thuis of op kantoor', 'de-kaasgenoten' ), 'text' => __( 'Snel iets bijzonders op tafel zonder gedoe.', 'de-kaasgenoten' ) ),
				array( 'title' => __( 'Mooi verpakt', 'de-kaasgenoten' ), 'text' => __( 'Een verzorgde uitstraling vanaf het moment van openen.', 'de-kaasgenoten' ) ),
				array( 'title' => __( 'Voor iedere smaak', 'de-kaasgenoten' ), 'text' => __( 'Combineer zachte, pittige en hartige smaken.', 'de-kaasgenoten' ) ),
			),
		),
		'kerstpakketten' => array(
			'eyebrow' => __( 'Feestelijk samengesteld', 'de-kaasgenoten' ),
			'title'   => __( 'Kerstpakketten', 'de-kaasgenoten' ),
			'intro'   => __( 'Luxe kerstpakketten met ambachtelijke kazen, delicatessen en warme feestelijke details.', 'de-kaasgenoten' ),
			'image'   => 'cat-pakketten.jpg',
			'cta'     => __( 'Bekijk kerstpakketten', 'de-kaasgenoten' ),
			'url'     => dkg_product_category_url( 'kerstpakketten', 'kerstpakketten' ),
			'cards'   => array(
				array( 'title' => __( 'Voor teams en relaties', 'de-kaasgenoten' ), 'text' => __( 'Een smaakvol bedankje aan het einde van het jaar.', 'de-kaasgenoten' ) ),
				array( 'title' => __( 'Op maat mogelijk', 'de-kaasgenoten' ), 'text' => __( 'Stem inhoud, budget en bezorgmoment af.', 'de-kaasgenoten' ) ),
				array( 'title' => __( 'Feestelijke presentatie', 'de-kaasgenoten' ), 'text' => __( 'Met aandacht verpakt en klaar om te geven.', 'de-kaasgenoten' ) ),
			),
		),
		'relatiegeschenken' => array(
			'eyebrow' => __( 'Geef smaak cadeau', 'de-kaasgenoten' ),
			'title'   => __( 'Relatiegeschenken', 'de-kaasgenoten' ),
			'intro'   => __( 'Versterk relaties met een stijlvol kaaspakket dat persoonlijk, verzorgd en memorabel aanvoelt.', 'de-kaasgenoten' ),
			'image'   => 'cat-zakelijk.jpg',
			'cta'     => __( 'Bekijk relatiegeschenken', 'de-kaasgenoten' ),
			'url'     => dkg_product_category_url( 'relatiegeschenken', 'relatiegeschenken' ),
			'cards'   => array(
				array( 'title' => __( 'Voor klanten', 'de-kaasgenoten' ), 'text' => __( 'Een onderscheidend cadeau dat blijft hangen.', 'de-kaasgenoten' ) ),
				array( 'title' => __( 'Voor medewerkers', 'de-kaasgenoten' ), 'text' => __( 'Laat waardering zien met kwaliteit en aandacht.', 'de-kaasgenoten' ) ),
				array( 'title' => __( 'Persoonlijke afwerking', 'de-kaasgenoten' ), 'text' => __( 'Met kaartje, boodschap of zakelijke uitstraling.', 'de-kaasgenoten' ) ),
			),
		),
		'zakelijk' => array(
			'eyebrow' => __( 'Zakelijk bestellen', 'de-kaasgenoten' ),
			'title'   => __( 'Zakelijk & maatwerk', 'de-kaasgenoten' ),
			'intro'   => __( 'Voor bedrijven die relaties, medewerkers of gasten iets smaakvols en verzorgds willen geven.', 'de-kaasgenoten' ),
			'image'   => 'promo-zakelijk.jpg',
			'cta'     => __( 'Neem contact op', 'de-kaasgenoten' ),
			'url'     => dkg_page_url( 'contact' ),
			'cards'   => array(
				array( 'title' => __( 'Maatwerk per budget', 'de-kaasgenoten' ), 'text' => __( 'Van compact geschenk tot royaal pakket.', 'de-kaasgenoten' ) ),
				array( 'title' => __( 'Meerdere adressen', 'de-kaasgenoten' ), 'text' => __( 'Handig voor teams, klanten en landelijke levering.', 'de-kaasgenoten' ) ),
				array( 'title' => __( 'Persoonlijk advies', 'de-kaasgenoten' ), 'text' => __( 'We denken mee over inhoud, planning en presentatie.', 'de-kaasgenoten' ) ),
			),
		),
	);

	return isset( $pages[ $key ] ) ? $pages[ $key ] : null;
}

function dkg_render_luxe_page( $key ) {
	$data = dkg_luxe_page_data( $key );

	if ( ! $data ) {
		return;
	}

	$page_content = '';
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			ob_start();
			the_content();
			$page_content = trim( ob_get_clean() );
		}
	}

	get_header();
	?>
	<main id="primary" class="dkg-main dkg-luxe-page">
		<section class="dkg-luxe-hero" style="background-image: linear-gradient(90deg, rgba(16,37,27,.94), rgba(16,37,27,.68) 42%, rgba(16,37,27,.1)), url('<?php echo dkg_asset_uri( 'images/' . $data['image'] ); ?>');">
			<div class="dkg-container">
				<p class="dkg-eyebrow"><?php echo esc_html( $data['eyebrow'] ); ?></p>
				<h1><?php echo esc_html( $data['title'] ); ?></h1>
				<p><?php echo esc_html( $data['intro'] ); ?></p>
				<a class="dkg-button dkg-button-gold" href="<?php echo esc_url( $data['url'] ); ?>"><?php echo esc_html( $data['cta'] ); ?></a>
			</div>
		</section>

		<section class="dkg-section">
			<div class="dkg-container dkg-luxe-card-grid">
				<?php foreach ( $data['cards'] as $card ) : ?>
					<article class="dkg-luxe-info-card">
						<h2><?php echo esc_html( $card['title'] ); ?></h2>
						<p><?php echo esc_html( $card['text'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</section>

		<?php if ( $page_content ) : ?>
			<section class="dkg-section">
				<div class="dkg-container dkg-luxe-content">
					<div class="dkg-entry-content">
						<?php echo $page_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				</div>
			</section>
		<?php endif; ?>
	</main>
	<?php
	get_footer();
}
