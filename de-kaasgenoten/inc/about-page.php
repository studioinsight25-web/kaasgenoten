<?php
/**
 * Over Ons page content and renderer.
 *
 * Pas teksten en afbeeldingen hieronder aan — geen template-wijziging nodig.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Content voor de Over Ons pagina.
 *
 * @return array<string, mixed>
 */
function dkg_about_page_content() {
	return array(
		'hero'    => array(
			'eyebrow'   => __( 'Over De Kaasgenoten', 'de-kaasgenoten' ),
			'title'     => __( 'Drie ondernemers. Eén passie voor kaas — vanaf de marktkraam.', 'de-kaasgenoten' ),
			'text'      => __( 'Wij verkopen ambachtelijke kazen en delicatessen op de marktkraam én online. Met liefde geselecteerd, met passie samengesteld — rechtstreeks van boer tot bord.', 'de-kaasgenoten' ),
			'cta_label' => __( 'Bekijk ons assortiment', 'de-kaasgenoten' ),
			'cta_url'   => dkg_shop_url(),
			'image'     => 'hero-clean.jpg',
			'image_alt' => __( 'Ambachtelijke kazen en delicatessen', 'de-kaasgenoten' ),
		),
		'usps'    => array(
			array(
				'icon'  => 'cheese',
				'title' => __( 'Zorgvuldig geselecteerd', 'de-kaasgenoten' ),
				'text'  => __( 'Alleen kazen die voldoen aan onze hoge kwaliteitseisen.', 'de-kaasgenoten' ),
			),
			array(
				'icon'  => 'farm',
				'title' => __( 'Van de boer', 'de-kaasgenoten' ),
				'text'  => __( 'Rechtstreeks van ambachtelijke boeren en kaasmakers.', 'de-kaasgenoten' ),
			),
			array(
				'icon'  => 'heart',
				'title' => __( 'Van harte gebracht', 'de-kaasgenoten' ),
				'text'  => __( 'Met passie en persoonlijke aandacht voor elke bestelling.', 'de-kaasgenoten' ),
			),
			array(
				'icon'  => 'award',
				'title' => __( 'Premium garantie', 'de-kaasgenoten' ),
				'text'  => __( 'Niet tevreden? Wij lossen het persoonlijk voor u op.', 'de-kaasgenoten' ),
			),
		),
		'mission' => array(
			'eyebrow'   => __( 'Onze missie', 'de-kaasgenoten' ),
			'title'     => __( 'Van marktkraam naar uw deur', 'de-kaasgenoten' ),
			'text'      => __( 'De Kaasgenoten is ontstaan op de marktkraam: persoonlijk contact, eerlijk advies en kaas waar wij zelf achter staan. Diezelfde selectie en zorgvuldigheid gelden voor elke online bestelling.', 'de-kaasgenoten' ),
			'cta_label' => __( 'Lees verder', 'de-kaasgenoten' ),
			'cta_url'   => dkg_page_url( 'over-ons' ),
			'image'     => 'about-founders.jpg',
			'image_alt' => __( 'Kaasmaker in de kaasrijpingskelder', 'de-kaasgenoten' ),
		),
		'promise' => array(
			'eyebrow'   => __( 'Onze belofte', 'de-kaasgenoten' ),
			'title'     => __( 'Alleen kazen waar wij trots op zijn', 'de-kaasgenoten' ),
			'text'      => __( 'Elke kaas in ons assortiment is persoonlijk geproefd en goedgekeurd. Wij werken uitsluitend samen met producenten die onze waarden delen: kwaliteit, eerlijkheid en respect voor het ambacht.', 'de-kaasgenoten' ),
			'image'     => 'cat-kaas.jpg',
			'image_alt' => __( 'Selectie ambachtelijke kazen', 'de-kaasgenoten' ),
		),
		'values'  => array(
			'eyebrow' => __( 'Waar wij voor staan', 'de-kaasgenoten' ),
			'title'   => __( 'Onze waarden, uw garantie', 'de-kaasgenoten' ),
			'items'   => array(
				array(
					'icon'  => 'hand',
					'title' => __( 'Ambacht', 'de-kaasgenoten' ),
					'text'  => __( 'Met de hand geselecteerd — op de marktkraam en voor uw bestelling.', 'de-kaasgenoten' ),
				),
				array(
					'icon'  => 'knife',
					'title' => __( 'Vers afgesneden', 'de-kaasgenoten' ),
					'text'  => __( 'Vers afgesneden op bestelling, zoals op onze marktkraam.', 'de-kaasgenoten' ),
				),
				array(
					'icon'  => 'service',
					'title' => __( 'Persoonlijke service', 'de-kaasgenoten' ),
					'text'  => __( 'Altijd bereikbaar voor advies en vragen.', 'de-kaasgenoten' ),
				),
				array(
					'icon'  => 'leaf',
					'title' => __( 'Eerlijke herkomst', 'de-kaasgenoten' ),
					'text'  => __( 'Transparant over herkomst en productie.', 'de-kaasgenoten' ),
				),
				array(
					'icon'  => 'box',
					'title' => __( 'Zorgvuldig verpakt', 'de-kaasgenoten' ),
					'text'  => __( 'Optimale bescherming tijdens transport.', 'de-kaasgenoten' ),
				),
				array(
					'icon'  => 'star',
					'title' => __( 'Premium kwaliteit', 'de-kaasgenoten' ),
					'text'  => __( 'Alleen het beste komt in ons assortiment.', 'de-kaasgenoten' ),
				),
			),
		),
		'cta'     => array(
			'eyebrow'   => __( 'Ontdek het verschil', 'de-kaasgenoten' ),
			'title'     => __( 'Voor iedere kaasliefhebber', 'de-kaasgenoten' ),
			'text'      => __( 'Of u nu op zoek bent naar een verfijnde oude kaas, een uniek cadeaupakket of advies voor de perfecte borrelplank — wij helpen u graag.', 'de-kaasgenoten' ),
			'cta_label' => __( 'Bekijk alle kazen', 'de-kaasgenoten' ),
			'cta_url'   => dkg_product_category_url( 'kaas', 'kaas-delicatessen' ),
			'image'     => 'promo-pakketten.jpg',
			'image_alt' => __( 'Luxe kaasplank met delicatessen', 'de-kaasgenoten' ),
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
 * Render de Over Ons pagina.
 */
function dkg_render_about_page() {
	$content = dkg_about_page_content();

	get_header();
	?>
	<main id="primary" class="dkg-main dkg-about-page">
		<section class="dkg-about-hero" aria-labelledby="dkg-about-hero-title">
			<div class="dkg-about-hero__media">
				<img src="<?php echo esc_url( dkg_asset_uri( 'images/' . $content['hero']['image'] ) ); ?>" alt="<?php echo esc_attr( $content['hero']['image_alt'] ); ?>" width="1728" height="910" decoding="async">
			</div>
			<div class="dkg-about-hero__shade" aria-hidden="true"></div>
			<div class="dkg-container dkg-about-hero__inner">
				<p class="dkg-eyebrow"><?php echo esc_html( $content['hero']['eyebrow'] ); ?></p>
				<h1 id="dkg-about-hero-title"><?php echo esc_html( $content['hero']['title'] ); ?></h1>
				<p class="dkg-about-hero__text"><?php echo esc_html( $content['hero']['text'] ); ?></p>
				<div class="dkg-hero-actions">
					<a class="dkg-button dkg-button-gold" href="<?php echo esc_url( $content['hero']['cta_url'] ); ?>">
						<?php echo esc_html( $content['hero']['cta_label'] ); ?> <span aria-hidden="true">›</span>
					</a>
				</div>
			</div>
		</section>

		<section class="dkg-about-usps" aria-label="<?php esc_attr_e( 'Onze beloftes', 'de-kaasgenoten' ); ?>">
			<div class="dkg-container dkg-about-usps__grid">
				<?php foreach ( $content['usps'] as $usp ) : ?>
					<article class="dkg-about-usp">
						<span class="dkg-about-usp__icon" aria-hidden="true"><?php echo dkg_icon( $usp['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<h2><?php echo esc_html( $usp['title'] ); ?></h2>
						<p><?php echo esc_html( $usp['text'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</section>

		<section class="dkg-about-split">
			<div class="dkg-about-split__media">
				<img src="<?php echo esc_url( dkg_asset_uri( 'images/' . $content['mission']['image'] ) ); ?>" alt="<?php echo esc_attr( $content['mission']['image_alt'] ); ?>" width="720" height="900" loading="lazy" decoding="async">
			</div>
			<div class="dkg-about-split__content">
				<p class="dkg-eyebrow dkg-eyebrow--dark"><?php echo esc_html( $content['mission']['eyebrow'] ); ?></p>
				<h2><?php echo esc_html( $content['mission']['title'] ); ?></h2>
				<p><?php echo esc_html( $content['mission']['text'] ); ?></p>
				<a class="dkg-button dkg-button-gold" href="<?php echo esc_url( $content['mission']['cta_url'] ); ?>">
					<?php echo esc_html( $content['mission']['cta_label'] ); ?> <span aria-hidden="true">›</span>
				</a>
			</div>
		</section>

		<section class="dkg-about-split dkg-about-split--reverse">
			<div class="dkg-about-split__media">
				<img src="<?php echo esc_url( dkg_asset_uri( 'images/' . $content['promise']['image'] ) ); ?>" alt="<?php echo esc_attr( $content['promise']['image_alt'] ); ?>" width="720" height="900" loading="lazy" decoding="async">
			</div>
			<div class="dkg-about-split__content">
				<p class="dkg-eyebrow dkg-eyebrow--dark"><?php echo esc_html( $content['promise']['eyebrow'] ); ?></p>
				<h2><?php echo esc_html( $content['promise']['title'] ); ?></h2>
				<p><?php echo esc_html( $content['promise']['text'] ); ?></p>
			</div>
		</section>

		<section class="dkg-about-values">
			<div class="dkg-container">
				<div class="dkg-about-values__intro">
					<p class="dkg-eyebrow dkg-eyebrow--dark"><?php echo esc_html( $content['values']['eyebrow'] ); ?></p>
					<h2><?php echo esc_html( $content['values']['title'] ); ?></h2>
				</div>
				<div class="dkg-about-values__grid">
					<?php foreach ( $content['values']['items'] as $value ) : ?>
						<article class="dkg-about-value">
							<span class="dkg-about-value__icon" aria-hidden="true"><?php echo dkg_icon( $value['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
							<h3><?php echo esc_html( $value['title'] ); ?></h3>
							<p><?php echo esc_html( $value['text'] ); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section class="dkg-about-cta">
			<div class="dkg-about-cta__media">
				<img src="<?php echo esc_url( dkg_asset_uri( 'images/' . $content['cta']['image'] ) ); ?>" alt="<?php echo esc_attr( $content['cta']['image_alt'] ); ?>" width="900" height="700" loading="lazy" decoding="async">
			</div>
			<div class="dkg-about-cta__shade" aria-hidden="true"></div>
			<div class="dkg-container dkg-about-cta__inner">
				<p class="dkg-eyebrow"><?php echo esc_html( $content['cta']['eyebrow'] ); ?></p>
				<h2><?php echo esc_html( $content['cta']['title'] ); ?></h2>
				<p><?php echo esc_html( $content['cta']['text'] ); ?></p>
				<a class="dkg-button dkg-button-gold" href="<?php echo esc_url( $content['cta']['cta_url'] ); ?>">
					<?php echo esc_html( $content['cta']['cta_label'] ); ?> <span aria-hidden="true">›</span>
				</a>
			</div>
		</section>

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

		<?php
		$extra_content = '';
		while ( have_posts() ) :
			the_post();
			$extra_content = apply_filters( 'the_content', get_the_content() );
		endwhile;

		if ( '' !== trim( $extra_content ) ) :
			?>
			<section class="dkg-about-extra">
				<div class="dkg-container dkg-entry-content">
					<?php echo $extra_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
			</section>
			<?php
		endif;
		?>
	</main>
	<?php
	get_footer();
}
