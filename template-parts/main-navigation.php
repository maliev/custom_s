<?php if ( has_nav_menu( 'primary' ) ) : ?>
	
	<button id="menu-primary-btn"
	        class="menu-primary-btn menu-primary-toggle hamburger hamburger--arrow d-flex d-xl-none justify-content-center align-items-center position-relative z-1"
	        type="button" aria-controls="menu-primary"
	        aria-expanded="false">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
	</button>
	<nav class="navigation navigation--header">
		<ul class="navigation__list">
			<?php foreach ( getCustomNavigation() as $item ) :
				$is_active = (int) $item['id'] === get_the_ID();
				$itemLink = str_contains( $item['url'], '#' ) && ! is_front_page() ? site_url( $item['url'] ) : $item['url'];
				$itemTitle = $item['title'] ?? false; ?>
				<li class="navigation__item<?= ( $item['classes'] ? '' . $item['classes'] : '' ) . ( $is_active ? ' is--active' : '' ); ?>">
					<a href="<?= $itemLink ?>"
					   class="navigation__link"
					   title="<?= $itemTitle ?>">
						<?= $itemTitle ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</nav>
<?php endif; ?>
