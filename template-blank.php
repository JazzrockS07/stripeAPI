<?php

/**
 * Template Name: Blank Page Template
 *
 * Template for displaying a blank page.
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;


get_header();

while (have_posts()) {
   the_post();
   the_content();
}

get_footer();
