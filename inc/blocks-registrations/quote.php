<?php
acf_register_block_type( [
	'name'            => 'quote',
	'title'           => __( 'Quote' ),
	'discription'     => __( 'A custom block: quote' ),
	'render_template' => 'template-parts/blocks/quote.php',
	'mode'            => 'edit',
	'category'        => 'content',
	'icon'            => 'format-quote',
	'keywords'        => [ 'Quote' ],
	'example'         => [
		'attributes' => [
			'mode' => 'preview',
			'data' => [
				'_is_preview' => 'true',
			],
		],
	],
	'supports'        => [
		'align' => [ 'left', 'right', 'center', 'wide', 'full' ],
		'color' => [
			'background' => false,
			'gradients'  => false,
			'text'       => true,
		],
	],
] );
