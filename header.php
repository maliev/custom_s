<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package some_clientname
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
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
