<?php
/**
 * Merkpagina – hint zonder actief filter.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$brand = isset( $args['brand'] ) ? $args['brand'] : array();
$hint  = ! empty( $brand['hint'] ) ? $brand['hint'] : __( 'Kies hierboven een filter om het assortiment te bekijken.', 'de-kaasgenoten' );
?>
<section class="dkg-brand-hint">
	<div class="dkg-container">
		<p><?php echo esc_html( $hint ); ?></p>
	</div>
</section>
