<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	return;
}

class archiveQuickUpdates extends App {

	/**
	 * Method card_blog
	 *
	 * @param int $post_id [explicite description]
	 *
	 * @return HTML
	 */
	public static function card_blog(int $post_id = \null) {
		?>
		<div class="post-item post3-item-style">
			<?= singleQuickUpdates::featured_image($post_id,'featured-image',true); ?>
			<div class="content">
				<h4 class="title">
					<?php
					singleQuickUpdates::title($post_id, 3, true);
					?>
				</h4>
			</div>
		</div>
		<!--== End: News Post Item ==-->
		<?php
	}

	public static function listing(string $post_type = 'post', int $term_id = \null, int $posts_per_page = 9) {
		$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
		$args = [
			'post_type' => $post_type,
			'posts_per_page' => $posts_per_page,
			'paged' => $paged,
		];
		if($term_id) {
			$args['tax_query'] = [
				'relation' => 'AND',
				[
					'taxonomy' => 'category',
					'field' => 'id',
					'terms' => $term_id,
					'operator' => 'IN'
				]
			];
		}
		$qry = new WP_Query($args);

		if($qry->have_posts()):
			?>
			<div class="row row-gutter-60 mb-n6">
						<?php while($qry->have_posts()): $qry->the_post(); ?>
							<div class="col-md-6 col-xl-4 mb-6">
								<!--== Start: News Post Item ==--><?= self::card_blog(get_the_ID()) ?>
							</div>
							<!--== End: News Post Item ==-->
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
			</div>
		<?php
		endif;
	}

	public static function render(string $post_type = 'post', int $term_id = \null, int $posts_per_page = 9) {
		self::listing($post_type,$term_id,$posts_per_page);
	}

}