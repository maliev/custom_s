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
$className = basename( __FILE__, '.php' ) . ( ! empty( $block['className'] ) ? ' ' . $block['className'] : '' );
//frontend
if ( ! is_admin() ) : ?>
	<section class="section <?= $className ?>">
		<div class="container">
			<?php if ( $title = get_field( 'header__title' ) ): ?>
				<h1><?= $title ?></h1>
			<?php endif; ?>
			<?php if ( $paragraph = get_field( 'header__text' ) ): ?>
				<p><?= $paragraph ?></p>
			<?php endif; ?>
			<?php if ( $button = get_field( 'header__button' ) ): ?>
				<a href="<?= $button['url'] ?>" class="button" <?= $button['target'] ? 'target="' . $button['target'] . '"' : '' ?>><?= $button['title'] ?></a>
			<?php endif; ?>
		</div>
	</section>
<?php
//display preview html & on block hover
elseif ( is_admin() && ( $is_preview ?? '' ) ): $screen = get_current_screen(); ?>
	<img src="<?= get_template_directory_uri() . '/assets/imgs/previews/hero.jpg' ?>" style="width: 100%; height: auto" alt="Preview of what the header custom block">
<?php endif;
