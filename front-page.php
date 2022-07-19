<?php

/**
 * The template for displaying home page
 *
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

?>
	<!--== Start: Event Section Wrapper ==-->
	<div class="event-section section section-padding">
		<div class="container">
			<!--== Start: Section Title ==-->
			<div class="section-title center mt-n3">
				<div class="story-wrap">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/story.png" alt="Stories" />
				</div>
				<h2 class="title"><?php _e('Stories & Documentaries','yellow'); ?></h2>
				<?php _e('Lorem Ipsum is simply dummy text of the printing and typesetting industry page when looking','yellow'); ?>
			</div>
			<!--== End: Section Title ==-->

			<div class="row mb-n6">
				<?php archiveLongArticles::render('post',31,1, 'left'); ?>
				<?php archiveLongArticles::render('post',33,1, 'right'); ?>
			</div>
		</div>
	</div>
	<!--== End: Event Section Wrapper ==-->

	<!--== Start: News Post Section Wrapper ==-->
	<div class="blog-post-section section section-padding pt-0">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 text-center text-sm-start">
					<!--== Start: Section Title ==-->
					<div class="ylabel"><?php _e('QUICK UPDATES','yellow'); ?></div>
					<div class="section-title mt-n1">
						<h2 class="title mb-n3"><?php _e('Short Daily Updates','yellow'); ?></h2>
					</div>
					<!--== End: Section Title ==-->
				</div>
			</div>
			<?php archiveQuickUpdates::render('post',25,3); ?>
		</div>
	</div>
	<!--== End: News Post Section Wrapper ==-->
<?php
get_footer();
