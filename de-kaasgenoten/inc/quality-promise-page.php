<?php
/**
 * Kwaliteitsbelofte pagina en herbruikbare premium-componenten.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * URL van de kwaliteitsbelofte-pagina.
 *
 * @return string
 */
function dkg_quality_promise_page_url() {
	return dkg_page_url( 'kwaliteitsbelofte' );
}

/**
 * Content voor de kwaliteitsbelofte-pagina.
 *
 * Pas teksten aan via de filter `dkg_quality_promise_page_content`
 * of in dit bestand.
 *
 * @return array<string, mixed>
 */
function dkg_quality_promise_page_content() {
	$content = array(
		'hero'   => array(
			'title'    => __( 'Onze kwaliteitsbelofte', 'de-kaasgenoten' ),
			'lead'     => __( 'Echte kwaliteit zit in aandacht.', 'de-kaasgenoten' ),
			'text'     => __( 'Iedere bestelling wordt zorgvuldig geselecteerd, vers afgesneden en met vakmanschap verpakt.', 'de-kaasgenoten' ),
			'image'    => 'quality-promise-hero.jpg',
			'image_alt'=> __( 'Ambachtelijke kazen in premium presentatie', 'de-kaasgenoten' ),
		),
		'intro'  => array(
			__( 'Bij De Kaasgenoten draait alles om smaak, vakmanschap en betrouwbaarheid.', 'de-kaasgenoten' ),
			__( 'Wij werken samen met gepassioneerde kaasmakers en leveranciers die dezelfde liefde voor kwaliteit delen.', 'de-kaasgenoten' ),
			__( 'Dat is de belofte die wij u doen – bij iedere bestelling opnieuw.', 'de-kaasgenoten' ),
		),
		'cards'  => array(
			array(
				'icon'  => 'knife',
				'title' => __( 'Altijd vers afgesneden', 'de-kaasgenoten' ),
				'text'  => __( 'Uw kaas wordt pas kort voor verzending met de hand afgesneden zodat smaak, structuur en kwaliteit optimaal behouden blijven.', 'de-kaasgenoten' ),
			),
			array(
				'icon'  => 'award',
				'title' => __( 'Zorgvuldig geselecteerd', 'de-kaasgenoten' ),
				'text'  => __( 'Ons assortiment bestaat uitsluitend uit kwaliteitsproducten waar wij volledig achter staan.', 'de-kaasgenoten' ),
			),
			array(
				'icon'  => 'box',
				'title' => __( 'Professioneel verpakt', 'de-kaasgenoten' ),
				'text'  => __( 'Iedere bestelling wordt met zorg verpakt zodat uw producten veilig aankomen.', 'de-kaasgenoten' ),
			),
			array(
				'icon'  => 'tag',
				'title' => __( 'Eerlijke en transparante prijzen', 'de-kaasgenoten' ),
				'text'  => __( 'Wij rekenen eerlijke productprijzen. Verzendkosten worden apart berekend zodat u nooit betaalt voor verborgen kosten.', 'de-kaasgenoten' ),
			),
			array(
				'icon'  => 'leaf',
				'title' => __( 'Ambacht en duurzaamheid', 'de-kaasgenoten' ),
				'text'  => __( 'Wij kiezen voor ambachtelijke producenten met respect voor mens, dier en natuur.', 'de-kaasgenoten' ),
			),
			array(
				'icon'  => 'service',
				'title' => __( 'Persoonlijke service', 'de-kaasgenoten' ),
				'text'  => __( 'Heeft u vragen of zoekt u advies? Wij denken graag met u mee.', 'de-kaasgenoten' ),
			),
			array(
				'icon'  => 'hand',
				'title' => __( 'Zorgvuldig verwerkt', 'de-kaasgenoten' ),
				'text'  => __( 'Iedere bestelling krijgt dezelfde aandacht, ongeacht de grootte van uw bestelling.', 'de-kaasgenoten' ),
			),
			array(
				'icon'  => 'heart',
				'title' => __( 'Onze dankbaarheid', 'de-kaasgenoten' ),
				'text'  => __( 'Uw vertrouwen betekent veel voor ons. Wij doen iedere dag ons uiterste best om verwachtingen te overtreffen.', 'de-kaasgenoten' ),
			),
		),
		'story'  => array(
			'title'     => __( 'Meer dan alleen kaas', 'de-kaasgenoten' ),
			'paragraphs'=> array(
				__( 'Bij De Kaasgenoten geloven wij dat kwaliteit begint bij aandacht.', 'de-kaasgenoten' ),
				__( 'Van de selectie van onze kazen tot de manier waarop iedere bestelling wordt verpakt: wij behandelen iedere bestelling alsof deze voor onze eigen tafel bestemd is.', 'de-kaasgenoten' ),
				__( 'Daarom kiezen wij voor vakmanschap, eerlijke producten en persoonlijke service.', 'de-kaasgenoten' ),
			),
			'signature' => __( 'Met liefde voor kaas.', 'de-kaasgenoten' ),
			'image'     => 'quality-promise-story.jpg',
			'image_alt' => __( 'Ambachtelijke kaasselectie met noten en druiven', 'de-kaasgenoten' ),
			'badge'     => __( 'Met zorg geselecteerd voor u', 'de-kaasgenoten' ),
		),
		'usp_bar'=> array(
			array(
				'icon'  => 'truck',
				'title' => __( 'Verzendkosten €7,95', 'de-kaasgenoten' ),
				'text'  => __( 'Binnen Nederland', 'de-kaasgenoten' ),
			),
			array(
				'icon'  => 'hand',
				'title' => __( 'Zorgvuldig verwerkt', 'de-kaasgenoten' ),
				'text'  => __( 'Met aandacht voor elke bestelling', 'de-kaasgenoten' ),
			),
			array(
				'icon'  => 'box',
				'title' => __( 'Veilig verpakt', 'de-kaasgenoten' ),
				'text'  => __( 'Beschermd tijdens transport', 'de-kaasgenoten' ),
			),
			array(
				'icon'  => 'shield',
				'title' => __( 'Veilig betalen', 'de-kaasgenoten' ),
				'text'  => __( 'Met iDEAL & creditcard', 'de-kaasgenoten' ),
			),
			array(
				'icon'  => 'pin',
				'title' => __( 'Afhalen op afspraak', 'de-kaasgenoten' ),
				'text'  => __( 'Op onze locatie in Opmeer', 'de-kaasgenoten' ),
			),
		),
	);

	return apply_filters( 'dkg_quality_promise_page_content', $content );
}

/**
 * Responsive thema-afbeelding met optionele WebP-variant.
 *
 * @param string               $filename Bestandsnaam onder assets/images/.
 * @param string               $alt      Alt-tekst.
 * @param array<string, mixed> $attrs    Extra HTML-attributen.
 */
function dkg_responsive_theme_image( $filename, $alt, $attrs = array() ) {
	$filename = ltrim( (string) $filename, '/' );
	$base     = pathinfo( $filename, PATHINFO_FILENAME );
	$webp     = 'images/' . $base . '.webp';
	$fallback = 'images/' . $filename;
	$webp_path = get_template_directory() . '/assets/' . $webp;

	$defaults = array(
		'loading'  => 'lazy',
		'decoding' => 'async',
		'class'    => '',
	);

	$attrs = wp_parse_args( $attrs, $defaults );
	$class = trim( (string) $attrs['class'] );
	unset( $attrs['class'] );

	$attr_string = '';
	foreach ( $attrs as $key => $value ) {
		if ( '' === $value || null === $value ) {
			continue;
		}
		$attr_string .= sprintf( ' %s="%s"', esc_attr( $key ), esc_attr( (string) $value ) );
	}

	if ( is_readable( $webp_path ) ) {
		printf(
			'<picture><source srcset="%s" type="image/webp"><img src="%s" alt="%s" class="%s"%s></picture>',
			esc_url( dkg_asset_uri( $webp ) ),
			esc_url( dkg_asset_uri( $fallback ) ),
			esc_attr( $alt ),
			esc_attr( $class ),
			$attr_string // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		);
		return;
	}

	printf(
		'<img src="%s" alt="%s" class="%s"%s>',
		esc_url( dkg_asset_uri( $fallback ) ),
		esc_attr( $alt ),
		esc_attr( $class ),
		$attr_string // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	);
}

/**
 * HeroBanner — premium full-width hero.
 *
 * @param array<string, mixed> $hero Hero-data.
 */
function dkg_hero_banner( $hero ) {
	$image_url = dkg_asset_uri( 'images/' . $hero['image'] );
	?>
	<section
		class="dkg-hero-banner"
		style="background-image: linear-gradient(180deg, rgba(16,37,27,.55), rgba(16,37,27,.78)), url('<?php echo esc_url( $image_url ); ?>');"
		aria-labelledby="dkg-hero-banner-title"
	>
		<div class="dkg-container dkg-hero-banner__inner">
			<h1 id="dkg-hero-banner-title"><?php echo esc_html( $hero['title'] ); ?></h1>
			<span class="dkg-hero-banner__divider" aria-hidden="true"></span>
			<p class="dkg-hero-banner__lead"><?php echo esc_html( $hero['lead'] ); ?></p>
			<p class="dkg-hero-banner__text"><?php echo esc_html( $hero['text'] ); ?></p>
		</div>
	</section>
	<?php
}

/**
 * QualityCard — enkele beloftekaart.
 *
 * @param array<string, string> $card Kaartdata.
 */
function dkg_quality_card( $card ) {
	?>
	<article class="dkg-quality-card">
		<span class="dkg-quality-card__icon" aria-hidden="true"><?php echo dkg_icon( $card['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
		<h2 class="dkg-quality-card__title"><?php echo esc_html( $card['title'] ); ?></h2>
		<p class="dkg-quality-card__text"><?php echo esc_html( $card['text'] ); ?></p>
	</article>
	<?php
}

/**
 * PromiseGrid — raster met kwaliteitskaarten.
 *
 * @param array<int, array<string, string>> $cards   Kaarten.
 * @param string                            $label   Toegankelijkheidslabel.
 */
function dkg_promise_grid( $cards, $label = '' ) {
	if ( empty( $cards ) ) {
		return;
	}

	if ( ! $label ) {
		$label = __( 'Onze kwaliteitsbeloftes', 'de-kaasgenoten' );
	}
	?>
	<section class="dkg-section dkg-promise-grid" aria-label="<?php echo esc_attr( $label ); ?>">
		<div class="dkg-container dkg-promise-grid__inner">
			<?php foreach ( $cards as $card ) : ?>
				<?php dkg_quality_card( $card ); ?>
			<?php endforeach; ?>
		</div>
	</section>
	<?php
}

/**
 * StorySection — beeld + verhaal.
 *
 * @param array<string, mixed> $story Story-data.
 */
function dkg_story_section( $story ) {
	?>
	<section class="dkg-section dkg-story-section" aria-labelledby="dkg-story-section-title">
		<div class="dkg-container dkg-story-section__layout">
			<div class="dkg-story-section__media">
				<?php
				dkg_responsive_theme_image(
					$story['image'],
					$story['image_alt'],
					array(
						'width'  => '720',
						'height' => '900',
						'class'  => 'dkg-story-section__image',
					)
				);
				?>
				<?php if ( ! empty( $story['badge'] ) ) : ?>
					<span class="dkg-story-section__badge"><?php echo esc_html( $story['badge'] ); ?></span>
				<?php endif; ?>
			</div>
			<div class="dkg-story-section__content">
				<span class="dkg-story-section__divider" aria-hidden="true"></span>
				<h2 id="dkg-story-section-title"><?php echo esc_html( $story['title'] ); ?></h2>
				<?php foreach ( $story['paragraphs'] as $paragraph ) : ?>
					<p><?php echo esc_html( $paragraph ); ?></p>
				<?php endforeach; ?>
				<?php if ( ! empty( $story['signature'] ) ) : ?>
					<p class="dkg-story-section__signature"><?php echo esc_html( $story['signature'] ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
}

/**
 * BottomUSPBar — statische vertrouwensbalk.
 *
 * @param array<int, array<string, string>> $items USP-items.
 */
function dkg_bottom_usp_bar( $items ) {
	if ( empty( $items ) ) {
		return;
	}
	?>
	<section class="dkg-bottom-usp-bar" aria-label="<?php esc_attr_e( 'Service en vertrouwen', 'de-kaasgenoten' ); ?>">
		<div class="dkg-container dkg-bottom-usp-bar__grid">
			<?php foreach ( $items as $item ) : ?>
				<div class="dkg-bottom-usp-bar__item">
					<span class="dkg-bottom-usp-bar__icon" aria-hidden="true"><?php echo dkg_icon( $item['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<div>
						<strong><?php echo esc_html( $item['title'] ); ?></strong>
						<span><?php echo esc_html( $item['text'] ); ?></span>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</section>
	<?php
}

/**
 * QualityPromisePage — volledige pagina-render.
 */
function dkg_render_quality_promise_page() {
	$content = dkg_quality_promise_page_content();

	get_header();
	?>
	<main id="primary" class="dkg-main dkg-quality-promise-page">
		<?php dkg_hero_banner( $content['hero'] ); ?>

		<section class="dkg-section dkg-quality-intro">
			<div class="dkg-container dkg-quality-intro__inner">
				<?php
				$intro_count = count( $content['intro'] );
				foreach ( $content['intro'] as $index => $paragraph ) :
					$is_last = ( $index + 1 ) === $intro_count;
					?>
					<p<?php echo $is_last ? ' class="dkg-quality-intro__emphasis"' : ''; ?>><?php echo esc_html( $paragraph ); ?></p>
				<?php endforeach; ?>
			</div>
		</section>

		<?php dkg_promise_grid( $content['cards'] ); ?>
		<?php dkg_story_section( $content['story'] ); ?>
		<?php dkg_bottom_usp_bar( $content['usp_bar'] ); ?>

		<?php
		$extra_content = '';
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				$extra_content = apply_filters( 'the_content', get_the_content() );
			}
		}

		if ( '' !== trim( $extra_content ) ) :
			?>
			<section class="dkg-section dkg-quality-extra">
				<div class="dkg-container dkg-entry-content">
					<?php echo $extra_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
			</section>
		<?php endif; ?>
	</main>
	<?php
	get_footer();
}

/**
 * Laad pagina-styles.
 */
function dkg_enqueue_quality_promise_assets() {
	if ( ! is_page( 'kwaliteitsbelofte' ) ) {
		return;
	}

	wp_enqueue_style(
		'dkg-quality-promise-page',
		get_template_directory_uri() . '/assets/css/components/quality-promise-page.css',
		array( 'dkg-theme' ),
		DKG_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'dkg_enqueue_quality_promise_assets', 20 );

/**
 * SEO: document title.
 *
 * @param array<string, string> $parts Title parts.
 * @return array<string, string>
 */
function dkg_quality_promise_document_title( $parts ) {
	if ( is_page( 'kwaliteitsbelofte' ) ) {
		$parts['title'] = __( 'Onze kwaliteitsbelofte', 'de-kaasgenoten' );
		$parts['site']  = __( 'De Kaasgenoten', 'de-kaasgenoten' );
	}

	return $parts;
}
add_filter( 'document_title_parts', 'dkg_quality_promise_document_title' );

/**
 * SEO: meta description.
 */
function dkg_quality_promise_meta_description() {
	if ( ! is_page( 'kwaliteitsbelofte' ) ) {
		return;
	}

	$description = __( 'Ontdek waarom kwaliteit, vakmanschap en persoonlijke service centraal staan bij De Kaasgenoten. Van vers afgesneden kaas tot professionele verpakking.', 'de-kaasgenoten' );

	echo '<meta name="description" content="' . esc_attr( $description ) . '" />' . "\n";
}
add_action( 'wp_head', 'dkg_quality_promise_meta_description', 1 );
