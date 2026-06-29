<?php
/**
 * Merkpagina – introductietekst.
 *
 * @package De_Kaasgenoten
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$brand = isset( $args['brand'] ) ? $args['brand'] : array();
$lead  = ! empty( $brand['lead'] ) ? $brand['lead'] : '';

if ( ! $lead ) {
	return;
}
?>
<section class="dkg-brand-lead">
	<div class="dkg-container">
		<p><?php echo esc_html( $lead ); ?></p>
	</div>
</section>
