<?php
acf_register_block_type( [
	'name'            => 'hero-video',
	'title'           => __( 'Hero-Video' ),
	'description'     => __( 'A custom block: hero-video.' ),
	'render_template' => 'template-parts/blocks/hero-video.php',
	'mode'            => 'edit',
	'align'           => 'full',
	'category'        => 'header',
	'icon'            => 'superhero-alt',
	'keywords'        => [ 'Header', 'Hero', 'slider', 'img', 'top', 'gallery' ],
	'supports'        => [ 'multiple' => false ],
	'example'         => [
		'attributes' => [
			'mode' => 'preview',
			'data' => [
				'_is_preview' => 'true',
			],
		],
	],
	'enqueue_assets'  => function () {
		if ( ! is_admin() ) {
			wp_enqueue_script( 'customs-hero-video-js', filePath( 'hero-video.min.js' ), [], fileTimeVersion( 'hero-video.min.js' ), true );
		}
	},
] );

