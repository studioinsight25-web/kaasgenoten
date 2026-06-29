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
			'text'  => __( 'Hetzelfde eerlijke advies als op onze marktkraam.', 'de-kaasgenoten' ),
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
				array( 'title' => __( 'Boerenkaas', 'de-kaasgenoten' ), 'text' => __( 'Vol en ambachtelijk, van vertrouwde kaasboeren.', 'de-kaasgenoten' ), 'image' => 'boerenkaas-ravenswaard.png', 'url' => dkg_product_category_url( 'boerenkaas', 'kaas' ) ),
				array( 'title' => __( 'Noord-Hollandse kaas', 'de-kaasgenoten' ), 'text' => __( 'Traditionele polderkaas met rijke, volle smaak.', 'de-kaasgenoten' ), 'image' => 'noord-hollandse-kaas-hero.jpg', 'url' => dkg_product_category_url( 'noord-hollandse-kaas', 'kaas' ) ),
				array( 'title' => __( 'Biologische kaas', 'de-kaasgenoten' ), 'text' => __( 'Eerlijk gemaakt, met respect voor dier en natuur.', 'de-kaasgenoten' ), 'image' => 'product-geiten.jpg', 'url' => dkg_product_category_url( 'biologische-kaas', 'kaas' ) ),
				array( 'title' => __( 'Lutjewinkel', 'de-kaasgenoten' ), 'text' => __( 'Karaktervolle kaas met een eigen smaak.', 'de-kaasgenoten' ), 'image' => 'noord-hollandse-lutjewinkel.png', 'url' => dkg_product_category_url( 'lutjewinkel', 'kaas' ) ),
				array( 'title' => __( 'Terschellinger', 'de-kaasgenoten' ), 'text' => __( 'Bijzondere eilandkaas voor de liefhebber.', 'de-kaasgenoten' ), 'image' => 'product-truffel.jpg', 'url' => dkg_product_category_url( 'terschellinger', 'kaas' ) ),
			),
			'product_cat'   => 'kaas',
			'products_title' => __( 'Populaire kazen', 'de-kaasgenoten' ),
			'cta_block'     => array(
				'eyebrow' => __( 'Hulp nodig bij je keuze?', 'de-kaasgenoten' ),
				'title'   => __( 'Niet zeker welke kaas bij je past?', 'de-kaasgenoten' ),
				'text'    => __( 'Wij denken graag met u mee en stellen een selectie samen op basis van uw smaak en gelegenheid.', 'de-kaasgenoten' ),
				'button'  => __( 'Persoonlijk advies', 'de-kaasgenoten' ),
				'url'     => $contact,
			),
		),

		'biologische-kaas' => array(
			'eyebrow'        => __( 'Ambachtelijk geselecteerd', 'de-kaasgenoten' ),
			'title'          => __( 'Biologische Kaas', 'de-kaasgenoten' ),
			'intro'          => __( 'Van romige jonge kaas tot karaktervolle oude kaas — met zorg geselecteerd bij ambachtelijke kaasmakerijen.', 'de-kaasgenoten' ),
			'image'          => 'cat-kaas.jpg',
			'cta'            => __( 'Bekijk alle biologische kaas', 'de-kaasgenoten' ),
			'url'            => dkg_product_category_url( 'biologische-kaas', 'kaas' ),
			'secondary'      => array( 'label' => __( 'Vraag persoonlijk advies', 'de-kaasgenoten' ), 'url' => $contact ),
			'lead'           => __( 'Bij De Kaasgenoten draait alles om smaak en kwaliteit. We werken samen met boeren en kaasmakers die hun vak verstaan, zodat jij thuis geniet van kaas met een verhaal.', 'de-kaasgenoten' ),
			'product_cat'    => 'biologische-kaas',
			'products_title' => __( 'Populaire biologische kazen', 'de-kaasgenoten' ),
			'cta_block'      => array(
				'eyebrow' => __( 'Hulp nodig bij je keuze?', 'de-kaasgenoten' ),
				'title'   => __( 'Niet zeker welke kaas bij je past?', 'de-kaasgenoten' ),
				'text'    => __( 'Wij denken graag met u mee en stellen een selectie samen op basis van uw smaak en gelegenheid.', 'de-kaasgenoten' ),
				'button'  => __( 'Persoonlijk advies', 'de-kaasgenoten' ),
				'url'     => $contact,
			),
		),

		'noord-hollandse-kaas' => array(
			'eyebrow'          => __( 'Traditie uit de polder', 'de-kaasgenoten' ),
			'title'            => __( 'Noord-Hollandse kaas', 'de-kaasgenoten' ),
			'intro'            => __( 'Echte Noord-Hollandse kaas dankt haar rijke smaak aan het weidegras, de volle melk en eeuwenoude kaasmakerstraditie uit de polder.', 'de-kaasgenoten' ),
			'hero_layout'      => 'split',
			'image'            => 'noord-hollandse-kaas-hero.jpg',
			'cta'              => __( 'Ontdek onze makers', 'de-kaasgenoten' ),
			'url'              => '#dkg-nh-makers',
			'secondary'        => array( 'label' => __( 'Vraag persoonlijk advies', 'de-kaasgenoten' ), 'url' => $contact ),
			'spotlights_id'    => 'dkg-nh-makers',
			'spotlights_heading' => __( 'Ontdek onze makers', 'de-kaasgenoten' ),
			'spotlights_aria_label' => __( 'Onze Noord-Hollandse makers', 'de-kaasgenoten' ),
			'lead'             => __( 'Noord-Hollandse kaas staat bekend om haar zachte, volle smaak en karakteristieke rijping. De combinatie van vruchtbare weilanden, gecontroleerde kwaliteit en vakmanschap maakt elke hap bijzonder.', 'de-kaasgenoten' ),
			'story'            => array(
				'heading'    => __( 'Waarom Noord-Hollandse kaas zo lekker is', 'de-kaasgenoten' ),
				'paragraphs' => array(
					__( 'In de Noord-Hollandse polder groeien koeien op weidegras dat rijk is aan voedingsstoffen. Die volle melk vormt de basis voor een kaas met een zachte structuur, een mild-zilt karakter en een subtiel nootachtig aroma.', 'de-kaasgenoten' ),
					__( 'Traditionele rijping op houten planken geeft de kaas tijd om haar smaak te ontwikkelen — van romig en zacht tot karaktervol en licht pittig. Dat vakmanschap proeft u in elke snede.', 'de-kaasgenoten' ),
					__( 'Bij De Kaasgenoten selecteren we Noord-Hollandse kazen van makers die deze traditie met trots voortzetten. Ontdek hieronder onze favorieten: Lutjewinkel en Beemster.', 'de-kaasgenoten' ),
				),
			),
			'hero_highlights'  => array(
				array( 'icon' => 'farm', 'text' => __( 'Weidemelk uit de polder', 'de-kaasgenoten' ) ),
				array( 'icon' => 'leaf', 'text' => __( 'Ambachtelijk gerijpt', 'de-kaasgenoten' ) ),
				array( 'icon' => 'award', 'text' => __( 'Echte Noord-Hollandse kwaliteit', 'de-kaasgenoten' ) ),
			),
			'brand_spotlights' => array(
				array(
					'title'    => __( 'Lutjewinkel', 'de-kaasgenoten' ),
					'subtitle' => __( 'Echte Noord-Hollandse kaas met karakter', 'de-kaasgenoten' ),
					'text'     => __( 'Zacht van smaak, rijk van traditie — al sinds 1916 met vakmanschap gemaakt in het hart van Noord-Holland.', 'de-kaasgenoten' ),
					'image'    => 'noord-hollandse-lutjewinkel.png',
					'cta'      => __( 'Bekijk Lutjewinkel kazen', 'de-kaasgenoten' ),
					'url'      => dkg_product_category_url( 'lutjewinkel', 'kaas' ),
				),
				array(
					'title'    => __( 'Beemster', 'de-kaasgenoten' ),
					'subtitle' => __( 'Wereldberoemde kaas uit de Beemster', 'de-kaasgenoten' ),
					'text'     => __( 'Rijk van smaak, gemaakt met vakmanschap — een klassieker die al sinds 1612 de tafel siert.', 'de-kaasgenoten' ),
					'image'    => 'noord-hollandse-beemster.png',
					'cta'      => __( 'Bekijk Beemster kazen', 'de-kaasgenoten' ),
					'url'      => dkg_product_category_url( 'beemster', 'kaas' ),
				),
			),
			'show_products'    => false,
			'collections'      => array(),
			'product_cat'      => 'noord-hollandse-kaas',
			'usps'             => array(
				array(
					'icon'  => 'farm',
					'title' => __( 'Polderweide & volle melk', 'de-kaasgenoten' ),
					'text'  => __( 'Het weidegras van Noord-Holland geeft de kaas haar kenmerkende zachte, volle smaak.', 'de-kaasgenoten' ),
				),
				array(
					'icon'  => 'knife',
					'title' => __( 'Traditioneel gerijpt', 'de-kaasgenoten' ),
					'text'  => __( 'Met tijd en aandacht ontwikkelt de kaas haar rijke, nootachtige karakter.', 'de-kaasgenoten' ),
				),
				array(
					'icon'  => 'award',
					'title' => __( 'Echte herkomst', 'de-kaasgenoten' ),
					'text'  => __( 'Noord-Hollandse kaas staat voor kwaliteit, traditie en herkenbare smaak.', 'de-kaasgenoten' ),
				),
				array(
					'icon'  => 'hand',
					'title' => __( 'Met zorg geselecteerd', 'de-kaasgenoten' ),
					'text'  => __( 'Wij kiezen makers die vakmanschap en smaak voorop stellen.', 'de-kaasgenoten' ),
				),
			),
			'cta_block'        => array(
				'eyebrow' => __( 'Hulp bij uw keuze?', 'de-kaasgenoten' ),
				'title'   => __( 'Welke Noord-Hollandse kaas past bij u?', 'de-kaasgenoten' ),
				'text'    => __( 'Wij denken graag met u mee over de juiste kaas voor op tafel, de borrel of als cadeau.', 'de-kaasgenoten' ),
				'button'  => __( 'Persoonlijk advies', 'de-kaasgenoten' ),
				'url'     => $contact,
			),
		),

		'boerenkaas' => array(
			'eyebrow'               => __( 'Ambacht van de boerderij', 'de-kaasgenoten' ),
			'title'                 => __( 'Boerenkaas', 'de-kaasgenoten' ),
			'intro'                 => __( 'Echte boerenkaas uit het hart van het land — ambachtelijk gemaakt met volle melk, tijd en aandacht op de boerderij.', 'de-kaasgenoten' ),
			'hero_layout'           => 'split',
			'image'                 => 'boerenkaas-logo.png',
			'hero_image_is_logo'    => true,
			'cta'                   => __( 'Ontdek Ravenswaard', 'de-kaasgenoten' ),
			'url'                   => '#dkg-boeren-makers',
			'secondary'             => array( 'label' => __( 'Vraag persoonlijk advies', 'de-kaasgenoten' ), 'url' => $contact ),
			'spotlights_id'         => 'dkg-boeren-makers',
			'spotlights_heading'    => __( 'Onze boerenkaas', 'de-kaasgenoten' ),
			'spotlights_aria_label' => __( 'Onze boerenkaas makers', 'de-kaasgenoten' ),
			'lead'                  => __( 'Boerenkaas dankt haar rijke smaak aan korte ketens, weidemelk en het vakmanschap van de kaasmaker op de boerderij. Vol, eerlijk en met een karakter dat u proeft.', 'de-kaasgenoten' ),
			'story'                 => array(
				'heading'    => __( 'Waarom boerenkaas zo lekker is', 'de-kaasgenoten' ),
				'paragraphs' => array(
					__( 'Boerenkaas wordt gemaakt op de boerderij zelf, met melk van koeien die grazen op weilanden in de omgeving. Die korte keten en de volle melk geven een rijke, authentieke smaak die u niet vindt in massaproductie.', 'de-kaasgenoten' ),
					__( 'Met tijd en geduld rijpt de kaas tot een vol karakter — van zacht en romig tot stevig en licht pittig. Elke boerderij heeft zijn eigen signatuur, en dat proeft u in elke snede.', 'de-kaasgenoten' ),
					__( 'Bij De Kaasgenoten werken we samen met boeren die hun vak met passie uitoefenen. Ontdek hieronder Ravenswaard Boerenkaas uit Afferden in het hart van Gelderland.', 'de-kaasgenoten' ),
				),
			),
			'hero_highlights'       => array(
				array( 'icon' => 'farm', 'text' => __( 'Gemaakt op de boerderij', 'de-kaasgenoten' ) ),
				array( 'icon' => 'leaf', 'text' => __( 'Weidemelk uit de regio', 'de-kaasgenoten' ) ),
				array( 'icon' => 'award', 'text' => __( 'Afgerijpt met tijd en zorg', 'de-kaasgenoten' ) ),
			),
			'brand_spotlights'      => array(
				array(
					'title'    => __( 'Ravenswaard', 'de-kaasgenoten' ),
					'subtitle' => __( 'Echte boerenkaas uit het hart van Gelderland', 'de-kaasgenoten' ),
					'text'     => __( 'Ambachtelijk gemaakt op boerderij Ravenswaard in Afferden — afgerijpt met tijd, gemaakt met liefde.', 'de-kaasgenoten' ),
					'image'    => 'boerenkaas-ravenswaard.png',
					'cta'      => __( 'Bekijk Ravenswaard kazen', 'de-kaasgenoten' ),
					'url'      => dkg_product_category_url( 'ravenswaard', 'kaas' ),
				),
			),
			'show_products'         => false,
			'collections'           => array(),
			'product_cat'           => 'boerenkaas',
			'usps'                  => array(
				array(
					'icon'  => 'farm',
					'title' => __( 'Korte keten', 'de-kaasgenoten' ),
					'text'  => __( 'Van melk tot kaas op dezelfde boerderij — puur en eerlijk.', 'de-kaasgenoten' ),
				),
				array(
					'icon'  => 'knife',
					'title' => __( 'Met de hand gerijpt', 'de-kaasgenoten' ),
					'text'  => __( 'Traditionele rijping geeft de kaas tijd om haar volle smaak te ontwikkelen.', 'de-kaasgenoten' ),
				),
				array(
					'icon'  => 'award',
					'title' => __( 'Echt boerenkarakter', 'de-kaasgenoten' ),
					'text'  => __( 'Vol van smaak, met de herkenbare kwaliteit van ambachtelijke boerenkaas.', 'de-kaasgenoten' ),
				),
				array(
					'icon'  => 'hand',
					'title' => __( 'Met zorg geselecteerd', 'de-kaasgenoten' ),
					'text'  => __( 'Wij kiezen boeren die vakmanschap en smaak voorop stellen.', 'de-kaasgenoten' ),
				),
			),
			'cta_block'             => array(
				'eyebrow' => __( 'Hulp bij uw keuze?', 'de-kaasgenoten' ),
				'title'   => __( 'Welke boerenkaas past bij u?', 'de-kaasgenoten' ),
				'text'    => __( 'Wij denken graag met u mee over de juiste kaas voor op tafel, de borrel of als cadeau.', 'de-kaasgenoten' ),
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

		'aanbieding' => array(
			'eyebrow'       => __( 'Tijdelijk voordelig', 'de-kaasgenoten' ),
			'title'         => __( 'Aanbiedingen', 'de-kaasgenoten' ),
			'intro'         => __( 'Ontdek onze actuele deals op ambachtelijke kaas en delicatessen — dezelfde zorgvuldige selectie als op onze marktkraam, tijdelijk scherper geprijsd.', 'de-kaasgenoten' ),
			'image'         => 'promo-pakketten.jpg',
			'cta'           => __( 'Bekijk alle aanbiedingen', 'de-kaasgenoten' ),
			'url'           => dkg_product_category_url( 'aanbieding', 'aanbieding' ),
			'secondary'     => array( 'label' => __( 'Bekijk volledig assortiment', 'de-kaasgenoten' ), 'url' => dkg_shop_url() ),
			'lead'          => __( 'Hier vind je onze actuele aanbiedingen. Alleen producten die je expliciet aan de categorie Aanbieding koppelt, verschijnen op deze pagina.', 'de-kaasgenoten' ),
			'collections'   => array(),
			'product_cat'   => 'aanbieding',
			'products_title' => __( 'Actuele aanbiedingen', 'de-kaasgenoten' ),
			'usps'          => array(
				array(
					'icon'  => 'gift',
					'title' => __( 'Echte waarde', 'de-kaasgenoten' ),
					'text'  => __( 'Korting op geselecteerde kwaliteitsproducten, geen compromis op smaak.', 'de-kaasgenoten' ),
				),
				array(
					'icon'  => 'truck',
					'title' => __( 'Snel geleverd', 'de-kaasgenoten' ),
					'text'  => __( 'Ook aanbiedingen worden vers en gekoeld verzonden.', 'de-kaasgenoten' ),
				),
				array(
					'icon'  => 'shield',
					'title' => __( 'Beperkte voorraad', 'de-kaasgenoten' ),
					'text'  => __( 'Acties zijn tijdelijk — grijp je kans zolang het kan.', 'de-kaasgenoten' ),
				),
				array(
					'icon'  => 'hand',
					'title' => __( 'Persoonlijk advies', 'de-kaasgenoten' ),
					'text'  => __( 'Twijfel je? We helpen je graag met de beste keuze.', 'de-kaasgenoten' ),
				),
			),
			'cta_block'     => array(
				'eyebrow' => __( 'Niets gevonden?', 'de-kaasgenoten' ),
				'title'   => __( 'Bekijk ons volledige assortiment', 'de-kaasgenoten' ),
				'text'    => __( 'Naast aanbiedingen hebben we een uitgebreide selectie ambachtelijke kazen en delicatessen.', 'de-kaasgenoten' ),
				'button'  => __( 'Naar de winkel', 'de-kaasgenoten' ),
				'url'     => dkg_shop_url(),
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
		'biologische-kaas'     => 'biologische-kaas',
		'bastiaansen'          => 'kaas',
		'mekkerstee'           => 'kaas',
		'terschellinger'       => 'kaas',
		'boerenkaas'           => 'boerenkaas',
		'ravenswaard'          => 'kaas',
		'lutjewinkel'          => 'kaas',
		'noord-hollandse-kaas' => 'noord-hollandse-kaas',
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
 * Heeft deze landingspagina een split-hero layout?
 *
 * @param array<string, mixed> $data Landingsdata.
 * @return bool
 */
function dkg_luxe_has_split_hero( $data ) {
	return ! empty( $data['hero_layout'] ) && 'split' === $data['hero_layout'];
}

/**
 * Toon automatische subcategorie-kaarten onder de landingsinhoud?
 *
 * @param array<string, mixed> $data Landingsdata.
 * @return bool
 */
function dkg_luxe_should_render_child_collections( $data ) {
	if ( isset( $data['show_child_collections'] ) ) {
		return ! empty( $data['show_child_collections'] );
	}

	return empty( $data['brand_spotlights'] );
}

/**
 * Render split hero (licht, twee kolommen).
 *
 * @param array<string, mixed> $data        Landingsdata.
 * @param string               $title       Paginatitel.
 * @param string               $description Intro/omschrijving.
 */
function dkg_luxe_render_split_hero( $data, $title = '', $description = '' ) {
	$hero_image = ! empty( $data['image'] ) ? dkg_asset_uri( 'images/' . $data['image'] ) : '';
	$title      = $title ? $title : ( $data['title'] ?? '' );
	$description = $description ? $description : ( $data['intro'] ?? '' );
	?>
	<section class="dkg-cat-hero-split">
		<div class="dkg-container dkg-cat-hero-split__grid">
			<div class="dkg-cat-hero-split__copy">
				<?php
				if ( function_exists( 'woocommerce_breadcrumb' ) ) {
					woocommerce_breadcrumb(
						array(
							'wrap_before' => '<nav class="dkg-woo-breadcrumb dkg-woo-breadcrumb--light" aria-label="' . esc_attr__( 'Breadcrumb', 'de-kaasgenoten' ) . '">',
							'wrap_after'  => '</nav>',
						)
					);
				}
				?>
				<?php if ( ! empty( $data['eyebrow'] ) ) : ?>
					<p class="dkg-eyebrow dkg-eyebrow--green"><?php echo esc_html( $data['eyebrow'] ); ?></p>
				<?php endif; ?>
				<h1><?php echo esc_html( $title ); ?></h1>
				<?php if ( $description ) : ?>
					<div class="dkg-cat-hero-split__intro"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
				<?php endif; ?>
				<?php if ( ! empty( $data['cta'] ) && ! empty( $data['url'] ) ) : ?>
					<div class="dkg-cat-hero-split__actions">
						<a class="dkg-button dkg-button-gold" href="<?php echo esc_url( $data['url'] ); ?>"><?php echo esc_html( $data['cta'] ); ?></a>
						<?php if ( ! empty( $data['secondary']['label'] ) && ! empty( $data['secondary']['url'] ) ) : ?>
							<a class="dkg-button dkg-button-ghost dkg-button-ghost--dark" href="<?php echo esc_url( $data['secondary']['url'] ); ?>"><?php echo esc_html( $data['secondary']['label'] ); ?></a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( $data['hero_highlights'] ) && empty( $data['usps'] ) ) : ?>
					<ul class="dkg-cat-hero-split__highlights">
						<?php foreach ( $data['hero_highlights'] as $highlight ) : ?>
							<li>
								<span class="dkg-cat-hero-split__highlight-icon" aria-hidden="true"><?php echo dkg_icon( $highlight['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
								<span><?php echo esc_html( $highlight['text'] ); ?></span>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
			<?php if ( $hero_image ) : ?>
				<?php
				$visual_class = 'dkg-cat-hero-split__visual';

				if ( ! empty( $data['hero_image_is_logo'] ) ) {
					$visual_class .= ' dkg-cat-hero-split__visual--logo';
				}
				?>
				<div class="<?php echo esc_attr( $visual_class ); ?>">
					<img src="<?php echo esc_url( $hero_image ); ?>" alt="<?php echo esc_attr( $title ); ?>" width="420" height="520" loading="eager" decoding="async">
				</div>
			<?php endif; ?>
		</div>
	</section>
	<?php
}

/**
 * Render lead + story als één overzichtelijke contentsectie.
 *
 * @param array<string, mixed> $data Landingsdata.
 */
function dkg_luxe_render_editorial_content( $data ) {
	$has_lead  = ! empty( $data['lead'] );
	$has_story = ! empty( $data['story']['paragraphs'] );

	if ( ! $has_lead && ! $has_story ) {
		return;
	}

	$heading = ! empty( $data['story']['heading'] ) ? $data['story']['heading'] : '';
	?>
	<section class="dkg-section dkg-cat-editorial">
		<div class="dkg-container">
			<div class="dkg-cat-editorial__panel">
				<?php if ( $has_lead ) : ?>
					<p class="dkg-cat-editorial__lead"><?php echo esc_html( $data['lead'] ); ?></p>
				<?php endif; ?>
				<?php if ( $has_story ) : ?>
					<div class="dkg-cat-editorial__body">
						<?php if ( $heading ) : ?>
							<h2><?php echo esc_html( $heading ); ?></h2>
						<?php endif; ?>
						<?php foreach ( $data['story']['paragraphs'] as $paragraph ) : ?>
							<p><?php echo esc_html( $paragraph ); ?></p>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
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
 * Render een verhalende tekstsectie.
 *
 * @param array<string, mixed> $data Landingsdata.
 */
function dkg_luxe_render_story( $data ) {
	if ( empty( $data['story']['paragraphs'] ) ) {
		return;
	}

	$heading = ! empty( $data['story']['heading'] ) ? $data['story']['heading'] : '';
	?>
	<section class="dkg-section dkg-cat-story">
		<div class="dkg-container dkg-cat-story__inner">
			<?php if ( $heading ) : ?>
				<h2><?php echo esc_html( $heading ); ?></h2>
			<?php endif; ?>
			<?php foreach ( $data['story']['paragraphs'] as $paragraph ) : ?>
				<p><?php echo esc_html( $paragraph ); ?></p>
			<?php endforeach; ?>
		</div>
	</section>
	<?php
}

/**
 * Render grote merk-spotlights met bannerafbeeldingen.
 *
 * @param array<string, mixed> $data Landingsdata.
 */
function dkg_luxe_render_brand_spotlights( $data ) {
	if ( empty( $data['brand_spotlights'] ) ) {
		return;
	}

	$section_id   = ! empty( $data['spotlights_id'] ) ? $data['spotlights_id'] : 'dkg-makers';
	$heading      = ! empty( $data['spotlights_heading'] ) ? $data['spotlights_heading'] : __( 'Ontdek onze makers', 'de-kaasgenoten' );
	$aria_label   = ! empty( $data['spotlights_aria_label'] ) ? $data['spotlights_aria_label'] : __( 'Onze makers', 'de-kaasgenoten' );
	$grid_class   = 1 === count( $data['brand_spotlights'] ) ? ' dkg-cat-spotlight-grid--single' : '';
	?>
	<section class="dkg-section dkg-cat-spotlights" id="<?php echo esc_attr( $section_id ); ?>" aria-label="<?php echo esc_attr( $aria_label ); ?>">
		<div class="dkg-container">
			<div class="dkg-section-heading">
				<h2><?php echo esc_html( $heading ); ?></h2>
			</div>
			<div class="dkg-cat-spotlight-grid<?php echo esc_attr( $grid_class ); ?>">
				<?php foreach ( $data['brand_spotlights'] as $spotlight ) : ?>
					<?php
					$image = ! empty( $spotlight['image'] ) ? dkg_asset_uri( 'images/' . $spotlight['image'] ) : '';
					$url   = ! empty( $spotlight['url'] ) ? $spotlight['url'] : '#';
					?>
					<a class="dkg-cat-spotlight-card" href="<?php echo esc_url( $url ); ?>">
						<?php if ( $image ) : ?>
							<img class="dkg-cat-spotlight-card__image" src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $spotlight['title'] ?? '' ); ?>" loading="lazy" decoding="async">
						<?php endif; ?>
						<span class="dkg-cat-spotlight-card__shade" aria-hidden="true"></span>
						<span class="dkg-cat-spotlight-card__content">
							<?php if ( ! empty( $spotlight['subtitle'] ) ) : ?>
								<span class="dkg-cat-spotlight-card__subtitle"><?php echo esc_html( $spotlight['subtitle'] ); ?></span>
							<?php endif; ?>
							<span class="dkg-cat-spotlight-card__title"><?php echo esc_html( $spotlight['title'] ?? '' ); ?></span>
							<?php if ( ! empty( $spotlight['text'] ) ) : ?>
								<span class="dkg-cat-spotlight-card__text"><?php echo esc_html( $spotlight['text'] ); ?></span>
							<?php endif; ?>
							<span class="dkg-cat-spotlight-card__cta"><?php echo esc_html( $spotlight['cta'] ?? __( 'Bekijken', 'de-kaasgenoten' ) ); ?> &rarr;</span>
						</span>
					</a>
				<?php endforeach; ?>
			</div>
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
						<span class="dkg-cat-collection-image<?php echo ! empty( $col['is_brand_logo'] ) ? ' is-brand-logo' : ''; ?>">
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

	$section_class = 'dkg-section dkg-cat-usps';

	if ( dkg_luxe_has_split_hero( $data ) ) {
		$section_class .= ' dkg-cat-usps--feature';
	}
	?>
	<section class="<?php echo esc_attr( $section_class ); ?>">
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
	<main id="primary" class="dkg-main dkg-cat-page<?php echo dkg_luxe_has_split_hero( $data ) ? ' dkg-cat-page--split' : ''; ?>">
		<?php if ( dkg_luxe_has_split_hero( $data ) ) : ?>
			<?php dkg_luxe_render_split_hero( $data ); ?>
		<?php else : ?>
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
		<?php endif; ?>

		<?php
		dkg_luxe_render_lead( $data );

		if ( dkg_luxe_has_split_hero( $data ) ) {
			dkg_luxe_render_usps( $data );
		}

		dkg_luxe_render_collections( $data );
		dkg_luxe_render_products( $data );

		if ( ! dkg_luxe_has_split_hero( $data ) ) {
			dkg_luxe_render_usps( $data );
		}
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
