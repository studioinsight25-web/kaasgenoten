<?php
/**
 * Juridische pagina's, FAQ en bedrijfsgegevens.
 *
 * BELANGRIJK: de teksten hieronder zijn voorbeeldteksten als startpunt.
 * Laat ze controleren door een jurist en vul de echte bedrijfsgegevens in
 * via dkg_company_details() voordat de webshop live gaat.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Centrale bedrijfsgegevens.
 *
 * Pas deze waarden aan naar de werkelijke gegevens van de onderneming.
 * Ze worden gebruikt op de juridische pagina's en in de footer.
 *
 * @return array<string, string>
 */
function dkg_company_details() {
	$defaults = array(
		'name'        => 'De Kaasgenoten',
		'legal_name'  => 'De Kaasgenoten B.V.',
		'street'      => 'De Veken 122b',
		'postal'      => '1716 KG',
		'city'        => 'Opmeer',
		'country'     => 'Nederland',
		'email'       => 'info@de-kaasgenoten.nl',
		'phone'       => '0416 - 123 456',
		'phone_href'  => '+31416123456',
		'kvk'         => '00000000',
		'btw'         => 'NL000000000B00',
		'iban'        => 'NL00 BANK 0000 0000 00',
	);

	/**
	 * Filter de bedrijfsgegevens zodat ze ook via een child-thema of plugin
	 * aangepast kunnen worden zonder dit bestand te wijzigen.
	 */
	return apply_filters( 'dkg_company_details', $defaults );
}

/**
 * Volledig postadres als één string.
 *
 * @return string
 */
function dkg_company_address_line() {
	$c = dkg_company_details();

	return sprintf( '%s, %s %s, %s', $c['street'], $c['postal'], $c['city'], $c['country'] );
}

/**
 * Content voor de juridische pagina's.
 *
 * Elke pagina heeft: title, intro, updated (datum), layout en sections.
 * Een sectie heeft een id (voor de inhoudsopgave) en een title + body (HTML).
 *
 * @param string $key Pagina-sleutel.
 * @return array<string, mixed>|null
 */
function dkg_legal_page_data( $key ) {
	$c       = dkg_company_details();
	$company = esc_html( $c['name'] );
	$email   = esc_html( $c['email'] );
	$address = esc_html( dkg_company_address_line() );
	$updated = __( 'Laatst bijgewerkt: januari 2026', 'de-kaasgenoten' );

	$pages = array(
		'privacy-policy' => array(
			'eyebrow' => __( 'Juridisch', 'de-kaasgenoten' ),
			'title'   => __( 'Privacybeleid', 'de-kaasgenoten' ),
			'intro'   => sprintf(
				/* translators: %s: bedrijfsnaam */
				__( '%s respecteert uw privacy en verwerkt persoonsgegevens in overeenstemming met de Algemene Verordening Gegevensbescherming (AVG). In dit privacybeleid leggen wij uit welke gegevens wij verzamelen en waarom.', 'de-kaasgenoten' ),
				$company
			),
			'updated' => $updated,
			'layout'  => 'document',
			'sections' => array(
				array(
					'id'    => 'verwerkingsverantwoordelijke',
					'title' => __( '1. Verwerkingsverantwoordelijke', 'de-kaasgenoten' ),
					'body'  => '<p>' . sprintf(
						/* translators: 1: bedrijfsnaam, 2: adres, 3: e-mail */
						__( 'De verwerkingsverantwoordelijke voor uw persoonsgegevens is %1$s, gevestigd te %2$s. Voor vragen over dit privacybeleid kunt u contact opnemen via %3$s.', 'de-kaasgenoten' ),
						'<strong>' . $company . '</strong>',
						$address,
						'<a href="mailto:' . esc_attr( $c['email'] ) . '">' . $email . '</a>'
					) . '</p>',
				),
				array(
					'id'    => 'welke-gegevens',
					'title' => __( '2. Welke gegevens wij verwerken', 'de-kaasgenoten' ),
					'body'  => '<p>' . __( 'Wij verwerken de gegevens die u aan ons verstrekt bij het plaatsen van een bestelling of het aanmaken van een account, waaronder:', 'de-kaasgenoten' ) . '</p>'
						. '<ul>'
						. '<li>' . __( 'NAW-gegevens (naam, adres, woonplaats)', 'de-kaasgenoten' ) . '</li>'
						. '<li>' . __( 'E-mailadres en telefoonnummer', 'de-kaasgenoten' ) . '</li>'
						. '<li>' . __( 'Bestel- en betaalgegevens', 'de-kaasgenoten' ) . '</li>'
						. '<li>' . __( 'Technische gegevens zoals IP-adres en browsertype', 'de-kaasgenoten' ) . '</li>'
						. '</ul>',
				),
				array(
					'id'    => 'doeleinden',
					'title' => __( '3. Doeleinden en grondslagen', 'de-kaasgenoten' ),
					'body'  => '<p>' . __( 'Wij gebruiken uw gegevens om uw bestelling te verwerken en te bezorgen, om u te informeren over uw bestelling, voor onze administratie en — alleen met uw toestemming — voor het versturen van onze nieuwsbrief. De grondslagen zijn de uitvoering van de overeenkomst, een wettelijke verplichting en uw toestemming.', 'de-kaasgenoten' ) . '</p>',
				),
				array(
					'id'    => 'bewaartermijn',
					'title' => __( '4. Bewaartermijn', 'de-kaasgenoten' ),
					'body'  => '<p>' . __( 'Wij bewaren uw gegevens niet langer dan noodzakelijk. Bestel- en factuurgegevens bewaren wij vanwege de wettelijke fiscale bewaarplicht zeven jaar.', 'de-kaasgenoten' ) . '</p>',
				),
				array(
					'id'    => 'delen-met-derden',
					'title' => __( '5. Delen met derden', 'de-kaasgenoten' ),
					'body'  => '<p>' . __( 'Wij delen uw gegevens uitsluitend met partijen die nodig zijn voor de uitvoering van uw bestelling, zoals bezorgdiensten en betaaldienstverleners. Met deze partijen sluiten wij verwerkersovereenkomsten. Wij verkopen uw gegevens nooit aan derden.', 'de-kaasgenoten' ) . '</p>',
				),
				array(
					'id'    => 'uw-rechten',
					'title' => __( '6. Uw rechten', 'de-kaasgenoten' ),
					'body'  => '<p>' . __( 'U heeft het recht op inzage, correctie, verwijdering en overdraagbaarheid van uw gegevens, en u kunt bezwaar maken tegen verwerking. Neem hiervoor contact met ons op. U heeft daarnaast het recht een klacht in te dienen bij de Autoriteit Persoonsgegevens.', 'de-kaasgenoten' ) . '</p>',
				),
				array(
					'id'    => 'beveiliging',
					'title' => __( '7. Beveiliging', 'de-kaasgenoten' ),
					'body'  => '<p>' . __( 'Wij nemen passende technische en organisatorische maatregelen om uw gegevens te beschermen, waaronder versleutelde verbindingen (SSL).', 'de-kaasgenoten' ) . '</p>',
				),
			),
		),
		'algemene-voorwaarden' => array(
			'eyebrow' => __( 'Juridisch', 'de-kaasgenoten' ),
			'title'   => __( 'Algemene voorwaarden', 'de-kaasgenoten' ),
			'intro'   => sprintf(
				/* translators: %s: bedrijfsnaam */
				__( 'Deze algemene voorwaarden zijn van toepassing op alle aanbiedingen, bestellingen en overeenkomsten van %s.', 'de-kaasgenoten' ),
				$company
			),
			'updated' => $updated,
			'layout'  => 'document',
			'sections' => array(
				array(
					'id'    => 'definities',
					'title' => __( '1. Definities', 'de-kaasgenoten' ),
					'body'  => '<p>' . sprintf(
						/* translators: %s: bedrijfsnaam */
						__( 'In deze voorwaarden wordt verstaan onder "ondernemer": %s; en onder "consument": de natuurlijke persoon die een overeenkomst aangaat met de ondernemer.', 'de-kaasgenoten' ),
						'<strong>' . $company . '</strong>'
					) . '</p>',
				),
				array(
					'id'    => 'toepasselijkheid',
					'title' => __( '2. Toepasselijkheid', 'de-kaasgenoten' ),
					'body'  => '<p>' . __( 'Deze voorwaarden zijn van toepassing op elk aanbod van de ondernemer en op elke tot stand gekomen overeenkomst op afstand tussen ondernemer en consument.', 'de-kaasgenoten' ) . '</p>',
				),
				array(
					'id'    => 'aanbod',
					'title' => __( '3. Het aanbod', 'de-kaasgenoten' ),
					'body'  => '<p>' . __( 'Het aanbod bevat een volledige en nauwkeurige omschrijving van de aangeboden producten. Kennelijke vergissingen of fouten in het aanbod binden de ondernemer niet.', 'de-kaasgenoten' ) . '</p>',
				),
				array(
					'id'    => 'overeenkomst',
					'title' => __( '4. De overeenkomst', 'de-kaasgenoten' ),
					'body'  => '<p>' . __( 'De overeenkomst komt tot stand op het moment van aanvaarding door de consument van het aanbod en het voldoen aan de daarbij gestelde voorwaarden. De ondernemer bevestigt de ontvangst van de bestelling per e-mail.', 'de-kaasgenoten' ) . '</p>',
				),
				array(
					'id'    => 'prijzen',
					'title' => __( '5. Prijzen en betaling', 'de-kaasgenoten' ),
					'body'  => '<p>' . __( 'De vermelde prijzen zijn inclusief btw. Betaling vindt plaats via de aangeboden betaalmethoden. De consument is verplicht onjuistheden in verstrekte of vermelde betaalgegevens onverwijld te melden.', 'de-kaasgenoten' ) . '</p>',
				),
				array(
					'id'    => 'herroeping',
					'title' => __( '6. Herroepingsrecht', 'de-kaasgenoten' ),
					'body'  => '<p>' . __( 'Bij de aankoop van producten heeft de consument een wettelijk herroepingsrecht. Let op: verse levensmiddelen die snel bederven zijn hiervan wettelijk uitgesloten. Zie ons retourbeleid voor de details.', 'de-kaasgenoten' ) . '</p>',
				),
				array(
					'id'    => 'levering',
					'title' => __( '7. Levering en uitvoering', 'de-kaasgenoten' ),
					'body'  => '<p>' . sprintf(
						/* translators: %s: link naar verzendpagina */
						__( 'De ondernemer zal de grootst mogelijke zorgvuldigheid in acht nemen bij de uitvoering van bestellingen. Zie onze pagina %s voor informatie over verzending, verpakking en afhalen op afspraak.', 'de-kaasgenoten' ),
						'<a href="' . esc_url( dkg_shipping_page_url() ) . '">' . esc_html__( 'Verzenden & bezorgen', 'de-kaasgenoten' ) . '</a>'
					) . '</p>',
				),
				array(
					'id'    => 'klachten',
					'title' => __( '8. Klachtenregeling', 'de-kaasgenoten' ),
					'body'  => '<p>' . sprintf(
						/* translators: %s: e-mail */
						__( 'Klachten over de uitvoering van de overeenkomst kunt u binnen bekwame tijd indienen via %s. Wij reageren binnen 14 dagen. U kunt uw klacht ook voorleggen aan de Geschillencommissie of via het Europese ODR-platform.', 'de-kaasgenoten' ),
						'<a href="mailto:' . esc_attr( $c['email'] ) . '">' . $email . '</a>'
					) . '</p>',
				),
				array(
					'id'    => 'toepasselijk-recht',
					'title' => __( '9. Toepasselijk recht', 'de-kaasgenoten' ),
					'body'  => '<p>' . __( 'Op overeenkomsten tussen de ondernemer en de consument is uitsluitend Nederlands recht van toepassing.', 'de-kaasgenoten' ) . '</p>',
				),
			),
		),
		'terugbetaal-en-retourneringsbeleid' => array(
			'eyebrow' => __( 'Klantenservice', 'de-kaasgenoten' ),
			'title'   => __( 'Retour- en terugbetaalbeleid', 'de-kaasgenoten' ),
			'intro'   => __( 'Wij willen dat u tevreden bent met uw bestelling. Hieronder leest u hoe retourneren en terugbetalen werkt.', 'de-kaasgenoten' ),
			'updated' => $updated,
			'layout'  => 'document',
			'sections' => array(
				array(
					'id'    => 'verse-producten',
					'title' => __( '1. Verse levensmiddelen', 'de-kaasgenoten' ),
					'body'  => '<p>' . __( 'Omdat wij verse, aan bederf onderhevige levensmiddelen verkopen, is het wettelijke herroepingsrecht op deze producten uitgesloten. Dit is geregeld in de wet (uitzonderingen op het herroepingsrecht).', 'de-kaasgenoten' ) . '</p>',
				),
				array(
					'id'    => 'beschadigd',
					'title' => __( '2. Beschadigd of verkeerd geleverd', 'de-kaasgenoten' ),
					'body'  => '<p>' . sprintf(
						/* translators: %s: e-mail */
						__( 'Is uw bestelling beschadigd aangekomen of klopt er iets niet? Neem dan binnen 24 uur na ontvangst contact met ons op via %s, het liefst met een foto. Wij zorgen voor een passende oplossing of terugbetaling.', 'de-kaasgenoten' ),
						'<a href="mailto:' . esc_attr( $c['email'] ) . '">' . $email . '</a>'
					) . '</p>',
				),
				array(
					'id'    => 'niet-verse-producten',
					'title' => __( '3. Niet-bederfelijke producten', 'de-kaasgenoten' ),
					'body'  => '<p>' . __( 'Voor niet-bederfelijke producten (zoals cadeauverpakkingen of accessoires) geldt een bedenktijd van 14 dagen. U kunt het product ongebruikt en in de originele verpakking retourneren.', 'de-kaasgenoten' ) . '</p>',
				),
				array(
					'id'    => 'terugbetaling',
					'title' => __( '4. Terugbetaling', 'de-kaasgenoten' ),
					'body'  => '<p>' . __( 'Na goedkeuring van uw retour of klacht betalen wij het bedrag binnen 14 dagen terug via dezelfde betaalmethode als waarmee u heeft betaald.', 'de-kaasgenoten' ) . '</p>',
				),
			),
		),
		'levering-verzending' => array(
			'eyebrow' => __( 'Klantenservice', 'de-kaasgenoten' ),
			'title'   => __( 'Verzenden & bezorgen', 'de-kaasgenoten' ),
			'intro'   => __( 'Deze pagina is verplaatst. U vindt alle informatie over verzending, verpakking en afhalen op afspraak op onze nieuwe verzendpagina.', 'de-kaasgenoten' ),
			'updated' => $updated,
			'layout'  => 'document',
			'sections' => array(
				array(
					'id'    => 'verplaatst',
					'title' => __( '1. Nieuwe verzendpagina', 'de-kaasgenoten' ),
					'body'  => '<p>' . sprintf(
						/* translators: %s: link */
						__( 'Bekijk %s voor actuele informatie over verzendkosten, verwerking, Track & Trace en afhalen op onze locatie in Opmeer.', 'de-kaasgenoten' ),
						'<a href="' . esc_url( dkg_shipping_page_url() ) . '">' . esc_html__( 'Verzenden & bezorgen', 'de-kaasgenoten' ) . '</a>'
					) . '</p>',
				),
			),
		),
		'cookiebeleid' => array(
			'eyebrow' => __( 'Juridisch', 'de-kaasgenoten' ),
			'title'   => __( 'Cookiebeleid', 'de-kaasgenoten' ),
			'intro'   => sprintf(
				/* translators: %s: bedrijfsnaam */
				__( '%s gebruikt cookies om de website goed te laten werken, te analyseren en te verbeteren. Hieronder leest u welke soorten cookies wij gebruiken.', 'de-kaasgenoten' ),
				$company
			),
			'updated' => $updated,
			'layout'  => 'document',
			'sections' => array(
				array(
					'id'    => 'wat-zijn-cookies',
					'title' => __( '1. Wat zijn cookies?', 'de-kaasgenoten' ),
					'body'  => '<p>' . __( 'Cookies zijn kleine tekstbestanden die bij een bezoek aan de website op uw apparaat worden opgeslagen. Ze helpen de website te functioneren en uw voorkeuren te onthouden.', 'de-kaasgenoten' ) . '</p>',
				),
				array(
					'id'    => 'soorten',
					'title' => __( '2. Welke cookies wij gebruiken', 'de-kaasgenoten' ),
					'body'  => '<ul>'
						. '<li>' . __( 'Functionele cookies: noodzakelijk voor de werking van de winkelwagen en het bestelproces.', 'de-kaasgenoten' ) . '</li>'
						. '<li>' . __( 'Analytische cookies: om het gebruik van de website te meten en te verbeteren.', 'de-kaasgenoten' ) . '</li>'
						. '<li>' . __( 'Marketingcookies: alleen geplaatst met uw toestemming.', 'de-kaasgenoten' ) . '</li>'
						. '</ul>',
				),
				array(
					'id'    => 'beheren',
					'title' => __( '3. Cookies beheren', 'de-kaasgenoten' ),
					'body'  => '<p>' . __( 'U kunt uw cookievoorkeuren op elk moment aanpassen of cookies verwijderen via de instellingen van uw browser. Het uitschakelen van functionele cookies kan de werking van de webshop beperken.', 'de-kaasgenoten' ) . '</p>',
				),
			),
		),
		'disclaimer' => array(
			'eyebrow' => __( 'Juridisch', 'de-kaasgenoten' ),
			'title'   => __( 'Disclaimer', 'de-kaasgenoten' ),
			'intro'   => sprintf(
				/* translators: %s: bedrijfsnaam */
				__( 'Op het gebruik van deze website van %s zijn de onderstaande voorwaarden van toepassing.', 'de-kaasgenoten' ),
				$company
			),
			'updated' => $updated,
			'layout'  => 'document',
			'sections' => array(
				array(
					'id'    => 'aansprakelijkheid',
					'title' => __( '1. Aansprakelijkheid', 'de-kaasgenoten' ),
					'body'  => '<p>' . __( 'Wij besteden de grootst mogelijke zorg aan de inhoud van deze website. Toch kunnen wij niet garanderen dat alle informatie te allen tijde volledig en juist is. Aan de inhoud kunnen geen rechten worden ontleend.', 'de-kaasgenoten' ) . '</p>',
				),
				array(
					'id'    => 'intellectueel-eigendom',
					'title' => __( '2. Intellectueel eigendom', 'de-kaasgenoten' ),
					'body'  => '<p>' . __( 'Alle teksten, afbeeldingen en andere materialen op deze website zijn beschermd door auteursrecht. Gebruik zonder schriftelijke toestemming is niet toegestaan.', 'de-kaasgenoten' ) . '</p>',
				),
			),
		),
	);

	return isset( $pages[ $key ] ) ? $pages[ $key ] : null;
}

/**
 * Veelgestelde vragen.
 *
 * @return array<int, array<string, string>>
 */
function dkg_faq_items() {
	return array(
		array(
			'q' => __( 'Hoe snel wordt mijn bestelling geleverd?', 'de-kaasgenoten' ),
			'a' => __( 'Wij verwerken bestellingen van maandag t/m vrijdag en verzenden zo snel mogelijk zodra uw bestelling zorgvuldig en compleet klaar is. U ontvangt bericht zodra uw pakket is verzonden.', 'de-kaasgenoten' ),
		),
		array(
			'q' => __( 'Worden de kazen zorgvuldig verpakt?', 'de-kaasgenoten' ),
			'a' => __( 'Ja. Onze kazen worden vers afgesneden, vacuüm verpakt en in een stevige doos verzonden. Lees meer op onze pagina Verzenden & bezorgen.', 'de-kaasgenoten' ),
		),
		array(
			'q' => __( 'Kan ik mijn bestelling afhalen?', 'de-kaasgenoten' ),
			'a' => __( 'Ja. Kies bij het afrekenen voor “Afhalen op afspraak”. Na uw bestelling nemen wij contact met u op om een geschikt moment af te spreken op onze locatie in Opmeer.', 'de-kaasgenoten' ),
		),
		array(
			'q' => __( 'Kan ik mijn bestelling retourneren?', 'de-kaasgenoten' ),
			'a' => __( 'Verse levensmiddelen kunnen wettelijk niet worden geretourneerd. Is er iets mis met je bestelling? Neem dan binnen 24 uur contact met ons op, dan lossen wij het op.', 'de-kaasgenoten' ),
		),
		array(
			'q' => __( 'Welke betaalmethoden accepteren jullie?', 'de-kaasgenoten' ),
			'a' => __( 'Je kunt veilig betalen met iDEAL, creditcard, Bancontact en andere gangbare betaalmethoden.', 'de-kaasgenoten' ),
		),
		array(
			'q' => __( 'Wat zijn de verzendkosten?', 'de-kaasgenoten' ),
			'a' => __( 'Binnen Nederland rekenen wij €7,95 verzendkosten per bestelling. Afhalen op afspraak op onze locatie in Opmeer is gratis.', 'de-kaasgenoten' ),
		),
		array(
			'q' => __( 'Kan ik een pakket op maat samenstellen?', 'de-kaasgenoten' ),
			'a' => __( 'Zeker! Neem contact met ons op voor een persoonlijk of zakelijk pakket op maat.', 'de-kaasgenoten' ),
		),
	);
}

/**
 * Render een juridische pagina (document met inhoudsopgave en secties).
 *
 * @param string $key Pagina-sleutel.
 */
function dkg_render_legal_page( $key ) {
	$data = dkg_legal_page_data( $key );

	if ( ! $data ) {
		// Onbekende sleutel: val terug op de standaard paginaweergave.
		get_template_part( 'page' );
		return;
	}

	get_header();
	?>
	<main id="primary" class="dkg-main dkg-legal-page">
		<section class="dkg-legal-hero">
			<div class="dkg-container">
				<p class="dkg-eyebrow"><?php echo esc_html( $data['eyebrow'] ); ?></p>
				<h1><?php echo esc_html( $data['title'] ); ?></h1>
				<?php if ( ! empty( $data['intro'] ) ) : ?>
					<p class="dkg-legal-hero__intro"><?php echo esc_html( $data['intro'] ); ?></p>
				<?php endif; ?>
				<?php if ( ! empty( $data['updated'] ) ) : ?>
					<p class="dkg-legal-hero__updated"><?php echo esc_html( $data['updated'] ); ?></p>
				<?php endif; ?>
			</div>
		</section>

		<section class="dkg-section">
			<div class="dkg-container dkg-legal-layout">
				<?php if ( count( $data['sections'] ) > 1 ) : ?>
					<aside class="dkg-legal-toc" aria-label="<?php esc_attr_e( 'Inhoudsopgave', 'de-kaasgenoten' ); ?>">
						<p class="dkg-legal-toc__title"><?php esc_html_e( 'Op deze pagina', 'de-kaasgenoten' ); ?></p>
						<ul>
							<?php foreach ( $data['sections'] as $section ) : ?>
								<li><a href="#<?php echo esc_attr( $section['id'] ); ?>"><?php echo esc_html( $section['title'] ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					</aside>
				<?php endif; ?>

				<div class="dkg-legal-content dkg-entry-content">
					<?php foreach ( $data['sections'] as $section ) : ?>
						<section id="<?php echo esc_attr( $section['id'] ); ?>" class="dkg-legal-section">
							<h2><?php echo esc_html( $section['title'] ); ?></h2>
							<?php echo wp_kses_post( $section['body'] ); ?>
						</section>
					<?php endforeach; ?>

					<?php
					// Optionele extra inhoud uit de pagina-editor onder de standaardtekst.
					$extra = '';
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
							$extra = apply_filters( 'the_content', get_the_content() );
						}
					}
					if ( '' !== trim( $extra ) ) {
						echo $extra; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
					?>
				</div>
			</div>
		</section>
	</main>
	<?php
	get_footer();
}

/**
 * Render de Veelgestelde vragen-pagina met accordion.
 */
function dkg_render_faq_page() {
	$items = dkg_faq_items();

	get_header();
	?>
	<main id="primary" class="dkg-main dkg-legal-page dkg-faq-page">
		<section class="dkg-legal-hero">
			<div class="dkg-container">
				<p class="dkg-eyebrow"><?php esc_html_e( 'Klantenservice', 'de-kaasgenoten' ); ?></p>
				<h1><?php esc_html_e( 'Veelgestelde vragen', 'de-kaasgenoten' ); ?></h1>
				<p class="dkg-legal-hero__intro"><?php esc_html_e( 'De antwoorden op de meest gestelde vragen. Staat jouw vraag er niet bij? Neem gerust contact met ons op.', 'de-kaasgenoten' ); ?></p>
			</div>
		</section>

		<section class="dkg-section">
			<div class="dkg-container dkg-faq-wrap">
				<div class="dkg-faq-list">
					<?php foreach ( $items as $index => $item ) : ?>
						<article class="dkg-faq-item<?php echo 0 === $index ? ' is-open' : ''; ?>">
							<h2 class="dkg-faq-item__heading">
								<button
									type="button"
									class="dkg-faq-question"
									id="<?php echo esc_attr( 'dkg-faq-q-' . $index ); ?>"
									aria-controls="<?php echo esc_attr( 'dkg-faq-a-' . $index ); ?>"
									aria-expanded="<?php echo 0 === $index ? 'true' : 'false'; ?>"
								>
									<?php echo esc_html( $item['q'] ); ?>
								</button>
							</h2>
							<div
								class="dkg-faq-answer"
								id="<?php echo esc_attr( 'dkg-faq-a-' . $index ); ?>"
								role="region"
								aria-labelledby="<?php echo esc_attr( 'dkg-faq-q-' . $index ); ?>"
								<?php echo 0 === $index ? '' : ' hidden'; ?>
							>
								<p><?php echo esc_html( $item['a'] ); ?></p>
							</div>
						</article>
					<?php endforeach; ?>
				</div>

				<?php
				$extra = '';
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						$extra = apply_filters( 'the_content', get_the_content() );
					}
				}
				if ( '' !== trim( $extra ) ) {
					echo '<div class="dkg-entry-content dkg-faq-extra">' . $extra . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
				?>
			</div>
		</section>
	</main>
	<?php
	get_footer();
}
