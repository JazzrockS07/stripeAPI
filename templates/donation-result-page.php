<?php

/**
 * Template Name: Donation Result
 *
 * Template for displaying a success or cancel donation page.
 *
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$stripe = new \Stripe\StripeClient('sk_live_...');

if (isset($_GET['id'])) {

	$id = $_GET['id'];

	$paymentid = get_field( 'paymentid',$id);

	$checkout_session = $stripe->checkout->sessions->retrieve($paymentid);

	if (!empty($checkout_session->payment_status) || $checkout_session->payment_status == 'paid') {
		update_field( 'result', 'success', $id);
		$ammount = $checkout_session->amount_total / 100;
		$currency = $checkout_session->currency;
		update_field('amount_from_billing', $ammount, $id);
		update_field('currency_from_billing', $currency, $id);
	} else {
		update_field( 'result', 'error', $id);
	}

	if (!empty($checkout_session->subscription)) {
		$subscriptionid = $checkout_session->subscription;
		update_field('subscriptionid', $subscriptionid, $id);
	}
}


get_header();

while (have_posts()) {
	the_post();
	the_content();
}

get_footer();
