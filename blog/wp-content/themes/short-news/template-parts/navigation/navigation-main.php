<?php
/**
 * Displays main navigation
 *
 * @package Short News
 * @since Short News 1.0
 */

?>

	<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Main Menu', 'short-news' ); ?>">
		<?php 
			wp_nav_menu( array( 
				'theme_location' => 'main_menu', 
				'menu_id' => 'main-menu', 
				'menu_class' => 'main-menu', 
				'container' => false,
				'fallback_cb' => 'short_news_fallback_menu'
				) ); 
		// Main Menu ?>
	</nav>
	