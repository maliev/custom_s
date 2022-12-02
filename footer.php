<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package some_clientname
 */

?>

<footer id="colophon" class="footer site-footer">
	<div class="site-info">
		<div class="container">
			<div class="footer__inner">
				<div class="footer__navigation">
					<?php if ( has_nav_menu( 'footer' ) ) : ?>
						<nav class="navigation navigation--footer">
							<ul class="navigation__list">
								<?php foreach ( getCustomNavigation( 'footer' ) as $item ): ?>
									<li class="navigation__item <?= $item['classes']; ?>">
										<a href="<?= $item['url']; ?>"
										   class="navigation__link"
										   target="<?= $item['target'] ?>" title="<?= $item['title']; ?>">
											<?= $item['title']; ?>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</nav>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
