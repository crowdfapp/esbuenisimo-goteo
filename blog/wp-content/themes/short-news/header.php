<?php
/**
 * The Header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-template-parts
 *
 * @package Short News
 * @since Short News 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'short-news' ); ?></a>
		
	<header id="masthead" class="site-header" role="banner">
		<?php short_news_header(); ?>
	</header><!-- .site-header -->
	
	<div id="mobile-header" class="mobile-header">
		<div class="mobile-navbar">
			<div class="container">
				<span id="menu-toggle" class="menu-toggle" title="<?php esc_attr_e( 'Menu', 'short-news' ); ?>"><span class="button-toggle"></span></span>
				<?php short_news_search_popup(); ?>
			</div>
		</div>
		<nav id="mobile-navigation" class="main-navigation mobile-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Main Menu', 'short-news' ); ?>"></nav>
	</div>
	
	<?php 
		short_news_featured_posts_area_1();
		short_news_featured_posts_area_2();
	?>
	
	<div id="content" class="site-content">
		<div class="container">
			<div class="site-inner">
