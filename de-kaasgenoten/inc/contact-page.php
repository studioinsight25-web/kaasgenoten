<?php
/**
 * Contact page content and renderer.
 *
 * Pas teksten, gegevens en de kaart hieronder aan — geen template-wijziging nodig.
 *
 * Het contactformulier plaats je in de WordPress-editor van de Contact-pagina
 * als shortcode, bijvoorbeeld:  [contact-form-7 id="123" title="Contact"]
 * of  [wpforms id="123"].  Die shortcode wordt automatisch in het
 * formulierkaartje weergegeven.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Content voor de Contact pagina.
 *
 * @return array<string, mixed>
 */
function dkg_contact_page_content() {
	$c = dkg_company_details();

	return array(
		'hero'    => array(
			'eyebrow' => __( 'Contact', 'de-kaasgenoten' ),
			'title'   => __( 'Wij helpen u graag', 'de-kaasgenoten' ),
			'text'    => __( 'Heeft u een vraag, opmerking of wilt u persoonlijk advies? Neem gerust contact met ons op — wij reageren meestal binnen één werkdag.', 'de-kaasgenoten' ),
		),
		'form'    => array(
			'title' => __( 'Stuur ons een bericht', 'de-kaasgenoten' ),
			'intro' => __( 'Vul het formulier in en wij nemen zo snel mogelijk contact met u op.', 'de-kaasgenoten' ),
		),
		'info'    => array(
			'title' => __( 'Contactgegevens', 'de-kaasgenoten' ),
			'items' => array(
				array(
					'icon'  => 'pin',
					'label' => __( 'Adres', 'de-kaasgenoten' ),
					'lines' => array( $c['street'], $c['postal'] . ' ' . $c['city'] ),
				),
				array(
					'icon'  => 'phone',
					'label' => __( 'Telefoon', 'de-kaasgenoten' ),
					'lines' => array( $c['phone'] ),
					'url'   => 'tel:' . $c['phone_href'],
				),
				array(
					'icon'  => 'mail',
					'label' => __( 'E-mail', 'de-kaasgenoten' ),
					'lines' => array( $c['email'] ),
					'url'   => 'mailto:' . $c['email'],
				),
				array(
					'icon'  => 'clock',
					'label' => __( 'Openingstijden', 'de-kaasgenoten' ),
					'lines' => array( __( 'Ma t/m vr: 9:00 - 17:00', 'de-kaasgenoten' ), __( 'Za & zo: gesloten', 'de-kaasgenoten' ) ),
				),
			),
			'socials' => dkg_social_links(),
		),
		// OpenStreetMap embed — pas de coördinaten/bbox aan op het juiste adres.
		// Snel bijwerken: ga naar openstreetmap.org, zoek het adres, klik "Delen"
		// → "HTML insluiten" en kopieer de bbox- en markerwaarden hierheen.
		'map'     => array(
			'embed'   => 'https://www.openstreetmap.org/export/embed.html?bbox=4.9286%2C52.7006%2C4.9586%2C52.7146&layer=mapnik&marker=52.7076%2C4.9436',
			'link'    => 'https://www.openstreetmap.org/?mlat=52.7076&mlon=4.9436#map=15/52.7076/4.9436',
			'caption' => __( 'Bekijk grotere kaart', 'de-kaasgenoten' ),
			'title'   => __( 'Locatie van De Kaasgenoten op de kaart', 'de-kaasgenoten' ),
		),
		'trust'   => array(
			array(
				'icon'  => 'truck',
				'title' => __( 'Zorgvuldig verzonden', 'de-kaasgenoten' ),
				'text'  => __( 'Zo snel mogelijk, met zorg verwerkt', 'de-kaasgenoten' ),
			),
			array(
				'icon'  => 'shield',
				'title' => __( 'Veilig betalen', 'de-kaasgenoten' ),
				'text'  => __( 'iDEAL, creditcard & Bancontact', 'de-kaasgenoten' ),
			),
			array(
				'icon'  => 'knife',
				'title' => __( 'Vers afgesneden', 'de-kaasgenoten' ),
				'text'  => __( 'Vers afgesneden op bestelling', 'de-kaasgenoten' ),
			),
			array(
				'icon'  => 'star',
				'title' => __( 'Klanttevredenheid', 'de-kaasgenoten' ),
				'text'  => __( '4,9/5 op basis van reviews', 'de-kaasgenoten' ),
			),
		),
	);
}

/**
 * Render de Contact pagina.
 */
function dkg_render_contact_page() {
	$content = dkg_contact_page_content();

	$form_markup = '';
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			$form_markup = apply_filters( 'the_content', get_the_content() );
		}
	}

	get_header();
	?>
	<main id="primary" class="dkg-main dkg-contact-page">
		<section class="dkg-contact-hero" aria-labelledby="dkg-contact-hero-title">
			<div class="dkg-contact-hero__shade" aria-hidden="true"></div>
			<div class="dkg-container dkg-contact-hero__inner">
				<p class="dkg-eyebrow"><?php echo esc_html( $content['hero']['eyebrow'] ); ?></p>
				<h1 id="dkg-contact-hero-title"><?php echo esc_html( $content['hero']['title'] ); ?></h1>
				<p class="dkg-contact-hero__text"><?php echo esc_html( $content['hero']['text'] ); ?></p>
			</div>
		</section>

		<section class="dkg-section">
			<div class="dkg-container dkg-contact-layout">
				<div class="dkg-contact-form-card">
					<h2><?php echo esc_html( $content['form']['title'] ); ?></h2>
					<p class="dkg-contact-form-card__intro"><?php echo esc_html( $content['form']['intro'] ); ?></p>
					<div class="dkg-contact-form-card__form">
						<?php
						if ( '' !== trim( $form_markup ) ) {
							// Inhoud uit de pagina-editor (bijv. de formulier-shortcode), reeds door the_content-filter gehaald.
							echo $form_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						} else {
							echo '<p class="dkg-contact-form-card__placeholder">';
							esc_html_e( 'Plaats hier het contactformulier door de shortcode van je formulier-plugin (bijvoorbeeld Contact Form 7 of WPForms) in de pagina-editor te zetten.', 'de-kaasgenoten' );
							echo '</p>';
						}
						?>
					</div>
				</div>

				<aside class="dkg-contact-info">
					<h2><?php echo esc_html( $content['info']['title'] ); ?></h2>
					<ul class="dkg-contact-info__list">
						<?php foreach ( $content['info']['items'] as $item ) : ?>
							<li class="dkg-contact-info__item">
								<span class="dkg-contact-info__icon" aria-hidden="true"><?php echo dkg_icon( $item['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
								<div class="dkg-contact-info__body">
									<strong><?php echo esc_html( $item['label'] ); ?></strong>
									<?php if ( ! empty( $item['url'] ) ) : ?>
										<a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( implode( ' ', $item['lines'] ) ); ?></a>
									<?php else : ?>
										<span><?php echo wp_kses_post( implode( '<br>', array_map( 'esc_html', $item['lines'] ) ) ); ?></span>
									<?php endif; ?>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>

					<?php if ( ! empty( $content['info']['socials'] ) ) : ?>
						<div class="dkg-contact-socials" aria-label="<?php esc_attr_e( 'Volg ons op social media', 'de-kaasgenoten' ); ?>">
							<?php foreach ( $content['info']['socials'] as $social ) : ?>
								<a href="<?php echo esc_url( $social['url'] ); ?>" aria-label="<?php echo esc_attr( $social['label'] ); ?>" target="_blank" rel="noopener noreferrer">
									<?php echo dkg_icon( $social['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</a>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</aside>
			</div>
		</section>

		<?php if ( ! empty( $content['map']['embed'] ) ) : ?>
			<section class="dkg-contact-map" aria-label="<?php esc_attr_e( 'Onze locatie', 'de-kaasgenoten' ); ?>">
				<iframe
					class="dkg-contact-map__frame"
					title="<?php echo esc_attr( $content['map']['title'] ); ?>"
					src="<?php echo esc_url( $content['map']['embed'] ); ?>"
					loading="lazy"
					referrerpolicy="no-referrer-when-downgrade"></iframe>
				<?php if ( ! empty( $content['map']['link'] ) ) : ?>
					<a class="dkg-contact-map__link" href="<?php echo esc_url( $content['map']['link'] ); ?>" target="_blank" rel="noopener noreferrer">
						<?php echo esc_html( $content['map']['caption'] ); ?>
					</a>
				<?php endif; ?>
			</section>
		<?php endif; ?>

		<section class="dkg-about-trust" aria-label="<?php esc_attr_e( 'Vertrouwen en service', 'de-kaasgenoten' ); ?>">
			<div class="dkg-container dkg-about-trust__grid">
				<?php foreach ( $content['trust'] as $item ) : ?>
					<article class="dkg-about-trust-item">
						<span class="dkg-about-trust-item__icon" aria-hidden="true"><?php echo dkg_icon( $item['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<div>
							<strong><?php echo esc_html( $item['title'] ); ?></strong>
							<span><?php echo esc_html( $item['text'] ); ?></span>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</section>
	</main>
	<?php
	get_footer();
}
