<?php
include("../../../../wp-load.php");

\Stripe\Stripe::setApiKey('sk_live_...');

$endpoint_secret = 'whsec_...';

$payload = @file_get_contents('php://input');

$event = null;

try {
	$event = \Stripe\Event::constructFrom(
		json_decode($payload, true)
	);
} catch(\UnexpectedValueException $e) {
	// Invalid payload
	echo '⚠️  Webhook error while parsing basic request.';
	http_response_code(400);
	exit();
}
if ($endpoint_secret) {
	// Only verify the event if there is an endpoint secret defined
	// Otherwise use the basic decoded event
	$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
	try {
		$event = \Stripe\Webhook::constructEvent(
			$payload, $sig_header, $endpoint_secret
		);
	} catch(\Stripe\Exception\SignatureVerificationException $e) {
		// Invalid signature
		echo '⚠️  Webhook error while validating signature.';
		http_response_code(400);
		exit();
	}
}

if (isset($event->data->object->subscription) && ($event->data->object->billing_reason != 'subscription_create')) {

	$subscriptionid = $event->data->object->subscription;
	$invoiceid = $event->data->object->id;

	$my_subscription = get_posts( array(
		'post_type' => 'subscription_info',
		'posts_per_page' => -1,
		'meta_query' => array(
			array(
				'key' => 'subscriptionid', // name of custom field
				'value' => $subscriptionid,
			)
		)
	) );

	$count_subscriptionid = count($my_subscription);

	$invoice_isset = get_posts( array(
		'post_type' => 'subscription_payment',
		'posts_per_page' => -1,
		'meta_query' => array(
			array(
				'key' => 'invoiceid', // name of custom field
				'value' => $invoiceid,
			)
		)
	) );

	$count_invoiceid = count($invoice_isset);

	if($count_subscriptionid > 0 && $count_invoiceid < 1) {
		$payment_platform = 'stripe';
		$payment_name = $event->data->object->customer_name;
		$payment_amount = $event->data->object->amount_paid;
		$payment_currency = $event->data->object->currency;
		$payment_email = $event->data->object->customer_email;
		// Handle the event
		switch ($event->type) {
			case 'invoice.paid':
				if (!isset($post_id)) {
					$my_post = array(
						'post_title' => wp_strip_all_tags('Subscription payment from ' . $payment_name),
						'post_status' => 'publish',
						'post_type' => 'subscription_payment',
					);
					$post_id = wp_insert_post($my_post);
					update_field( 'platform',$payment_platform , $post_id);
					update_field( 'name_from_billing', $payment_name, $post_id);
					update_field( 'email_from_billing', $payment_email, $post_id);
					update_field( 'result', 'success', $post_id);
					update_field('amount_from_billing', $payment_amount / 100, $post_id);
					update_field('currency_from_billing', $payment_currency, $post_id);
					update_field('subscriptionid', $subscriptionid, $post_id);
					update_field('invoiceid', $invoiceid, $post_id);
					update_field('count_subscriptionid', $count_subscriptionid, $post_id);
					update_field('count_invoiceid', $count_invoiceid, $post_id);
				}
				break;
			case 'invoice.payment_failed':
				if (!isset($post_id)) {
					$my_post = array(
						'post_title' => wp_strip_all_tags('Subscription payment from ' . $payment_name),
						'post_status' => 'publish',
						'post_type' => 'subscription_payment',
					);
					$post_id = wp_insert_post($my_post);
					update_field( 'platform',$payment_platform , $post_id);
					update_field( 'name_from_billing', $payment_name, $post_id);
					update_field( 'email_from_billing', $payment_email, $post_id);
					update_field( 'result', 'error', $post_id);
					update_field('amount_from_billing', $payment_amount / 100, $post_id);
					update_field('currency_from_billing', $payment_currency, $post_id);
					update_field('subscriptionid', $subscriptionid, $post_id);
					update_field('invoiceid', $invoiceid, $post_id);
					update_field('count_subscriptionid', $count_subscriptionid, $post_id);
					update_field('count_invoiceid', $count_invoiceid, $post_id);
				}
				break;
			default:
				// Unexpected event type
				error_log('Received unknown event type');
		}
	}
}


http_response_code(200);