<?php
/**
 * Verzenden & bezorgen pagina.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * URL van de verzendpagina.
 *
 * @return string
 */
function dkg_shipping_page_url() {
	return dkg_page_url( 'verzenden-bezorgen' );
}

/**
 * Content voor de Verzenden & bezorgen pagina.
 *
 * @return array<string, mixed>
 */
function dkg_shipping_page_content() {
	return array(
		'hero'       => array(
			'title'    => __( 'Verzenden & bezorgen', 'de-kaasgenoten' ),
			'text'     => __( 'Wij doen er alles aan om uw bestelling met de grootste mogelijke zorg te verpakken en zo snel mogelijk bij u te bezorgen.', 'de-kaasgenoten' ),
			'subline'  => __( 'Eerlijke communicatie en kwaliteit, daar staan wij voor.', 'de-kaasgenoten' ),
			'image'    => 'shipping-hero.jpg',
			'image_alt'=> __( 'Verzenddoos met zorgvuldig verpakte kaas', 'de-kaasgenoten' ),
		),
		'cards'      => array(
			array(
				'icon'   => 'truck',
				'title'  => __( 'Verzendkosten', 'de-kaasgenoten' ),
				'amount' => '€7,95',
				'text'   => __( 'Binnen Nederland rekenen wij een eerlijk vast tarief voor de verzending van uw bestelling. Dit tarief geldt per bestelling.', 'de-kaasgenoten' ),
			),
			array(
				'icon'   => 'clock',
				'title'  => __( 'Levering', 'de-kaasgenoten' ),
				'amount' => __( 'Zo snel mogelijk', 'de-kaasgenoten' ),
				'text'   => __( 'Wij verzenden uw bestelling met de grootste mogelijke zorg. Zodra uw pakket is overgedragen aan onze verzendpartner, ontvangt u van ons een bevestiging.', 'de-kaasgenoten' ),
			),
			array(
				'icon'   => 'calendar',
				'title'  => __( 'Wanneer verzenden wij?', 'de-kaasgenoten' ),
				'text'   => __( 'Bestellingen worden van maandag t/m vrijdag verwerkt. Uw bestelling wordt zo snel mogelijk klaargemaakt en aangeboden bij onze verzendpartner. Tijdens drukke periodes kan de verwerking iets langer duren.', 'de-kaasgenoten' ),
			),
			array(
				'icon'   => 'box',
				'title'  => __( 'Track & Trace', 'de-kaasgenoten' ),
				'text'   => __( 'Zodra uw bestelling is verzonden, ontvangt u van ons een e-mail met een Track & Trace-code zodat u uw pakket eenvoudig kunt volgen.', 'de-kaasgenoten' ),
			),
			array(
				'icon'   => 'pin',
				'title'  => __( 'Afhalen op afspraak', 'de-kaasgenoten' ),
				'amount' => __( 'Gratis', 'de-kaasgenoten' ),
				'text'   => __( 'U kunt uw bestelling ook afhalen op afspraak op onze locatie in Opmeer. Na het plaatsen van uw bestelling nemen wij contact met u op om een geschikt afhaalmoment af te spreken.', 'de-kaasgenoten' ),
			),
		),
		'packaging'  => array(
			'title'  => __( 'Zo verpakken wij uw kaas', 'de-kaasgenoten' ),
			'intro'  => __( 'Onze kazen zijn kwetsbare producten. Online bestelt u dezelfde zorgvuldig geselecteerde kaas als op onze marktkraam — verpakt met dezelfde aandacht voor versheid en kwaliteit.', 'de-kaasgenoten' ),
			'image'  => 'shipping-packaging.jpg',
			'image_alt' => __( 'Kaas zorgvuldig verpakt in een verzenddoos', 'de-kaasgenoten' ),
			'bullets'=> array(
				array(
					'title' => __( 'Vers en zorgvuldig', 'de-kaasgenoten' ),
					'text'  => __( 'Uw kaas wordt pas kort voor verzending afgesneden — zoals u dat van ons op de marktkraam gewend bent.', 'de-kaasgenoten' ),
				),
				array(
					'title' => __( 'Vacuüm verpakt', 'de-kaasgenoten' ),
					'text'  => __( 'De kaas wordt luchtdicht verpakt zodat smaak en kwaliteit optimaal behouden blijven.', 'de-kaasgenoten' ),
				),
				array(
					'title' => __( 'Stevige verpakking', 'de-kaasgenoten' ),
					'text'  => __( 'Onze dozen en materialen beschermen de kaas tijdens transport.', 'de-kaasgenoten' ),
				),
				array(
					'title' => __( 'Koel en veilig bezorgd', 'de-kaasgenoten' ),
					'text'  => __( 'Uw pakket wordt zo goed mogelijk beschermd zodat uw kaas in uitstekende conditie bij u aankomt.', 'de-kaasgenoten' ),
				),
			),
		),
		'faq'        => array(
			array(
				'q' => __( 'Kan ik mijn bestelling afhalen?', 'de-kaasgenoten' ),
				'a' => __( 'Ja, dat is mogelijk. Kies tijdens het afrekenen voor “Afhalen op afspraak”. Na uw bestelling nemen wij contact met u op om een geschikt moment af te spreken op onze locatie in Opmeer.', 'de-kaasgenoten' ),
			),
			array(
				'q' => __( 'Wat als ik niet thuis ben?', 'de-kaasgenoten' ),
				'a' => __( 'De bezorger probeert uw pakket af te leveren. Bent u niet thuis? Dan wordt het pakket meestal bij de buren afgegeven of naar een afhaalpunt gebracht.', 'de-kaasgenoten' ),
			),
			array(
				'q' => __( 'Mijn pakket is beschadigd, wat nu?', 'de-kaasgenoten' ),
				'a' => __( 'Neem zo snel mogelijk contact met ons op en stuur een foto van de schade. Samen zoeken we naar een passende oplossing.', 'de-kaasgenoten' ),
			),
			array(
				'q' => __( 'Kan ik een bezorgdag kiezen?', 'de-kaasgenoten' ),
				'a' => __( 'Op dit moment is het niet mogelijk om een specifieke bezorgdag te kiezen. Wij verzenden uw bestelling zo snel mogelijk.', 'de-kaasgenoten' ),
			),
		),
		'trust'      => array(
			array( 'icon' => 'knife', 'text' => __( 'Vers en zorgvuldig verpakt', 'de-kaasgenoten' ) ),
			array( 'icon' => 'shield', 'text' => __( 'Veilig en vertrouwd bestellen', 'de-kaasgenoten' ) ),
			array( 'icon' => 'box', 'text' => __( 'Zorgvuldig verpakt', 'de-kaasgenoten' ) ),
			array( 'icon' => 'truck', 'text' => __( 'Zo snel mogelijk verzonden', 'de-kaasgenoten' ) ),
		),
	);
}

/**
 * Laad pagina-styles.
 */
function dkg_enqueue_shipping_page_assets() {
	if ( ! is_page( 'verzenden-bezorgen' ) ) {
		return;
	}

	wp_enqueue_style(
		'dkg-shipping-page',
		get_template_directory_uri() . '/assets/css/components/shipping-page.css',
		array( 'dkg-theme' ),
		DKG_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'dkg_enqueue_shipping_page_assets', 20 );

/**
 * Redirect oude levering-verzending URL.
 */
function dkg_redirect_legacy_shipping_page() {
	if ( is_page( 'levering-verzending' ) ) {
		wp_safe_redirect( dkg_shipping_page_url(), 301 );
		exit;
	}
}
add_action( 'template_redirect', 'dkg_redirect_legacy_shipping_page' );

/**
 * Render de Verzenden & bezorgen pagina.
 */
function dkg_render_shipping_page() {
	$content   = dkg_shipping_page_content();
	$hero      = $content['hero'];
	$hero_image = dkg_asset_uri( 'images/' . $hero['image'] );

	get_header();
	?>
	<main id="primary" class="dkg-main dkg-shipping-page">
		<section class="dkg-shipping-hero" style="background-image: linear-gradient(180deg, rgba(16,37,27,.72), rgba(16,37,27,.82)), url('<?php echo esc_url( $hero_image ); ?>');" aria-labelledby="dkg-shipping-hero-title">
			<div class="dkg-container dkg-shipping-hero__inner">
				<h1 id="dkg-shipping-hero-title"><?php echo esc_html( $hero['title'] ); ?></h1>
				<span class="dkg-shipping-hero__icon" aria-hidden="true"><?php echo dkg_icon( 'cheese' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<p class="dkg-shipping-hero__text"><?php echo esc_html( $hero['text'] ); ?></p>
				<p class="dkg-shipping-hero__subline"><?php echo esc_html( $hero['subline'] ); ?></p>
			</div>
		</section>

		<section class="dkg-section dkg-shipping-cards" aria-label="<?php esc_attr_e( 'Verzendinformatie', 'de-kaasgenoten' ); ?>">
			<div class="dkg-container dkg-shipping-cards__grid">
				<?php foreach ( $content['cards'] as $card ) : ?>
					<article class="dkg-shipping-card">
						<span class="dkg-shipping-card__icon" aria-hidden="true"><?php echo dkg_icon( $card['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<h2><?php echo esc_html( $card['title'] ); ?></h2>
						<?php if ( ! empty( $card['amount'] ) ) : ?>
							<p class="dkg-shipping-card__amount"><?php echo esc_html( $card['amount'] ); ?></p>
						<?php endif; ?>
						<p class="dkg-shipping-card__text"><?php echo esc_html( $card['text'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</section>

		<section class="dkg-section dkg-shipping-packaging" aria-labelledby="dkg-shipping-packaging-title">
			<div class="dkg-container dkg-shipping-packaging__layout">
				<div class="dkg-shipping-packaging__content">
					<h2 id="dkg-shipping-packaging-title"><?php echo esc_html( $content['packaging']['title'] ); ?></h2>
					<p class="dkg-shipping-packaging__intro"><?php echo esc_html( $content['packaging']['intro'] ); ?></p>
					<ul class="dkg-shipping-packaging__list">
						<?php foreach ( $content['packaging']['bullets'] as $bullet ) : ?>
							<li>
								<span class="dkg-shipping-packaging__check" aria-hidden="true"><?php echo dkg_icon( 'shield' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
								<div>
									<strong><?php echo esc_html( $bullet['title'] ); ?></strong>
									<span><?php echo esc_html( $bullet['text'] ); ?></span>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="dkg-shipping-packaging__media">
					<img src="<?php echo esc_url( dkg_asset_uri( 'images/' . $content['packaging']['image'] ) ); ?>" alt="<?php echo esc_attr( $content['packaging']['image_alt'] ); ?>" width="720" height="720" loading="lazy" decoding="async">
				</div>
			</div>
		</section>

		<section class="dkg-section dkg-shipping-faq" aria-labelledby="dkg-shipping-faq-title">
			<div class="dkg-container">
				<h2 id="dkg-shipping-faq-title" class="dkg-shipping-faq__heading"><?php esc_html_e( 'Veelgestelde vragen', 'de-kaasgenoten' ); ?></h2>
				<div class="dkg-shipping-faq__grid">
					<?php foreach ( $content['faq'] as $item ) : ?>
						<article class="dkg-shipping-faq__item">
							<h3><?php echo esc_html( $item['q'] ); ?></h3>
							<p><?php echo esc_html( $item['a'] ); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section class="dkg-shipping-trust" aria-label="<?php esc_attr_e( 'Onze service', 'de-kaasgenoten' ); ?>">
			<div class="dkg-container dkg-shipping-trust__grid">
				<?php foreach ( $content['trust'] as $item ) : ?>
					<div class="dkg-shipping-trust__item">
						<span aria-hidden="true"><?php echo dkg_icon( $item['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<span><?php echo esc_html( $item['text'] ); ?></span>
					</div>
				<?php endforeach; ?>
			</div>
		</section>
	</main>
	<?php
	get_footer();
}
