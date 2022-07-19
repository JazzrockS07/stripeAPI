<?php

/**
 * The template for displaying the footer
 * Contains the closing of the #content div and all content after
 *
 * @package mbase
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>

<?php customFooter::render(); ?>

<?php wp_footer(); ?>

</body>
</html>
