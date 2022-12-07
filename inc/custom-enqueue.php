<?php
/**
 * Update file version, if file updated
 *
 * @param $file
 *
 * @return false|string
 */
function fileTimeVersion( $file ): bool|string {
	$tmp       = explode( '.', $file );
	$folder    = end( $tmp ) . '/';
	$path_file = plugin_dir_path( __DIR__ ) . 'assets/' . $folder . $file;
	
	if ( file_exists( $path_file ) ) :
		return date( 'Ymd-His', filemtime( $path_file ) );
	else :
		return false;
	endif;
}

/**
 * Get file path
 *
 * @param $file
 *
 * @return string
 */
function filePath( $file ): string {
	
	$tmp    = explode( '.', $file );
	$folder = end( $tmp ) . '/';
	
	return ( get_template_directory_uri() . '/assets/' . $folder . $file );
}

function customs_scripts(): void {
	wp_enqueue_style( 'customs-style', filePath( 'main.min.css' ), [], fileTimeVersion( 'main.min.css' ) );
	wp_enqueue_script( 'customs-main-js', filePath( 'main.min.js' ), [], fileTimeVersion( 'main.min.js' ), true );
	wp_enqueue_script( 'customs-slider-js', filePath( 'slider.min.js' ), [], fileTimeVersion( 'slider.min.js' ), true );
}

add_action( 'wp_enqueue_scripts', 'customs_scripts' );
