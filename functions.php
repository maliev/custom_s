<?php
/**
 * some_clientname functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package some_clientname
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function some_clientname_setup(): void {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Stiftung Forum Recht, use a find and replace
		* to change 'some_clientname' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'some_clientname', get_template_directory() . '/languages' );
	
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	
	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );
	
	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );
	
	//register nav menus
	register_nav_menus(
		[
			'primary' => esc_html__( 'Primary', 'some_clientname-theme' ),
			'social'  => esc_html__( 'Social', 'some_clientname-theme' ),
			'footer'  => esc_html__( 'Footer', 'some_clientname-theme' ),
		]
	);
	
	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		[
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		]
	);
	
	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'some_clientname_custom_background_args',
			[
				'default-color' => 'ffffff',
				'default-image' => '',
			]
		)
	);
	
	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		[
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		]
	);
	
	/**
	 * Register new image sizes
	 */
	add_image_size( 'maxSize', 2560, 9999 );
	add_image_size( 'xxl', 1920, 9999 );
	add_image_size( 'xl', 1440, 9999 );
	add_image_size( 'm', 800, 9999 );
	add_image_size( 's', 600, 600 );
}

add_action( 'after_setup_theme', 'some_clientname_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function some_clientname_content_width(): void {
	$GLOBALS['content_width'] = apply_filters( 'some_clientname_content_width', 640 );
}

add_action( 'after_setup_theme', 'some_clientname_content_width', 0 );

// ******************** START: Requirements  ********************** //
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/custom-enqueue.php';

/**
 * Custom theme functions
 */
require get_template_directory() . '/inc/custom-functions.php';

// ******************** END: Requirements  ********************** //
// ******************** START: ACF Blocks  ********************** //
/**
 * Custom Block Category
 */
function custom_block_categories( $categories ): array {
	
	return array_merge(
		$categories,
		[
			[
				'slug'     => 'custom-blocks',
				'title'    => __( 'Eigene Blöcke' ),
				'icon'     => 'wordpress',
				'position' => 1,
			],
		]
	);
}

add_filter( 'block_categories_all', 'custom_block_categories', 10, 2 );

/** ACF Blocks
 *
 * Every block is registered in one own file.
 */
function register_acf_block_types(): void {
	if ( function_exists( 'acf_register_block_type' ) ) {
		foreach ( glob( get_template_directory() . '/inc/blocks-registrations/*.php' ) as $filename ) {
			include_once $filename;
		}
	}
}

add_action( 'acf/init', 'register_acf_block_types' );
// ******************** END: ACF Blocks  ********************** //