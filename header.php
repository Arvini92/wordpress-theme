<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Popperscores
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
<div id="page" class="site <?php echo get_theme_mod('layout_setting', 'no-sidebar'); ?>">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'popperscores' ); ?></a>

	<?php if(get_header_image()) { ?>
		<header id="masthead" class="site-header" style="background-image: url(<?php header_image(); ?>)">
	<?php } else { ?>
		<header id="masthead" class="site-header">
	<?php } ?>

		<?php // Display site icon or first letter as logo ?>
		<div class="site-logo">
			<?php $site_title = get_bloginfo( 'name' ); ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<div class="screen-reader-text">
					<?php printf( esc_html__('Go to the home page of %1$s', 'popperscores'), $site_title ); ?>
				</div>
				<?php
				if ( has_site_icon() ) {
					$site_icon = esc_url( get_site_icon_url(270)); ?>
					<img class="site-icon" src="<?php echo $site_icon; ?>" alt="">
				<?php } else { ?>
					<div class="site-firstletter" aria-hidden="true">
						<?php echo substr($site_title, 0, 1); ?>
					</div>
				<?php } ?>
			</a>
		</div>

		<div class="site-branding<?php if( is_singular()) { echo ' screen-reader-text'; } ?>">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$popperscores_description = get_bloginfo( 'description', 'display' );
			if ( $popperscores_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $popperscores_description; /* WPCS: xss ok. */ ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'popperscores' ); ?></button>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
				'menu_class'     => 'nav-menu',
			) );
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
