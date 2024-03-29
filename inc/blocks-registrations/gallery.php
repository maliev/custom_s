<?php
acf_register_block_type( [
	'name'            => 'gallery',
	'title'           => __( 'Gallery' ),
	'description'     => __( 'A custom block: gallery.' ),
	'render_template' => 'template-parts/blocks/gallery.php',
	'mode'            => 'edit',
	'align'           => 'full',
	'category'        => 'content',
	'icon'            => 'format-gallery',
	'keywords'        => [ 'Galerie', 'Slider', 'images', 'img' ],
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
			wp_enqueue_script( 'customs-gallery-js', filePath( 'gallery.min.js' ), [], fileTimeVersion( 'gallery.min.js' ), true );
		}
	},
] );


