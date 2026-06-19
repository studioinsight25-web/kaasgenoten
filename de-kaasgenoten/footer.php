<?php
/**
 * Footer template.
 *
 * @package De_Kaasgenoten
 */
?>
<footer class="dkg-footer">
	<div class="dkg-container dkg-footer-grid">
		<div class="dkg-footer-brand">
			<a class="dkg-logo dkg-logo-footer" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<span class="dkg-logo-mark" aria-hidden="true">
					<svg viewBox="0 0 62 45"><path d="M7 17 31 5l24 12v21H7Z"></path><path d="M15 20h32M20 31h4m12 0h4M29 15h4"></path></svg>
				</span>
				<span class="dkg-logo-text">
					<strong><?php esc_html_e( 'De Kaasgenoten', 'de-kaasgenoten' ); ?></strong>
					<small><?php esc_html_e( 'Ambachtelijke kaas', 'de-kaasgenoten' ); ?></small>
				</span>
			</a>
			<p><?php esc_html_e( 'De lekkerste kazen, delicatessen en cadeaupakketten. Met liefde geselecteerd, met passie samengesteld.', 'de-kaasgenoten' ); ?></p>
			<div class="dkg-socials" aria-label="<?php esc_attr_e( 'Social media', 'de-kaasgenoten' ); ?>">
				<a href="<?php echo esc_url( dkg_page_url( 'contact' ) ); ?>" aria-label="<?php esc_attr_e( 'Facebook informatie aanvragen', 'de-kaasgenoten' ); ?>">f</a>
				<a href="<?php echo esc_url( dkg_page_url( 'contact' ) ); ?>" aria-label="<?php esc_attr_e( 'Instagram informatie aanvragen', 'de-kaasgenoten' ); ?>">◎</a>
				<a href="tel:+31416123456" aria-label="<?php esc_attr_e( 'Bel De Kaasgenoten', 'de-kaasgenoten' ); ?>">w</a>
				<a href="mailto:info@de-kaasgenoten.nl" aria-label="E-mail">✉</a>
			</div>
		</div>
		<div>
			<h2><?php esc_html_e( 'Klantenservice', 'de-kaasgenoten' ); ?></h2>
			<ul>
				<li><a href="<?php echo esc_url( dkg_page_url( 'veelgestelde-vragen' ) ); ?>"><?php esc_html_e( 'Veelgestelde vragen', 'de-kaasgenoten' ); ?></a></li>
				<li><a href="<?php echo esc_url( dkg_page_url( 'levering-verzending' ) ); ?>"><?php esc_html_e( 'Levering & verzending', 'de-kaasgenoten' ); ?></a></li>
				<li><a href="<?php echo esc_url( dkg_page_url( 'terugbetaal-en-retourneringsbeleid' ) ); ?>"><?php esc_html_e( 'Terugbetaal- en retourneringsbeleid', 'de-kaasgenoten' ); ?></a></li>
				<li><a href="<?php echo esc_url( class_exists( 'WooCommerce' ) ? wc_get_cart_url() : dkg_page_url( 'winkelwagen' ) ); ?>"><?php esc_html_e( 'Winkelwagen', 'de-kaasgenoten' ); ?></a></li>
				<li><a href="<?php echo esc_url( dkg_page_url( 'contact' ) ); ?>"><?php esc_html_e( 'Contact', 'de-kaasgenoten' ); ?></a></li>
			</ul>
		</div>
		<div>
			<h2><?php esc_html_e( 'Informatie', 'de-kaasgenoten' ); ?></h2>
			<ul>
				<li><a href="<?php echo esc_url( dkg_page_url( 'kaas-delicatessen' ) ); ?>"><?php esc_html_e( 'Kaas & Delicatessen', 'de-kaasgenoten' ); ?></a></li>
				<li><a href="<?php echo esc_url( dkg_page_url( 'borrelpakketten' ) ); ?>"><?php esc_html_e( 'Borrelpakketten', 'de-kaasgenoten' ); ?></a></li>
				<li><a href="<?php echo esc_url( dkg_page_url( 'kerstpakketten' ) ); ?>"><?php esc_html_e( 'Kerstpakketten', 'de-kaasgenoten' ); ?></a></li>
				<li><a href="<?php echo esc_url( dkg_page_url( 'relatiegeschenken' ) ); ?>"><?php esc_html_e( 'Relatiegeschenken', 'de-kaasgenoten' ); ?></a></li>
				<li><a href="<?php echo esc_url( dkg_page_url( 'over-ons' ) ); ?>"><?php esc_html_e( 'Over ons', 'de-kaasgenoten' ); ?></a></li>
				<li><a href="<?php echo esc_url( dkg_page_url( 'privacy-policy' ) ); ?>"><?php esc_html_e( 'Privacybeleid', 'de-kaasgenoten' ); ?></a></li>
			</ul>
		</div>
		<div>
			<?php $dkg_company = dkg_company_details(); ?>
			<h2><?php esc_html_e( 'Contact', 'de-kaasgenoten' ); ?></h2>
			<p><?php echo esc_html( $dkg_company['name'] ); ?><br><?php echo esc_html( $dkg_company['street'] ); ?><br><?php echo esc_html( $dkg_company['postal'] . ' ' . $dkg_company['city'] ); ?></p>
			<p>
				<a href="<?php echo esc_url( 'tel:' . $dkg_company['phone_href'] ); ?>"><?php echo esc_html( $dkg_company['phone'] ); ?></a><br>
				<a href="<?php echo esc_url( 'mailto:' . $dkg_company['email'] ); ?>"><?php echo esc_html( $dkg_company['email'] ); ?></a>
			</p>
			<p class="dkg-footer-legal-meta">
				<?php
				printf(
					/* translators: 1: KvK-nummer, 2: btw-nummer */
					esc_html__( 'KvK: %1$s · BTW: %2$s', 'de-kaasgenoten' ),
					esc_html( $dkg_company['kvk'] ),
					esc_html( $dkg_company['btw'] )
				);
				?>
			</p>
		</div>
		<div>
			<?php if ( is_active_sidebar( 'footer-newsletter' ) ) : ?>
				<?php dynamic_sidebar( 'footer-newsletter' ); ?>
			<?php else : ?>
				<h2><?php esc_html_e( 'Nieuwsbrief', 'de-kaasgenoten' ); ?></h2>
				<p><?php esc_html_e( 'Ontvang tips, recepten en aanbiedingen in je mailbox.', 'de-kaasgenoten' ); ?></p>
				<p class="dkg-newsletter-note"><?php esc_html_e( 'Plaats hier je nieuwsbrief-inschrijfformulier via de widget "Footer nieuwsbrief" (bijvoorbeeld MailPoet).', 'de-kaasgenoten' ); ?></p>
				<a class="dkg-button dkg-button-gold dkg-newsletter-cta" href="<?php echo esc_url( dkg_page_url( 'contact' ) ); ?>"><?php esc_html_e( 'Schrijf je in', 'de-kaasgenoten' ); ?></a>
			<?php endif; ?>
		</div>
	</div>
	<div class="dkg-container dkg-footer-bottom">
		<p>© <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php esc_html_e( 'De Kaasgenoten. Alle rechten voorbehouden.', 'de-kaasgenoten' ); ?></p>
		<nav aria-label="<?php esc_attr_e( 'Juridische links', 'de-kaasgenoten' ); ?>">
			<a href="<?php echo esc_url( dkg_page_url( 'algemene-voorwaarden' ) ); ?>"><?php esc_html_e( 'Algemene voorwaarden', 'de-kaasgenoten' ); ?></a>
			<a href="<?php echo esc_url( dkg_page_url( 'terugbetaal-en-retourneringsbeleid' ) ); ?>"><?php esc_html_e( 'Retourbeleid', 'de-kaasgenoten' ); ?></a>
			<a href="<?php echo esc_url( dkg_page_url( 'privacy-policy' ) ); ?>"><?php esc_html_e( 'Privacybeleid', 'de-kaasgenoten' ); ?></a>
			<a href="<?php echo esc_url( dkg_page_url( 'cookiebeleid' ) ); ?>"><?php esc_html_e( 'Cookiebeleid', 'de-kaasgenoten' ); ?></a>
			<a href="<?php echo esc_url( dkg_page_url( 'levering-verzending' ) ); ?>"><?php esc_html_e( 'Levering & verzending', 'de-kaasgenoten' ); ?></a>
		</nav>
	</div>
</footer>

<div class="dkg-cookie-banner" id="dkg-cookie-banner" role="dialog" aria-live="polite" aria-label="<?php esc_attr_e( 'Cookiemelding', 'de-kaasgenoten' ); ?>">
	<div class="dkg-container dkg-cookie-banner__inner">
		<p class="dkg-cookie-banner__text">
			<?php
			printf(
				/* translators: %s: link naar cookiebeleid */
				esc_html__( 'Wij gebruiken cookies om de website goed te laten werken en te verbeteren. Lees meer in ons %s.', 'de-kaasgenoten' ),
				'<a href="' . esc_url( dkg_page_url( 'cookiebeleid' ) ) . '">' . esc_html__( 'cookiebeleid', 'de-kaasgenoten' ) . '</a>'
			);
			?>
		</p>
		<div class="dkg-cookie-banner__actions">
			<button type="button" class="dkg-button dkg-button-outline" data-dkg-cookie="decline"><?php esc_html_e( 'Weigeren', 'de-kaasgenoten' ); ?></button>
			<button type="button" class="dkg-button dkg-button-gold" data-dkg-cookie="accept"><?php esc_html_e( 'Accepteren', 'de-kaasgenoten' ); ?></button>
		</div>
	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>
