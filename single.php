<?php

/**
 * The template for displaying all single posts
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

?>
<div class="breadcrumbs">
	<div class="breadcrumbs-caption">
		<h2 class="h-decoration h-center text-light mb-0">Blog</h2>
	</div>
</div>

<div class="container pt-6 pb-4">
	<div class="row justify-content-center">
		<div class="col-lg-8 blogpost">
			<?php if (has_post_thumbnail()) { ?>

				<?php the_post_thumbnail('medium-page-thumb', array('class' => 'w-100 img-fluid')) ?>

			<?php  } else {
			}
			?>
			<?php
			while (have_posts()) {
				the_post();
			?>

				<h1 class="h3 h-decoration mt-4"><?php the_title() ?></h1>

				<?php the_content() ?>
				<div class="blog-details">

					<div class="post-author mt-6">
						<h2 class="h4 text-dark h-decoration">About Author</h2>
						<div class="inner-box">


							<figure class="author-thumb"><img alt="" src="http://2.gravatar.com/avatar/?s=110&amp;d=mm&amp;r=g" srcset="http://2.gravatar.com/avatar/?s=220&amp;d=mm&amp;r=g 2x" class="avatar avatar-110 photo avatar-default" height="110" width="110"></figure>
							<h4>ALICE REITER FELD</h4>
							<p>Ms. Reiter Feld has been in private practice for over 30 years. During that time, she’s proven to be a determined fighter for the rights of senior citizens and family members when it comes to elder care options, and on the importance of engaging an elder law attorney to plan and execute a personalized strategy. Her primary areas of practice under the “Elder Law Umbrella” include long-term care needs planning, asset protection planning, estate planning, probate, Veteran’s Benefits, and Medicaid planning and assistance.</p>
							<br>
							<div class="social-links-one clearfix">
								<a href="#"><span class="fa fa-facebook-f"></span></a>
								<a href="#"><span class="fa fa-twitter"></span></a>
								<a href="#"><span class="fa fa-google-plus"></span></a>
								<a href="#"><span class="fa fa-linkedin"></span></a>
								<a href="#"><span class="fa fa-skype"></span></a>
							</div>
						</div>
					</div>
				</div>


			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if (comments_open() || get_comments_number()) {
					comments_template();
				}
			}
			?>
		</div>
		<div class="col-lg-3 sidebar">
			<?php
			get_template_part('templates/sidebar', 'blog');
			?>
		</div>
	</div>
</div>
<?php
get_footer();
