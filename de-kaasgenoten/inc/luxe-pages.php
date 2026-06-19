<?php
/**
 * Herbruikbare premium landingspagina's voor de hoofdcategorieën.
 *
 * Elke pagina bestaat uit een hero, een korte intro, een grid met
 * subcollecties, een rij met USP's, optioneel een rij uitgelichte
 * producten (alleen met WooCommerce actief) en een afsluitende CTA.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Standaard USP-rij die op elke categoriepagina wordt getoond.
 *
 * @return array<int, array<string, string>>
 */
function dkg_luxe_default_usps() {
	return array(
		array(
			'icon'  => 'farm',
			'title' => __( 'Direct van de kaasboer', 'de-kaasgenoten' ),
			'text'  => __( 'Korte keten en eerlijke, ambachtelijke kwaliteit.', 'de-kaasgenoten' ),
		),
		array(
			'icon'  => 'knife',
			'title' => __( 'Vers voor je verwerkt', 'de-kaasgenoten' ),
			'text'  => __( 'Op bestelling gesneden en zorgvuldig verpakt.', 'de-kaasgenoten' ),
		),
		array(
			'icon'  => 'truck',
			'title' => __( 'Snel & gekoeld bezorgd', 'de-kaasgenoten' ),
			'text'  => __( 'Door heel Nederland netjes aan huis geleverd.', 'de-kaasgenoten' ),
		),
		array(
			'icon'  => 'hand',
			'title' => __( 'Persoonlijk advies', 'de-kaasgenoten' ),
			'text'  => __( 'Specialisten die graag met je meedenken.', 'de-kaasgenoten' ),
		),
	);
}

/**
 * Content per landingspagina.
 *
 * @param string $key Pagina-sleutel.
 * @return array<string, mixed>|null
 */
function dkg_luxe_page_data( $key ) {
	$contact = dkg_page_url( 'contact' );

	$pages = array(
		'kaas' => array(
			'eyebrow'       => __( 'Ambachtelijk geselecteerd', 'de-kaasgenoten' ),
			'title'         => __( 'Kaas', 'de-kaasgenoten' ),
			'intro'         => __( 'Van romige jonge kaas tot karaktervolle oude kaas — met zorg geselecteerd bij ambachtelijke kaasmakerijen.', 'de-kaasgenoten' ),
			'image'         => 'cat-kaas.jpg',
			'cta'           => __( 'Bekijk alle kaas', 'de-kaasgenoten' ),
			'url'           => dkg_product_category_url( 'kaas', 'kaas' ),
			'secondary'     => array( 'label' => __( 'Vraag persoonlijk advies', 'de-kaasgenoten' ), 'url' => $contact ),
			'lead'          => __( 'Bij De Kaasgenoten draait alles om smaak en kwaliteit. We werken samen met boeren en kaasmakers die hun vak verstaan, zodat jij thuis geniet van kaas met een verhaal.', 'de-kaasgenoten' ),
			'collections'   => array(
				array( 'title' => __( 'Boerenkaas', 'de-kaasgenoten' ), 'text' => __( 'Vol en ambachtelijk, van vertrouwde kaasboeren.', 'de-kaasgenoten' ), 'image' => 'product-boeren.jpg', 'url' => dkg_product_category_url( 'boerenkaas', 'kaas' ) ),
				array( 'title' => __( 'Biologische kaas', 'de-kaasgenoten' ), 'text' => __( 'Eerlijk gemaakt, met respect voor dier en natuur.', 'de-kaasgenoten' ), 'image' => 'product-geiten.jpg', 'url' => dkg_product_category_url( 'biologische-kaas', 'kaas' ) ),
				array( 'title' => __( 'Lutjewinkel', 'de-kaasgenoten' ), 'text' => __( 'Karaktervolle kaas met een eigen smaak.', 'de-kaasgenoten' ), 'image' => 'product-jonge.jpg', 'url' => dkg_product_category_url( 'lutjewinkel', 'kaas' ) ),
				array( 'title' => __( 'Terschellinger', 'de-kaasgenoten' ), 'text' => __( 'Bijzondere eilandkaas voor de liefhebber.', 'de-kaasgenoten' ), 'image' => 'product-truffel.jpg', 'url' => dkg_product_category_url( 'terschellinger', 'kaas' ) ),
			),
			'product_cat'   => 'kaas',
			'products_title' => __( 'Populaire kazen', 'de-kaasgenoten' ),
			'cta_block'     => array(
				'eyebrow' => __( 'Hulp nodig bij je keuze?', 'de-kaasgenoten' ),
				'title'   => __( 'Niet zeker welke kaas bij je past?', 'de-kaasgenoten' ),
				'text'    => __( 'Onze kaasspecialisten stellen graag een selectie samen op basis van jouw smaak en gelegenheid.', 'de-kaasgenoten' ),
				'button'  => __( 'Persoonlijk advies', 'de-kaasgenoten' ),
				'url'     => $contact,
			),
		),

		'delicatessen' => array(
			'eyebrow'       => __( 'Lekker erbij', 'de-kaasgenoten' ),
			'title'         => __( 'Delicatessen', 'de-kaasgenoten' ),
			'intro'         => __( 'De lekkerste begeleiders bij je kaas: noten, olijven, dips en andere ambachtelijke smaakmakers.', 'de-kaasgenoten' ),
			'image'         => 'cat-delicatessen.jpg',
			'cta'           => __( 'Bekijk alle delicatessen', 'de-kaasgenoten' ),
			'url'           => dkg_product_category_url( 'delicatessen', 'delicatessen' ),
			'secondary'     => array( 'label' => __( 'Stel een borrelplank samen', 'de-kaasgenoten' ), 'url' => dkg_product_category_url( 'borrelpakketten', 'pakketten' ) ),
			'lead'          => __( 'Maak van elke borrel een feest. Onze delicatessen zijn met zorg uitgekozen om perfect te combineren met onze kazen.', 'de-kaasgenoten' ),
			'collections'   => array(
				array( 'title' => __( 'Noten', 'de-kaasgenoten' ), 'text' => __( 'Gebrand, gezouten of puur — altijd vers.', 'de-kaasgenoten' ), 'image' => 'cat-noten.jpg', 'url' => dkg_product_category_url( 'noten', 'delicatessen' ) ),
				array( 'title' => __( 'Olijven & antipasti', 'de-kaasgenoten' ), 'text' => __( 'Mediterrane smaken voor op tafel.', 'de-kaasgenoten' ), 'image' => 'cat-delicatessen.jpg', 'url' => dkg_product_category_url( 'olijven', 'delicatessen' ) ),
				array( 'title' => __( 'Dips & spreads', 'de-kaasgenoten' ), 'text' => __( 'Romige en hartige smaakmakers om te dippen.', 'de-kaasgenoten' ), 'image' => 'product-extra.jpg', 'url' => dkg_product_category_url( 'dips', 'delicatessen' ) ),
				array( 'title' => __( 'Wijn & borrel', 'de-kaasgenoten' ), 'text' => __( 'De perfecte begeleiders bij een mooie kaasplank.', 'de-kaasgenoten' ), 'image' => 'cat-wijn.jpg', 'url' => dkg_product_category_url( 'wijn', 'delicatessen' ) ),
			),
			'product_cat'   => 'delicatessen',
			'products_title' => __( 'Populaire delicatessen', 'de-kaasgenoten' ),
			'cta_block'     => array(
				'eyebrow' => __( 'Compleet maken?', 'de-kaasgenoten' ),
				'title'   => __( 'Combineer met onze kazen', 'de-kaasgenoten' ),
				'text'    => __( 'Stel zelf je ideale plank samen of laat ons een passend pakket voor je verzorgen.', 'de-kaasgenoten' ),
				'button'  => __( 'Bekijk pakketten', 'de-kaasgenoten' ),
				'url'     => dkg_product_category_url( 'pakketten', 'pakketten' ),
			),
		),

		'pakketten' => array(
			'eyebrow'       => __( 'Kant-en-klaar genieten', 'de-kaasgenoten' ),
			'title'         => __( 'Pakketten', 'de-kaasgenoten' ),
			'intro'         => __( 'Rijk gevulde pakketten boordevol kaas en delicatessen — perfect om te geven of samen van te genieten.', 'de-kaasgenoten' ),
			'image'         => 'cat-pakketten.jpg',
			'cta'           => __( 'Bekijk alle pakketten', 'de-kaasgenoten' ),
			'url'           => dkg_product_category_url( 'pakketten', 'pakketten' ),
			'secondary'     => array( 'label' => __( 'Pakket op maat aanvragen', 'de-kaasgenoten' ), 'url' => $contact ),
			'lead'          => __( 'Geen gedoe, wel genieten. Onze pakketten zijn met aandacht samengesteld en verzorgd verpakt, klaar om te delen of cadeau te geven.', 'de-kaasgenoten' ),
			'collections'   => array(
				array( 'title' => __( 'Borrelpakketten', 'de-kaasgenoten' ), 'text' => __( 'Alles voor een gezellige borrel in één pakket.', 'de-kaasgenoten' ), 'image' => 'promo-pakketten.jpg', 'url' => dkg_product_category_url( 'borrelpakketten', 'pakketten' ) ),
				array( 'title' => __( 'Kerstpakketten', 'de-kaasgenoten' ), 'text' => __( 'Feestelijk samengesteld voor de mooiste tijd van het jaar.', 'de-kaasgenoten' ), 'image' => 'cat-pakketten.jpg', 'url' => dkg_product_category_url( 'kerstpakketten', 'pakketten' ) ),
				array( 'title' => __( 'Cadeaupakketten', 'de-kaasgenoten' ), 'text' => __( 'Een smaakvol cadeau voor elke gelegenheid.', 'de-kaasgenoten' ), 'image' => 'promo-zakelijk.jpg', 'url' => dkg_product_category_url( 'relatiegeschenken', 'geschenken' ) ),
				array( 'title' => __( 'Pakket op maat', 'de-kaasgenoten' ), 'text' => __( 'Stel samen met ons jouw ideale pakket samen.', 'de-kaasgenoten' ), 'image' => 'about-founders.jpg', 'url' => $contact ),
			),
			'product_cat'   => 'pakketten',
			'products_title' => __( 'Onze favoriete pakketten', 'de-kaasgenoten' ),
			'cta_block'     => array(
				'eyebrow' => __( 'Iets bijzonders nodig?', 'de-kaasgenoten' ),
				'title'   => __( 'Pakket op maat samenstellen', 'de-kaasgenoten' ),
				'text'    => __( 'Vertel ons je wensen en budget, dan stellen wij een passend pakket voor je samen.', 'de-kaasgenoten' ),
				'button'  => __( 'Neem contact op', 'de-kaasgenoten' ),
				'url'     => $contact,
			),
		),

		'geschenken' => array(
			'eyebrow'       => __( 'Geef smaak cadeau', 'de-kaasgenoten' ),
			'title'         => __( 'Geschenken', 'de-kaasgenoten' ),
			'intro'         => __( 'Stijlvolle kaascadeaus voor familie, vrienden en relaties — persoonlijk, verzorgd en altijd gewaardeerd.', 'de-kaasgenoten' ),
			'image'         => 'cat-zakelijk.jpg',
			'cta'           => __( 'Bekijk alle geschenken', 'de-kaasgenoten' ),
			'url'           => dkg_product_category_url( 'geschenken', 'geschenken' ),
			'secondary'     => array( 'label' => __( 'Cadeau op maat', 'de-kaasgenoten' ), 'url' => $contact ),
			'lead'          => __( 'Een cadeau dat blijft hangen. Onze geschenken combineren ambachtelijke kwaliteit met een verzorgde presentatie.', 'de-kaasgenoten' ),
			'collections'   => array(
				array( 'title' => __( 'Relatiegeschenken', 'de-kaasgenoten' ), 'text' => __( 'Onderscheidende cadeaus voor klanten en relaties.', 'de-kaasgenoten' ), 'image' => 'promo-zakelijk.jpg', 'url' => dkg_product_category_url( 'relatiegeschenken', 'zakelijk' ) ),
				array( 'title' => __( 'Kerstgeschenken', 'de-kaasgenoten' ), 'text' => __( 'Feestelijke cadeaus om het jaar mee af te sluiten.', 'de-kaasgenoten' ), 'image' => 'cat-pakketten.jpg', 'url' => dkg_product_category_url( 'kerstpakketten', 'pakketten' ) ),
				array( 'title' => __( 'Persoonlijk cadeau', 'de-kaasgenoten' ), 'text' => __( 'Voor een verjaardag, bedankje of zomaar.', 'de-kaasgenoten' ), 'image' => 'promo-pakketten.jpg', 'url' => dkg_product_category_url( 'borrelpakketten', 'pakketten' ) ),
				array( 'title' => __( 'Cadeaubon', 'de-kaasgenoten' ), 'text' => __( 'Laat de ontvanger zelf kiezen wat hij lekker vindt.', 'de-kaasgenoten' ), 'image' => 'about-founders.jpg', 'url' => $contact ),
			),
			'product_cat'   => 'geschenken',
			'products_title' => __( 'Geliefde cadeaus', 'de-kaasgenoten' ),
			'cta_block'     => array(
				'eyebrow' => __( 'Iets persoonlijks?', 'de-kaasgenoten' ),
				'title'   => __( 'Cadeau op maat', 'de-kaasgenoten' ),
				'text'    => __( 'We stellen graag een cadeau samen dat helemaal past bij de ontvanger en de gelegenheid.', 'de-kaasgenoten' ),
				'button'  => __( 'Neem contact op', 'de-kaasgenoten' ),
				'url'     => $contact,
			),
		),

		'zakelijk' => array(
			'eyebrow'       => __( 'Zakelijk bestellen', 'de-kaasgenoten' ),
			'title'         => __( 'Zakelijk & maatwerk', 'de-kaasgenoten' ),
			'intro'         => __( 'Voor bedrijven die relaties, medewerkers of gasten iets smaakvols en verzorgds willen geven.', 'de-kaasgenoten' ),
			'image'         => 'promo-zakelijk.jpg',
			'cta'           => __( 'Neem contact op', 'de-kaasgenoten' ),
			'url'           => $contact,
			'secondary'     => array( 'label' => __( 'Bekijk relatiegeschenken', 'de-kaasgenoten' ), 'url' => dkg_product_category_url( 'relatiegeschenken', 'geschenken' ) ),
			'lead'          => __( 'Van een compact bedankje tot een royaal kerstpakket voor het hele team: we denken met je mee over inhoud, budget en bezorging.', 'de-kaasgenoten' ),
			'collections'   => array(
				array( 'title' => __( 'Relatiegeschenken', 'de-kaasgenoten' ), 'text' => __( 'Een onderscheidend cadeau dat waardering uitstraalt.', 'de-kaasgenoten' ), 'image' => 'promo-zakelijk.jpg', 'url' => dkg_product_category_url( 'relatiegeschenken', 'geschenken' ) ),
				array( 'title' => __( 'Kerstpakketten voor teams', 'de-kaasgenoten' ), 'text' => __( 'Verras medewerkers met een feestelijk pakket.', 'de-kaasgenoten' ), 'image' => 'cat-pakketten.jpg', 'url' => dkg_product_category_url( 'kerstpakketten', 'pakketten' ) ),
				array( 'title' => __( 'Maatwerk per budget', 'de-kaasgenoten' ), 'text' => __( 'Van klein gebaar tot uitgebreid geschenk.', 'de-kaasgenoten' ), 'image' => 'promo-pakketten.jpg', 'url' => $contact ),
				array( 'title' => __( 'Levering op meerdere adressen', 'de-kaasgenoten' ), 'text' => __( 'Handig voor teams, klanten en landelijke spreiding.', 'de-kaasgenoten' ), 'image' => 'about-founders.jpg', 'url' => $contact ),
			),
			'product_cat'   => '',
			'products_title' => '',
			'cta_block'     => array(
				'eyebrow' => __( 'Samen regelen', 'de-kaasgenoten' ),
				'title'   => __( 'Plan een zakelijke bestelling', 'de-kaasgenoten' ),
				'text'    => __( 'Neem contact op voor een vrijblijvend voorstel op maat, afgestemd op jouw wensen en planning.', 'de-kaasgenoten' ),
				'button'  => __( 'Neem contact op', 'de-kaasgenoten' ),
				'url'     => $contact,
			),
		),
	);

	// Aliassen zodat bestaande pagina's/templates blijven werken.
	$aliases = array(
		'kaas-delicatessen' => 'kaas',
		'borrelpakketten'   => 'pakketten',
		'kerstpakketten'    => 'pakketten',
		'relatiegeschenken' => 'geschenken',
	);

	if ( isset( $aliases[ $key ] ) ) {
		$key = $aliases[ $key ];
	}

	$data = isset( $pages[ $key ] ) ? $pages[ $key ] : null;

	if ( $data && ! isset( $data['usps'] ) ) {
		$data['usps'] = dkg_luxe_default_usps();
	}

	return $data ? apply_filters( 'dkg_luxe_page_data', $data, $key ) : null;
}

/**
 * Koppel een productcategorie-slug aan de bijbehorende landingsdata.
 *
 * Zo kan ook het WooCommerce-categorie-archief de rijke layout tonen,
 * ongeacht of het menu naar een pagina of naar een categorie wijst.
 *
 * @param string $slug Slug van de productcategorie.
 * @return array<string, mixed>|null
 */
function dkg_luxe_data_for_term( $slug ) {
	$map = array(
		// Hoofdcategorie + alle kaas-subcategorieën/merken → Kaas-landing.
		'biologische-kaas'     => 'kaas',
		'bastiaansen'          => 'kaas',
		'mekkerstee'           => 'kaas',
		'terschellinger'       => 'kaas',
		'boerenkaas'           => 'kaas',
		'ravenswaard'          => 'kaas',
		'lutjewinkel'          => 'kaas',
		'noord-hollandse-kaas' => 'kaas',
		'goudse-kaas'          => 'kaas',
		// Pakketten & Geschenken (gecombineerde categorie).
		'pakketten-geschenken' => 'pakketten',
		'borrelpakketten'      => 'pakketten',
		'kerstpakketten'       => 'pakketten',
		'relatiegeschenken'    => 'geschenken',
		// Delicatessen-subcategorieën (indien aanwezig).
		'noten'                => 'delicatessen',
		'olijven'              => 'delicatessen',
		'dips'                 => 'delicatessen',
		'wijn'                 => 'delicatessen',
	);

	$key = isset( $map[ $slug ] ) ? $map[ $slug ] : $slug;

	return dkg_luxe_page_data( $key );
}

/**
 * Render de korte intro-tekst (lead).
 *
 * @param array<string, mixed> $data Landingsdata.
 */
function dkg_luxe_render_lead( $data ) {
	if ( empty( $data['lead'] ) ) {
		return;
	}
	?>
	<section class="dkg-section dkg-cat-lead">
		<div class="dkg-container">
			<p><?php echo esc_html( $data['lead'] ); ?></p>
		</div>
	</section>
	<?php
}

/**
 * Render het grid met subcollecties.
 *
 * @param array<string, mixed> $data    Landingsdata.
 * @param string               $heading Optionele kop.
 */
function dkg_luxe_render_collections( $data, $heading = '', $collections = null ) {
	if ( null === $collections ) {
		$collections = isset( $data['collections'] ) ? $data['collections'] : array();
	}

	if ( empty( $collections ) ) {
		return;
	}

	if ( '' === $heading ) {
		$heading = __( 'Ontdek de collectie', 'de-kaasgenoten' );
	}
	?>
	<section class="dkg-section dkg-cat-collections">
		<div class="dkg-container">
			<?php if ( $heading ) : ?>
				<div class="dkg-section-heading">
					<h2><?php echo esc_html( $heading ); ?></h2>
				</div>
			<?php endif; ?>
			<div class="dkg-cat-collection-grid">
				<?php
				foreach ( $collections as $col ) :
					if ( ! empty( $col['image_url'] ) ) {
						$col_image = $col['image_url'];
					} elseif ( ! empty( $col['image'] ) ) {
						$col_image = dkg_asset_uri( 'images/' . $col['image'] );
					} else {
						$col_image = dkg_asset_uri( 'images/cat-kaas.jpg' );
					}
					?>
					<a class="dkg-cat-collection-card" href="<?php echo esc_url( $col['url'] ); ?>">
						<span class="dkg-cat-collection-image">
							<img src="<?php echo esc_url( $col_image ); ?>" alt="<?php echo esc_attr( $col['title'] ); ?>" loading="lazy" />
						</span>
						<span class="dkg-cat-collection-body">
							<span class="dkg-cat-collection-title"><?php echo esc_html( $col['title'] ); ?></span>
							<span class="dkg-cat-collection-text"><?php echo esc_html( $col['text'] ); ?></span>
							<span class="dkg-cat-collection-link"><?php esc_html_e( 'Bekijken', 'de-kaasgenoten' ); ?> &rarr;</span>
						</span>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
}

/**
 * Render de USP-rij.
 *
 * @param array<string, mixed> $data Landingsdata.
 */
function dkg_luxe_render_usps( $data ) {
	if ( empty( $data['usps'] ) ) {
		return;
	}
	?>
	<section class="dkg-section dkg-cat-usps">
		<div class="dkg-container dkg-cat-usp-grid">
			<?php foreach ( $data['usps'] as $usp ) : ?>
				<article class="dkg-cat-usp">
					<span class="dkg-cat-usp-icon"><?php echo dkg_icon( $usp['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<h3><?php echo esc_html( $usp['title'] ); ?></h3>
					<p><?php echo esc_html( $usp['text'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</section>
	<?php
}

/**
 * Render de afsluitende CTA-sectie.
 *
 * @param array<string, mixed> $data Landingsdata.
 */
function dkg_luxe_render_cta( $data ) {
	if ( empty( $data['cta_block'] ) ) {
		return;
	}
	$cta = $data['cta_block'];
	?>
	<section class="dkg-cat-cta">
		<div class="dkg-container">
			<?php if ( ! empty( $cta['eyebrow'] ) ) : ?>
				<p class="dkg-eyebrow"><?php echo esc_html( $cta['eyebrow'] ); ?></p>
			<?php endif; ?>
			<h2><?php echo esc_html( $cta['title'] ); ?></h2>
			<?php if ( ! empty( $cta['text'] ) ) : ?>
				<p><?php echo esc_html( $cta['text'] ); ?></p>
			<?php endif; ?>
			<a class="dkg-button dkg-button-gold" href="<?php echo esc_url( $cta['url'] ); ?>"><?php echo esc_html( $cta['button'] ); ?></a>
		</div>
	</section>
	<?php
}

/**
 * Render een rij uitgelichte producten uit een categorie.
 *
 * @param array<string, mixed> $data Landingsdata.
 */
function dkg_luxe_render_products( $data ) {
	$products = ! empty( $data['product_cat'] ) && function_exists( 'dkg_category_products' )
		? dkg_category_products( $data['product_cat'], 4 )
		: array();

	if ( empty( $products ) ) {
		return;
	}
	?>
	<section class="dkg-section dkg-products-section dkg-cat-products">
		<div class="dkg-container">
			<div class="dkg-section-heading">
				<h2><?php echo esc_html( ! empty( $data['products_title'] ) ? $data['products_title'] : __( 'Uitgelicht', 'de-kaasgenoten' ) ); ?></h2>
				<a href="<?php echo esc_url( $data['url'] ); ?>"><?php echo esc_html( $data['cta'] ); ?> &rarr;</a>
			</div>
			<div class="dkg-product-grid">
				<?php foreach ( $products as $product ) : ?>
					<?php dkg_product_card_from_product( $product ); ?>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
}

/**
 * Render een complete categorie-landingspagina.
 *
 * @param string $key Pagina-sleutel.
 */
function dkg_render_luxe_page( $key ) {
	$data = dkg_luxe_page_data( $key );

	if ( ! $data ) {
		get_header();
		echo '<main id="primary" class="dkg-main"><div class="dkg-container dkg-section"><p>' . esc_html__( 'Deze pagina is nog niet beschikbaar.', 'de-kaasgenoten' ) . '</p></div></main>';
		get_footer();
		return;
	}

	$page_content = '';
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			$page_content = trim( apply_filters( 'the_content', get_the_content() ) );
		}
	}

	$hero_image = dkg_asset_uri( 'images/' . $data['image'] );

	get_header();
	?>
	<main id="primary" class="dkg-main dkg-cat-page">
		<section class="dkg-cat-hero" style="background-image: linear-gradient(90deg, rgba(16,37,27,.94), rgba(16,37,27,.68) 42%, rgba(16,37,27,.15)), url('<?php echo esc_url( $hero_image ); ?>');">
			<div class="dkg-container">
				<p class="dkg-eyebrow"><?php echo esc_html( $data['eyebrow'] ); ?></p>
				<h1><?php echo esc_html( $data['title'] ); ?></h1>
				<p class="dkg-cat-hero-intro"><?php echo esc_html( $data['intro'] ); ?></p>
				<div class="dkg-cat-hero-actions">
					<a class="dkg-button dkg-button-gold" href="<?php echo esc_url( $data['url'] ); ?>"><?php echo esc_html( $data['cta'] ); ?></a>
					<?php if ( ! empty( $data['secondary']['label'] ) ) : ?>
						<a class="dkg-button dkg-button-ghost" href="<?php echo esc_url( $data['secondary']['url'] ); ?>"><?php echo esc_html( $data['secondary']['label'] ); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</section>

		<?php
		dkg_luxe_render_lead( $data );
		dkg_luxe_render_collections( $data );
		dkg_luxe_render_products( $data );
		dkg_luxe_render_usps( $data );
		?>

		<?php if ( $page_content ) : ?>
			<section class="dkg-section dkg-cat-content">
				<div class="dkg-container">
					<div class="dkg-entry-content">
						<?php echo $page_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<?php dkg_luxe_render_cta( $data ); ?>
	</main>
	<?php
	get_footer();
}
