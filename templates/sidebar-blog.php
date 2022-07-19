<div class="menuwrap position-sticky" style="top: 10px">

   <?php


   $categories = wp_list_categories(array(
      'title_li' => '',
      'echo'     => 0
   ));

   if ($categories) : ?>
      <ul class="menu">
         <?php echo $categories; ?>
      </ul>
   <?php endif; ?>

   <div class="bg-grey px-4 pb-4 mt-5 widget sidebar-recent-posts recent-posts">
      <div class="styled-heading">
         <h2 class=" text-dark h-decoration mt-4">Recent Posts</h2>
      </div>
      <?php echo do_shortcode('[latest-posts]') ?>
   </div>

   <div class="slick-sidebar mt-4">
      <?php echo do_shortcode('[testimonials expand="carousel"]') ?>
   </div>
</div>