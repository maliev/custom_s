<?php

/**
 * Remove unnecessary parts of the admin menu.
 */
function remove_menus(): void {
	remove_menu_page( 'edit-comments.php' );
}

add_action( 'admin_menu', 'remove_menus' );

/**
 * Remove unnecessary elements from admin bar
 */
function my_admin_bar_render(): void {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'comments' ); //Comments
	$wp_admin_bar->remove_menu( 'customize' ); //Customizer
}

add_action( 'wp_before_admin_bar_render', 'my_admin_bar_render' );

/**
 * Get svg icon as inline image.
 *
 * @param string $name
 *
 * @return false|string
 */
function get_svg( string $name = '' ): bool|string {

// Path to img directory in theme.
	$path = get_stylesheet_directory() . '/assets/';


// If string is not empty and icon exists.
	if ( ( $name != '' ) && ( file_exists( $path . $name . '.svg' ) ) ) :

// Load and return the contents of the file
		return file_get_contents( $path . $name . '.svg' );
	
	else:

// Return a blank string if there is nothing.
		return '';
	
	endif;
	
}

/**
 * enable svg support
 *
 * @param $mimes
 *
 * @return mixed
 */
function cc_mime_types( $mimes ): mixed {
	$mimes['svg'] = 'image/svg+xml';
	
	return $mimes;
}

add_filter( 'upload_mimes', 'cc_mime_types' );

/**
 * Disable the emoji's
 */
function disable_emojis(): void {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	
	// Remove from TinyMCE
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}

add_action( 'init', 'disable_emojis' );

/**
 * Filter out the tinymce emoji plugin.
 *
 * @param $plugins
 *
 * @return array
 */
function disable_emojis_tinymce( $plugins ): array {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, [ 'wpemoji' ] );
	} else {
		return [];
	}
}

/**
 * wpml custom language switcher
 */

function my_custom_language_switcher(): string {
	$languages = apply_filters( 'wpml_active_languages', null, [
		'skip_missing' => 0,
	] );
	
	$lang = '';
	
	if ( ! empty( $languages ) ) {
		
		foreach ( $languages as $language ) {
			
			if ( ! $language['active'] ) {
				$lang .= '<a class="lang-link" href="' . esc_url( $language['url'] ) . '">';
				$lang .= '<span>' . esc_html( $language['code'] ) . '</span>';
				$lang .= '</a>';
			}
		}
	}
	
	return $lang;
}

/**
 * Custom navigation
 * @param string $navName
 * default navName is primary
 * @return array
 */

function getCustomNavigation( string $navName = 'primary' ): array {
	$navigationArray = [];
	if ( ( $navLocations = get_nav_menu_locations() ) && isset( $navLocations[ $navName ] ) ) {
		$nav       = wp_get_nav_menu_object( $navLocations[ $navName ] );
		$navElems = wp_get_nav_menu_items( $nav->term_id );
		$mainElemID = 0;
		
		foreach ( (array) $navElems as $navElem ) {
			if ( $navElem->menu_item_parent == 0 ) {
				$mainElemID = $navElem->db_id;
				$navID        = $navElem->object_id;
				$navTitle     = $navElem->title;
				$navUrl       = $navElem->url;
				$navTarget    = $navElem->target;
				$navClasses   = join( ' ', $navElem->classes );
				$navigationArray[] = [
					"id"      => $navID,
					"title"   => $navTitle,
					"classes" => $navClasses,
					"url"     => $navUrl,
					"target"  => $navTarget,
					"child"   => [],
				];
			} else if ( $navElem->menu_item_parent == $mainElemID ) {
				$navID                                        = $navElem->object_id;
				$navTitle                                     = $navElem->title;
				$navUrl                                       = $navElem->url;
				$navTarget                                    = $navElem->target;
				$navClasses                                   = join( ' ', $navElem->classes );
				$parent[ count( $parent ) - 1 ]["child"][] = [
					"id"      => $navID,
					"title"   => $navTitle,
					"classes" => $navClasses,
					"target"  => $navTarget,
					"url"     => $navUrl,
				];
			}
		}
	}
	
	return $navigationArray;
}

/**
 * ACF common option page
 */
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page( [
		'page_title' => 'Optionen',
		'menu_title' => 'Optionen',
		'menu_slug'  => 'options',
	] );
}

/**
 *
 * @return int
 * custom excerpt length
 */
function custom_excerpt_length(): int {
	return 45;
}

add_filter( 'excerpt_length', 'custom_excerpt_length' );

/**
 * @param $more
 *
 * @return mixed|string
 *
 * custom read more link text
 */
function read_more( $more ): mixed {
	if ( is_admin() ) {
		return $more;
	}
	
	return ' ...';
}

add_filter( 'excerpt_more', 'read_more', 99 );

/**
 * @param $text
 *
 * @return mixed|void
 * Allow a tag in the excerpt
 */

function new_wp_trim_excerpt( $text ) {
	$raw_excerpt = $text;
	if ( '' == $text ) {
		$text = get_the_content( '' );
		
		$text = strip_shortcodes( $text );
		
		$text           = apply_filters( 'the_content', $text );
		$text           = str_replace( ']]>', ']]>', $text );
		$text           = strip_tags( $text, '<a>' );
		$excerpt_length = apply_filters( 'excerpt_length', 55 );
		
		$excerpt_more = apply_filters( 'excerpt_more', ' ' . '[ ...]' );
		$words        = preg_split( '/(<a.*?a>)|\n|\r|\t|\s/', $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE );
		if ( count( $words ) > $excerpt_length ) {
			array_pop( $words );
			$text = implode( ' ', $words );
			$text = $text . $excerpt_more;
		} else {
			$text = implode( ' ', $words );
		}
	}
	
	return apply_filters( 'new_wp_trim_excerpt', $text, $raw_excerpt );
	
}

remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
add_filter( 'get_the_excerpt', 'new_wp_trim_excerpt' );

//Remove JQuery migrate
function remove_jquery_migrate( $scripts ): void {
	if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
		$script = $scripts->registered['jquery'];
		
		if ( $script->deps ) { // Check whether the script has any dependencies
			$script->deps = array_diff( $script->deps, [
				'jquery-migrate',
			] );
		}
	}
}

add_action( 'wp_default_scripts', 'remove_jquery_migrate' );

/**
 * Allow only ACF Blocks
 *
 * @param $block_editor_context
 * @param $editor_context
 *
 * @return array|bool
 */
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

/**
 * Wysiwyg formate
 */

/*add_filter( 'tiny_mce_before_init', function ( $settings ) {
	
	$settings['block_formats'] = 'Paragraph=p;H1=h1;H2=h2;H3=h3;H4=h4';
	// make sure we don't override other custom <code>content_css</code> files
	$content_css = get_template_directory_uri() . '/assets/css/editor.min.css';
	if ( isset( $settings['content_css'] ) ) {
		$content_css .= ',' . $settings['content_css'];
	}
	
	$settings['content_css'] = $content_css;
	
	return $settings;
	
} );*/

add_filter( 'acf/fields/wysiwyg/toolbars', 'my_toolbars' );
function my_toolbars( $toolbars ) {
	// Uncomment to view format of $toolbars
	
	/*echo '<pre>';
		print_r($toolbars);
	echo '</pre>';
	die;*/
	
	
	// Add a new toolbar called "Custom Toolbar"
	// - this toolbar has only 1 row of buttons
	$toolbars['Custom Toolbar']       = [];
	$toolbars['Custom Toolbar'][1]    = [ 'formatselect', 'bold', 'underline', 'link', 'bullist', 'superscript' ];
	$toolbars['Header Toolbar']       = [];
	$toolbars['Header Toolbar'][1]    = [ 'formatselect', 'bold', 'underline', 'italic' ];
	
	// Edit the "Full" toolbar and remove 'code'
	// - delet from array code from http://stackoverflow.com/questions/7225070/php-array-delete-by-value-not-key
	if ( ( $key = array_search( 'code', $toolbars['Full'][2] ) ) !== false ) {
		unset( $toolbars['Full'][2][ $key ] );
	}
	
	// remove the 'Basic' toolbar completely
	unset( $toolbars['Basic'] );
	
	// return $toolbars - IMPORTANT!
	return $toolbars;
}


function custom_excerpt( $blockText, $length = 300 ) {
	if ( strlen( $blockText ) <= $length ) {
		return $blockText;
	} else {
		$new = wordwrap( $blockText, $length );
		$new = explode( "\n", $new );
		
		return $new[0] . ' ...';
	}
}


/**
 * Get ID of the first ACF block on the page
 */
function getFirstBlockID() {
	$post = get_post();
	
	if ( has_blocks( $post->post_content ) ) {
		$blocks            = parse_blocks( $post->post_content );
		$first_block_attrs = $blocks[0]['attrs'];
		
		if ( array_key_exists( 'id', $first_block_attrs ) ) {
			return $first_block_attrs['id'];
		}
	}
	
	return false;
}

/**
 * Add style for Admin Menu Post type and icons, theme settings
 **/
/*function custom_admin_style(): void {
	wp_enqueue_style( 'my-admin-style', get_template_directory_uri() . '/assets/css/admin-styles.min.css' );
}
add_action( 'admin_enqueue_scripts', 'custom_admin_style' );*/


/**
 *
 * Get gutenberg block data by content and acf blockName
 *
 * @param $content
 * @param $blockName
 *
 * @return false|mixed
 */
function getBlockDataByName( $content, $blockName ): mixed {
	$blocks = parse_blocks( $content );
	
	if ( $blocks ) {
		foreach ( $blocks as $block ) {
			if ( ( 'acf/' . $blockName ) === $block['blockName'] ) {
				return $block['attrs']['data'];
			}
		}
	}
	
	return false;
}

/**
 * Render post content without core paragraph block
 *
 * @return void
 */
function blocksNoParagraph(): void {
	global $post;
	$blocks = parse_blocks( $post->post_content );
	
	if ( $blocks ) {
		foreach ( $blocks as $block ) {
			if ( ! ( ( 'core/paragraph' ) === $block['blockName'] ) ) {
				echo render_block( $block );
			}
		}
	}
}


/*** Change authorlink for seo
 * @return string|null
 */
function changeAuthorLink(): ?string {
    return home_url( 'about' );
}
add_filter( 'author_link', 'changeAuthorLink' );

/**  Redirect Author page to about page
 * @return void
 */
function redirect_author_archive(): void {
  if(!is_admin() && is_author()) {
    wp_redirect(home_url('about'));
    exit();
  }
}
add_action('template_redirect', 'redirect_author_archive');
