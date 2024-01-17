<?php
acf_register_block_type( [
	'name'            => 'text',
	'title'           => __( 'Text' ),
	'description'     => __( 'A custom block: text.' ),
	'render_template' => 'template-parts/blocks/text.php',
	'mode'            => 'edit',
	'align'           => 'full',
	'category'        => 'content',
	'icon'            => 'text-page',
	'keywords'        => [ 'text', 'wysiwyg' ],
	'example'         => [
		'attributes' => [
			'mode' => 'preview',
			'data' => [
				'_is_preview' => 'true',
			],
		],
	],
	'supports'        => [
		'align' => [ 'full' ],
		'color' => [
			'background' => false,
			'gradients'  => false,
			'text'       => true,
		],
	]
] );
