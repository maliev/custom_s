<?php
/**
 * Header/Hero Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */
// create class attribute allowing for custom "className" values && adding classes from admin panel if exist
$className     = basename( __FILE__, '.php' ) . ( ! empty( $block['className'] ) ? ' ' . $block['className'] : '' );
//frontend
if ( ! is_admin() ) :
	$title = get_field( 'hero__title' );
	$paragraph = get_field( 'hero__text' );
	$button    = get_field( 'hero__button' );
	$imgID     = get_field( 'hero__image' );
	?>
	<section class="section <?= str_replace('header', 'hero', $className) ?>">
		<div class="full-width">
			<div class="hero__inner">
				<div class="container">
					<div class="row">
						<div class="<?= $imgID ? 'col-md-6' : '' ?>">
							<h1><?= ! empty( $title ) ? $title : get_the_title() ?></h1>
							<?php if ( ! empty( $paragraph ) ): ?>
								<p><?= $paragraph ?></p>
							<?php endif; ?>
							<?php if ( ! empty( $button ) ): ?>
								<a href="<?= $button['url'] ?? '' ?>" class="button" <?= $button['target'] ? 'target="' . $button['target'] . '"' : '' ?>><?= $button['title'] ?? '' ?></a>
							<?php endif; ?>
						</div>
						<?php if ( $imgID ): ?>
							<div class="col-md-6">
								<?= wp_get_attachment_image( $imgID, 'm' ) ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php
//display preview html & on block hover
elseif ( is_admin() && ( $is_preview ?? '' ) ): $screen = get_current_screen(); ?>
	<img src="<?= get_template_directory_uri() . '/assets/imgs/previews/hero.jpg' ?>" style="width: 100%; height: auto" alt="Preview of what the header custom block">
<?php endif;
