# stripeAPI
connection API Stripe to wordpress without any plugins

1. Connect the Stripe API to the WordPress theme using composer

2. Send the payment form data to stripe/payment-handler.php

3. After a successful payment, the page /success-donation/ is displayed, if unsuccessful, then the page /cancel_donation/. These pages use one template /templates/donation-result-page.php

4. For recurring payments, webhooks from the Stripe admin panel and the /stripe/payment-status.php file are used

5. Payment data is stored in wordpress database with custom post type and ACF
