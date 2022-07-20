<?php
include("../../../../wp-load.php");

$stripe = new \Stripe\StripeClient('sk_live_...');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'https://' . $_SERVER['SERVER_NAME'];

if ($_POST['donation-value-custom'] != '') {
	$donation_amount = $_POST['donation-value-custom'];
} else {
	$donation_amount = $_POST['donation-value'];
}

$payment_platform = 'stripe';

$payment_name = (isset($_POST['donor-name'])) ? $_POST['donor-name'] : 'anonymous';

$payment_phone = (isset($_POST['donor-phone'])) ? $_POST['donor-phone'] : '';

$payment_address = (isset($_POST['donor-address'])) ? $_POST['donor-address'] : '';

$payment_message = (isset($_POST['donor-message'])) ? $_POST['donor-message'] : '';

$anonymous = (isset($_POST['anonymous'])) ? $_POST['anonymous'] : 'no';

$payment_amount_from_form = $donation_amount;

$payment_currency_from_form = (isset($_POST['currency'])) ? $_POST['currency'] : '';

if(isset($_POST['subscription']) && $_POST['subscription'] == 'to-subscription') {

	$payment_mode = 'subscription';

	$my_post = array(
		'post_title' => wp_strip_all_tags( $payment_name . ' donation' ),
		'post_status' => 'publish',
		'post_type' => 'subscription_info',
	);

	$post_id = wp_insert_post($my_post);

	update_field( 'platform',$payment_platform , $post_id);

	update_field( 'donor_name', $payment_name, $post_id);

	update_field( 'phone', $payment_phone, $post_id);

	update_field( 'address', $payment_address, $post_id);

	update_field( 'message', $payment_message, $post_id);

	update_field( 'anonymous', $anonymous, $post_id);

	update_field( 'amount_from_form', $payment_amount_from_form, $post_id);

	update_field( 'currency_from_form', $payment_currency_from_form, $post_id);

	if ($payment_currency_from_form == 'uah' ) {
		$price = 'price_...';
	} elseif ($payment_currency_from_form == 'ron') {
		$price = 'price_...';
	} else {
		$price = 'price_...';
	}

	$request = [
		'line_items' => [[
			'price' => $price,
			'quantity' => $donation_amount,
		]],
		'metadata' => [
			'donor_name' => $payment_name,
			'donor_address' => $payment_address,
			'donor_phone' => $payment_phone,
			'donor_message' => $payment_message
		],
		'mode' => $payment_mode,
		'success_url' => $YOUR_DOMAIN . '/success-donation/?id=' .$post_id,
		'cancel_url' => $YOUR_DOMAIN . '/cancel_donation/?id=' .$post_id,
	];
	if (isset($_POST['donor-email'])&&($_POST['donor-email'] != '')) {
		$payment_email = $_POST['donor-email'];
		$request['customer_email'] = $payment_email;
	}

} else {

	$payment_mode = 'payment';

	$my_post = array(
		'post_title' => wp_strip_all_tags( $payment_name . ' donation' ),
		'post_status' => 'publish',
		'post_type' => 'payments',
	);

	$post_id = wp_insert_post($my_post);

	update_field( 'platform',$payment_platform , $post_id);

	update_field( 'donor_name', $payment_name, $post_id);

	update_field( 'phone', $payment_phone, $post_id);

	update_field( 'address', $payment_address, $post_id);

	update_field( 'message', $payment_message, $post_id);

	update_field( 'anonymous', $anonymous, $post_id);

	update_field( 'amount_from_form', $payment_amount_from_form, $post_id);

	update_field( 'currency_from_form', $payment_currency_from_form, $post_id);

	$request = [
		'line_items' => [[
			'price_data' => [
				'currency' => $payment_currency_from_form,
				'product_data' => [
					'name' => 'Donate',
				],
				'unit_amount' => number_format($donation_amount ?? 0, 2, '.', '') * 100,
			],
			'quantity' => 1,
		]],
		'metadata' => [
			'donor_name' => $payment_name,
			'donor_address' => $payment_address,
			'donor_phone' => $payment_phone,
			'donor_message' => $payment_message
		],
		'mode' => $payment_mode,
		'success_url' => $YOUR_DOMAIN . '/success-donation/?id=' .$post_id,
		'cancel_url' => $YOUR_DOMAIN . '/cancel_donation/?id=' .$post_id,
	];
	if (isset($_POST['donor-email'])&&($_POST['donor-email'] != '')) {
		$payment_email = $_POST['donor-email'];
		$request['customer_email'] = $payment_email;
		update_field( 'email', $payment_email, $post_id);
	}
}

$checkout_session = $stripe->checkout->sessions->create($request);

$paymentid = $checkout_session->id;

update_field( 'paymentid',$paymentid , $post_id);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);





