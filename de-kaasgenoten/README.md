# De Kaasgenoten theme

Custom WordPress/WooCommerce theme voor De Kaasgenoten (v2.3.0).

## Na installatie in WordPress

1. Activeer WooCommerce.
2. Stel de WooCommerce pagina's in: Winkel, Winkelwagen, Afrekenen en Mijn account.
3. Activeer het thema — categorieën en het gewicht-attribuut worden automatisch aangemaakt (`inc/wc-setup.php`).
4. Vul bedrijfsgegevens in via **Weergave → Customizer → De Kaasgenoten**.
5. Koppel het hoofdmenu aan de locatie `Hoofdmenu` (fallback-menu aanwezig als er geen menu is).
6. Plaats een contactformulier-shortcode op de Contact-pagina (CF7 of WPForms).
7. Krijg je 404 op pagina's? Ga naar **Instellingen → Permalinks** en klik op **Wijzigingen opslaan**.

## WooCommerce-structuur

### Hoofdcategorieën
- `kaas`, `delicatessen`, `pakketten`, `geschenken`, `aanbieding`

### Rijpheid (onder `kaas`)
- `jong`, `jong-belegen`, `belegen`, `extra-belegen`, `oud`

### Merken
- `bastiaansen`, `marienwaerdt` (onder `biologische-kaas`)
- `ravenswaard`, `mekkerstee`, `lutjewinkel`, `terschellinger`

### Merk-subcategorieën (filters op merkpagina's)
Producten horen in **één merk-subcategorie**, bijvoorbeeld:
- `bastiaansen-koekaas`, `bastiaansen-geitenkaas`, …
- `marienwaerdt-koekaas`, `marienwaerdt-kruidenkaas`, `marienwaerdt-geitenkaas`
- `mekkerstee-geitenkaas`, `mekkerstee-geitenkaas-kruiden`
- `terschellinger-koekaas`, `terschellinger-kruidenkaas`
- `ravenswaard-koekaas`, `ravenswaard-kruidenkaas`

Dubbele tagging (merk + losse soortcategorie) is **niet** nodig.

### Pakketten & geschenken
- `borrelpakketten`, `kerstpakketten`, `relatiegeschenken`

### Gewicht-attribuut
- `pa_gewicht`: 250 gram, 500 gram, 1000 gram, 2000 gram

## Merkpagina's

Merkpagina's worden getoond op `/winkel/?product_cat={merk-slug}/` met filterkaarten via `?filter=koekaas`.

Configuratie in `inc/brand-pages.php`. Elk filter verwijst naar een **merk-subcategorie** (bijv. `bastiaansen-koekaas`). Alleen subcategorieën die in WooCommerce bestaan worden als kaart getoond.

## Aanbiedingen

Alleen producten in categorie `aanbieding` verschijnen op de aanbiedingenpagina — niet automatisch alle sale-producten.

## Thema-modules (`inc/`)

| Bestand | Functie |
|---------|---------|
| `theme-options.php` | Customizer: bedrijf, socials, topbar, trust, homepage |
| `wc-setup.php` | Auto-aanmaken categorieën en gewicht-attribuut |
| `nav.php` | Menu-fallback, footer-info-links |
| `search.php` | Product-only zoeken |
| `single-product.php` | PDP tabs, sticky ATC, admin meta |
| `cart-checkout.php` | Mini-cart fragments, checkout trust bar |
| `seo.php` | Organization schema, canonical merkfilters |
| `performance.php` | Conditionele WC assets, WebP/AVIF |

## Aanbevolen plugins

| Functie | Plugin |
|---------|--------|
| Formulieren | Contact Form 7 of WPForms |
| Nieuwsbrief | MailPoet |
| SEO | Rank Math |
| Zoeken | FiboSearch (optioneel) |
| Filters | Filter Everything (optioneel) |
| Cache | LiteSpeed / WP Rocket |

## Nieuwsbrief

Installeer MailPoet en plaats het formulier in **Weergave → Widgets → Footer nieuwsbrief**.

## Deployment

Zip het `de-kaasgenoten/` map met forward slashes (niet backslashes) zodat WordPress `style.css` correct herkent.

Zie `CHANGELOG.md` voor versiegeschiedenis.

## Preview

`preview.html` is alleen bedoeld als snelle visuele preview buiten WordPress.
