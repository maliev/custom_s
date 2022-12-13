<?php
/**
 * Hero-Video Block Template.
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
	$title = get_field( 'hero-video__title' );
	$paragraph = get_field( 'hero-video__text' );
	$button    = get_field( 'hero-video__button' );
	$video_src = get_field( 'hero-video__video' );
	?>
	<section class="section <?= $className ?>">
		<div class="container">
			<?php if ( ! empty( $paragraph ) ): ?>
				<p><?= $paragraph ?></p>
			<?php endif; ?>
			<?php if ( ! empty( $button ) ): ?>
				<a href="<?= $button['url'] ?? '' ?>" class="button" <?= $button['target'] ? 'target="' . $button['target'] . '"' : '' ?>><?= $button['title'] ?? '' ?></a>
			<?php endif; ?>
			<div class="hero-video__wrap">
					<video class="hero-video__video" loop autoplay muted>
						<source type="video/mp4" src="<?= $video_src['url'] ?>">
					</video>
			</div>
			<h1><?= ! empty( $title ) ? $title : get_the_title() ?></h1>
		</div>
	</section>
<?php
//display preview html & on block hover
elseif ( is_admin() && ( $is_preview ?? '' ) ): $screen = get_current_screen(); ?>
	<img src="<?= get_template_directory_uri() . '/assets/imgs/previews/hero-video.jpg' ?>" style="width: 100%; height: auto" alt="Preview of what the header custom block">
<?php endif;
