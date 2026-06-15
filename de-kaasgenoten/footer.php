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
				<a href="#" aria-label="Facebook">f</a>
				<a href="#" aria-label="Instagram">◎</a>
				<a href="#" aria-label="WhatsApp">w</a>
				<a href="mailto:info@de-kaasgenoten.nl" aria-label="E-mail">✉</a>
			</div>
		</div>
		<div>
			<h2><?php esc_html_e( 'Klantenservice', 'de-kaasgenoten' ); ?></h2>
			<ul>
				<li><a href="#"><?php esc_html_e( 'Veelgestelde vragen', 'de-kaasgenoten' ); ?></a></li>
				<li><a href="#"><?php esc_html_e( 'Verzending & levering', 'de-kaasgenoten' ); ?></a></li>
				<li><a href="#"><?php esc_html_e( 'Retourneren', 'de-kaasgenoten' ); ?></a></li>
				<li><a href="#"><?php esc_html_e( 'Betaalmethoden', 'de-kaasgenoten' ); ?></a></li>
				<li><a href="#"><?php esc_html_e( 'Contact', 'de-kaasgenoten' ); ?></a></li>
			</ul>
		</div>
		<div>
			<h2><?php esc_html_e( 'Informatie', 'de-kaasgenoten' ); ?></h2>
			<ul>
				<li><a href="#"><?php esc_html_e( 'Over ons', 'de-kaasgenoten' ); ?></a></li>
				<li><a href="#"><?php esc_html_e( 'Kaas kennis', 'de-kaasgenoten' ); ?></a></li>
				<li><a href="#"><?php esc_html_e( 'Recepten & inspiratie', 'de-kaasgenoten' ); ?></a></li>
				<li><a href="#"><?php esc_html_e( 'Vacatures', 'de-kaasgenoten' ); ?></a></li>
				<li><a href="#"><?php esc_html_e( 'Privacybeleid', 'de-kaasgenoten' ); ?></a></li>
			</ul>
		</div>
		<div>
			<h2><?php esc_html_e( 'Contact', 'de-kaasgenoten' ); ?></h2>
			<p>De Kaasgenoten<br>Ambachtstraat 1<br>5711 KA Kaatsheuvel</p>
			<p><a href="tel:+31416123456">0416 - 123 456</a><br><a href="mailto:info@de-kaasgenoten.nl">info@de-kaasgenoten.nl</a></p>
		</div>
		<div>
			<h2><?php esc_html_e( 'Nieuwsbrief', 'de-kaasgenoten' ); ?></h2>
			<p><?php esc_html_e( 'Ontvang tips, recepten en aanbiedingen in je mailbox.', 'de-kaasgenoten' ); ?></p>
			<form class="dkg-newsletter" action="#" method="post">
				<label class="screen-reader-text" for="dkg-newsletter-email"><?php esc_html_e( 'E-mailadres', 'de-kaasgenoten' ); ?></label>
				<input id="dkg-newsletter-email" type="email" placeholder="<?php esc_attr_e( 'Jouw e-mailadres', 'de-kaasgenoten' ); ?>">
				<button type="submit" aria-label="<?php esc_attr_e( 'Aanmelden', 'de-kaasgenoten' ); ?>">→</button>
			</form>
		</div>
	</div>
	<div class="dkg-container dkg-footer-bottom">
		<p>© <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php esc_html_e( 'De Kaasgenoten. Alle rechten voorbehouden.', 'de-kaasgenoten' ); ?></p>
		<nav aria-label="<?php esc_attr_e( 'Juridische links', 'de-kaasgenoten' ); ?>">
			<a href="#"><?php esc_html_e( 'Algemene voorwaarden', 'de-kaasgenoten' ); ?></a>
			<a href="#"><?php esc_html_e( 'Privacybeleid', 'de-kaasgenoten' ); ?></a>
			<a href="#"><?php esc_html_e( 'Cookiebeleid', 'de-kaasgenoten' ); ?></a>
		</nav>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
