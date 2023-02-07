<?php

defined('ABSPATH') || exit;

?>
<div class="cart_totals <?php echo (WC()->customer->has_calculated_shipping()) ? 'calculated_shipping' : ''; ?>">

	<?php do_action('woocommerce_before_cart_totals'); ?>

	<h2 class="h2cart"><?php esc_html_e('Ваш заказ', 'woocommerce'); ?></h2>
	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'single-post-thumbnail' );?>

    <img src="<?php  echo $image[0]; ?>" data-id="<?php echo $loop->post->ID; ?>">
	<table cellspacing="0" class="shop_table shop_table_responsive">

		<tr class="cart-subtotal">

			<th><?php esc_html_e('Сумма заказа', 'woocommerce'); ?></th>
			
			<td data-title="<?php esc_attr_e('Сумма заказа', 'woocommerce'); ?>" data-test="">
				
				

				

				<?php wc_cart_totals_subtotal_html(); ?></td>
		</tr>


		<?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
			<tr class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
				<th><?php wc_cart_totals_coupon_label($coupon); ?></th>
				<td data-title="<?php echo esc_attr(wc_cart_totals_coupon_label($coupon, false)); ?>"><?php wc_cart_totals_coupon_html($coupon); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>

			<?php do_action('woocommerce_cart_totals_before_shipping'); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action('woocommerce_cart_totals_after_shipping'); ?>

		<?php elseif (WC()->cart->needs_shipping() && 'yes' === get_option('woocommerce_enable_shipping_calc')) : ?>

			<tr class="shipping">
				<th><?php esc_html_e('Shipping', 'woocommerce'); ?></th>
				<td data-title="<?php esc_attr_e('Shipping', 'woocommerce'); ?>"><?php woocommerce_shipping_calculator(); ?></td>
			</tr>

		<?php endif; ?>

		<?php foreach (WC()->cart->get_fees() as $fee) : ?>
			<tr class="fee">
				<th><?php echo esc_html($fee->name); ?></th>
				<td data-title="<?php echo esc_attr($fee->name); ?>"><?php wc_cart_totals_fee_html($fee); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php
		if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) {
			$taxable_address = WC()->customer->get_taxable_address();
			$estimated_text  = '';

			if (WC()->customer->is_customer_outside_base() && !WC()->customer->has_calculated_shipping()) {
				/* translators: %s location. */
				$estimated_text = sprintf(' <small>' . esc_html__('(estimated for %s)', 'woocommerce') . '</small>', WC()->countries->estimated_for_prefix($taxable_address[0]) . WC()->countries->countries[$taxable_address[0]]);
			}

			if ('itemized' === get_option('woocommerce_tax_total_display')) {
				foreach (WC()->cart->get_tax_totals() as $code => $tax) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		?>
					<tr class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
						<th><?php echo esc_html($tax->label) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
							?></th>
						<td data-title="<?php echo esc_attr($tax->label); ?>"><?php echo wp_kses_post($tax->formatted_amount); ?></td>
					</tr>
				<?php
				}
			} else {
				?>
				<tr class="tax-total">
					<th><?php echo esc_html(WC()->countries->tax_or_vat()) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
						?></th>
					<td data-title="<?php echo esc_attr(WC()->countries->tax_or_vat()); ?>"><?php wc_cart_totals_taxes_total_html(); ?></td>
				</tr>
		<?php
			}
		}
		?>

		<?php do_action('woocommerce_cart_totals_before_order_total'); ?>

		<tr class="order-total">
			<th><?php esc_html_e('Total', 'woocommerce'); ?></th>
			<td data-title="<?php esc_attr_e('Total', 'woocommerce'); ?>"><?php wc_cart_totals_order_total_html(); ?></td>
		</tr>

		<?php do_action('woocommerce_cart_totals_after_order_total'); ?>

	</table>
	<div class="cdek">
		<svg width="84" height="40" viewBox="0 0 84 40" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M13.472 26.9213H9.84372C4.18425 26.9213 8.29588 15.0061 13.0606 15.0061H18.793C19.7119 15.0061 21.3324 15.1737 22.1307 12.9203L23.3643 9.41995H15.5035C11.2466 9.41995 7.93302 10.9062 5.53861 13.3999C1.40254 17.6673 -1.45141e-05 24.3322 0.991485 27.5205C1.93479 30.4696 4.49857 32.4113 8.51346 32.4592L11.6336 32.4834H15.4794L16.4227 29.6784C17.124 27.6884 15.5517 26.9213 13.472 26.9213ZM57.6364 21.9827L58.8217 18.1706H46.1722C44.068 18.1706 43.1247 18.746 42.7619 19.9448L41.5765 23.7568H54.2264C56.3306 23.7568 57.2739 23.1814 57.6364 21.9827ZM39.6903 28.6955L38.505 32.5071H51.1545C53.2346 32.5071 54.202 31.9321 54.5648 30.7333L55.7502 26.9213H43.1003C41.0205 26.9213 40.0772 27.4967 39.6903 28.6955ZM60.5875 13.2558L61.7725 9.44408H49.123C47.0188 9.44408 46.0755 10.0191 45.7126 11.2179L44.5273 15.0299H57.1772C59.2573 15.0299 60.2002 14.4545 60.5875 13.2558ZM41.4798 14.0232C40.9479 10.4749 39.0372 9.44408 34.3933 9.44408H25.9281L20.994 23.7568H24.1141C25.9762 23.7568 26.9196 23.7806 27.9114 21.1435L29.967 15.0061H33.1113C35.7962 15.0061 35.1913 18.3385 33.837 21.5748C32.6276 24.428 30.5234 26.9451 27.9837 26.9451H22.7353C20.6311 26.9451 19.6637 27.5205 19.2767 28.7193L17.9706 32.5313H21.8161L25.5893 32.5071C28.927 32.4834 31.6602 32.2437 34.8529 29.3905C38.2388 26.3459 42.1573 18.5302 41.4798 14.0232ZM84 9.41995H76.6715L69.7782 16.684C68.9801 17.5232 68.1577 18.3623 67.3597 19.3452H67.287L70.7215 9.41995H64.7473L56.6935 32.5071H62.6673L65.231 25.2431L67.8916 23.0135L69.9961 29.5825C70.6488 31.6204 71.3264 32.5071 72.7775 32.5071H77.3487L72.6566 19.609L84 9.41995Z" fill="#00B33C" />
		</svg>

		<div class="right">
			<span>Бесплатная доставка в случае покупки товара</span>
			<small>Доставка в случае отказа <span>1 500 руб.</span> </small>
		</div>
	</div>
	<div class="wc-proceed-to-checkout">
		<?php do_action('woocommerce_proceed_to_checkout'); ?>
	</div>

	<?php do_action('woocommerce_after_cart_totals'); ?>

</div>