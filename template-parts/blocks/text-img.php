<?php
/**
 * Text-Image Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */

// Create class attribute allowing for custom "className" values.
$className = basename( __FILE__, '.php' ) . ( ! empty( $block['className'] ) ? ' ' . $block['className'] : '' );
$alignment = get_field( 'text-img__alignment' );
$link      = get_field( 'text-img__more-link' );
$ID = get_the_ID();
if ( ! is_admin() ) : ?>
	<section class="section has--background <?= $className ?> is--<?= $alignment ?> text-img">
		<div class="full-width">
			<div class="text-img__inner">
				<div class="container">
					<div class="row g-0">
						<div class="text-img__row <?= $alignment !== 'img-text' ? 'offset-md-1 col-md-11' : 'col-md-12' ?>">
							<div class="row">
								<div class="col-md-5 text-img__item text-img__img-wrap <?= $alignment !== 'img-text' ? 'offset-md-1' : '' ?>">
									<?php if ( $link ): ?>
									<a href="<?= $link['url'] ?>" class="text-img__link">
										<?php endif; ?>
										<?= wp_get_attachment_image( get_field( 'text-img__img' ), 'xl', '', [ 'class' => 'text-img__img' ] ) ?>
										<?php if ( $link ): ?>
									</a>
								<?php endif; ?>
								</div>
								<div class="col-md-5 text-img__item text-img__text-wrap show-content-links <?= $alignment === 'img-text' ? 'offset-md-1' : '' ?>">
									<div class="h3 text-img__title"><?= get_field( 'text-img__title' ) ?></div>
									<div class="text-img__text p-default"><?= get_field( 'text-img__text' ) ?></div>
									<?php if ( $link ): ?>
										<a href="<?= $link['url'] ?>" class="button button--grey text-img__button" <?= $link['target'] ? 'target="_blank"' : '' ?>><?= $link['title'] ?></a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php elseif ( is_admin() && ( $is_preview ?? '' ) ): ?>
	<h2><?= get_field('text-img__name', $ID) ?></h2>
	<img src="<?= get_template_directory_uri() . '/assets/imgs/previews/text-img.jpg' ?>" style="width: 100%; height: auto" alt="Preview of what the text-img custom block">
<?php endif;
