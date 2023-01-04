<?php
/**
 * Call-to-Action Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// create class attribute allowing for custom "className" values && adding classes from admin panel if exist
$className     = basename( __FILE__, '.php' ) . ( ! empty( $block['className'] ) ? ' ' . $block['className'] : '' );
$bg           = get_field( 'call-to-action__bg' );
$title        = get_field( 'call-to-action__title' );
$subline      = get_field( 'call-to-action__subline' );
$button       = get_field( 'call-to-action__button' );
//frontend
if ( ! is_admin() ) : ?>
	<section class="section has--background <?= str_replace('call-to-action','cta', $className) ?>">
		<div class="full-width bg--<?= $bg ?>">
			<div class="container cta__inner section__inner">
				<div class="row g-0">
					<div class="col-md-7">
						<div class="cta__left">
							<div class="h2 cta__title"><?= $title ?></div>
							<div class="h3 cta__subline"><?= $subline ?></div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="cta__right">
							<?php if ( $button ): ?>
								<a class="button cta__button" href="<?= $button['url'] ?>" title="<?= $button['title'] ?>" <?= $button['target'] ? 'target="_blank"' : '' ?>"><?= $button['title'] ?></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php
//display preview html & on block hover
elseif ( is_admin() && ( $is_preview ?? '' ) ): ?>
	<img src="<?= get_template_directory_uri() . '/assets/imgs/previews/call-to-action.jpg' ?>" style="width: 100%; height: auto" alt="Preview of what the call-to-action (cta) custom block">
<?php endif;
