<div class="menuwrap">

	<?php

	if ($post->post_parent) {
		$parent = wp_list_pages(array(
			'title_li' => '',
			'include' => $post->post_parent,
			'echo'     => 0
		));
		$children = wp_list_pages(array(
			'title_li' => '',
			'child_of' => $post->post_parent,
			'echo'     => 0
		));
	} else {
		$parent = wp_list_pages(array(
			'title_li' => '',
			'include' => $post->ID,
			'echo'     => 0
		));
		$children = wp_list_pages(array(
			'title_li' => '',
			'child_of' => $post->ID,
			'echo'     => 0
		));
	}

	if ($children) : ?>
		<ul class="menu">
			<?php echo $parent; ?>
			<?php echo $children; ?>
		</ul>
	<?php endif; ?>

	<div class="bg-grey px-4 pb-4 mt-4 widget sidebar-recent-posts recent-posts">
		<div class="styled-heading">
			<h2 class=" text-dark h-decoration mt-4">Recent Posts</h2>
		</div>
		<?php echo do_shortcode('[latest-posts]') ?>
	</div>


	<div class="slick-sidebar mt-4">
		<?php echo do_shortcode('[testimonials expand="carousel"]') ?>
	</div>

</div>