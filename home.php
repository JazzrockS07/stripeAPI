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
      <h2 class="h-decoration h-center text-light mb-0">Our Elder Law, Estate Planning<br> and Elder Mediation blog</h2>
   </div>
</div>

<div class="container mt-5">
   <div class="row">


      <?php if (have_posts()) : while (have_posts()) : the_post();


            $tags = wp_get_post_tags(get_the_ID()); //this is the adjustment, all the rest is bhlarsen
            $num_of_tags = count($tags);
            $num_count = 0;
            $tagshtml = '<span class="post_tags">';
            foreach ($tags as $tag) {
               $tag_link = get_tag_link($tag->term_id);
               $num_count = $num_count + 1;
               $tagshtml .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
               $tagshtml .= $tag->name;
               if ($num_count < $num_of_tags) {
                  $tagshtml .= ', ';
               }
               $tagshtml .= '</a>';
            }
            $tagshtml .= '</span>';

      ?>




            <article class="column featured-news col-md-4 col-sm-6 col-xs-12">
               <div class="inner-box">
                  <figure class="image-box">
                     <?php if (has_post_thumbnail()) { ?>

                        <?php the_post_thumbnail('post-list-thumb', array('class' => 'w-100 img-fluid')) ?>

                     <?php  } else {
                        echo '<img class="w-100 img-fluid" src="' . get_template_directory_uri() . '/assets/images/placeholder.png" alt="Fara Poza">';
                     }
                     ?>
                     <a href="<?php the_permalink() ?>" class="default-overlay-outer">
                        <div class="inner">
                           <div class="content-layer">
                              <div class="link-icon"><i class="bi bi-link-45deg"></i></div>
                           </div>
                        </div>
                     </a>
                  </figure>
                  <div class="content">
                     <div class="date"><?php echo get_the_date('j') ?><br><?php echo get_the_date('M') ?></div>

                     <div class="tags" style=" white-space: nowrap;text-overflow: ellipsis;overflow:hidden"><i class="bi bi-tags-fill"></i>&ensp; Tags: <?php echo $tagshtml ?></div>
                     <h3><a class="text-primary" href="<?php the_permalink() ?>"><?php echo get_the_title(); ?></a></h3>
                     <div class="text">
                        <?php echo wp_trim_words(get_the_content(), 22, '...'); ?>
                     </div>
                     <a href="<?php the_permalink() ?>" class="theme-btn read-more">Read More</a>
                  </div>

               </div>
            </article>

         <?php endwhile; ?>
   </div>

   <?php if (function_exists('bootstrap_pagination')) {
            bootstrap_pagination();
         } else if (is_paged()) { ?>
      <ul class="pagination">
         <li class="page-item older">
            <?php next_posts_link('<i class="fas fa-arrow-left"></i> ' . __('Previous', 'b4st')) ?></li>
         <li class="page-item newer">
            <?php previous_posts_link(__('Next', 'b4st') . ' <i class="fas fa-arrow-right"></i>') ?></li>
      </ul>
   <?php } ?>

<?php
      else :
         wp_redirect(get_bloginfo('url') . '/404', 404);
         exit;
      endif;
?>

</div><!-- /.row -->
</div><!-- /.container -->
<?php

get_footer();
