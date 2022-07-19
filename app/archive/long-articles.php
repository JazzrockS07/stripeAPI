<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	return;
}

class archiveLongArticles extends App {

	/**
	 * Method card_blog
	 *
	 * @param int $post_id [explicite description]
	 *
	 * @return HTML
	 */
	public static function card_blog(int $post_id = \null, string $image_location = 'left') {
		if ($image_location == 'left') {
			$image_location_class = 'mb-4';
		} else {
			$image_location_class = 'alt';
		}
		?>
		<div class="event-item <?php echo $image_location_class ?>">
			<?= singleLongArticles::featured_image($post_id,'featured-image',true); ?>
			<div class="content">
				<div class="details">
					<div class="ylabel sm"><?php singleLongArticles::category($post_id)?></div>
					<?php singleLongArticles::title($post_id, 3, true); ?>
					<?php singleLongArticles::excerpt($post_id); ?>
					<div>
						<span class="date">
									<span class="text-gray"><?php _e('Date','yellow'); ?>:</span> <?php singleLongArticles::date($post_id); ?>
						</span>
						<span class="date"><span class="text-gray"><?php _e('Comment','yellow'); ?>:</span> 8,962</span>
						<span class="date"><span class="text-gray"><?php _e('Likes','yellow'); ?>:</span> 78K</span>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	public static function listing(string $post_type = 'post', int $term_id = \null, int $posts_per_page = 9, string $image_location = 'left') {
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
				<?php while($qry->have_posts()): $qry->the_post(); ?>
					<!--== Start: Event Title ==-->
					<div class="col-12 mb-6">
						<?= self::card_blog(get_the_ID(), $image_location) ?>
					</div>
					<!--== End: Event Title ==-->
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
		<?php
		endif;
	}

	public static function render(string $post_type = 'post', int $term_id = \null, int $posts_per_page = 9, string $image_location = 'left' ) {
		self::listing($post_type,$term_id,$posts_per_page, $image_location);
	}

}