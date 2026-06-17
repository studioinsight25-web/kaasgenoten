<?php
/**
 * Header template.
 *
 * @package De_Kaasgenoten
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="screen-reader-text" href="#primary"><?php esc_html_e( 'Ga naar inhoud', 'de-kaasgenoten' ); ?></a>

<div class="dkg-topbar">
	<div class="dkg-container dkg-topbar-inner">
		<span><?php echo dkg_icon( 'heart' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Vers van het mes, met liefde geselecteerd', 'de-kaasgenoten' ); ?></span>
		<span><?php echo dkg_icon( 'truck' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Gratis verzending vanaf €75', 'de-kaasgenoten' ); ?></span>
		<span><?php echo dkg_icon( 'truck' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Voor 15:00 besteld, morgen in huis', 'de-kaasgenoten' ); ?></span>
	</div>
</div>

<header class="dkg-site-header">
	<div class="dkg-container dkg-header-inner">
		<a class="dkg-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php esc_attr_e( 'De Kaasgenoten homepage', 'de-kaasgenoten' ); ?>">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<span class="dkg-logo-mark" aria-hidden="true">
					<svg viewBox="0 0 62 45"><path d="M7 17 31 5l24 12v21H7Z"></path><path d="M15 20h32M20 31h4m12 0h4M29 15h4"></path></svg>
				</span>
				<span class="dkg-logo-text">
					<strong><?php esc_html_e( 'De Kaasgenoten', 'de-kaasgenoten' ); ?></strong>
					<small><?php esc_html_e( 'Ambachtelijke kaas', 'de-kaasgenoten' ); ?></small>
				</span>
			<?php endif; ?>
		</a>

		<button class="dkg-menu-toggle" type="button" aria-expanded="false" aria-controls="primary-menu">
			<span></span><span></span><span></span>
			<span class="screen-reader-text"><?php esc_html_e( 'Menu openen', 'de-kaasgenoten' ); ?></span>
		</button>

		<nav class="dkg-primary-nav" aria-label="<?php esc_attr_e( 'Hoofdmenu', 'de-kaasgenoten' ); ?>">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_id'        => 'primary-menu',
				'menu_class'     => 'dkg-menu',
				'container'      => false,
				'fallback_cb'    => 'dkg_menu_fallback',
			) );
			?>
		</nav>

		<div class="dkg-header-actions">
			<a href="<?php echo esc_url( home_url( '/?s=' ) ); ?>" aria-label="<?php esc_attr_e( 'Zoeken', 'de-kaasgenoten' ); ?>"><?php echo dkg_icon( 'search' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
			<a href="<?php echo esc_url( class_exists( 'WooCommerce' ) ? wc_get_page_permalink( 'myaccount' ) : dkg_page_url( 'mijn-account' ) ); ?>" aria-label="<?php esc_attr_e( 'Mijn account', 'de-kaasgenoten' ); ?>"><?php echo dkg_icon( 'user' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
			<a class="dkg-cart-link" href="<?php echo esc_url( class_exists( 'WooCommerce' ) ? wc_get_cart_url() : dkg_page_url( 'winkelwagen' ) ); ?>" aria-label="<?php esc_attr_e( 'Winkelwagen', 'de-kaasgenoten' ); ?>">
				<?php echo dkg_icon( 'cart' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<span class="dkg-cart-count"><?php echo esc_html( dkg_cart_count() ); ?></span>
			</a>
		</div>
	</div>
</header>
