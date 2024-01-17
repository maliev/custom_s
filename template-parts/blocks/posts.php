<?php
/**
 * Posts Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */
// create class attribute allowing for custom "className" values && adding classes from admin panel if exist
$className    = basename( __FILE__, '.php' ) . ( ! empty( $block['className'] ) ? ' ' . $block['className'] : '' );
$postsPerPage = get_field( 'posts__total' );
//wp query
$first_four_posts = new WP_Query( [
	'post_type'      => 'post',
	'posts_per_page' => $postsPerPage ?? 4,
] );

$all_posts = new WP_Query( [
	'post_type'      => 'post',
	'posts_per_page' => - 1,
] );

//pass values to posts script
wp_localize_script( 'customs-posts-js', 'customs_loadmore_params', [
	'restURL'      => rest_url(),
	'restNonce'    => wp_create_nonce( 'wp_rest' ),
	'postsPerPage' => $postsPerPage ?? 4,
] );

//frontend
if ( ! is_admin() ) : ?>
	<section class="section <?= $className ?>">
		<div class="posts__list row">
			<?php while ( $first_four_posts->have_posts() ): $first_four_posts->the_post(); ?>
				<div class="posts__item-wrap fadeIn col-lg-3 col-md-4 col-sm-6 col-12">
					<a class="posts__item" href="<?= get_permalink(get_the_ID()) ?>">
						<?= wp_get_attachment_image( get_post_thumbnail_id(), 'm', '', [ 'class' => 'posts__img' ] ) ?>
						<div class="posts__item-text">
							<time class="posts__date"><?= get_the_date( 'Y-m-d' ) ?></time>
							<div class="posts__item-title"><?= get_the_title() ?></div>
							<?= mb_strimwidth( get_the_excerpt(), 0, 100, '...' ) ?>
						</div>
					</a>
				</div>
			<?php endwhile;
			wp_reset_postdata(); ?>
		</div>
		<?php if ( $all_posts->post_count > $postsPerPage ): ?>
			<div class="button button--loadmore posts__more hide"><?= get_field( 'posts__more-button-text' ) ?></div>
		<?php endif; ?>
	</section>
<?php
//display preview html & on block hover
elseif ( is_admin() && ( $is_preview ?? '' ) ): $screen = get_current_screen(); ?>
	<img src="<?= get_template_directory_uri() . '/assets/imgs/previews/posts.jpg' ?>" style="width: 100%; height: auto" alt="Preview of posts custom block">
<?php endif;
