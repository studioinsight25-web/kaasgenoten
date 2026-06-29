<?php
/**
 * Product search form.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<form role="search" method="get" class="woocommerce-product-search dkg-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="woocommerce-product-search-field"><?php esc_html_e( 'Zoek producten', 'de-kaasgenoten' ); ?></label>
	<input type="search" id="woocommerce-product-search-field" class="search-field" placeholder="<?php esc_attr_e( 'Zoek in ons assortiment…', 'de-kaasgenoten' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
	<input type="hidden" name="post_type" value="product" />
	<button type="submit" class="dkg-button dkg-button-gold"><?php esc_html_e( 'Zoeken', 'de-kaasgenoten' ); ?></button>
</form>
