<?php
acf_register_block_type( [
	'name'            => 'hero-slider',
	'title'           => __( 'Hero-Slider' ),
	'description'     => __( 'A custom block: hero-slider.' ),
	'render_template' => 'template-parts/blocks/hero-slider.php',
	'mode'            => 'edit',
	'align'           => 'full',
	'category'        => 'header',
	'icon'            => 'slides',
	'keywords'        => [ 'Header', 'Hero', 'slider', 'img', 'top', 'gallery' ],
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

