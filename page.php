<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package UnderStrap
 */


// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
?>
<div class="breadcrumbs">
   <div class="breadcrumbs-caption">
      <h2 class="h-decoration-center h-center text-light mb-0"><?php echo get_the_title(get_the_ID()); ?> </h2>
   </div>
</div>

<?php
while (have_posts()) {
   the_post();
   the_content();
}


get_footer();
