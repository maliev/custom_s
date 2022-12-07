<?php
// Register a gallery block.
acf_register_block_type( [
	'name'            => 'gallery',
	'title'           => __( 'Gallery' ),
	'description'     => __( 'A custom block: gallery.' ),
	'render_template' => 'template-parts/blocks/gallery.php',
	'mode'            => 'edit',
	'align'           => 'full',
	'category'        => 'custom-blocks',
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
] );


