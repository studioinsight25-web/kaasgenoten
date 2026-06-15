<?php
/**
 * Product archive template.
 *
 * @package De_Kaasgenoten
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
?>
<main id="primary" class="dkg-main dkg-woo">
	<div class="dkg-container">
		<?php
		do_action( 'woocommerce_before_main_content' );

		if ( woocommerce_product_loop() ) {
			do_action( 'woocommerce_before_shop_loop' );
			woocommerce_product_loop_start();

			if ( wc_get_loop_prop( 'total' ) ) {
				while ( have_posts() ) {
					the_post();
					do_action( 'woocommerce_shop_loop' );
					wc_get_template_part( 'content', 'product' );
				}
			}

			woocommerce_product_loop_end();
			do_action( 'woocommerce_after_shop_loop' );
		} else {
			do_action( 'woocommerce_no_products_found' );
		}

		do_action( 'woocommerce_after_main_content' );
		?>
	</div>
</main>
<?php
get_footer( 'shop' );
