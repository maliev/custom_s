<?php
// Register a text-img block.
acf_register_block_type( [
	'name'            => 'text-img',
	'title'           => __( 'Text-Image/Image-Text' ),
	'description'     => __( 'A custom block: text-img/img-text.' ),
	'render_template' => 'template-parts/blocks/text-img.php',
	'mode'            => 'edit',
	'align'           => 'full',
	'category'        => 'custom-blocks',
	'icon'            => 'align-right',
	'keywords'        => [ 'Text-Bild', 'text-img' ],
	'example'         => [
		'attributes' => [
			'mode' => 'preview',
			'data' => [
				'_is_preview' => 'true',
			],
		],
	],
] );

