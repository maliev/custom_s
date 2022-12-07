<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package customs
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="apple-touch-icon" sizes="180x180" href="<?= get_template_directory_uri() . '/assets/icons/apple-touch-icon.png' ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= get_template_directory_uri() . '/assets/icons/favicon-32x32.png' ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= get_template_directory_uri() . '/assets/icons/favicon-16x16.png' ?>">
	<link rel="manifest" href="<?= get_template_directory_uri() . '/assets/icons/site.webmanifest' ?>">
	<link rel="mask-icon" href="<?= get_template_directory_uri() . '/assets/icons/safari-pinned-tab.svg' ?>" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<header id="masthead" class="site-header header">
		<div class="container g-0">
			<div class="header__row row">
				<div class="site-branding col-8 col-xl-3">
					<a href="<?= esc_url( site_url() ) ?>" class="custom-logo-link" rel="home">
						<img src="<?= get_template_directory_uri() . '/assets/icons/logo.svg' ?>"
						     width="262" height="80"
						     title="<?php bloginfo( 'name' ) ?>"
						     class="custom-logo" alt="<?php bloginfo( 'name' ) ?>">
					</a>
				</div>
				<div class="header__right col-4 col-xl-9 justify-content-end">
					<?php get_template_part( 'template-parts/main-navigation' ) ?>
				</div>
			</div>
		</div>
	</header><!-- #masthead -->
