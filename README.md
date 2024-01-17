# WordPress starter theme "CustomS" based on [_s](https://github.com/automattic/_s) 
<img src="screenshot.png" width="500"/>  

### Installation
Run "npm install" to install all dependencies  
Put your fonts to /assets/fonts and add font-face imports to  __font-faces.scss   
Define headlines or body or default paragraph font styles etc. in the __fonts.scss file  
Define bootstrap/hamburger or custom variables
Now you can run your npm build/watcher ```npm run build``` or ```npm run watch```

### Dependencies:   
- PHP 8   
- WordPress >= 6.0
- WordPress plugin "Advanced Custom Fields Pro" >= 6
- Node >= v16

All WordPress core blocks except paragraph (for the ability to copy&paste blocks) & your acf blocks are removed by default, you can add them individually back here:
```
//custom-functions.php
function customs_allowed_block_types( $block_editor_context, $editor_context ): array|bool {
	if ( function_exists( 'acf_get_block_types' ) ) {
		$allowedBlocks = array_keys( acf_get_block_types() );
		//add needed core blocks
		array_push( $allowedBlocks, 'core/spacer', 'core/paragraph' );
		
		return $allowedBlocks;
	}
	
	return $block_editor_context;
}

add_filter( 'allowed_block_types_all', 'customs_allowed_block_types', 10, 2 );
``` 
All local registered custom fields can be stored in your git repository and imported on your live server without having to export/import acf-json file or dabase

https://user-images.githubusercontent.com/76956279/205954107-fc3e412a-853e-45a5-b2b4-beb4fff36d10.mov



### Install wp plugins from predefined text file with your must have plugin list !!!wp-cli is required  
- Define pluginlist in the pluginlist.txt
- run the command: ```wp plugin install $(<"pluginlist.txt") --allow-root --activate```
- to update all your plugins: ```wp plugin update --all```

