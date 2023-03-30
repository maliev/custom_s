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
				$childItems = $item['child'] ?? null;
				$itemLink = str_contains( $item['url'], '#' ) && ! is_front_page() ? site_url( $item['url'] ) : $item['url'];
				$itemTitle = $item['title'] ?? false; ?>
				<li class="navigation__item<?= ( $item['classes'] ? '' . $item['classes'] : '' ) . ( $is_active ? ' is--active' : '' ); ?>">
					<a href="<?= $itemLink ?>"
					   class="navigation__link"
					   title="<?= $itemTitle ?>">
						<?= $itemTitle ?>
					</a>
					<?php if ( $childItems ) : ?>
						<ul class="navigation__sublist">
							<?php foreach ( $childItems as $subitem ):
								$subItemID = (int) $subitem['id'] ?? false;
								$subTitle = $subitem['title'] ?? false;
								$subLink = $subitem['url'] ?? false;
								$isChildActive = $subItemID === get_the_ID();
								$itemTarget = $subitem['target'] ?? false; ?>
								<li class="navigation__subitem <?= $isChildActive ? ' is--active' : ''; ?>">
									<a href="<?= $subLink ?>"
									   class="navigation__sublink"
									   title="<?= $subTitle ?>"
									   target="<?= $itemTarget ?>">
										<?= $subTitle; ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>
	</nav>
<?php endif; ?>
