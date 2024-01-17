<?php
acf_register_block_type( [
	'name'            => 'hero',
	'title'           => __( 'Header/Hero' ),
	'description'     => __( 'A custom block: hero.' ),
	'render_template' => 'template-parts/blocks/hero.php',
	'mode'            => 'edit',
	'align'           => 'full',
	'category'        => 'header',
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

