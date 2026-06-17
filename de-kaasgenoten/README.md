# De Kaasgenoten theme

Custom WordPress/WooCommerce theme voor De Kaasgenoten.

## Na installatie in WordPress

1. Activeer WooCommerce.
2. Stel de WooCommerce pagina's in: Winkel, Winkelwagen, Afrekenen en Mijn account.
3. Maak productcategorieen aan met deze slugs:
   - `kaas`
   - `jong`
   - `jong-belegen`
   - `belegen`
   - `extra-belegen`
   - `oud`
   - `kaas-delicatessen`
   - `delicatessen`
   - `borrelpakketten`
   - `kerstpakketten`
   - `relatiegeschenken`
   - `pakketten-geschenken`
4. Koppel het hoofdmenu aan de locatie `Hoofdmenu`.
5. Koppel eventueel een footermenu aan de locatie `Footermenu`.
6. Krijg je 404 op pagina's? Ga naar `Instellingen -> Permalinks` en klik een keer op `Wijzigingen opslaan`.

Gebruik voor productoverzichten bij voorkeur WooCommerce categorie-archieven zoals:

- `/product-category/kaas/`
- `/product-category/delicatessen/`
- `/product-category/pakketten-geschenken/`

## Nieuwsbrief

Aanbevolen: installeer en activeer MailPoet. Maak in MailPoet een formulier aan en plaats dat formulier in:

`Weergave -> Widgets -> Footer nieuwsbrief`

Gebruik bijvoorbeeld een MailPoet blok of shortcode-widget met:

`[mailpoet_form id="1"]`

Zonder widget toont het thema een simpele fallback die de bezoeker naar de contactpagina stuurt.

## Preview

`preview.html` is alleen bedoeld als snelle visuele preview buiten WordPress. De echte controle moet in WordPress met WooCommerce gebeuren.
