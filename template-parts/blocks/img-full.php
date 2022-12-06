<?php
/**
 * Image (full size)
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */

// Create class attribute allowing for custom "className" values.
$className = basename( __FILE__, '.php' ) . ( ! empty( $block['className'] ) ? ' ' . $block['className'] : '' );
//frontend
if ( ! is_admin() ) : ?>
	<section class="section <?= $className ?>">
		<div class="full-width">
			<div class="section__inner img-full__img-wrap">
				<?= wp_get_attachment_image( get_field( 'img-full__img' ), 'maxSize', '', [ 'class' => 'img-full__img' ] ) ?>
			</div>
		</div>
	</section>
<?php
//display preview html & on block hover
elseif ( is_admin() && ( $is_preview ?? '' ) ): ?>
	<img src="<?= get_template_directory_uri() . '/assets/imgs/previews/img.jpg' ?>" style="width: 100%; height: auto" alt="Preview of what the image full size custom block">
<?php endif;
