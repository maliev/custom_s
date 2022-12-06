<?php
// Register a img-full block.
acf_register_block_type( [
	'name'            => 'img-full',
	'title'           => __( 'Image (Full Size)' ),
	'description'     => __( 'A custom block: image (full size).' ),
	'render_template' => 'template-parts/blocks/img-full.php',
	'mode'            => 'edit',
	'align'           => 'full',
	'category'        => 'custom-blocks',
	'icon'            => 'format-image',
	'keywords'        => [ 'Bild (volle Breite)', 'img-full', 'Bild', 'img' ],
	'example'         => [
		'attributes' => [
			'mode' => 'preview',
			'data' => [
				'_is_preview' => 'true',
			],
		],
	],
] );


