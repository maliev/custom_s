<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package customs
 */

?>

<section class="no-results not-found">
	<div class="container">
		<header class="page-header">
			<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'customs' ); ?></h1>
		</header><!-- .page-header -->
		
		<div class="page-content">
			<?php if ( is_search() ) : ?>
				<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'customs' ); ?></p>
			<?php else : ?>
				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'customs' ); ?></p>
			<?php endif; ?>
		</div><!-- .page-content -->
	</div>
</section><!-- .no-results -->
