# WordPress starter theme "Clientname" based on [_s](https://github.com/automattic/_s)

### Replace default name "Clientname" pay attention to match all the cases.
- Clientname
- some_clientname
- some-clientname

Run "npm install" to install all dependencies  
Put your fonts to /assets/fonts and add font-face imports to  __font-faces.scss   
Define headlines or body or default paragraph font styles etc. in the __fonts.scss file  
Define bootstrap/hamburger or custom variables

### Dependencies:   
- PHP 8   
- WordPress >= 6.0
- WordPress plugin "Advanced Custom Fields Pro" >= 6
- Node >= v16

All WordPress core blocks except paragraph/spacer & your acf blocks are removed by default, your can add them individually back here:
```
//custom-functions.php
function some_clientname_allowed_block_types( $block_editor_context, $editor_context ): array|bool {
	if ( function_exists( 'acf_get_block_types' ) ) {
		$allowedBlocks = array_keys( acf_get_block_types() );
		//add needed core blocks
		array_push( $allowedBlocks, 'core/spacer', 'core/paragraph' );
		
		return $allowedBlocks;
	}
	
	return $block_editor_context;
}

add_filter( 'allowed_block_types_all', 'some_clientname_allowed_block_types', 10, 2 );
``` 
All local registered custom fields can be stored in your git repository and imported on your live server without having to export/import acf-json file or dabase

https://user-images.githubusercontent.com/76956279/205954107-fc3e412a-853e-45a5-b2b4-beb4fff36d10.mov

