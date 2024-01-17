<?php
acf_register_block_type( [
	'name'            => 'call-to-action',
	'title'           => __( 'Call-to-Action' ),
	'description'     => __( 'A custom block: call-to-action.' ),
	'render_template' => 'template-parts/blocks/call-to-action.php',
	'mode'            => 'edit',
	'align'           => 'full',
	'category'        => 'content',
	'icon'            => 'feedback',
	'keywords'        => [ 'cta', 'call-to-action', 'newsletter', 'contact' ],
	'example'         => [
		'attributes' => [
			'mode' => 'preview',
			'data' => [
				'_is_preview' => 'true',
			],
		],
	],
] );

