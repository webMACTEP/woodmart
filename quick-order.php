<?php

function quick_order($product_id, $name, $phone, $size) {

	global $woocommerce;

	$temp_text = 'Быстрый заказ';
	$quantity = 1;
	$args = array( 
		'variation' => array( 'pa_size' => $size),
	); 

	$address = array(
	  'first_name' => $name,
	  'last_name'  => 'Фамилия',
	  'email'      => 'test@test.ru',
	  'phone'      => $phone,
	  'address_1'  => 'Адрес',
	  'city'       => 'Город',
	  'country'    => 'RU'
	);

	// Now we create the order
	$order = wc_create_order(array('status' => 'pending'));

	// The add_product() function below is located in /plugins/woocommerce/includes/abstracts/abstract_wc_order.php
	$order->add_product( get_product($product_id), $quantity, $args); // This is an existing SIMPLE 
	$order->set_address( $address, 'billing' );
	$order->calculate_totals();
	$order->update_status("processing", 'Imported order', TRUE);

	// Get the WC_Email_New_Order object
	$email_new_order = WC()->mailer()->get_emails()['WC_Email_New_Order'];

	// Sending the new Order email notification for an $order_id (order ID)
	$email_new_order->trigger( $order->get_id() );
}

global $product;

if (isset($_POST['billing_first_name']) && isset($_POST['billing_phone'])) {
	$name = $_POST['billing_first_name'];
	$phone = $_POST['billing_phone'];
	$size = $_POST['size'];
	quick_order($product->get_id(), $name, $phone, $size);
	echo 'Success';
}

?>