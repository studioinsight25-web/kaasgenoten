<?php
/**
 * Thank you page.
 *
 * @package De_Kaasgenoten
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order dkg-thankyou">

	<?php if ( $order ) : ?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Helaas kon uw betaling niet worden verwerkt. Probeer het opnieuw of kies een andere betaalmethode.', 'de-kaasgenoten' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Opnieuw betalen', 'de-kaasgenoten' ); ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'Mijn account', 'de-kaasgenoten' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>

			<div class="dkg-thankyou__hero">
				<p class="dkg-eyebrow"><?php esc_html_e( 'Bedankt voor uw bestelling', 'de-kaasgenoten' ); ?></p>
				<h2><?php esc_html_e( 'We gaan voor u aan de slag', 'de-kaasgenoten' ); ?></h2>
				<p><?php esc_html_e( 'U ontvangt een bevestiging per e-mail. Uw bestelling wordt met zorg verpakt en gekoeld verzonden.', 'de-kaasgenoten' ); ?></p>
			</div>

			<?php wc_get_template( 'checkout/order-received.php', array( 'order' => $order ) ); ?>

			<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details dkg-thankyou__details">

				<li class="woocommerce-order-overview__order order">
					<?php esc_html_e( 'Bestelnummer:', 'de-kaasgenoten' ); ?>
					<strong><?php echo esc_html( $order->get_order_number() ); ?></strong>
				</li>

				<li class="woocommerce-order-overview__date date">
					<?php esc_html_e( 'Datum:', 'de-kaasgenoten' ); ?>
					<strong><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></strong>
				</li>

				<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
					<li class="woocommerce-order-overview__email email">
						<?php esc_html_e( 'E-mail:', 'de-kaasgenoten' ); ?>
						<strong><?php echo esc_html( $order->get_billing_email() ); ?></strong>
					</li>
				<?php endif; ?>

				<li class="woocommerce-order-overview__total total">
					<?php esc_html_e( 'Totaal:', 'de-kaasgenoten' ); ?>
					<strong><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></strong>
				</li>

				<?php if ( $order->get_payment_method_title() ) : ?>
					<li class="woocommerce-order-overview__payment-method method">
						<?php esc_html_e( 'Betaalmethode:', 'de-kaasgenoten' ); ?>
						<strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
					</li>
				<?php endif; ?>

			</ul>

			<ol class="dkg-thankyou__steps">
				<li><?php esc_html_e( 'U ontvangt een orderbevestiging per e-mail.', 'de-kaasgenoten' ); ?></li>
				<li><?php esc_html_e( 'Wij pakken uw bestelling vers en gekoeld in.', 'de-kaasgenoten' ); ?></li>
				<li><?php esc_html_e( 'De koerier levert uw pakket bij u thuis af.', 'de-kaasgenoten' ); ?></li>
			</ol>

		<?php endif; ?>

		<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
		<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

	<?php else : ?>

		<?php wc_get_template( 'checkout/order-received.php', array( 'order' => false ) ); ?>

	<?php endif; ?>

</div>
