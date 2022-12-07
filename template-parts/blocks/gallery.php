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
$className = basename( __FILE__, '.php' ) . ( ! empty( $block['className'] ) ? ' ' . $block['className'] : '' );
$images    = get_field( 'gallery__images' );
//frontend
if ( ! is_admin() ) : ?>
	<section class="section <?= $className . ' ' . ( count( $images ) <= 1 ? 'is--image' : '' ) ?>">
		<div class="row g-0">
			<div class="section__inner col-md-10 offset-md-1">
				<?php if ( $title = get_field( 'gallery__title' ) ): ?>
					<div class="h2 section__title"><?= $title ?></div>
				<?php endif; ?>
				<div class="slider__init-wrapper">
					<div class="slider__navigation">
						<div class="slider__button swiper-button-prev"></div>
						<div class="slider__button swiper-button-next"></div>
					</div>
					<div class="swiper-wrapper">
						<!-- Slides -->
						<?php if ( $images ): ?>
							<?php foreach ( $images as $image ):  ?>
								<div class="slider__item swiper-slide">
									<div class="slider__img-wrap">
										<?= wp_get_attachment_image( $image['id'], 'full', '', [ 'class' => 'slider__img' ] ); ?>
										<div class="slider__caption"><?= wp_get_attachment_caption( $image['id'] ); ?></div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php
//display preview html & on block hover
elseif ( is_admin() && ( $is_preview ?? '' ) ): ?>
	<img src="<?= get_template_directory_uri() . '/assets/imgs/previews/gallery.jpg' ?>" style="width: 100%; height: auto" alt="Preview of what the image full size custom block">
<?php endif;
