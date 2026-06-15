<?php
/**
 * Single product template.
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

		while ( have_posts() ) :
			the_post();
			wc_get_template_part( 'content', 'single-product' );
		endwhile;

		do_action( 'woocommerce_after_main_content' );
		?>
	</div>
</main>
<?php
get_footer( 'shop' );
