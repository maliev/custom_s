<?php
/**
 * Gallery Block
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */

// Create class attribute allowing for custom "className" values.
$className   = basename( __FILE__, '.php' ) . ( ! empty( $block['className'] ) ? ' ' . $block['className'] : '' );
$images      = get_field( 'gallery__images' );
//frontend
if ( ! is_admin() && ! empty( $images ) ) : ?>
	<section class="fade-in section <?= $className . ' ' . ( count( $images ) <= 1 ? 'is--image' : '' ) ?>">
		<?php if ( $title = get_field( 'gallery__title' ) ): ?>
			<div class="h2 section__title"><?= $title ?></div>
		<?php endif; ?>
		<div class="row gallery__row">
			<div class="col-lg-8">
				<div class="gallery__slider-wrapper">
					<div class="gallery__slider-init">
						<div class="swiper-wrapper">
							<!-- Slides -->
							<?php foreach ( $images as $image ): ?>
								<div class="slider__item swiper-slide">
									<div class="slider__img-wrap">
										<?php if ( isset( $image['id'] ) ): ?>
											<?= wp_get_attachment_image( $image['id'], 'xl', '', [ 'class' => 'gallery__img' ] ); ?>
										<?php endif; ?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="gallery__navigation-wrap">
					<div class="gallery__navigation">
						<div class="gallery__nav-button swiper-button-prev">
							<?= get_svg( 'icons/arrow-left' ) ?>
						</div>
						<div class="gallery__nav-button swiper-button-next">
							<?= get_svg( 'icons/arrow-right' ) ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php
//display preview html & on block hover
elseif ( is_admin() && ( $is_preview ?? '' ) ): ?>
	<img src="<?= get_template_directory_uri() . '/assets/imgs/previews/gallery.png' ?>" style="width: 100%; height: auto" alt="Preview of gallery custom block">
<?php endif;
