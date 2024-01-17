<?php
/**
 * Accordion Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */
// create class attribute allowing for custom "className" values && adding classes from admin panel if exist
$className = basename( __FILE__, '.php' ) . ( ! empty( $block['className'] ) ? ' ' . $block['className'] : '' );
$blockID   = $block['id'] ?? '';
//frontend
if ( ! is_admin() && $blockID ) : ?>
	<section class="section accordion-flush <?= $className ?>" id="<?= $blockID ?>">
		<?php if ( have_rows( 'accordion__elements' ) ) : ?>
			<div class="accordion__items">
				<?php while ( have_rows( 'accordion__elements' ) ) : the_row();
					$title = get_sub_field( 'accordion__title' );
					$text  = get_sub_field( 'accordion__text' );
					
					if ( ! empty( $title ) && ! empty( $text ) ) :
						$rowIndex = get_row_index(); ?>
						<div class="accordion__item accordion-item">
							<h2 class="accordion__header accordion-header" id="<?= $blockID . 'Heading' . $rowIndex ?>">
								<button class="accordion__button accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $blockID . 'Collapse' . $rowIndex ?>" aria-expanded="true" aria-controls="<?= $blockID . 'Collapse' . $rowIndex ?>">
									<?= $title ?>
								</button>
							</h2>
							<div id="<?= $blockID . 'Collapse' . $rowIndex ?>" class="accordion-collapse collapse" aria-labelledby="<?= $blockID . 'Heading' . $rowIndex ?>">
								<div class="accordion-body">
									<?= $text ?>
								</div>
							</div>
						</div>
					<?php endif;
				endwhile; ?>
			</div>
		<?php endif; ?>
	</section>

<?php
//display preview html & on block hover
elseif ( is_admin() && ( $is_preview ?? '' ) ): $screen = get_current_screen(); ?>
	<img src="<?= get_template_directory_uri() . '/assets/imgs/previews/accordion.jpg' ?>" style="width: 100%; height: auto" alt="Preview of accordion block">
<?php endif;
