<?php
/**
 * Product category archive fallback.
 *
 * @package De_Kaasgenoten
 */

defined( 'ABSPATH' ) || exit;

if ( function_exists( 'wc_get_template' ) ) {
	wc_get_template( 'archive-product.php' );
} else {
	get_template_part( 'archive' );
}
