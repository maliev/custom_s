<?php
acf_register_block_type( [
	'name'            => 'posts',
	'title'           => __( 'Posts' ),
	'description'     => __( 'A custom block: posts.' ),
	'render_template' => 'template-parts/blocks/posts.php',
	'mode'            => 'edit',
	'align'           => 'full',
	'category'        => 'content',
	'icon'            => 'admin-post',
	'keywords'        => [ 'Posts', 'query' ],
	'example'         => [
		'attributes' => [
			'mode' => 'preview',
			'data' => [
				'_is_preview' => 'true',
			],
		],
	],
	'supports'        => [
		'multiple' => false,
		'align'    => [ 'full' ],
		'color'    => [
			'background' => false,
			'gradients'  => false,
			'posts'      => true,
		],
	],
	'enqueue_assets'  => function () {
		if ( ! is_admin() ) {
			wp_enqueue_script( 'customs-posts-js', filePath( 'posts.min.js' ), [], fileTimeVersion( 'posts.min.js' ), true );
		}
	},
] );
