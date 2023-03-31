<?php
/**
 * Cards
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
		<?php if ( $blockTitle = get_field( 'cards__block-title' ) ): ?>
			<div class="section__title h2"><?= $blockTitle ?></div>
		<?php endif; ?>
		<?php if ( $desc = get_field( 'cards__block-desc' ) ): ?>
			<div class="section__desc"><?= $desc ?></div>
		<?php endif; ?>
		<div class="row">
			<?php
			// check if the repeater field has rows of data
			if ( have_rows( 'cards__list' ) ) : ?>
				<?php
				// loop through the rows of data
				while ( have_rows( 'cards__list' ) ) : the_row(); ?>
					<div class="cards__item col-md-2 col-lg-4">
						<?= wp_get_attachment_image( get_sub_field( 'cards__list-img' ), 'maxSize', '', [ 'class' => 'cards__img' ] ) ?>
						<?php if ( $itemDesc = get_sub_field( 'cards__list-desc' ) ): ?>
							<div class="section__desc"><?= $itemDesc ?></div>
						<?php endif; ?>
						<?php if ( $itemLink = get_sub_field( 'cards__list-link' ) ): ?>
							<a href="<?= $itemLink['url'] ?>" class="section__item-link" <?= $itemLink['target'] ? 'target="' . $itemLink['target'] . '"' : '' ?>><?= $itemLink['title'] ?></a>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</section>
<?php
//display preview html & on block hover
elseif ( is_admin() && ( $is_preview ?? '' ) ): ?>
	<img src="<?= get_template_directory_uri() . '/assets/imgs/previews/cards.jpg' ?>" style="width: 100%; height: auto" alt="Preview of what the cards custom block">
<?php endif;
