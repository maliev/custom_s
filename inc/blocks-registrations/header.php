<?php
// Register a header/hero block.
acf_register_block_type( [
	'name'            => 'header',
	'title'           => __( 'Header/Hero Block' ),
	'description'     => __( 'A custom block: header.' ),
	'render_template' => 'template-parts/blocks/header.php',
	'mode'            => 'edit',
	'align'           => 'full',
	'category'        => 'custom-blocks',
	'icon'            => 'superhero',
	'keywords'        => [ 'Header', 'Hero' ],
	'supports'        => [ 'multiple' => false ],
	'example'         => [
		'attributes' => [
			'mode' => 'preview',
			'data' => [
				'_is_preview' => 'true',
			],
		],
	],
] );

