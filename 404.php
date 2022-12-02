<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package some_clientname
 */

get_header();
?>
	
	<main id="primary" class="site-main">
		<section class="error-404 not-found">
			<div class="container">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Seite nicht gefunden.', 'some_clientname' ); ?></h1>
				</header><!-- .page-header -->
			</div>
		</section><!-- .error-404 -->
	</main><!-- #main -->

<?php
get_footer();
