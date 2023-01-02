<?php
/**
 * Quote Block Template
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */
//create class attribute for main section tag with file name as class && add classes from admin panel if exist
$className = basename( __FILE__, '.php' ) . ( ! empty( $block['className'] ) ? ' ' . $block['className'] : '' );
//add block alignment as class
$alignment = ( !empty( $block['align'] ) ? ( ' is--' . $block['align'] ) : '' );
//front
if ( ! is_admin() ) : ?>
	<section class="section <?= $className ?>">
		<div class="row<?= $alignment ?>">
			<figure class="col-md-6 quote__inner">
				<blockquote><?= get_field( 'quote__text' ); ?></blockquote>
				<?php if ( $src = get_field( 'quote__source' ) ): ?>
					<figcaption><?= $src ?></figcaption>
				<?php endif; ?>
				<?php if ( $btn = get_field( 'quote__button' ) ): ?>
					<a class="button quote__button" href="<?= $btn['url'] ?>"<?= $btn['target'] === '_blank' ? ' target="_blank"' : '' ?>><?= $btn['title'] ?></a>
				<?php endif; ?>
			</figure>
		</div>
	</section>
<?php elseif ( is_admin() && ( $is_preview ?? '' ) ): ?>
	<img src="<?= get_template_directory_uri() . '/assets/imgs/previews/quote.jpg' ?>" style="width: 100%; height: auto" alt="Preview of the quote block">
<?php endif;
