<?php
function blog_posts_api( $request ): array {
	$allPosts = [];
	$postsQuery = get_posts(
		[
			'post_type'      => 'post',
			'posts_per_page' => - 1
		]
	);
	
	foreach ( $postsQuery as $post ) {
		$ID             = $post->ID;
		$attachmentIMG = wp_get_attachment_image(get_post_thumbnail_id($post->ID), 'm', '', ['class' => 'posts__img']);
		
		$allPosts[]   = (object) [
			'id'               => $ID,
			'slug'             => $post->post_name,
			'type'             => $post->post_type,
			'img' => $attachmentIMG,
			'title'            => $post->post_title,
			'url'              => get_permalink( $ID ),
			'date' => get_the_date('Y-m-d', $ID),
			'excerpt'          => mb_strimwidth( get_the_excerpt( $ID ), 0, 100, '...' ),
		];
	}
	
	return $allPosts;
}


add_action( 'rest_api_init', 'get_all_existing_posts' );
function get_all_existing_posts(): void {
	register_rest_route( 'blog-posts', '/all-posts', [
		'methods'  => 'GET',
		'callback' => 'blog_posts_api',
		'permission_callback' => '__return_true'
	] );
}
