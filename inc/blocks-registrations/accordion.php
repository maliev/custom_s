<?php
// Register a text-img block.
acf_register_block_type( [
	'name'            => 'accordion',
	'title'           => __( 'Accordion' ),
	'description'     => __( 'A custom block: accordion.' ),
	'render_template' => 'template-parts/blocks/accordion.php',
	'mode'            => 'edit',
	'align'           => 'full',
	'category'        => 'content',
	'icon'            => 'editor-ul',
	'keywords'        => [ 'Akkordeon', 'accordion' ],
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
	],
	'enqueue_assets'  => function () {
		if ( ! is_admin() ) {
			wp_enqueue_script( 'customs-accordion-js', filePath( 'accordion.min.js' ), [], fileTimeVersion( 'accordion.min.js' ), true );
		}
	},
] );
