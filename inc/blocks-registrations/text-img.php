<?php
acf_register_block_type( [
	'name'            => 'text-img',
	'title'           => __( 'Text-Image/Image-Text' ),
	'description'     => __( 'A custom block: text-img/img-text.' ),
	'render_template' => 'template-parts/blocks/text-img.php',
	'mode'            => 'edit',
	'align'           => 'full',
	'category'        => 'content',
	'icon'            => 'align-right',
	'keywords'        => [ 'text-img' ],
	'example'         => [
		'attributes' => [
			'mode' => 'preview',
			'data' => [
				'_is_preview' => 'true',
			],
		],
	],
] );

