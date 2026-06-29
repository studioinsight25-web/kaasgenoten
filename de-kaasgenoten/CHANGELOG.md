# Changelog

## 2.0.0 — 2026-06-15

Uitbreidingsplan geïmplementeerd: productie-klaar maken, premium winkelervaring en schaalbaar beheer.

### Fase 1 — Productie-klaar
- Centrale bedrijfsgegevens via Customizer (`inc/theme-options.php`)
- Automatisch aanmaken WooCommerce-categorieën en `pa_gewicht` attribuut (`inc/wc-setup.php`)
- Contactformulier via shortcode in pagina-editor
- Menu-fallback en footer-links naar WC-categorieën (`inc/nav.php`)
- Sorteerconflict opgelost: kaasvolgorde respecteert handmatige `?orderby`
- Nep-sterren vervangen door echte reviews of "Nog geen reviews"
- Aanbieding-CSS alleen op aanbiedingenpagina; nav-knop styles in `theme.css`

### Fase 2 — Winkelervaring
- Premium productpagina met tabs, sticky ATC, kaas-meta in admin (`inc/single-product.php`)
- Cart, checkout en bedankpagina templates in themastijl
- Mini-cart slide-out met WooCommerce fragments (`inc/cart-checkout.php`)
- Productzoekfunctie (`inc/search.php`, `search.php`, `product-searchform.php`)

### Fase 3 — Schaalbaar beheer
- Merkpagina's: Bastiaansen, Ravenswaard, Mèkkerstee, Lutjewinkel, Terschellinger
- Customizer: bedrijfsgegevens, socials, topbar, trust score, homepage hero

### Fase 4 — SEO & performance
- Organization schema en canonical URLs voor merkfilters (`inc/seo.php`)
- Conditioneel WC CSS, WebP/AVIF uploads, lazy load (`inc/performance.php`)

## 1.6.4

- Merkpagina Bastiaansen met filterkaarten
- Aanbiedingenpagina (alleen categorie `aanbieding`)
- Kaasvolgorde jong → oud → kruiden
- Gewicht-variaties 250g–2000g
