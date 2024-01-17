<?php
acf_register_block_type( [
	'name'            => 'cards',
	'title'           => __( 'Cards' ),
	'description'     => __( 'A custom block: cards.' ),
	'render_template' => 'template-parts/blocks/cards.php',
	'mode'            => 'edit',
	'align'           => 'full',
	'category'        => 'content',
	'icon'            => 'table-row-after',
	'keywords'        => [ 'Cards', 'tiles', 'img', 'teaser' ],
	'example'         => [
		'attributes' => [
			'mode' => 'preview',
			'data' => [
				'_is_preview' => 'true',
			],
		],
	],
] );


