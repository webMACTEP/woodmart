<?php

/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.4.0
 */

defined('ABSPATH') || exit; ?>

<div class="woocommerce cart-content-wrapper row">

	<?php do_action('woocommerce_before_cart'); ?>

	<form class="woocommerce-cart-form cart-data-form col-12 col-lg-8 col-xl-8" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
		<div class="cart-table-section">

			<?php do_action('woocommerce_before_cart_table'); ?>

			<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
				<thead>
					<tr>

						<th class="product-thumbnail">&nbsp;</th>
						<th class="product-name "><?php esc_html_e('Product', 'woocommerce'); ?></th>
						<th class="product-price">111<?php esc_html_e('Цена ', 'woocommerce'); ?></th>
						<th class="product-quantity"><?php esc_html_e('Скидка', 'woocommerce'); ?></th>
						<th class="product-subtotal"><?php esc_html_e('Итого', 'woocommerce'); ?></th>
						<th class="product-remove">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<?php do_action('woocommerce_before_cart_contents'); ?>

					<?php
					foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
						$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
						$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

						if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
							$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
					?>

							<tr class="woocommerce-cart-form__cart-item nowrap <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">



								<td class="product-thumbnail">
									<?php
									if (!$product_permalink) {
										echo apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
									} else {
										printf('<a href="%s">%s</a>', esc_url($product_permalink), apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key));
									}
									?>
								</td>

								<td class="product-name block" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
									<?php
									if (!$product_permalink) {
										echo wp_kses_post(apply_filters('woocommerce_cart_item_name', esc_html($_product->get_name()), $cart_item, $cart_item_key) . '&nbsp;');
									} else {
										echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), esc_html($_product->get_name())), $cart_item, $cart_item_key));
									}

									do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

									// Meta data
									echo wc_get_formatted_cart_item_data($cart_item);

									// Backorder notification
									if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
										echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
									}
									?>
								</td>



								<td class="product-price" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
									<b>
										<?php
										// echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
										echo get_cart_product_price($_product);
										?>
									</b>
								</td>

								<td class="product-quantity c-red" data-title="<?php esc_attr_e('Скидка', 'woocommerce'); ?>">
									<b class="uppp">
										<span class="down"><?php
																	// if ( $_product->is_sold_individually() ) {
																	// 	$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
																	// } else {
																	// 	$product_quantity = woocommerce_quantity_input( array(
																	// 		'input_name'  => "cart[{$cart_item_key}][qty]",
																	// 		'input_value' => $cart_item['quantity'],
																	// 		'max_value'   => $_product->get_max_purchase_quantity(),
																	// 		'min_value'   => '0',
																	// 		'product_name'  => $_product->get_name(),
																	// 	), $_product, false );
																	// }
																	// echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );

																	echo get_cart_discount($_product);
																	?></span>

									</b>
								</td>

								<td class="product-subtotal" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
									<?php
									echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key);
									?>
								</td>
								<td class="product-remove">
									<?php
									echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										'woocommerce_cart_item_remove_link',
										sprintf(
											'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
											esc_url(wc_get_cart_remove_url($cart_item_key)),
											esc_html__('Remove this item', 'woocommerce'),
											esc_attr($product_id),
											esc_attr($_product->get_sku())
										),
										$cart_item_key
									);
									?>
								</td>
							</tr>
							<tr class="minnone">

							</tr>
					<?php
						}
					}
					?>

					<?php do_action('woocommerce_cart_contents'); ?>

					<?php do_action('woocommerce_after_cart_contents'); ?>
				</tbody>
			</table>

			<div class="row cart-actions">
				<div class="col-12 order-last order-md-first col-md">

					<?php if (wc_coupons_enabled()) { ?>
						<div onclick="document.getElementById('open').classList.add('active');document.getElementById('opened').classList.add('active')" class="coupon">
							<div id="open" class="open">
								<img src="/wp-content/themes/woodmart/images/coupon.svg" alt=""><span class="span">Ввести купон</span>
							</div>
							<div id="opened" class="opened ">
								<label for="coupon_code"><?php esc_html_e('Coupon:', 'woocommerce'); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>"><?php esc_attr_e('Применить', 'woocommerce'); ?></button>
								<?php do_action('woocommerce_cart_coupon'); ?>
							</div>


						</div>
					<?php } ?>

				</div>
				<div class="col-12 order-first order-md-last col-md-auto">

					<button type="submit" class="button" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>"><?php esc_html_e('Update cart', 'woocommerce'); ?></button>


					<?php do_action('woocommerce_cart_actions'); ?>

					<?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
				</div>
			</div>
		</div>
	</form>

	<div class="cart-totals-section col-12 col-lg-4 col-xl-4 cart-collaterals">
		<?php woocommerce_cart_totals(); ?>
	</div>

</div>

<?php do_action('woocommerce_after_cart_table'); ?>



<div class="cart-collaterals">

	<?php
	/**
	 * Cart collaterals hook.
	 *
	 * @hooked woocommerce_cross_sell_display
	 * @hooked woocommerce_cart_totals - 10
	 */
	do_action('woocommerce_cart_collaterals');
	?>

</div>

<?php do_action('woocommerce_after_cart'); ?>